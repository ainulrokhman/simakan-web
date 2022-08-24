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
$route['seller'] = 'seller/index';
$route['logout'] = 'auth/logout';

//app
$route['about'] = 'about/index';
$route['updateapp'] = 'about/updatedata';

//product
$route['product'] = 'product/index';
$route['addproduct'] = 'product/addproduct';
$route['saveproduct'] = 'product/saveproduct';
$route['editproduct/(:any)'] = 'product/editproduct/$1';
$route['updateproduct'] = 'product/updateproduct';
$route['deleteproduct/(:any)'] = 'product/deleteproduct/$1';
$route['productstatus/(:any)'] = 'product/productstatus/$1';

//news
$route['news'] = 'news/index';
$route['addnews'] = 'news/addnews';
$route['savenews'] = 'news/savenews';
$route['editnews/(:any)'] = 'news/editnews/$1';
$route['updatenews'] = 'news/updatenews';
$route['deletenews/(:any)'] = 'news/deletenews/$1';
$route['newsstatus/(:any)'] = 'news/newsstatus/$1';

//promo
$route['promo'] = 'promo/index';
$route['addpromo'] = 'promo/addpromo';
$route['savepromo'] = 'promo/savepromo';
$route['editpromo/(:any)'] = 'promo/editpromo/$1';
$route['updatepromo'] = 'promo/updatepromo';
$route['deletepromo/(:any)'] = 'promo/deletepromo/$1';
$route['promostatus/(:any)'] = 'promo/promostatus/$1';

//work
$route['work'] = 'work/index';
$route['addwork'] = 'work/addwork';
$route['savework'] = 'work/savework';
$route['editwork/(:any)'] = 'work/editwork/$1';
$route['updatework'] = 'work/updatework';
$route['deletework/(:any)'] = 'work/deletework/$1';
$route['workstatus/(:any)'] = 'work/workstatus/$1';

//sallary
$route['sallary'] = 'sallary/index';
$route['addsallary'] = 'sallary/addsallary';
$route['savesallary'] = 'sallary/savesallary';
$route['editsallary/(:any)'] = 'sallary/editsallary/$1';
$route['updatesallary'] = 'sallary/updatesallary';
$route['deletesallary/(:any)'] = 'sallary/deletesallary/$1';
$route['sallarystatus/(:any)'] = 'sallary/sallarystatus/$1';

//payment
$route['payment'] = 'payment/index';
$route['addpayment'] = 'payment/addpayment';
$route['savepayment'] = 'payment/savepayment';
$route['editpayment/(:any)'] = 'payment/editpayment/$1';
$route['updatepayment'] = 'payment/updatepayment';
$route['deletepayment/(:any)'] = 'payment/deletepayment/$1';
$route['paymentstatus/(:any)'] = 'payment/paymentstatus/$1';

//location
$route['location'] = 'location/index';
$route['province'] = 'location/province';
$route['saveprovince'] = 'location/saveprovince';
$route['updateprovince'] = 'location/updateprovince';
$route['editprovince/(:any)'] = 'location/editprovince/$1';
$route['deleteprovince/(:any)'] = 'location/deleteprovince/$1';

$route['city'] = 'location/city';
$route['editcity/(:any)'] = 'location/editcity/$1';
$route['savecity'] = 'location/savecity';
$route['updatecity'] = 'location/updatecity';
$route['deletecity/(:any)'] = 'location/deletecity/$1';

$route['district'] = 'location/district';
$route['editdistrict/(:any)'] = 'location/editdistrict/$1';
$route['savedistrict'] = 'location/savedistrict';
$route['updatedistrict'] = 'location/updatedistrict';
$route['deletedistrict/(:any)'] = 'location/deletedistrict/$1';


//admin
$route['admin'] = 'admin/index';
$route['saveadmin'] = 'admin/saveadmin';
$route['deleteadmin/(:any)'] = 'admin/deleteadmin/$1';
$route['resetpassword/(:any)'] = 'admin/resetpassword/$1';
$route['profile'] = 'admin/profile';
$route['changepassword'] = 'admin/changepassword';
$route['updateprofile'] = 'admin/updateprofile';
$route['updatepassword'] = 'admin/updatepassword';

//user
$route['user'] = 'user/index';
$route['deleteuser/(:any)'] = 'user/deleteuser/$1';
?>