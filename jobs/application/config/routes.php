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
$route['login'] = "user/login/login";
$route['logout'] = "user/login/logout";
$route['post-job'] = "welcome/postjob";
$route['job-listing/(:any)/(:any)'] = "home/job_listing/$1/$2";
$route['search-result'] = "home/search_result";
$route['job-detail/(:any)'] = "home/job_detail/$1";
$route['candidate-listing'] = "home/candidate_listing";
$route['about-us'] = "home/about_us";
$route['contact'] = "home/contact";
$route['pricing'] = "home/pricing";
$route['employer-listing'] = "home/employer_listing";
$route['employer-detail/(:any)'] = "home/employer_detail/$1";
$route['forgot-password'] = "user/login/forgot_password";
$route['reset-password/(:any)'] = "user/login/reset_password/$1";
$route['privacy-policy'] = "home/privacy_policy";
$route['term-and-conditions'] = "home/term_and_conditions";
$route['faq'] = "home/faq";

$route['profile'] = "dashboard/profile";
$route['jobseeker-profile'] = "dashboard/jobseeker_profile";
$route['subscription'] = "dashboard/subscription";
$route['change-password'] = "dashboard/change_password";
$route['my-jobs'] = "dashboard/my_jobs";
$route['update-post/(:any)'] = "dashboard/update_jobpost/$1";
$route['applied-job'] = "dashboard/applied_job";
$route['applicant-list'] = "dashboard/applicant_list";
$route['jobseeker-list'] = "dashboard/jobseeker_list";
$route['jobseeker-resume/(:any)'] = "user/user_dashboard/view_jobseekerresume/$1";
$route['notification'] = "user/user_dashboard/notification";
$route['help'] = "user/user_dashboard/help";
$route['favorite-job'] = "user/user_dashboard/favorite_job";
$route['shortlist-job'] = "user/user_dashboard/shortlist_job";

$route['unsubscribe/(:any)'] = "home/unsubscribe/$1";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//ADMIN URL
$route['admin'] = 'admin/login/index';
$route['admin/dashboard'] = 'admin/login/dashboard';
$route['admin/profile'] = 'admin/login/profile';
$route['admin/template'] = 'admin/email_template';
$route['admin/service'] = 'admin/manage_home/services';
$route['admin/our-service'] = 'admin/manage_home/our_services';
$route['admin/sent-mail'] = 'admin/mailer/sent_mail';
$route['admin/resend/(:any)'] = 'admin/mailer/resend/$1';
$route['admin/employers'] = 'admin/tableList/Employers';
$route['admin/employers/view/(:any)'] = 'admin/tableList/Employers/view/$1';
$route['admin/jobseekers'] = 'admin/tableList/jobseekers';
$route['admin/jobseekers/view/(:any)'] = 'admin/tableList/jobseekers/view/$1';
$route['admin/subscribers'] = 'admin/tableList/subscribers';
$route['admin/add-use-template/(:any)'] = 'admin/email_template/add_use_template/$1';
$route['admin/about-us'] = 'admin/manage_home/aboutus';
$route['admin/jobs'] = 'admin/tableList/jobs';
$route['admin/jobs/view/(:any)'] = 'admin/tableList/jobs/view/$1';
$route['admin/applied-jobs'] = 'admin/tableList/applied_jobs';
$route['admin/orders'] = 'admin/tableList/orders';
$route['admin/orders/view/(:any)'] = 'admin/tableList/orders/view/$1';
