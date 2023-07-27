<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mymodel');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data = array(
			'email_id' =>"email_id",
			'password'=>"password",
		);
		$this->load->view('admin/login',$data);
	}
	public function actionLogin()
	{
		$this->rules_login();
		if ($this->form_validation->run() == FALSE)
		{
			redirect(admin_url());
		}
		else
		{
			$cond = "email='".$_POST['email_id']."' or username='".$_POST['email_id']."' and password='".md5($_POST['password'])."'";
			$checkLoginUser = $this->Crud_model->get_single("admin",$cond);
			if(!empty($checkLoginUser))
			{
				$sess['phillyhire_admin'] =array(
					"id"=>$checkLoginUser->userId,
					"name"=>$checkLoginUser->name,
					"email_id"=>$checkLoginUser->email,
					"username"=>$checkLoginUser->username,
					"status"=>$checkLoginUser->status,
				);
				$this->session->set_userdata($sess);
				redirect(admin_url('dashboard'));
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-block alert-danger text-center">Email and Password not matched</div>');
				redirect(admin_url());
			}
			}
	}

	public function rules_login()
	{
		$this->form_validation->set_rules('email_id', 'Email id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">','</span>');
	}

	public function logOut()
	{
		unset($_SESSION['phillyhire_admin']);
		redirect(admin_url());
	}

	function profile()
	{

		//print_r($_SESSION['phillyhire_admin']['id']); exit;
		$get_data=$this->Crud_model->get_single('admin',"userId ='".$_SESSION['phillyhire_admin']['id']."'");
		$header = array('title' => 'profile');
		 $data = array(
				 'heading' => 'Profile',
				 'get_data' => $get_data,
		 );
		 $this->load->view('admin/common/header', $header);
		 $this->load->view('admin/common/sidebar');
		 $this->load->view('admin/profile',$data);
		 $this->load->view('admin/common/footer');
	}

	public function update_Profile()
	{
		$user_id = $_SESSION['phillyhire_admin']['id'];
		$con = "userId ='".$user_id."'";

			if($_FILES['image']['name']!='')
					{
										$_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
										$config2['image_library'] = 'gd2';
										$config2['source_image'] =  $_FILES['image']['tmp_name'];
										$config2['new_image'] =   getcwd().'/uploads/logo/'.$_POST['image'];
										$config2['upload_path'] =  getcwd().'/uploads/logo/';
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
											$image  = $_POST['image'];
											@unlink('uploads/logo/'.$_POST['old_image']);
										}
					}

						else{
								 $image  =$_POST['old_image'];
					}
				$data = array(
					'name' => ucwords($_POST['name']),
					'email' => $_POST['email'],
					'username' => $_POST['username'],
					'image'=>$image,
				);
				$this->Crud_model->SaveData('admin',$data,$con);

			$this->session->set_flashdata('message', 'Profile updated successfully');
			redirect(admin_url('profile'));

	}

  function dashboard()
  {
  	    $total_postjobs=$this->Crud_model->GetData('postjob');
			$total_user=$this->Crud_model->GetData('users');
			$total_subscription=$this->Crud_model->GetData('subscription');
		$total_appliedjobs=$this->Crud_model->GetData('applied_jobs');
			$received_payment=$this->Crud_model->GetData('employer_subscription','SUM(amount) as received_price',"payment_status='succeeded'",'','','','1');

			$pending_payment=$this->Crud_model->GetData('employer_subscription','SUM(amount) as pending_price',"payment_status='pending'",'','','','1');
			
			if(!empty($received_payment->received_price))
		{
			$Receivedpayment=$received_payment->received_price;
		}
		else{
			$Receivedpayment=0;
		}
		if(!empty($pending_payment->pending_price))
		{
			$Pendingpayment=$pending_payment->pending_price;
		}
		else{
			$Pendingpayment=0;
		}
			$header = array('title' => 'Dashboard');
			$data = array(
	            'heading' => 'Dashboard',
	           'total_postjobs' => $total_postjobs,
	            'total_user' => $total_user,
	            'total_subscription' => $total_subscription,
	           'total_appliedjobs' => $total_appliedjobs,
	            'Receivedpayment'=>$Receivedpayment,
	            'Pendingpayment'=>$Pendingpayment,
	        );
	$this->load->view('admin/common/header',$header);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/dashboard',$data);
		//$this->load->view('admin/common/footer');

	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
