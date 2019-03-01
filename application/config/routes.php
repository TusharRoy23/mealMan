<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//** Landing Page **\\
$route['default_controller'] = 'index';
//** Login, Register, Logout **\\
$route['Login'] = 'index/login_check';
$route['LoggedIn'] = 'index/login_attempt';
$route['Register'] = 'index/registration_attempt';
$route['Registration'] = 'index/get_register';
$route['Logout'] = 'index/get_logout';

//** Dashboard **\\
$route['Dashboard'] = 'index/logged_dashboard';
$route['PostDiagram'] = 'dashboard/post_get_add';
$route['Post-likes'] = 'index/postGetChoice';
$route['Dashboard-Image'] = "dashboard/upload";
$route['Dashboard-Image-Remove'] = "dashboard/remove";
$route['Dashboard-File'] = "dashboard/upload_files";
$route['Dashboard-File-Remove'] = "dashboard/remove_files";
$route['Dashboard-Post-Delete'] = "dashboard/set_post_delete";
$route['Dashboard-Post-Edit/(:any)'] = "dashboard/set_post_edit/$1";
$route['Dashboard-Edit-Image'] = "dashboard/get_uploaded_images";

$route['PostDiagram-Edit'] = 'dashboard/post_get_edit';

//** Friends **\\
$route['Friend-board'] = 'friends/index';
$route['Unfollow-user'] = 'friends/popUpUser';

//** Profile **\\
$route['Profile'] = 'friends/myself';
$route['Profile-edit'] = 'friends/update_myself';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
