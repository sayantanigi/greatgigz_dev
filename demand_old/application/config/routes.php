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
$route['default_controller'] = 'welcome'; 
$route['404_override'] = 'welcome/error_page';
$route['translate_uri_dashes'] = TRUE;

/*------------FrontEnd Routes----------*/
$route['auth-number'] = 'welcome/auth_number';
$route['provider-auth'] = 'welcome/prov_auth';
$route['provider-list'] = 'welcome/provider_list';
$route['provider-not-found'] = 'welcome/search_provider'; 
$route['create-profile'] = 'welcome/create_profile';
$route['edit-profile'] = 'welcome/edit_profile';

$route['forgot-password'] = 'welcome/forget_password';

$route['about'] = 'welcome/about'; 
$route['privacy-policy'] = 'welcome/privacy';
$route['terms-and-conditions'] = 'welcome/terms';
$route['career'] = 'welcome/career';
$route['logout'] = 'welcome/sign_out';
$route['service'] = 'welcome/service';
$route['opportunity'] = 'welcome/opportunity';
$route['house-is-possible'] = 'welcome/h_possible';
$route['faq'] = 'welcome/faq';
$route['contact'] = 'welcome/contact';
$route['search'] = 'welcome/search';
$route['service-detail/(:any)'] = 'welcome/service_detail/$1';

$route['newsdetails/(:any)'] = 'welcome/newsdetails/$1';
$route['forgot_password'] = 'welcome/forgot_password';

/*---------------Pages-----------------*/
$route['pages/(:any)'] = 'pages/index/$1';

/*------------Admin Routes------------*/
$route['admin'] = 'admin/users';
$route['dashboard'] = 'admin/dashboard/index';

