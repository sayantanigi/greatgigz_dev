<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
	}

		public function login()
	{
		$data['get_country']=$this->Crud_model->GetData('countries');
		$data['get_state']=$this->Crud_model->GetData('states');
		$this->load->view('common/header');
		$this->load->view('login',$data);
		$this->load->view('common/footer');
	}
	public function register()
	 {

	 	 $validate=$this->Crud_model->get_single('users',"mobile='".$_POST['mobile']."'");
	    if(!empty($validate))
	     {
				 $data=array(
				 'result'=>0,
				 'data'=>'phone',
				 );
			 }
			 else{
				$validate=$this->Crud_model->get_single('users',"email='".$_POST['email']."'");
				if(!empty($validate))
			 {
				 $data=array(
				 'result'=>0,
				 'data'=>'email',
				 );
			 }
			 }

			 if(empty($validate))
			 {
				 $name = $this->input->post('firstname',TRUE). $this->input->post('lastname',TRUE);
	              if (empty($name) || $name == '') {
	                  $name =$this->input->post('firstname',TRUE).'-'.$this->input->post('lastname',TRUE);
	              }
	              $slug = strtolower(url_title($name));
	              $slug_url =$this->Users_model->get_unique_url($slug);
		$data=array(
				'firstname' =>$this->input->post('firstname',TRUE),
				'lastname' =>$this->input->post('lastname',TRUE),
				'job_title' =>$this->input->post('job_title',TRUE),
				'email' =>$this->input->post('email',TRUE),
				'mobile' =>$this->input->post('mobile',TRUE),
				'ext' =>$this->input->post('ext',TRUE),
				'fax' =>$this->input->post('fax',TRUE),
				'company' =>$this->input->post('company',TRUE),
				'organization_type' =>$this->input->post('organization_type',TRUE),
				'address1' =>$this->input->post('address1',TRUE),
				'address2' =>$this->input->post('address2',TRUE),
				'city' =>$this->input->post('city',TRUE),
				'state' =>$this->input->post('state',TRUE),
				'other' =>$this->input->post('other',TRUE),
				'zipcode' =>$this->input->post('zipcode',TRUE),
				'country' =>$this->input->post('country',TRUE),
				'password' => md5($this->input->post('password',TRUE)),
				'userType' =>$this->input->post('userType',TRUE),
					'slug_url' =>$slug_url,
				'created_date'=>date('Y-m-d H:i:s'),
			);

		$this->Crud_model->SaveData('users',$data);
		 $this->load->library('email');
	 $email=$_POST['email'];
		$data=array(
	'email'=>$email,
	'job_title'=>$_POST['job_title'],
	'fullname'=>ucwords($_POST['firstname'].' '.$_POST['lastname']),
	'password'=>$_POST['password'],
);

	$htmlContent = $this->load->view('email_template/signup',$data,TRUE);
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
	$this->email->to($email);
	$this->email->subject('Registration Confirmation message from Phillyhire');
	$this->email->message($htmlContent);
	$this->email->send();
		$this->session->set_flashdata('message', 'Register Successfully !!');
		$data=array(
	 'result'=>1,
	 'data'=>1,
	       );
	}
	 echo json_encode($data); exit;

    }



	public function actionLogin()
	{

			$cond = "email='".$_POST['login_email']."' and password='".md5($_POST['login_password'])."' and status='1'";
			$checkLoginUser = $this->Crud_model->get_single("users",$cond);
			if(!empty($checkLoginUser))
			{
				$sess['commonUser'] =array(
					"id"=>$checkLoginUser->userId,
					"name"=>$checkLoginUser->firstname.' '.$checkLoginUser->lastname,
					"email"=>$checkLoginUser->email,
					"userType"=>$checkLoginUser->userType,
				);
				$this->session->set_userdata($sess);
			$this->session->set_flashdata('message', 'Login Successfully !!');
				if($_SESSION['commonUser']['userType']==2)
				{
				   $get_data=$this->Crud_model->get_single('employer_subscription',"employer_id='".$_SESSION['commonUser']['userId']."' and subscription_id='1'");
					$get_subscription=$this->Crud_model->get_single('subscription',"id='1'");
    $effectiveDate = strtotime("+".$get_subscription->subscription_duration." months", strtotime(date("Y-m-d")));
$end_date = date("Y-m-d", $effectiveDate); 
				    if(empty($get_data))
				    {
				        $data=array(
				        	'employer_id'=>$_SESSION['commonUser']['userId'],
				        	'subscription_id'=>1,
				       'no_of_post'=>$get_subscription->no_of_post,
                    'start_date'=>$get_subscription->subscription_duration,
                      'end_date'=>$end_date,
                    'payment_date'=>date('Y-m-d h:i:s'),
                     'created_date'=>date('Y-m-d h:i:s'),
                    );
                   $this->Crud_model->SaveData('employer_subscription',$data);
                   redirect(base_url('pricing'));
				    }
				    else{
					redirect(base_url('pricing'));
				}
				}
				else{
				
				redirect(base_url('home'));
			      }
			}
			else
			{
				$this->session->set_flashdata('error', 'Email and Password Incorrect');
				redirect(base_url('login'));
			}

	}


	public function logout()
    {
    	unset($_SESSION['commonUser']);
		redirect(base_url('login'));
    }

		////////////// start subscribe ////////////////////
     public function subcriber()
  	{
  		$get_data=$this->Crud_model->get_single('subscriber',"email='".$_POST['email']."'");

          if(empty($get_data))
          {
  		$data=array(
  			'email'=>$_POST['email'],
         'created_date'=>date('Y-m-d H:i:s'),
  		);

  		$this->Crud_model->SaveData('subscriber',$data);
      echo "1"; exit;
  	}
        else{
          echo "0"; exit;
        }

  	}
    ////////////// end subscribe ////////////////////




}//end controller
