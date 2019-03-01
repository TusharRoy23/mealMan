<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friends extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$sql = "SELECT * FROM profiles JOIN mutualUsers ON mutualUsers.mutualID = profiles.id WHERE mutualUsers.profileID = ".userStorageData()->profileId." AND mutualUsers.status = 1 AND profiles.status = 1";
		$data['mutual_friends'] = $this->index->getByQuery($sql);

		$nonsql = "SELECT * FROM profiles INNER JOIN mutualUsers ON mutualUsers.mutualID = profiles.id WHERE mutualUsers.mutualID NOT IN (SELECT mutualID FROM mutualUsers WHERE profileID = ".userStorageData()->profileId.") OR mutualUsers.mutualID IN (SELECT mutualID FROM mutualUsers WHERE profileID = ".userStorageData()->profileId." AND  mutualUsers.mutualID NOT IN (SELECT mutualID FROM mutualUsers WHERE mutualUsers.status = 1 AND profileID = ".userStorageData()->profileId.")) AND profiles.status = 1  GROUP BY profiles.id ";
		
		$data['only_users'] = $this->index->getByQuery($nonsql);


		$data['contents'] = array("friends/friends_board_view");
		$this->load->view('common/landing_template', $data);
	}

	public function myself()
	{
		$sql = "SELECT * FROM profiles JOIN users ON users.id = profiles.userID WHERE profiles.userID = ".userStorageData()->profileId;
		$data['profile'] = $this->index->getByQuery($sql);
		if ($data['profile']) {
			$data['contents'] = array("profile/own_profile_view");
			$this->load->view('common/landing_template', $data);
		}
	}

	public function update_myself()
	{
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[3]|max_length[12]');
			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');

			if ($this->form_validation->run() == FALSE) {
				echo FALSE;
			} else {
				$imgLink = 'profileImage_'. userStorageData()->profileId .'_'.rand().'.png';
				$config['upload_path'] = "./userDir/profileImage/";
	          	$config['allowed_types'] = 'jpg|png|jpeg';
	          	$config['max_size'] = 2048000;

	          	$config['max_width']  = 2500;
	          	$config['max_height']  = 2500;
			  	$config['file_name'] = $imgLink ;
	          	$this->load->library('upload', $config);

	          	//$this->upload->data();
	          	if ($this->upload->do_upload('imageFile')) {
	          		$arr = array(
	          			'photo' => "userDir/profileImage/".$imgLink,
	          			'firstName' => $this->input->post('firstname'),
	          			'lastName' => $this->input->post('lastname'),
	          			'email' => $this->input->post('email')
	          		);
	          		$where = array(
	          			'id' => userStorageData()->profileId
	          		);
	          		$update = $this->index->updateData('profiles', $where, $arr);
	          		if ($update) {
	          			echo TRUE;
	          		} 
	          		else {
	          			echo FALSE;
	          		}

	          	} else {
	          		$arr = array(
	          			'firstName' => $this->input->post('firstname'),
	          			'lastName' => $this->input->post('lastname'),
	          			'email' => $this->input->post('email')
	          		);
	          		$where = array(
	          			'id' => userStorageData()->profileId
	          		);
	          		$update = $this->index->updateData('profiles', $where, $arr);
	          		if ($update) {
	          			echo TRUE;
	          		} 
	          		else {
	          			echo FALSE;
	          		}
	          	}
			}
		
	}

	public function popUpUser()
	{
		$profileID = $this->input->post('profileID');

		if ($profileID) {
			$con = array(
				'status' => 1,
				'profileID' => userStorageData()->profileId,
				'mutualID' => $profileID
			);

			$tableID = $this->index->getSingleData('mutualUsers', $con, '', 'id', 'DESC');

			if ($tableID) {
				$sql = "UPDATE mutualUsers SET status = 0, deactivationDate = now() WHERE id = ".$tableID->id;
				$success = $this->index->updateQuery($sql);
				if ($success) {
					echo "true";
				}
				else
					echo "false";
			}
			else{
				$arr = array(
					'profileID' => userStorageData()->profileId,
					'mutualID' => $profileID
				);

				$success = $this->index->saveData('mutualUsers', $arr);
				if ($success) {
					echo $profileID;
				}
				else
					echo '0';
			}

			
		}
	}
}

/* End of file Friends.php */
/* Location: ./application/controllers/Friends.php */