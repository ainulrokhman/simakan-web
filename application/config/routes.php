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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'auth/index';
$route['checklogin'] = 'auth/checklogin';
$route['logout'] = 'auth/logout';

//planing
$route['planing'] = 'planing/index';
$route['planing/add'] = 'planing/addangket';
$route['planing/save'] = 'planing/saveangket';
$route['planing/delete/(:any)'] = 'planing/deleteangket/$1';
$route['planing/detail/(:any)'] = 'planing/detailangket/$1';
$route['planing/saveresponden'] = 'planing/saveresponden';
$route['planing/savequestion'] = 'planing/savequestion';
$route['planing/update'] = 'planing/updateangket';
$route['planing/deletequestion/(:any)'] = 'planing/deletequestion/$1';

//organizing
$route['organizing'] = 'organizing/index';
$route['organizing/detail/(:any)'] = 'organizing/detail/$1';
$route['organizing/result/(:any)'] = 'organizing/result/$1';

//actuating
$route['actuating'] = 'actuating/index';

//siswa
$route['siswa'] = 'siswa/index';
$route['siswa/add'] = 'siswa/addsiswa';
$route['siswa/save'] = 'siswa/savesiswa';
$route['siswa/detail/(:any)'] = 'siswa/detailsiswa/$1';
$route['siswa/delete/(:any)'] = 'siswa/deletesiswa/$1';

//guru
$route['guru'] = 'guru/index';
$route['guru/add'] = 'guru/addguru';
$route['guru/save'] = 'guru/saveguru';
$route['guru/delete/(:any)'] = 'guru/deleteguru/$1';

//profile
$route['profile'] = 'auth/profile';
$route['profile/update'] = 'auth/updateprofile';
$route['profile/changepassword'] = 'auth/changepassword';
$route['profile/updatepassword'] = 'auth/updatepassword';
?>