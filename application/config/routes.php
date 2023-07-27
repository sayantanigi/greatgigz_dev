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
$route['default_controller'] = 'landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['projects'] = "home/index";
$route['projects/register'] = "home/signup";
$route['projects/login'] = "home/login_page";
$route['projects/logout'] = "user/login/logout";
$route['projects/forgot-password'] = "user/login/forgot_password";
$route['projects/new-password/(:any)'] = "user/login/new_password/$1";
$route['projects/about-us'] = "home/about";
$route['projects/contact-us'] = "home/contact";
$route['projects/pricing'] = "home/pricing";
$route['projects/vendor_pricing'] = "home/vendor_pricing";
$route['projects/freelancer_pricing'] = "home/freelancer_pricing";
$route['projects/privacy-policy'] = "home/privacy";
$route['projects/term-and-conditions'] = "home/term_and_conditions";
$route['projects/employees_list/(:any)'] = "Welcome/employees_list/$1";
$route['projects/employer-list'] = "home/employer_list";
$route['projects/employerdetail/(:any)'] = "Welcome/employer_detail/$1";
$route['projects/workers-list'] = "home/workers_list";
$route['projects/worker-detail/(:any)'] = "home/worker_detail/$1";
$route['projects/ourjobs'] = "home/our_jobs";
$route['projects/postdetail/(:any)'] = "home/post_bidding/$1";
$route['stripe/(:any)'] = "Stripe/index/$1";
$route['projects/career-tip/(:any)'] = "home/career_tip/$1";
$route['save'] = "user/login/reg";
$route['validate'] = "user/login/validate_user";
$route['projects/logout'] = "user/login/logout";
$route['projects/profile'] = "user/dashboard/profile";
$route['projects/subscription'] = "user/dashboard/subscription";
$route['projects/myservice'] = "user/dashboard/myservice";
$route['projects/myjob'] = "user/dashboard/myjob";
$route['projects/dashboard'] = "user/dashboard/index";
$route['projects/postjob'] = "welcome/post_job";
$route['projects/search-job'] = "welcome/searchjob";
$route['projects/addservice'] = "user/dashboard/service_form";
$route['projects/jobbid'] = "user/dashboard/jobbid";
$route['projects/calender'] = "user/dashboard/calender";
$route['projects/chat'] = "user/dashboard/chat";
$route['projects/video'] = "user/dashboard/video_call";
$route['projects/password-reset'] = "user/dashboard/change_password";
$route['projects/education-list'] = "user/dashboard/education_list";
$route['projects/add-education'] = "user/dashboard/add_education";
$route['projects/update-education/(:any)'] = "user/dashboard/update_education/$1";
$route['projects/workexperience-list'] = "user/dashboard/workexperience_list";
$route['projects/add-workexperience'] = "user/dashboard/add_workexperience";
$route['projects/update-workexperience/(:any)'] = "user/dashboard/update_workexperience/$1";

//ADMIN URL
$route['projects/admin'] = 'admin/login/index';
$route['projects/admin/logout'] = 'admin/login/logout';
$route['projects/admin/dashboard'] = 'admin/login/dashboard';
$route['projects/admin/profile'] = 'admin/login/profile';
$route['projects/admin/category'] = 'admin/category';
$route['projects/admin/sub_category'] = 'admin/sub_category';
$route['projects/admin/specialist'] = 'admin/specialist';
$route['projects/admin/banner'] = 'admin/manage_home/Banner/index';
$route['projects/admin/manage_cms'] = 'admin/manage_cms/index';
$route['projects/admin/post_job'] = 'admin/post_job/index';
$route['projects/admin/chat'] = 'admin/chat/index';
$route['projects/admin/payment'] = 'admin/payment/index';
$route['projects/admin/jobsbidding'] = 'admin/jobsbidding/index';
$route['projects/admin/subscription'] = 'admin/subscription/index';
$route['projects/admin/users'] = 'admin/users/index';
$route['projects/admin/our-services'] = 'admin/manage_home/Our_services/index';
$route['projects/admin/company-logo'] = 'admin/manage_home/Company_logo/index';
$route['projects/admin/career'] = 'admin/manage_home/Career_tips/index';
$route['projects/admin/email-template'] = 'admin/Email_template/index';
