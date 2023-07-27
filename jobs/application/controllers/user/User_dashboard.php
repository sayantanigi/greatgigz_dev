<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('commonUser')) {
            redirect(base_url('login'));
        }
        $this->load->model('Post_job_model');
        $this->load->model('Users_model');
    }

  function update_password()
	{
		$get_user = $this->Crud_model->get_single('users', "userId='" .$_SESSION['commonUser']['userId'] . "' and status='1'");

		if ($get_user->password == md5($_POST['cur_password'])) {
			$data = array(
				'password' => md5($_POST['new_password']),
			);
			$this->Crud_model->SaveData('users', $data, "userId='" . $_SESSION['commonUser']['userId'] . "'");
			$this->session->set_flashdata('message', 'password Reset Successfully !');
			echo "1";
		} else {
			echo "0";
		}
	}

 ////////////////////////////  stat post job ////////////////////////////////

 public function update_postjob()
  {
    if($_FILES['company_logo']['name']!='')
      {
                $_POST['company_logo']= rand(11111,99999)."_".$_FILES['company_logo']['name'];
                $config2['image_library'] = 'gd2';
                $config2['source_image'] =  $_FILES['company_logo']['tmp_name'];
                $config2['new_image'] =   getcwd().'/uploads/company_logo/'.$_POST['company_logo'];
                $config2['upload_path'] =  getcwd().'/uploads/company_logo/';
                $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
                $config2['maintain_ratio'] = FALSE;

                $this->image_lib->initialize($config2);

                if(!$this->image_lib->resize())
                {
                    echo('<pre>');
                    echo ($this->image_lib->display_errors());
                    exit;
                }
                else{
                  $image  = $_POST['company_logo'];
                   @unlink('uploads/company_logo/'.$_POST['old_logo']);
                }
      }

        else{
             $image  = $_POST['old_logo'];
      }

      $job_title = $this->input->post('job_title',TRUE);
            if (empty($job_title) || $job_title == '') {
                $job_title =$this->input->post('job_title');
            }
            $slug = strtolower(url_title($job_title));
            $slug_url =$this->Post_job_model->get_unique_url($slug);
    $data=array(
      'user_id'=>$_SESSION['commonUser']['userId'],
      'category_id'=>$_POST['category_id'],
       'skill_id' =>implode(',', $_POST['skill_id']),
      'job_email'=>$_POST['job_email'],
      'job_title'=>$job_title,
      'job_type'=>$_POST['job_type'],
      'job_tags'=>$_POST['job_tags'],
      'description'=>$_POST['description'],
      'featured_job'=>$_POST['featured_job'],
      'application_email_url'=>$_POST['application_email_url'],
      'minimum_rate'=>$_POST['minimum_rate'],
      'maximum_rate'=>$_POST['maximum_rate'],
        'location'=>$_POST['location'],
      'latitude'=>$_POST['latitude'],
      'longitude'=>$_POST['longitude'],
      'minimum_salary'=>$_POST['minimum_salary'],
      'maximum_salary'=>$_POST['maximum_salary'],
      'hours_per_week'=>$_POST['hours_per_week'],
      'company_name'=>$_POST['company_name'],
      'address'=>$_POST['address'],
      'company_email'=>$_POST['company_email'],
      'company_phone'=>$_POST['company_phone'],
      'website'=>$_POST['website'],
      'company_logo'=>$image,
      'facebbok'=>$_POST['facebbok'],
      'twitter'=>$_POST['twitter'],
      'linked_in'=>$_POST['linked_in'],
      'google'=>$_POST['google'],
      'post_slug_url'=>$slug_url,
      'employer_subscription_id'=>$_POST['employer_subscription_id'],
    );
    $this->Crud_model->SaveData('postjob',$data,"id='".$_POST['id']."'");
    $this->session->set_flashdata('message', 'Post Job updated Successfully !');
  redirect(base_url("my-jobs"));

  }
  function delete_post($id)
	{

		$this->Crud_model->DeleteData('postjob', "id='".$id."'");
		$this->session->set_flashdata('message', 'Post deleted successfully !');
		redirect(base_url('my-jobs'));
	}

  ////////////////////////// end post job ///////////////////////////////////

  //////////////// start applicant list functionality/////////////////////

     function view_jobseekerresume($slug_url)
  {
    $cond="applied_jobs.slug_url='".$slug_url."'";
    $data['get_appliedjob']=$this->Users_model->get_jobseeker_resume($cond);
   $data['get_user']=$this->Crud_model->get_single('users',"userId='".$data['get_appliedjob']->user_id."' and status='1'");
   $data['get_category']=$this->Crud_model->get_single('category',"id='".$data['get_user']->category_id."'");
    $data['list_education']=$this->Crud_model->GetData('user_education','',"user_id='".$data['get_user']->userId."'");
    $data['list_workexperience']=$this->Crud_model->GetData('user_workexperience','',"user_id='".$data['get_user']->userId."'");
     $this->load->view('common/header');
    $this->load->view('user/jobseeker/jobseeker_resume',$data);
    $this->load->view('common/footer');
  }

  function delete_applicant()
    {

     $get_data=$this->Crud_model->get_single('applied_jobs', "appliedjob_id ='".$_POST['id']."'");
     if(!empty($get_data->resume) && file_exists('uploads/jobseeker_resume/'.$get_data->resume))
     {
      @unlink('uploads/jobseeker_resume/'.$get_data->resume);
     }
      $this->Crud_model->DeleteData('applied_jobs', "appliedjob_id ='".$_POST['id']."'");
      $this->session->set_flashdata('message', 'Applicant deleted successfully !');
      echo "1"; exit;
    }

  //////////////// end applicant list functionality/////////////////////

  function notification()
  {
    $update_notification=array(
      'status'=>0,
    );
    $this->Crud_model->SaveData('notification',$update_notification,"user_id ='".$_SESSION['commonUser']['userId']."'");
    $cond="notification.user_id='".$_SESSION['commonUser']['userId']."'";
    $data['get_notification']=$this->mymodel->list_notification($cond);
     $this->load->view('common/header');
    $this->load->view('user/notification',$data);
    $this->load->view('common/footer');
  }

 function help()
 {
   $data['get_user']=$this->Crud_model->get_single('users',"userId='".$_SESSION['commonUser']['userId']."' and status='1'");
    $data['settings']=$this->Crud_model->get_single('settingss');
    $this->load->view('common/header');
   $this->load->view('user/help',$data);
   $this->load->view('common/footer');
 }

 function favorite_job()
 {
   $cond="fav.user_id='".$_SESSION['commonUser']['userId']."'";
   $data['list_favoritejob']=$this->mymodel->get_favoritejob($cond);
    $this->load->view('common/header');
   $this->load->view('user/jobseeker/favorite_job',$data);
   $this->load->view('common/footer');
 }
 function Delete_favoritejob($id)
 {
   $this->Crud_model->DeleteData('favorite_jobs',"id='".$id."'");
     $this->session->set_flashdata('message', 'Job deleted successfully !');
   redirect(base_url('favorite-job'));
 }
 function shortlist_job()
  {
    $data['get_user']=$this->Crud_model->get_single('users',"userId='".$_SESSION['commonUser']['userId']."' and status='1'");
    $con="applied.user_id='".$_SESSION['commonUser']['userId']."' and applied.job_status!='pending'";
    $data['list_shortlistjob']=$this->mymodel->get_shortlist_jobs($con);
     $this->load->view('common/header');
    $this->load->view('user/jobseeker/shortlist_job',$data);
    $this->load->view('common/footer');
  }

  function purchase_subscription()
  {
    
    $get_subscription=$this->Crud_model->get_single('subscription',"id='".$_POST['subscription_id']."'");
    $effectiveDate = strtotime("+".$get_subscription->subscription_duration." months", strtotime(date("Y-m-d")));
$end_date = date("Y-m-d", $effectiveDate); 
    $data=array(
      'employer_id'=>$_SESSION['commonUser']['userId'],
      'subscription_id'=>$_POST['subscription_id'],
      'no_of_post'=>$get_subscription->no_of_post,
      'start_date'=>$get_subscription->subscription_duration,
      'end_date'=>$end_date,
      'payment_status'=>'succeeded',
      'amount'=>$get_subscription->subscription_amount,
      'payment_date'=>date('Y-m-d h:i:s'),
      'created_date'=>date('Y-m-d h:i:s'),
    );
    $this->Crud_model->SaveData('employer_subscription',$data);
    $get_user=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userId='".$_SESSION['commonUser']['userId']."' and status='1'",'','','','1');
     $this->load->library('email');
                  $data=array(
                          'name'=>$get_user->firstname.' '.$get_user->lastname,
                          'email'=>base64_encode($get_user->email),
                        
                          );

  $htmlContent = $this->load->view('email_template/subscription',$data,TRUE);
      $config = array(
    	'protocol' => 'ssmtp',
		'smtp_host' => 'ssl://ssmtp.googlemail.com',
		'smtp_port' => 587,
		'smtp_user' => 'no-reply@phillyhire.com',
		'smtp_pass' => 'o6,V%19+!Jo1',
		'smtp_crypto' => 'security',
		'mailtype' => 'html',
		'smtp_timeout' => '4',
		'charset' => 'iso-8859-1',
		'wordwrap' => TRUE
  );

  $this->email->initialize($config);
  $this->email->from('no-reply@phillyhire.com','Phillyhire');
  $this->email->to($get_user->email);
  $this->email->subject('Subscription Confirmation message from Phillyhire');
  $this->email->message($htmlContent);
  $this->email->send();
    echo "1"; exit;

  }

    function cancel_subscription()
  {
    $data=array(
      'payment_date'=>date('Y-m-d h:i:s'),
      'created_date'=>date('Y-m-d h:i:s'),
    );
     $this->Crud_model->SaveData('employer_subscription',$data,"id='".$_POST['id']."'");
    echo "1"; exit;
  }

   function renew_subscription()
  {
    $get_subscription=$this->Crud_model->get_single('subscription',"id='".$_POST['subscription_id']."'");
    $effectiveDate = strtotime("+".$get_subscription->subscription_duration." months", strtotime(date("Y-m-d")));
$end_date = date("Y-m-d", $effectiveDate); 
    $data=array(
      'employer_id'=>$_SESSION['commonUser']['userId'],
      'subscription_id'=>$_POST['subscription_id'],
      'no_of_post'=>$get_subscription->no_of_post,
      'start_date'=>$get_subscription->subscription_duration,
      'end_date'=>$end_date,
      'payment_date'=>date('Y-m-d h:i:s'),
      'created_date'=>date('Y-m-d h:i:s'),
    );
    $this->Crud_model->SaveData('employer_subscription',$data);
    echo "1"; exit;
  }
  
  function applied_changestatus()
  {
    $get_data = $this->Crud_model->get_single('applied_jobs', "appliedjob_id='".$_POST['appliedjob_id']."'");
     $get_user=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userId='".$get_data->user_id."' and status='1'",'','','','1');
    $get_user1=$this->Crud_model->GetData('users','userId,email',"userId='".$_SESSION['commonUser']['userId']."' and status='1'",'','','','1');
    if ($get_data->job_status == 'pending') {
      $data1 = array(
        'job_status'=>'shortlist',
      );
      $this->Crud_model->SaveData('applied_jobs',$data1,"appliedjob_id ='".$_POST['appliedjob_id']."'");
         $notification=array(
      'user_id'=>$get_data->user_id,
      'job_id'=>$get_data->job_id,
      'created_date'=>date('Y-m-d H:i:s'),
    );
     $this->Crud_model->SaveData('notification',$notification);
     $this->load->library('email');
                  $data=array(
                          'name'=>$get_user->firstname.' '.$get_user->lastname,
                        'email'=>base64_encode($get_user->email),
                          );

  $htmlContent = $this->load->view('email_template/shortlist_job',$data,TRUE);
      $config = array(
      'protocol' => 'ssmtp',
    'smtp_host' => 'ssl://ssmtp.googlemail.com',
    'smtp_port' => 587,
    'smtp_user' => 'no-reply@phillyhire.com',
    'smtp_pass' => 'o6,V%19+!Jo1',
    'smtp_crypto' => 'security',
    'mailtype' => 'html',
    'smtp_timeout' => '4',
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
  );
    $recipientArr = array($get_user1->email,$get_user->email);
  $this->email->initialize($config);
  $this->email->from('no-reply@phillyhire.com','Phillyhire');
  $this->email->to($recipientArr);
  $this->email->subject('Shortlisting for job Confirmation message from Phillyhire');
  $this->email->message($htmlContent);
  $this->email->send();
     
    }
    if ($get_data->job_status == 'shortlist') {
      $data1 = array(
        'job_status'=>'finalselected',
      );
      $this->Crud_model->SaveData('applied_jobs',$data1,"appliedjob_id ='".$_POST['appliedjob_id']."'");
         $notification1=array(
      'user_id'=>$get_data->user_id,
      'job_id'=>$get_data->job_id,
      'created_date'=>date('Y-m-d H:i:s'),
    );
     $this->Crud_model->SaveData('notification',$notification1);
     $this->load->library('email');
                  $data=array(
                          'name'=>$get_user->firstname.' '.$get_user->lastname,
                        'email'=>base64_encode($get_user->email),
                          );

  $htmlContent = $this->load->view('email_template/finalselection_job',$data,TRUE);
      $config = array(
      'protocol' => 'ssmtp',
    'smtp_host' => 'ssl://ssmtp.googlemail.com',
    'smtp_port' => 587,
    'smtp_user' => 'no-reply@phillyhire.com',
    'smtp_pass' => 'o6,V%19+!Jo1',
    'smtp_crypto' => 'security',
    'mailtype' => 'html',
    'smtp_timeout' => '4',
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
  );
     $recipientArr = array($get_user1->email,$get_user->email);
  $this->email->initialize($config);
  $this->email->from('no-reply@phillyhire.com','Phillyhire');
   $this->email->to($recipientArr);
  $this->email->subject('selection for job Confirmation message from Phillyhire');
  $this->email->message($htmlContent);
  $this->email->send();
     $updatepost = array(
      'is_delete' => 1,
    );
    $this->Crud_model->SaveData('postjob', $updatepost, "id='".$get_data->job_id."'");
    $jobstatus = $this->Crud_model->GetData('applied_jobs', '', "job_id='".$get_data->job_id. "' and job_status='shortlist'");

    foreach ($jobstatus as $row) {
      $data = array(
        'job_status' => 'rejected',
      );
      $this->Crud_model->SaveData('applied_jobs', $data, "appliedjob_id='".$row->appliedjob_id."'");
    }

    }
    $this->session->set_flashdata('message', 'change status successfully !');
    echo "1";
    exit;
    
  }
  
  /*------------- statrt jobseeker resume -----------*/
  function get_jobseeker_resume()
  {
    $get_data=$this->Crud_model->GetData('users','userId,jobseeker_resume',"userId='".$_SESSION['commonUser']['userId']."'",'','','','1');
      if(!empty($get_data->jobseeker_resume) && file_exists('uploads/jobseeker_resume/'.@$get_data->jobseeker_resume)){
        $resume= '<a href="'.base_url('uploads/jobseeker_resume/'.@$get_data->jobseeker_resume).'">'.@$get_data->jobseeker_resume.'</a>';
                 }
                 else{
                 $resume=''; 
                 } 
    $data=array(
      'resume'=>$resume,
      'old_resume'=>$get_data->jobseeker_resume,
    );
    echo json_encode($data);
  }
  /*------------- end jobseeker resume -------------*/


} //end controller
