<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('phillyhire'))
		{
	 		redirect(base_url('login'));
	 	}
       $this->load->model('Post_job_model');
    }
    ///////////////////////// start post job///////////////////////////
	public function postjob()
	{

		$data['get_users']=$this->Crud_model->get_single('users',"userId='".$_SESSION['commonUser']['userId']."' and status='1'");
		$data['get_category']=$this->Crud_model->GetData('category','',"status='1'");
		 $data['get_employer']=$this->Crud_model->GetData('employer_subscription','',"employer_id='".$_SESSION['commonUser']['userId']."'",'','(id)desc','','1');
   
    $data['total_postjobs']=$this->Crud_model->GetData('postjob','',"user_id='".$_SESSION['commonUser']['userId']."' and employer_subscription_id='".$data['get_employer']->id."'");
		$this->load->view('common/header');
		$this->load->view('frontend/postjob',$data);
		$this->load->view('common/footer');
	}

	 public function save_postjob()
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
                  }
        }

          else{
               $image  ="";
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
    		'created_date'=>date('Y-m-d H:i:s'),
    	);
    	$this->Crud_model->SaveData('postjob',$data);
    	$this->session->set_flashdata('message', 'Post Job Created Successfully !');
		redirect(base_url("my-jobs"));

    }

	//////////////////////// end post job////////////////////////////////


  function apply_job()
    {

      if($_FILES['resume']['name'] != '') {
      $src = $_FILES['resume']['tmp_name'];
      $filEnc = time();
      $avatar ='epc'.'_'.rand(11111, 99999)."_".$_FILES['resume']['name'];
      $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
      $dest = getcwd() . '/uploads/jobseeker_resume/' . $avatar1;

      if (move_uploaded_file($src, $dest)) {
        $resume  = $avatar1;
      }
    } else {

      $resume ='';
    }
            $title=$_FILES['resume']['name'];

            $slug = strtolower(url_title($title));
           $slug_url =$this->Crud_model->get_unique_url($slug);

    $data=array(
      'job_id'=>$_POST['job_id'],
      'user_id'=>$_SESSION['commonUser']['userId'],
      'resume'=>$resume,
      'slug_url'=>$slug_url,
      'created_date'=>date('Y-m-d H:i:s'),
    );
    $this->Crud_model->SaveData('applied_jobs',$data);
     // $this->session->set_flashdata('message', 'Apply job Successfully!');
      echo "1"; exit;


   // redirect(base_url("job-listing"));
    }

    function add_favoritejob()
   {

     $get_data=$this->Crud_model->get_single('favorite_jobs',"postjob_id='".$_POST['postid']."' and user_id='".$_SESSION['commonUser']['userId']."'");

     if(empty($get_data)){
     $data=array(
       'postjob_id'=>$_POST['postid'],
       'user_id'=>$_SESSION['commonUser']['userId'],
       'created_date'=>date('Y-m-d H:i:s'),
     );
     $this->Crud_model->SaveData('favorite_jobs',$data);
     echo "1"; exit;
   }
   else{
     echo "0"; exit;
   }

   }



}  // end controller
