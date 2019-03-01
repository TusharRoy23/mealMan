<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	if (!function_exists('isUserLoggedIn')) {
	    function isUserLoggedIn() {
	        $CI = & get_instance();
	        $CI->load->library('session');
	        if ($CI->session->has_userdata('user_info')) {
	        	return TRUE;
	         
	        } else {
	            return FALSE;
	        }
	    }
	}

	if (!function_exists('userStorageData')) {

	    function userStorageData() {
	        $CI = & get_instance();
	        $CI->load->library('session');

	        if (isUserLoggedIn()) {
	            if (isUserLoggedIn()) {
	                $storagedata = array(
	                    'id' => $CI->session->userdata['user_info'][0]['id'],
	                    'firstname' => $CI->session->userdata['user_info'][0]['firstName'],
	                    'lastname' => $CI->session->userdata['user_info'][0]['lastName'],
	                    'username' => $CI->session->userdata['user_info'][0]['username'],
	                    'email' => $CI->session->userdata['user_info'][0]['email'],
	                    'profile_photo' => $CI->session->userdata['user_info'][0]['photo'],
	                    'creation_date' => $CI->session->userdata['user_info'][0]['creationDate'],
	                    'profileId' => $CI->session->userdata['user_info'][0]['profileId'],
	                    'userCustomId' => $CI->session->userdata['user_info'][0]['userCustomId'],
	                    'profileCustomId' => $CI->session->userdata['user_info'][0]['profileCustomId']
	                );
	            }
	            return (object) $storagedata;
	        } else
	            return FALSE;
	    }
	}

	if (!function_exists('dbResultCheck')) {
		function dbResultCheck($array)
		{
			$CI = & get_instance();
			$CI->load->model('Index_model', 'index');

			if ($array['db'] == 'newsFeedsLikes') {
				$condition = array(
					'feedID' => $array['feedID'],
					'profileID' => userStorageData()->profileId,
					'status' => 1
				);

				$exist = $CI->index->getByCon('newsFeedsLikes', $condition);
				if ($exist) {
					return TRUE;
				}
				else
					return FALSE;
			}
			elseif ($array['db'] == 'newsFeedsComments') {
				
			}
		}
	}

	if (!function_exists('getTableId')) {
		function getTableId($customId, $tableName)
		{
			$CI = & get_instance();
			$CI->load->model('Index_model', 'index');

			$tableId = $CI->index->getTableId($customId, $tableName);
			if ($tableId) {
				return $tableId->id;
			}
			else
				return 0;
		}
	}
?>