<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'front/welcome'; // default
$route['admin'] = 'admin/admin'; // to remove one admin
$route['admin/classes/(:num)'] = 'admin/classes/index/$1'; // for index remove
$route['admin/user/(:num)'] = 'admin/user/index/$1';
$route['admin/(:any)'] = 'admin/$1'; // for all admin pages
$route['admin/adminLogout'] = 'admin/admin/adminLogout'; // for admin logout
$route['adminLogin'] = 'adminLogin'; // login for admin
$route['adminLogin/(:any)'] = 'adminLogin/$1'; // any url from Admin Login
$route['404_override'] = ''; // error page redirection

$route['pages/(:any)'] = 'front/welcome/index/$1'; // for all front pages
$route['(:any)'] = 'front/welcome/$1'; // for all front pages

/* End of file routes.php */
/* Location: ./application/config/routes.php */
