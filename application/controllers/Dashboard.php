<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
	}

	public function post_get_add()
	{
		if (!$this->input->post('description')){
			echo 'Validation FALSE';
		}
		else{
			$newsFeeds = array(
				'description' => $this->input->post('description'),
				'profileID' => userStorageData()->profileId,
				'customId' => md5(rand().userStorageData()->profileId)
			);

			$feedID = $this->index->saveData('newsFeeds', $newsFeeds);

			if ($feedID) {
				if ($this->input->post('images') && $this->input->post('type')) {
					//$imageUpload = $this->uploads($_FILES['files'], $feedID);
					$imageUpload = $this->uploads($this->input->post('images'), $feedID, $this->input->post('type'));
				}
				elseif ($this->input->post('files') && $this->input->post('type')) {
					$fileUpload = $this->uploads($this->input->post('files'), $feedID, $this->input->post('type'));
				}

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
						WHERE newsFeeds.status = 1 AND newsFeeds.profileID IN (SELECT mutualID FROM mutualUsers WHERE profileID = '".userStorageData()->profileId."' AND status = 1) AND newsFeeds.id = ".$feedID;

				$feeds = $this->index->getSingleByQuery($sql);
				$str =''; $j = 0;
				if ($feeds) {
					echo json_encode($feeds);
				}
				else
					echo 'News Feed FALSE';
			}
		}
	}

	public function post_get_edit()
	{
		if (!$this->input->post('description')) {
			echo 'Validation FALSE';
		}
		else{
			$feedID = getTableId($this->input->post('feedID'), 'newsFeeds');

			if ($this->input->post('type')) {
				if ($this->input->post('type') == 1) {
					if ($this->input->post('files')) {
						$arr = $this->input->post('files');

						$sql = "UPDATE newsFeeds SET description = '".$this->input->post('description')."', files = '".json_encode($arr)."', fileType = ".$this->input->post('type')." WHERE id = ".$feedID;

						$success = $this->index->updateQuery($sql);
					}
				}
				elseif ($this->input->post('type') == 2) {
					if ($this->input->post('files')) {
						$arr = $this->input->post('files');

						$sql = "UPDATE newsFeeds SET description = '".$this->input->post('description')."', files = '".json_encode($arr)."', fileType = ".$this->input->post('type')." WHERE id = ".$feedID;

						$success = $this->index->updateQuery($sql);
					}
				}
				
				else
					$success = 1;
				
	        	
	        	if ($success) {
					echo json_encode($arr);
				}
				else
					echo FALSE;
			}
			else{
				if ($feedID) {
					$sql = "UPDATE newsFeeds SET description = '".$this->input->post('description')."', files = '', fileType = 1 WHERE id = ".$feedID;

					$success = $this->index->updateQuery($sql);

					if ($success) {
						echo TRUE;
					}
					else
						echo FALSE;
				}
			}
		}
	}

	public function uploads($fileOrImages, $feedID, $type)
	{
		//
				$fileArr = array();
				// $config['upload_path'] = "./userDir/postImages/";
	   //        	$config['allowed_types'] = 'jpg|png|jpeg';
	   //        	$config['max_size'] = 2048000;

	   //        	$config['max_width']  = 2500;
	   //        	$config['max_height']  = 2500;
			 //  	//$config['file_name'] = $imgLink ;
	   //        	$this->load->library('upload', $config);

	   //        	if ($files['name']) {
	   //        		foreach ($files['name'] as $key => $imageLink) {
	   //        			// $_FILES['files[]']['name']= $files['name'][$key];
			 //           //  $_FILES['files[]']['type']= $files['type'][$key];
			 //           //  $_FILES['files[]']['tmp_name']= $files['tmp_name'][$key];
			 //           //  $_FILES['files[]']['error']= $files['error'][$key];
			 //           //  $_FILES['files[]']['size']= $files['size'][$key];

			 //            $fileName = 'postImage_'. userStorageData()->profileId .'_'.rand().'.png';

			 //            $fileArr[] = 'userDir/postImages/'. $fileName;
			 //            $config['file_name'] = $fileName;
    //         			$this->upload->initialize($config);

    //         			if ($this->upload->do_upload('files[]')) {
			 //                $this->upload->data();

			 //            } else {
			 //                return false;
			 //            }
	   //        		}

	   //        		$sql = "UPDATE newsFeeds SET files = '".json_encode($fileArr)."' WHERE id = ".$feedID;
	   //        		$success = $this->index->updateQuery($sql);

	   //        		if ($success) {
	   //        			return $fileArr;
	   //        		} else {
	   //        			return FALSE;
	   //        		}
	   //        	} 
	   //        	else {
	   //        		return FALSE;
	   //        	}
	    
	    if ($fileOrImages) {
	    	$sql = "UPDATE newsFeeds SET files = '".json_encode($fileOrImages)."', fileType = ".$type." WHERE id = ".$feedID;
	        $success = $this->index->updateQuery($sql);

	        if ($success) {
	          	return $fileOrImages;
	        } else {
	          	return FALSE;
	        }
	    }
	    else
	    	return FALSE;
	}

	public function upload() {
	    if (!empty($_FILES))
		{
			// $exists = is_file("./userDir/postImages/".$_FILES['file']['name']);
			if ($_FILES['file']['name']) {
				$config["upload_path"]   = "./userDir/postImages/";
				$config["allowed_types"] = "gif|jpg|png";
				$config["file_name"] = 'postImage_'. userStorageData()->profileId .'_'.rand().'.png';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload("file")) {
					echo 0;
				}
				else{
				    echo 'userDir/postImages/'. $config["file_name"];
				}
			}
			else
				echo 0;
		}
    }

    public function upload_files()
    {
    	if (!empty($_FILES)) {
    		$config["upload_path"]   = "./userDir/postFiles/";
			$config["allowed_types"] = "doc|docx|ppt|xls|pdf|odt|ods|odp|ppt|pptx";
			$exp = explode(".", $_FILES['file']['name']);
			$ex = $exp[1];
			$config["file_name"] = 'postFile_'. userStorageData()->profileId .'_'.rand().'.'.$ex;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload("file")) {
				echo "failed to upload file(s)";
			}
			else{
			    echo 'userDir/postFiles/'. $config["file_name"];
			}
    	}
    }

    public function remove()
	{
		$file = $this->input->post("file");
		if ($file && file_exists("./userDir/postImages/".$file)) {
			unlink("./userDir/postImages/". $file);
			echo TRUE;
		}
		else
			echo FALSE;
	}

	public function remove_files()
	{
		$file = $this->input->post("file");
		if ($file && file_exists("./userDir/postFiles/".$file)) {
			unlink("./userDir/postFiles/". $file);
		}
	}

	public function list_files()
	{
		$this->load->helper("file");
		$files = get_filenames("./userDir/postImages/");
		// we need name and size for dropzone mockfile
		foreach ($files as &$file) {
			$file = array(
				'name' => $file,
				'size' => filesize("./userDir/postImages" . "/" . $file)
			);
		}

		header("Content-type: text/json");
		header("Content-type: application/json");
		echo json_encode($files);
	}

	public function set_post_delete()
	{
		if ($this->input->post('feedID')) {
			$feedID = getTableId($this->input->post('feedID'), 'newsFeeds');
			if ($feedID) {
				$success = $this->index->inactiveById('newsFeeds', $feedID);
				if ($success) {
					echo TRUE;
				}
				else
					echo FALSE;
			}
		}
		else
			echo FALSE;
	}

	public function set_post_edit($customFeedId='')
	{
		if ($customFeedId) {
			$feedID = getTableId($customFeedId, 'newsFeeds');
			if ($feedID) {
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
						WHERE newsFeeds.status = 1 AND newsFeeds.profileID IN (SELECT mutualID FROM mutualUsers WHERE profileID = '".userStorageData()->profileId."' AND status = 1) AND newsFeeds.id = ".$feedID;

				$feeds = $this->index->getSingleByQuery($sql);
				if ($feeds) {
					$data['feeds'] = $feeds;
					$data['contents'] = array("dashboard_post_edit_view");
					$this->load->view('common/landing_template', $data);
				}
			}
			else
				redirect(base_url('Logout'));
		}
		else{
			redirect(base_url('Logout'));
		}
	}
	
	public function get_uploaded_images()
	{
		if ($this->input->post('feedID') && $this->input->post('type')) {
			$sql = "SELECT files FROM newsFeeds WHERE customId = '".$this->input->post('feedID')."' AND fileType = ".$this->input->post('type');
			$feeds = $this->index->getSingleByQuery($sql);

			if ($feeds) {
				$files = json_decode($feeds->files);
				$last = end($files);

				if (!$last) {
					array_pop($files);
				}
				
				$result  = array();
 				
 				if ($this->input->post('type') == 1) {
 					$uploadPath = scandir("./userDir/postImages");
 				}
 				else{
 					$uploadPath = scandir("./userDir/postFiles");
 				}

 				$ds = DIRECTORY_SEPARATOR; 

				if ($files)
				{
				 	for($i = 0; $i < sizeof($files); $i++)
				 	{
				 		$exp = explode("/", $files[$i]);
				 		

				 		if ($uploadPath) {
				 			foreach ($uploadPath as $key)
				 			{
				 				if ( '.'!=$key && '..'!=$key)
				 				{
				 					if ($exp[2] == $key) {
				 						$obj['name'] = $key;
					 					$obj['size'] = filesize($files[$i]);
					 					$result[] = $obj;
				 					}
				 				}
				 			}
				 		} 
				 	}
				}
			    echo json_encode($result);
			}
		}
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */