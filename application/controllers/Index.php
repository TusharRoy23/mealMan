<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->session->keep_flashdata('message');
	}

	public function index()
	{
		$data['contents'] = array("common/landing_board");
		$this->load->view('common/landing_template', $data);
	}

	public function login_check()
	{
		$data['contents'] = array("common/login");
		$this->load->view('common/landing_template', $data);
	}

	public function registration_attempt()
	{
		$data['contents'] = array("common/register");
		$this->load->view('common/landing_template', $data);
	}

	public function get_register()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[2]|max_length[20]');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[2]|max_length[20]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('common/header');
				$data['contents'] = array("common/register");
				$this->load->view('common/landing_template', $data);
				$this->load->view('common/footer');
			} else {
				$users = array(
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'customId' => md5(rand())
				);

				$user_id = $this->index->saveData('users', $users);
				if ($user_id) {
					$profiles = array(
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'userID' => $user_id,
						'customId' => md5(rand())
					);
					$profile_id = $this->index->saveData('profiles', $profiles);
					if ($profile_id) {
						$mutualUser = array(
							'profileID' => $profile_id,
							'mutualID' => $profile_id,
							'customId' => md5(rand())
						);
						$success = $this->index->saveData('mutualUsers', $mutualUser);

						if ($success) {
							$this->session->set_flashdata('message', 'Welcome '. $this->input->post('firstname'));
							redirect('Login');
						} else {
							echo "Failed";
						}
						
					} else {
						redirect('Register');
					}
					
				} else {
					redirect('Register');
				}
				
			}
		}
		else
			echo "Not";
	}

	public function login_attempt()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]');

			if ($this->form_validation->run() == FALSE) {
				$data['contents'] = array("common/login");
				$this->load->view('common/landing_template', $data);
			} 
			else {
				$sql = "SELECT *, profiles.id as profileId, profiles.customId as profileCustomId, users.customId as userCustomId  FROM users JOIN profiles ON profiles.userID = users.id where username = '".$this->input->post('username')."' AND password = '".md5($this->input->post('password'))."'";

				$user_info = $this->index->getByQuery($sql);

				if ($user_info) {
					$array = array(
						'user_info' => $user_info
					);
					$this->session->set_userdata( $array );
					redirect('Dashboard');
				} else {
					$this->session->set_flashdata('message', 'Username/Password is not exists !');
					redirect('Login');
				}
				
			}
		} else {
			
		}
	}

	public function logged_dashboard()
	{
		if (userStorageData()->profileId) {

			$sql = "SELECT newsFeeds.id as newsFeedsId, 
									newsFeeds.description as newsFeedsDescription,
									newsFeeds.creationDate as newsFeedsCreationDate,
									newsFeeds.files as newsFeedsFiles,
									newsFeeds.profileID as newsFeedsProfileId,
									newsFeeds.likes as likes,
									newsFeeds.fileType as fileType,
									newsFeeds.customId as newsFeedCustomId,
									newsFeedsComments.profileID as newsFeedsCommentsProfileId,
									newsFeedsComments.description as newsFeedsCommentsDescription,
									newsFeedsComments.files as newsFeedsCommentsFiles,
									newsFeedsComments.creationDate as newsFeedsCommentsCreationDate,
									profiles.firstName as firstname, profiles.lastName as lastname,
									profiles.photo as profilePic,
									profiles.customId as profileCustomId
					FROM newsFeeds 
					LEFT JOIN newsFeedsComments ON newsFeeds.id = newsFeedsComments.feedID 
					INNER JOIN profiles ON profiles.id = newsFeeds.profileID
					WHERE newsFeeds.status = 1 AND newsFeeds.profileID IN (SELECT mutualID FROM mutualUsers WHERE profileID = '".userStorageData()->profileId."' AND status = 1) GROUP BY newsFeeds.id ORDER BY newsFeeds.id DESC";



			$data['feeds'] = $this->index->getByQuery($sql);

			$data['contents'] = array("dashboard_view", "common/modal_view");
			$this->load->view('common/landing_template', $data);				
		} 
		else {
						
		}
		
	}

	public function postGetChoice()
	{
		$customFeedID = $this->input->post('feedID');
		$feedID = getTableId($customFeedID, 'newsFeeds');

		$array = array(
			'feedID' => $feedID,
			'profileID' => userStorageData()->profileId,
			'status' => 1
		);

		$liked = $this->index->getSingleData('newsFeedsLikes', $array, '', 'id', 'DESC');

		if ($liked) {
			$update_array = array(
				'status' => 0
			);

			$sql = "UPDATE newsFeedsLikes SET status = 0 WHERE id = ".$liked->id;
			$update = $this->index->updateQuery($sql);

			$rsql = "UPDATE newsFeeds SET likes = likes - 1 WHERE id = ".$feedID;
			$update = $this->index->updateQuery($rsql);

			if($update){
				$getLike = $this->index->getByCon('newsFeeds', array('id' => $feedID, 'status' => 1));
				$arr = array('likes' => $getLike->likes, 'sts' => 'false');
				echo json_encode($arr);
			}
			else
				echo FALSE;
		}
		else{
			$sql = "UPDATE newsFeeds SET likes = likes + 1 WHERE id = ".$feedID;
			$insert = $this->index->saveData('newsFeedsLikes', $array);

			if ($insert) {
				$update = $this->index->updateQuery($sql);
				if($update){
					$getLike = $this->index->getByCon('newsFeeds', array('id' => $feedID, 'status' => 1));
					$arr = array('likes' => $getLike->likes, 'sts' => 'true');
					echo json_encode($arr);
				}
				else
					echo FALSE;
			}
		}
	}

	public function get_logout()
	{
		$this->session->unset_userdata('user_info');
		redirect('Login');
	}
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */