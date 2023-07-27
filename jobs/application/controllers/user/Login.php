<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Users_model');
	}

	public function login() {
		$data['get_country']=$this->Crud_model->GetData('countries');
		$data['get_state']=$this->Crud_model->GetData('states','',"country_id='233'");
		$data['get_city']=$this->Crud_model->GetData('cities','',"state_id='1422'");
		$this->load->view('common/header');
		$this->load->view('login',$data);
		$this->load->view('common/footer');
	}

	public function register() {
		$validate=$this->Crud_model->get_single('users',"mobile='".$_POST['mobile']."'");
	    if(!empty($validate)) {
			$data=array(
				'result'=>0,
				'data'=>'phone',
			);
		} else {
			$validate=$this->Crud_model->get_single('users',"email='".$_POST['email']."'");
			if(!empty($validate)) {
				$data=array(
					'result'=>0,
					'data'=>'email',
				);
			}
		}
		if(empty($validate)) {
			$name = $this->input->post('firstname',TRUE). $this->input->post('lastname',TRUE);
			if (empty($name) || $name == '') {
				$name =$this->input->post('firstname',TRUE).'-'.$this->input->post('lastname',TRUE);
			}
			$slug = strtolower(url_title($name));
			$slug_url =$this->Users_model->get_unique_url($slug);
			$data=array(
				'firstname' =>$this->input->post('firstname',TRUE),
				'lastname' =>$this->input->post('lastname',TRUE),
				'email' =>$this->input->post('email',TRUE),
				'mobile' =>$this->input->post('mobile',TRUE),
				'companyname' =>$this->input->post('company',TRUE),
				'organization_type' =>$this->input->post('organization_type',TRUE),
				'address' =>$this->input->post('address1',TRUE),
				'city' =>$this->input->post('city',TRUE),
				'state' =>$this->input->post('state',TRUE),
				'country' =>$this->input->post('country',TRUE),
				'zip' =>$this->input->post('zipcode',TRUE),
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
				'fullname'=>ucwords($_POST['firstname'].' '.$_POST['lastname']),
				'password'=>$_POST['password']
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
				'data'=>1
			);
		}
		echo json_encode($data); exit;
    }

	public function actionLogin() {
		$cond = "email='".$_POST['login_email']."' and password='".md5($_POST['login_password'])."' and status='1'";
		$checkLoginUser = $this->Crud_model->get_single("users",$cond);
		if(!empty($checkLoginUser)) {
			$sess['commonUser'] =array(
				"userId"=>$checkLoginUser->userId,
				"companyname"=>$checkLoginUser->companyname,
				"firstname"=>$checkLoginUser->firstname,
				"lastname"=>$checkLoginUser->lastname,
				"userEmail"=>$checkLoginUser->email,
				"userMobile"=>$checkLoginUser->mobile,
				"UserLoggedIn"=>TRUE,
				'userType'=>$checkLoginUser->userType,
				//"name"=>$checkLoginUser->firstname.' '.$checkLoginUser->lastname,
				//"email"=>$checkLoginUser->email,
				//"userType"=>$checkLoginUser->userType,
			);
			$this->session->set_userdata($sess);
			$this->session->set_flashdata('message', 'Login Successfully !!');
			if($_SESSION['commonUser']['userType']==2) {
				$get_data=$this->Crud_model->GetData('employer_subscription','',"employer_id='".$_SESSION['commonUser']['userId']."'",'','(id) desc','','1');
				$total_postjobs=$this->Crud_model->GetData('postjob','',"user_id='".$_SESSION['commonUser']['userId']."' and employer_subscription_id='".$get_data->id."'");
				$get_subscription=$this->Crud_model->get_single('subscription',"id='1'");
				$effectiveDate = strtotime("+".$get_subscription->subscription_duration." months", strtotime(date("Y-m-d")));
				$end_date = date("Y-m-d", $effectiveDate); 
				if(empty($get_data)) {
					$data=array(
						'employer_id'=>$_SESSION['commonUser']['userId'],
						'subscription_id'=>1,
						'no_of_post'=>$get_subscription->no_of_post,
						'start_date'=>$get_subscription->subscription_duration,
						'end_date'=>$end_date,
						'payment_date'=>date('Y-m-d h:i:s'),
						'created_date'=>date('Y-m-d h:i:s')
					);
					$this->Crud_model->SaveData('employer_subscription',$data);
					redirect(base_url('dashboard'));
				} else {
					redirect(base_url('dashboard'));
				}
				if(date('Y-m-d',strtotime($get_data->end_date)) > date('Y-m-d') && $get_data->no_of_post > count($total_postjobs)){
					redirect(base_url('dashboard'));
				} else{
					redirect(base_url('pricing'));
				}
			} else {
				redirect(base_url('dashboard'));
			}
		} else {
			$this->session->set_flashdata('error', 'Email and Password Incorrect');
			redirect(base_url('login'));
		}
	}

	public function logout() {
    	unset($_SESSION['commonUser']);
		redirect(base_url('login'));
    }

	////////////// start subscribe ////////////////////
	public function subcriber() {
  		$get_data=$this->Crud_model->get_single('subscriber',"email='".$_POST['email']."'");
		if(empty($get_data)) {
  			$data=array(
  				'email'=>$_POST['email'],
         		'created_date'=>date('Y-m-d H:i:s'),
  			);
  			$this->Crud_model->SaveData('subscriber',$data);
      		echo "1"; exit;
  		} else {
			echo "0"; exit;
        }
  	}
    ////////////// end subscribe ////////////////////
    
    public function forgot_password() {
    	$this->load->view('common/header');
		$this->load->view('forgot_password');
		$this->load->view('common/footer');
    }

	public function forgotpass_action() {
		if(!empty($this->input->post('email',TRUE))) {
			$get_email = $this->Crud_model->GetData('users','firstname,lastname,email',"email='".$_POST['email']."' and status='1'",'','','','1');
			if(!empty($get_email)) {
				$this->load->library('email');
				$data=array(
					'email'=>$get_email->email,
					'fullname'=>$get_email->firstname.' '.$get_email->lastname,
				);
				$htmlContent = $this->load->view('email_template/forgot_password',$data,TRUE);
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
				$this->email->to($get_email->email);
				$this->email->subject('Forgot Password Confirmation message from Phillyhire');
				$this->email->message($htmlContent);
				$this->email->send();	
				$this->session->set_flashdata('success', 'Please check your email !');			 
			} else {
				$this->session->set_flashdata('error', 'Invalid Email Id !');
			}
			redirect(base_url('forgot-password'));
		}
	}

 	public function reset_password() {
		$this->load->view('common/header');
		$this->load->view('reset_password');
		$this->load->view('common/footer');
	}
	
	public function resetpassword_action() {
		if(!empty($this->input->post('email',TRUE))) {
			$get_email = $this->Crud_model->GetData('users','',"email='".$_POST['email']."' and status='1'",'','','','1');
			if(!empty($get_email)) {
				$data = array('password' =>md5($_POST['password']));
				$con="userId='".$get_email->userId."'";
				$this->Crud_model->SaveData('users',$data, $con);
				$this->session->set_flashdata('message', 'Reset password successfully !');
				echo "1";
			} else {
		 		$this->session->set_flashdata('error', 'Error');
			}
		}
	}
	
	function deactivate_user() {
		$data=array(
			'status'=>0,
		);
		$this->Crud_model->SaveData('users',$data,"userId='".$_POST['user_id']."'");
		unset($_SESSION['commonUser']);
		echo "1";
	}
}//end controller
