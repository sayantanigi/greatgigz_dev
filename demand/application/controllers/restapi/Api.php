<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{
	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model('Apimodel');
		error_reporting(0);
		$this->load->library('Twilio_lib'); 
	}

	public function signup_post() 
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {

			$userData['fullName'] = $this->post('fullName');
			$userData['mobile'] = $this->post('mobile');
			$userData['password'] = $this->post('password');
		}

		$this->form_validation->set_rules('fullName', 'fullName', 'trim|required');
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');	
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');

		if ($this->form_validation->run() === false) 
		{	
			if(form_error('fullName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('fullName'))
				], 400);
			}

			if(form_error('mobile')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('mobile'))
				], 400);
			}

			if(form_error('password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('password'))
				], 400);
			}


		} else {

			$userDetails=$this->Apimodel->get_cond('mobile_numbers', "mobile_number='".$userData['mobile']."'");

			if($userDetails)
			{
				$result= $userDetails->id;

				if($userDetails->profile_pic!="")
				{
					$pic = base_url().'assets/images/profile/'.$userDetails->profile_pic;
				} else {
					$pic = base_url().'upload/noimg.png';
				}

				if($userDetails->verified=='0')
				{			
					$array = [
						'status' => "2",
						'message'=>'Your account has not verified. Please verify.',
						'userId' => $userDetails->id,
						'fullName' => $userDetails->contact_name,
						'mobile' => $userDetails->mobile_number,
						'profilePic' => $pic,
					];

					$array = $this->arrcheck($array);
					$this->response($array, 200);
				}else{

					$array = [
						'status' => "1",
						'message'=>'You have registered successfully!',
						'userId' => $userDetails->id,
						'fullName' => $userDetails->contact_name,
						'mobile' => $userDetails->mobile_number,
						'profilePic' => $pic,
					];

					$array = $this->arrcheck($array);
					$this->response($array, 200);

				}


			}else{


				$mydata=array(
					'contact_name'=>$userData['fullName'],
					'mobile_number'=>$userData['mobile'],
					'password'=>base64_encode($userData['password']),
					'created'=>date('Y-m-d H:i:s'),
				);	

				$result=$this->Apimodel->add_details("mobile_numbers", $mydata);
			}			

			if($result)
			{			

				$fetchdetails=$this->Apimodel->get_cond('mobile_numbers', "id='$result'");

				if($fetchdetails->profile_pic!="")
				{
					$pic = base_url().'assets/images/profile/'.$fetchdetails->profile_pic;
				} else {
					$pic = base_url().'upload/noimg.png';
				}

				$array = [
					'status' => "2",
					'message'=>'You have registered successfully!',
					'userId' => $fetchdetails->id,
					'fullName' => $fetchdetails->contact_name,
					'mobile' => $fetchdetails->mobile_number,
					'profilePic' => $pic,
				];

				$array = $this->arrcheck($array);
				$this->response($array, 200);

			} else {
				$this->response([
					'status' =>"0",
					'error' => "Some problems occurred, please try again.!"
				], 400);				

			}

		}
	}

	public function login_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['mobile'] = $this->post('mobile');
			$userData['password'] = $this->post('password');
		}

		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() === false) 
		{

			if(form_error('mobile')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('mobile'))
				], 401);
			}
			if(form_error('password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('password'))
				], 400);
			}

		} else {

			$where = "mobile_number = '".$userData['mobile']."'";
			if ($this->Apimodel->count('mobile_numbers', $where) != 1) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid Mobile"
				], 400);			
			}else{

				$user = $this->Apimodel->get_cond('mobile_numbers', $where);

				if(base64_encode($userData['password'])!= $user->password) 
				{
					$this->response([
						'status' =>"0",
						'error' => "Invalid Password"
					], 400);	
				}elseif ($user->verified=='0') 
				{
					$this->response([
						'status' =>"0",
						'error' => "Your account has not verified. Please verify."
					], 400);	

				}
				else{

					if($user->profile_pic!="")
					{
						$pic = base_url().'assets/images/profile/'.$user->profile_pic;
					} else {
						$pic = base_url().'upload/noimg.png';
					}

					$array = [
						'status' =>"1",
						'personalInfo' => [
							'userId' => $user->id,
							'fullName' => $user->contact_name,
							'mobile' => $user->mobile_number,	
							'profilePic' => $pic,
							'created'=>@$user->created
						]
					];

					$array = $this->arrcheck($array);

					$this->response($array, 200);

				}
			}
		}

	}	

	public function getOtp_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['mobile'] = $this->post('mobile');
		}

		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');

		if ($this->form_validation->run() === false) {

			if(form_error('mobile')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('mobile'))
				], 400);
			}			

		} else {

			$where = "mobile_number = '".$userData['mobile']."' ";

			if ($this->Apimodel->count('mobile_numbers', $where) != 1) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid User"
				], 400);			
			}else{

				$otp = $this->generate_otp(6);

				$data = array(
					'verification_code'=>$otp,
				); 

				$update=$this->Apimodel->update_cond('mobile_numbers',$where, $data);	

				$user = $this->Apimodel->get_cond('mobile_numbers', $where);	

				$message = "Hi ".@$user->contact_name." Your OTP is " . $otp." from Prosearch Ghana.";
				$from = '(202) 952-4499';
				$to = $userData['mobile'];

				$response = $this->twilio_lib->sms($from, $to,$message);

				if($response->IsError)
				{
					$this->response([
						'status' =>"0",
						'error' => "Permission to send an SMS has not been enabled for the region indicated by the 'To' number",
					], 400);

				} else{

					$array = [
						'status' =>"1",
						'message' =>"OTP has been sent to your mobile number",
						'userId' =>$user->id,			
						'mobile' =>$user->mobile_number,
						'otp' =>$user->verification_code,							
					];

					$array = $this->arrcheck($array);

					$this->response($array, 200);	
				}			
			}
		}
	}

	public function verifyOTP_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['otp'] = $this->post('otp');
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('otp', 'otp', 'trim|required');

		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}

			if(form_error('otp')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('otp'))
				], 400);
			}		


		} else {

			$where = "id = '".$userData['userId']."' AND verification_code='".$userData['otp']."'";

			if ($this->Apimodel->count('mobile_numbers', $where) != 1) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid User!"
				], 400);			
			}else{

				$data = array(
					'verified' => 1,
					'verification_code'=>$this->generate_otp(6),
				); 		

				$where="id = '".$userData['userId']."'";
				$update=$this->Apimodel->update_cond('mobile_numbers', $where, $data);	

				if($update){

					$this->response([
						'status' => "1",
						'message' => 'Otp verified successfully.'
					], 200);

				} else {
					$this->response("Some problems occurred, please try again.", 400);
				}
			}
		}
	}

	public function updateProfile_post() 
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['fullName'] = $this->post('fullName');
			$userData['profilePic'] = $this->post('profilePic');
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('fullName', 'fullName', 'trim|required');

		if($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}

			if(form_error('fullName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('fullName'))
				], 400);
			}

		} else {

			$userId = $userData['userId'];			
			$dataraw = $this->Apimodel->get_cond('mobile_numbers', "id=$userId");

			if(!empty($dataraw))
			{
				$config['upload_path'] = './assets/images/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 204800;
				$config['max_width'] = 30000;
				$config['max_height'] = 20000;
				$config['file_name'] = uniqid();
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('profilePic'))
				{
					$error = array('error' => $this->upload->display_errors());
					@$image = $dataraw->profile_pic;

				} else {
					$file_data = $this->upload->data();
					$image = $file_data['file_name'];

				} 

				$mydata = array(
					'contact_name' =>$userData['fullName'],
					'profile_pic'=>$image,
				); 

				$where="id=$userId";

				$update=$this->Apimodel->update_cond('mobile_numbers', $where, $mydata);

				$user = $this->Apimodel->get_cond('mobile_numbers', "id=$userId");

				if($user->profile_pic!="")
				{
					$pic = base_url().'assets/images/profile/'.$user->profile_pic;
				} else {
					$pic = base_url().'uploads/noimg.png';
				}

				$arr= array(
					'userId' => $user->id,
					'fullName'=>$user->contact_name,
					'mobile'=>$user->mobile_number,
					'profilePic' => $pic,
				);

				if($update)
				{
					$this->response([
						'status'=>"1",
						'message' => 'Profile updated successfully.',
						'personalInfo'=>$arr
					], 200);
				} else {
					$this->response([
						'status' => "0",
						'error' => "Some problems occurred, please try again."
					], 400);
				}

			} else {
				$this->response([
					'status' => "0",
					'error' => 'No user found.'
				], 400);
			}

		}
	}			

	public function changePassword_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['userId'] = $this->post('userId');
			$userData['oldPassword'] = $this->post('oldPassword');
			$userData['newPassword'] = $this->post('newPassword');
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('oldPassword', 'oldPassword', 'trim|required');
		$this->form_validation->set_rules('newPassword', 'newPassword', 'trim|required|min_length[6]');		

		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}

			if(form_error('oldPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('oldPassword'))
				], 400);
			}

			if(form_error('newPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('newPassword'))
				], 400);
			}

		} else {	

			$userId = $userData['userId'];		
			$where = "id = '$userId'";
			$details = $this->Apimodel->get_cond('mobile_numbers', $where);

			if($details) 
			{
				if(base64_encode($userData['oldPassword'])!= $details->password) 
				{
					$this->response([
						'status' => "0",
						'error' => 'Old password is not matched!'
					], 400);

				}

				$data = array(
					'password' => base64_encode($userData['newPassword'])
				); 		

				$where="id = $userId";
				$update=$this->Apimodel->update_cond('mobile_numbers', $where, $data);	

				if($update)
				{

					$this->response([
						'status' => "1",
						'message' => 'Password updated successfully.'
					], 200);

				} else {
					$this->response([
						'status' => "0",
						'error' => "Some problems occurred, please try again."
					], 400);
				}
			} else {

				$this->response([
					'status' => "0",
					'error' => 'User not found!'
				], 400);

			}

		}
	}

	public function lookingList_get()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}

		$list = $this->Apimodel->fetch_all_join("SELECT * FROM sub_service WHERE status='1' ORDER BY name ASC");

		if(!empty($list)) 
		{
			foreach ($list as $cat)
			{

				$array[] = [
					'id' => $cat->id,
					'name'=>@$cat->name
				];				
			}

			$array = $this->arrcheck($array);
			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'message' => 'No Data found.'
			], 400);
		}
	}

	public function cityList_get()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}

		$list = $this->Apimodel->fetch_all_join("SELECT * FROM city WHERE status='1' AND parent_city='0' ORDER BY name ASC");

		if(!empty($list)) 
		{
			foreach ($list as $c)
			{

				$array[] = [
					'id' => $c->id,
					'name'=>$c->name
				];				
			}

			$array = $this->arrcheck($array);
			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'message' => 'No Data found.'
			], 400);
		}
	}

	public function neihborhoodList_post()
	{

		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['cityId'] = $this->post('cityId');			
		}

		$this->form_validation->set_rules('cityId', 'cityId', 'trim|required');

		if ($this->form_validation->run() === false) 
		{
			if(form_error('cityId')) 
			{
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('cityId'))
				], 400);
			}			

		} else {

			$cityId = $userData['cityId'];	
			$dataraw = $this->Apimodel->get_cond('city', "id=$cityId");

			if(!empty($dataraw)) 
			{

				$searchSql = "SELECT * FROM city WHERE parent_city =$cityId AND status=1 ORDER BY name ASC";

				$list = $this->Apimodel->fetch_all_join($searchSql);

				if(!empty($list))
				{
					foreach ($list as $book) 
					{						
						$array[] = [
							'id' => $book->id,
							'name' => $book->name
						];													
					}

					$array = $this->arrcheck($array);	

					$this->response([
						'status'=>"1",
						'list'=>$array

					], 200);

				} else {
					$this->response([
						'status' => "0",
						'message' => 'No data found.'
					], 400);
				}

			} else {
				$this->response([
					'status' => "0",
					'message' => 'No city found.'
				], 400);
			}
		}
	}

	public function aboutUs_get()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}

		$where = "id = '1'";
		$details = $this->Apimodel->get_cond('cms', $where);
		if($details)
		{
			$array = [
				'status' =>"1",
				'details' => [
					'id' => $details->id,
					'title' =>$details->title,
					'meta_title' => $details->meta_title,
					'meta_description' => $details->meta_description,
					'description' => strip_tags(html_entity_decode($details->description))
				]
			];

			$array = $this->arrcheck($array);

			$this->response($array, 200);


		}else{

			$this->response([
				'status' => "0",
				'message' => "No data found!"
			], 400);

		}
	}

	public function policy_get()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}

		$where = "id = '3'";
		$details = $this->Apimodel->get_cond('cms', $where);
		if($details)
		{
			$array = [
				'status' =>"1",
				'details' => [
					'id' => $details->id,
					'title' =>$details->title,
					'meta_title' => $details->meta_title,
					'meta_description' => $details->meta_description,
					'description' => strip_tags(html_entity_decode($details->description))
				]
			];
			$array = $this->arrcheck($array);
			$this->response($array, 200);
		}else{
			$this->response([
				'status' => "0",
				'message' => "No data found!"
			], 400);
		}
	}

	public function termsAndConditions_get()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}

		$where = "id = '4'";
		$details = $this->Apimodel->get_cond('cms', $where);
		if($details)
		{
			$array = [
				'status' =>"1",
				'details' => [
					'id' => $details->id,
					'title' =>$details->title,
					'meta_title' => $details->meta_title,
					'meta_description' => $details->meta_description,
					'description' => strip_tags(html_entity_decode($details->description))
				]
			];
			$array = $this->arrcheck($array);
			$this->response($array, 200);
		}else{

			$this->response([
				'status' => "0",
				'message' => "No data found!"
			], 400);

		}		
	}

	public function recoveryPassword_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['otp'] = $this->post('otp');
			$userData['newPassword'] = $this->post('newPassword');
		}
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('otp', 'otp', 'trim|required');
		$this->form_validation->set_rules('newPassword', 'newPassword', 'trim|required|min_length[6]');			

		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			if(form_error('otp')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('otp'))
				], 400);
			}
			if(form_error('newPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('newPassword'))
				], 400);

			}

		} else {

			$where = "id = '".$userData['userId']."' AND verification_code='".$userData['otp']."'";

			if ($this->Apimodel->count('mobile_numbers', $where) != 1) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid User!"
				], 400);			
			}else{

				$data = array(
					'password' => base64_encode($userData['newPassword']),
					'verification_code'=>$this->generate_otp(6),
				); 		

				$where="id = '".$userData['userId']."'";

				$update=$this->Apimodel->update_cond('mobile_numbers', $where, $data);	

				if($update)
				{
					$this->response([
						'status' => "1",
						'message' => 'Password Updated successfully.'
					], 200);

				} else {
					$this->response([
						'status' => "0",
						'error' => "Some problems occurred, please try again."
					], 400);
				}
			}
		}
	}

	public function search_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['serviceId'] = $this->post('serviceId');
			$userData['cityId'] = $this->post('cityId');
			$userData['neihborhoodId'] = $this->post('neihborhoodId');
		}
		$this->form_validation->set_rules('serviceId', 'serviceId', 'trim|required');
		$this->form_validation->set_rules('cityId', 'cityId', 'trim|required');
		$this->form_validation->set_rules('neihborhoodId', 'neihborhoodId', 'trim|required');	
		$this->form_validation->set_rules('userId', 'userId/IP', 'trim|required');			

		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			if(form_error('serviceId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('serviceId'))
				], 400);
			}
			if(form_error('cityId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('cityId'))
				], 400);
			}
			if(form_error('neihborhoodId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('neihborhoodId'))
				], 400);

			}

		} else {

			$where="id= '".$userData['userId']."'";

			if ($this->Apimodel->count('mobile_numbers', $where) != 1) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid Mobile"
				], 400);			
			}else{

				$user = $this->Apimodel->get_cond('mobile_numbers', $where);

				if ($user->verified=='0') 
				{
					$this->response([
						'status' =>"0",
						'error' => "Your account has not verified. Please verify."
					], 400);	

				}
				else{
					$nearest=[];
					$array=[];

					$searchKeyword = "service_type='".$userData['serviceId']."' AND city='".$userData['cityId']."' AND neihborhood='".$userData['neihborhoodId']."'";

					$countSettingAdmin=$this->db->get('searchmsg')->row();

					$curDate = date('Y-m-d');
					$searchWhere ="ip='".$userData['userId']."' AND DATE(created)=curDate()";

					$searchList = $this->Apimodel->get_cond_all('search_attempt', $searchWhere);

					if(count($searchList)>0)
					{
						if(count($searchList)<$countSettingAdmin->s_time)
						{
							$list = $this->Apimodel->get_cond_all('provider_list', $searchKeyword);

							if(!empty($list))
							{
								$mydata=array(
									'ip'=>$userData['userId'],
									'created'=>date('Y-m-d H:i:s'),
									'status' => 1,
								);	

								$result=$this->Apimodel->add_details("search_attempt", $mydata);	

								foreach ($list as $b) 
								{	
									if($b->image!="")
									{
										$pic = base_url().'assets/images/profile/'.$b->image;
									} else {
										$pic = base_url().'upload/noimg.png';
									}

									$serviceInfo = $this->Apimodel->fetch_single_join("SELECT name FROM sub_service  WHERE id='".$b->service_type."'");

									$cityInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$b->city."'");

									$neighInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$b->neihborhood."'");

									$array[] = [
										'id' => $b->id,
										'serviceName'=> @$serviceInfo->name,
										'companyName' => $b->company_name,
										'companyName' => $b->company_name,
										'contactFirstName' => $b->contact_prsn_fname,
										'companyLastName' => $b->contact_prsn_lname,
										'mobile' => $b->contact_prsn_mobile,
										'address'=>$b->company_addr,
										'cityName'=> @$cityInfo->name,
										'neighName'=> @$neighInfo->name,
										'created'=>$b->created_at,
										'rating' =>$b->rating,
										'pic' =>$pic,
									];													
								}

								$array = $this->arrcheck($array);	

								$searchNearKeyword = "service_type='".$userData['serviceId']."' AND city='".$userData['cityId']."' AND neihborhood!='".$userData['neihborhoodId']."'";

								$nearList = $this->Apimodel->get_cond_all('provider_list', $searchNearKeyword);

								if(!empty($nearList))
								{
									
									foreach ($nearList as $n) 
									{	
										if($n->image!="")
										{
											$npic = base_url().'assets/images/profile/'.$n->image;
										} else {
											$npic = base_url().'upload/noimg.png';
										}
										$serviceInfo = $this->Apimodel->fetch_single_join("SELECT name FROM sub_service  WHERE id='".$n->service_type."'");

										$cityInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$n->city."'");

										$neighInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$n->neihborhood."'");

										$nearest[] = [
											'id' => $n->id,
											'serviceName'=> @$serviceInfo->name,
											'companyName' => $n->company_name,
											'companyName' => $n->company_name,
											'contactFirstName' => $n->contact_prsn_fname,
											'companyLastName' => $n->contact_prsn_lname,
											'mobile' => $n->contact_prsn_mobile,
											'address'=>$n->company_addr,
											'cityName'=> @$cityInfo->name,
											'neighName'=> @$neighInfo->name,
											'created'=>$n->created_at,
											'rating' =>$n->rating,
											'pic' =>$npic,
										];													
									}
									
								}

								$nearest = $this->arrcheck($nearest);					

								$this->response([
									'status'=>"1",
									'message' =>"Also there are same providers found in some near location",
									'list'=>$array,
									'nearest'=>$nearest,
								], 200);

							} else {

								$searchNearKeyword = "service_type='".$userData['serviceId']."' AND city='".$userData['cityId']."'";

								$nearList = $this->Apimodel->get_cond_all('provider_list', $searchNearKeyword);

								if(!empty($nearList))
								{
									$mydata=array(
										'ip'=>$userData['userId'],
										'created'=>date('Y-m-d H:i:s'),
										'status' => 1,
									);	

									$result=$this->Apimodel->add_details("search_attempt", $mydata);

									foreach ($nearList as $n) 
									{	
										if($n->image!="")
										{
											$npic = base_url().'assets/images/profile/'.$n->image;
										} else {
											$npic = base_url().'upload/noimg.png';
										}

										$serviceInfo = $this->Apimodel->fetch_single_join("SELECT name FROM sub_service  WHERE id='".$n->service_type."'");

										$cityInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$n->city."'");

										$neighInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$n->neihborhood."'");										

										$nearest[] = [
											'id' => $n->id,
											'serviceName'=> @$serviceInfo->name,	
											'companyName' => $n->company_name,
											'companyName' => $n->company_name,
											'contactFirstName' => $n->contact_prsn_fname,
											'companyLastName' => $n->contact_prsn_lname,
											'mobile' => $n->contact_prsn_mobile,
											'address'=>$n->company_addr,
											'cityName'=> @$cityInfo->name,
											'neighName'=> @$neighInfo->name,
											'created'=>$n->created_at,
											'rating' =>$n->rating,
											'pic' =>$npic,
										];													
									}


									$nearest = $this->arrcheck($nearest);	

									$this->response([
										'status'=>"1",
										'message' =>"The type of Business/Service Provider/Artisan you were looking for is not available in your selected Location. However, there are some available options in other parts of the city!",
										'list'=>[],
										'nearest'=>$nearest,				

									], 200);

								}else{

									$this->response([
										'status' => "0",
										'message' => 'Sorry! We did not find a match for your search criteria. ProSearch is working to include more businesses and services in your area. Please come back later.'
									], 400);
								}
							}

						}else{
							$this->response([
								'status' => "1",
								'message' => $countSettingAdmin->name,
							], 200);

						}

					}else{

						$list = $this->Apimodel->get_cond_all('provider_list', $searchKeyword);

						if(!empty($list))
						{
							$mydata=array(
								'ip'=>$userData['userId'],
								'created'=>date('Y-m-d H:i:s'),
								'status' => 1,
							);	

							$result=$this->Apimodel->add_details("search_attempt", $mydata);	

							foreach ($list as $b) 
							{	
								if($b->image!="")
								{
									$pic = base_url().'assets/images/profile/'.$b->image;
								} else {
									$pic = base_url().'upload/noimg.png';
								}
								$serviceInfo = $this->Apimodel->fetch_single_join("SELECT name FROM sub_service  WHERE id='".$b->service_type."'");

								$cityInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$b->city."'");

								$neighInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$b->neihborhood."'");


								$array[] = [
									'id' => $b->id,
									'serviceName'=> @$serviceInfo->name,	
									'companyName' => $b->company_name,
									'companyName' => $b->company_name,
									'contactFirstName' => $b->contact_prsn_fname,
									'companyLastName' => $b->contact_prsn_lname,
									'mobile' => $b->contact_prsn_mobile,
									'address'=>$b->company_addr,
									'cityName'=> @$cityInfo->name,
									'neighName'=> @$neighInfo->name,
									'created'=>$b->created_at,
									'rating' =>$b->rating,
									'pic' =>$pic,
								];													
							}

							$array = $this->arrcheck($array);

						}

						$searchNearKeyword = "service_type='".$userData['serviceId']."' AND city='".$userData['cityId']."' AND neihborhood!='".$userData['neihborhoodId']."'";

						$nearList = $this->Apimodel->get_cond_all('provider_list', $searchNearKeyword);

						if(!empty($nearList))
						{
							
							foreach ($nearList as $n) 
							{	
								if($n->image!="")
								{
									$npic = base_url().'assets/images/profile/'.$n->image;
								} else {
									$npic = base_url().'upload/noimg.png';
								}

								$serviceInfo = $this->Apimodel->fetch_single_join("SELECT name FROM sub_service  WHERE id='".$n->service_type."'");

								$cityInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$n->city."'");

								$neighInfo = $this->Apimodel->fetch_single_join("SELECT name FROM city  WHERE id='".$n->neihborhood."'");


								$nearest[] = [
									'id' => $n->id,									
									'serviceName'=> @$serviceInfo->name,
									'companyName' => $n->company_name,
									'companyName' => $n->company_name,
									'contactFirstName' => $n->contact_prsn_fname,
									'companyLastName' => $n->contact_prsn_lname,
									'mobile' => $n->contact_prsn_mobile,
									'address'=>$n->company_addr,
									'cityName'=> @$cityInfo->name,
									'neighName'=> @$neighInfo->name,
									'created'=>$n->created_at,
									'rating' =>$n->rating,
									'pic' =>$npic,
								];													
							}
						}
						
						$nearest = $this->arrcheck($nearest);

						if((count($list)>0) && (count($nearList)>0))
						{
							$this->response([
								'status'=>"1",
								'message' =>"Also there are same providers found in some near location",
								'list'=>$array,
								'nearest'=>$nearest,				

							], 200);

						}else{
							$this->response([
								'status'=>"1",
								'message' =>"The type of Business/Service Provider/Artisan you were looking for is not available in your selected Location. However, there are some available options in other parts of the city!",
								'list'=>$array,
								'nearest'=>$nearest,				

							], 200);
						}
							

						} 

					}

				}
			}
					

	}

	public function searchByKeyword_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['serviceId'] = $this->post('serviceId');
			$userData['cityId'] = $this->post('cityId');
			$userData['neihborhoodId'] = $this->post('neihborhoodId');
		}
		$this->form_validation->set_rules('serviceId', 'serviceId', 'trim|required');
		$this->form_validation->set_rules('cityId', 'cityId', 'trim|required');
		$this->form_validation->set_rules('neihborhoodId', 'neihborhoodId', 'trim|required');	

		if ($this->form_validation->run() === false) 
		{
			if(form_error('serviceId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('serviceId'))
				], 400);
			}
			if(form_error('cityId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('cityId'))
				], 400);
			}
			if(form_error('neihborhoodId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('neihborhoodId'))
				], 400);

			}

		} else {

			$searchKeyword = "service_type='".$userData['serviceId']."' AND city='".$userData['cityId']."' AND neihborhood='".$userData['neihborhoodId']."'";

			$countSettingAdmin=$this->db->get('searchmsg')->row();				

			$list = $this->Apimodel->get_cond_all('provider_list', $searchKeyword);

			if(!empty($list))
			{

				foreach ($list as $b) 
				{	
					if($b->image!="")
					{
						$pic = base_url().'assets/images/profile/'.$b->image;
					} else {
						$pic = base_url().'upload/noimg.png';
					}

					$array[] = [
						'id' => $b->id,
						'companyName' => $b->company_name,
						'companyName' => $b->company_name,
						'contactFirstName' => $b->contact_prsn_fname,
						'companyLastName' => $b->contact_prsn_lname,
						'mobile' => $b->contact_prsn_mobile,
						'address'=>$b->company_addr,
						'created'=>$b->created_at,
						'rating' =>$b->rating,
						'pic' =>$pic,
					];													
				}

				$array = $this->arrcheck($array);	

				$this->response([
					'status'=>"1",
					'list'=>$array

				], 200);

			} else {

				$nearest=[];

				$searchNearKeyword = "service_type='".$userData['serviceId']."' AND city='".$userData['cityId']."' AND neihborhood!='".$userData['neihborhoodId']."'";

				$nearList = $this->Apimodel->get_cond_all('provider_list', $searchNearKeyword);

				if(!empty($nearList))
				{
					foreach ($nearList as $n) 
					{	
						if($n->image!="")
						{
							$npic = base_url().'assets/images/profile/'.$n->image;
						} else {
							$npic = base_url().'upload/noimg.png';
						}
						$serviceInfo = $this->Apimodel->fetch_single_join("SELECT name FROM sub_service  WHERE id='".$n->service_type."'");

						$nearest[] = [
							'id' => $n->id,
							'serviceName'=> @$serviceInfo->name,
							'companyName' => $n->company_name,
							'companyName' => $n->company_name,
							'contactFirstName' => $n->contact_prsn_fname,
							'companyLastName' => $n->contact_prsn_lname,
							'mobile' => $n->contact_prsn_mobile,
							'address'=>$n->company_addr,
							'created'=>$n->created_at,
							'rating' =>$n->rating,
							'pic' =>$npic,
						];													
					}

					$nearest = $this->arrcheck($nearest);

					$this->response([
						'status'=>"1",
						'message' =>"The type of Business/Service Provider/Artisan you were looking for is not available in your selected Location. However, there are some available options in other parts of the city!",
						'list'=>$nearest,
					], 200);
				}else
				{

					$this->response([
						'status' => "0",
						'message' => 'Sorry! We did not find a match for your search criteria. ProSearch is working to include more businesses and services in your area. Please come back later.'
					], 400);
				}
			}
		}		

	}

	public function testimonialList_get()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}

		$list = $this->Apimodel->get_cond_all('testimonials',"status='1'");

		if(!empty($list)) 
		{
			foreach ($list as $c)
			{

				if($c->image!="")
				{
					$pic = base_url().'assets/images/testimonial/'.$c->image;
				} else {
					$pic = base_url().'upload/noimg.png';
				}

				$array[] = [
					'id' => $c->id,
					'name'=>$c->name,
					'description'=>strip_tags($c->description),
					'pic'=>$pic,
					'created_at'=>$c->created_at,
				];				
			}

			$array = $this->arrcheck($array);
			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'message' => 'No Data found.'
			], 400);
		}
	}

	public function sendEnquiry_post()
	{		
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {

			$userData['firstname'] = $this->post('firstname');
			$userData['lastname'] = $this->post('lastname');
			$userData['email'] = $this->post('email');
			$userData['mobile'] = $this->post('mobile');
			$userData['message'] = $this->post('message');
		}

		$this->form_validation->set_rules('lastname', 'firstname', 'trim|required');
		$this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');	
		$this->form_validation->set_rules('message', 'message', 'trim|required');

		if ($this->form_validation->run() === false) 
		{	
			if(form_error('firstname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('firstname'))
				], 400);
			}
			if(form_error('lastname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('lastname'))
				], 400);
			}

			if(form_error('mobile')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('mobile'))
				], 400);
			}

			if(form_error('message')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('message'))
				], 400);
			}


		} else {

			$mydata=array(
				'firstname'=>$userData['firstname'],
				'lastname'=>$userData['lastname'],
				'email'=>$userData['email'],
				'phone'=>$userData['mobile'],
				'message'=>$userData['message'],
				'crested_at'=>date('Y-m-d H:i:s'),
			);	

			$result=$this->Apimodel->add_details("contacts", $mydata);			

			if($result)
			{		
				$ret=mail('support@prosearchghana.com, info@prosearchghana.com', 'you got feedback from '.$userData['email'], $userData['message']);

				$array = [
					'status' => "1",
					'message'=>'Thank you for contacting us! We will get back to you soon',
					'refId' => $result,
				];

				$array = $this->arrcheck($array);
				$this->response($array, 200);

			} else {
				$this->response([
					'status' =>"0",
					'error' => "Some problems occurred, please try again.!"
				], 400);				

			}

		}

	}

	public function serviceList_get()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}

		$list = $this->Apimodel->get_cond_all('service',"status='1'");

		if(!empty($list)) 
		{
			foreach ($list as $c)
			{

				if($c->image!="")
				{
					$pic = base_url().'assets/images/service/'.$c->image;
				} else {
					$pic = base_url().'upload/noimg.png';
				}

				$array[] = [
					'id' => $c->id,
					'title'=>$c->title,
					'description'=>strip_tags($c->description),
					'pic'=>$pic,
					'created_at'=>$c->created_at,
				];				
			}

			$array = $this->arrcheck($array);
			$this->response([
				'status'=>"1",
				'list'=>$array,
			], 200);
		} else {
			$this->response([
				'status' => "0",
				'message' => 'No Data found.'
			], 400);
		}
	}

	public function providerSignUp_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['serviceType'] = $this->post('serviceType');
			$userData['serviceId'] = $this->post('serviceId');
			$userData['firstName'] = $this->post('firstName');
			$userData['lastName'] = $this->post('lastName');
			$userData['companyName'] = $this->post('companyName');
			$userData['mobileNo'] = $this->post('mobileNo');
			$userData['address'] = $this->post('address');
			$userData['cityId'] = $this->post('cityId');
			$userData['neighborhoodId'] = $this->post('neighborhoodId');
			$userData['password'] = $this->post('password');
			$userData['otp'] = $this->post('otp');
			$userData['businessPic'] = $this->post('businessPic');
		}

		$this->form_validation->set_rules('serviceType', 'Business Owner/Service Provider', 'trim|required');
		$this->form_validation->set_rules('serviceId', 'serviceId', 'trim|required');
		$this->form_validation->set_rules('firstName', 'Contact Person First Name', 'trim|required');
		$this->form_validation->set_rules('lastName', 'Contact Person Last Name', 'trim|required');
		$this->form_validation->set_rules('companyName', 'companyName', 'trim|required');
		$this->form_validation->set_rules('mobileNo', 'Contact Person mobile No', 'trim|required|is_unique[provider_list.contact_prsn_mobile]');	
		$this->form_validation->set_rules('address', 'Company Address', 'trim|required');	
		$this->form_validation->set_rules('cityId', 'City', 'trim|required');	
		$this->form_validation->set_rules('neighborhoodId', 'Neighborhood', 'trim|required');	
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('otp', 'otp', 'trim|required');
		$this->form_validation->set_message('min_length', '%s: the minimum of characters is %s');

		$this->form_validation->set_message('is_unique', 'The %s is already taken');

		if ($this->form_validation->run() === false) 
		{	
			if(form_error('serviceType')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('serviceType'))
				], 400);
			}

			if(form_error('serviceId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('serviceId'))
				], 400);
			}

			if(form_error('firstName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('firstName'))
				], 400);
			}
			if(form_error('lastName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('lastName'))
				], 400);
			}
			if(form_error('companyName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('companyName'))
				], 400);
			}
			if(form_error('mobileNo')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('mobileNo'))
				], 400);
			}
			if(form_error('address')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('address'))
				], 400);
			}
			if(form_error('cityId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('cityId'))
				], 400);
			}

			if(form_error('neighborhoodId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('neighborhoodId'))
				], 400);
			}
			if(form_error('password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('password'))
				], 400);
			}

			if(form_error('otp')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('otp'))
				], 400);
			}


		} else {

			$mydata = array();

			if($_FILES['businessPic']['name']!='') 
			{
				$config['upload_path'] = './assets/images/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 204800;
				$config['max_width'] = 30000;
				$config['max_height'] = 20000;
				$config['file_name'] = uniqid();
				$this->load->library('upload', $config);

				if($this->upload->do_upload('businessPic'))
				{				
					$file_data = $this->upload->data();
					$mydata['image'] = $file_data['file_name'];
				}			

			}

			$mydata['owner_type'] =$userData['serviceType'];
			$mydata['service_type'] =$userData['serviceId'];
			$mydata['contact_prsn_fname'] =$userData['firstName'];
			$mydata['contact_prsn_lname'] =$userData['lastName'];
			$mydata['company_name'] =$userData['companyName'];
			$mydata['contact_prsn_mobile'] =$userData['mobileNo'];
			$mydata['company_addr'] =$userData['address'];
			$mydata['city'] =$userData['cityId'];
			$mydata['neihborhood'] =$userData['neighborhoodId'];
			$mydata['password'] = base64_encode($userData['password']);
			$mydata['status'] = 1;
			$mydata['admin_status'] = 1;
			$mydata['vcode'] = $userData['otp'];
			$mydata['created_at']=date('Y-m-d H:i:s');

			$result=$this->Apimodel->add_details("provider_list", $mydata);

			if($result)
			{			

				$fetchdetails=$this->Apimodel->get_cond('provider_list', "id='$result'");

				if($fetchdetails->image!="")
				{
					$pic = base_url().'assets/images/profile/'.$fetchdetails->image;
				} else {
					$pic = base_url().'upload/noimg.png';
				}

				$array = [
					'status' => "1",
					'message'=>'You have registered successfully!',
					'providerId' => $fetchdetails->id,
					'serviceType' => $fetchdetails->owner_type,
					'serviceId' => $fetchdetails->service_type,
					'companyName' => $fetchdetails->company_name,
					'firstName' => $fetchdetails->contact_prsn_fname,
					'lastName' => $fetchdetails->contact_prsn_lname,
					'mobileNo' => $fetchdetails->contact_prsn_mobile,
					'address' => $fetchdetails->company_addr,
					'cityId' => $fetchdetails->city,
					'cityId' => $fetchdetails->city,
					'neighborhoodId' => $fetchdetails->neihborhood,
					'businessPic' => $pic,
					'password' => $fetchdetails->password,
				];

				$array = $this->arrcheck($array);
				$this->response($array, 200);

			} else {
				$this->response([
					'status' =>"0",
					'error' => "Some problems occurred, please try again.!"
				], 400);				

			}		
		}
	}

	public function getOtpProvider_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['mobileNo'] = $this->post('mobileNo');
		}

		$this->form_validation->set_rules('mobileNo', 'mobileNo', 'trim|required');

		if ($this->form_validation->run() === false) 
		{
			if(form_error('mobileNo')) 
			{
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('mobileNo'))
				], 400);
			}			

		} else {

			$otp = $this->generate_otp(6);
			$message = "Hi User, Your OTP is " . $otp." from Prosearch Ghana.";
			$from = '(202) 952-4499';
			$to = $userData['mobileNo'];

			$where="contact_prsn_mobile = '".$userData['mobileNo']."'";				

			if($this->Apimodel->count('provider_list', $where) == 1) 
			{				
				$this->response([
					'status' =>"2",
					'message' => "Mobile number already registered!"
				], 200);

			}else{
				
			$response = $this->twilio_lib->sms($from, $to,$message);

			if($response->IsError)
			{
				$this->response([
					'status' =>"0",
					'error' => "Permission to send an SMS has not been enabled for the region indicated by the 'To' number",
				], 400);

			} else{				

				$array = [
					'status' =>"1",
					'message' =>"OTP has been sent to your mobile number",
					'otp' =>$otp,							
				];

				$array = $this->arrcheck($array);

				$this->response($array, 200);	
			}
		}			
		}
	}

	public function updateProviderProfile_post()
	{

		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['providerId'] = $this->post('providerId');
			$userData['serviceType'] = $this->post('serviceType');
			$userData['serviceId'] = $this->post('serviceId');
			$userData['firstName'] = $this->post('firstName');
			$userData['lastName'] = $this->post('lastName');
			$userData['companyName'] = $this->post('companyName');
			$userData['address'] = $this->post('address');
			$userData['cityId'] = $this->post('cityId');
			$userData['neighborhoodId'] = $this->post('neighborhoodId');
			$userData['password'] = $this->post('password');
			$userData['businessPic'] = $this->post('businessPic');
		}

		$this->form_validation->set_rules('providerId', 'providerId', 'trim|required');
		$this->form_validation->set_rules('serviceType', 'Business Owner/Service Provider', 'trim|required');
		$this->form_validation->set_rules('serviceId', 'serviceId', 'trim|required');
		$this->form_validation->set_rules('firstName', 'Contact Person First Name', 'trim|required');
		$this->form_validation->set_rules('lastName', 'Contact Person Last Name', 'trim|required');
		$this->form_validation->set_rules('companyName', 'companyName', 'trim|required');	
		$this->form_validation->set_rules('address', 'Company Address', 'trim|required');	
		$this->form_validation->set_rules('cityId', 'City', 'trim|required');	
		$this->form_validation->set_rules('neighborhoodId', 'Neighborhood', 'trim|required');	
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');

		if($this->form_validation->run() === false) 
		{
			if(form_error('providerId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('providerId'))
				], 400);
			}

			if(form_error('serviceType')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('serviceType'))
				], 400);
			}

			if(form_error('serviceId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('serviceId'))
				], 400);
			}

			if(form_error('firstName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('firstName'))
				], 400);
			}
			if(form_error('lastName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('lastName'))
				], 400);
			}
			if(form_error('companyName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('companyName'))
				], 400);
			}

			if(form_error('address')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('address'))
				], 400);
			}
			if(form_error('cityId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('cityId'))
				], 400);
			}

			if(form_error('neighborhoodId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('neighborhoodId'))
				], 400);
			}
			if(form_error('password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('password'))
				], 400);
			}



		} else {

			$userId = $userData['providerId'];			
			$dataraw = $this->Apimodel->get_cond('provider_list', "id=$userId");

			if(!empty($dataraw))
			{
				$config['upload_path'] = './assets/images/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 204800;
				$config['max_width'] = 30000;
				$config['max_height'] = 20000;
				$config['file_name'] = uniqid();
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('businessPic'))
				{
					$error = array('error' => $this->upload->display_errors());
					@$image = $dataraw->image;

				} else {
					$file_data = $this->upload->data();
					$image = $file_data['file_name'];

				} 

				$mydata = array(
					'owner_type'=>$userData['serviceType'],
					'service_type'=>$userData['serviceId'],
					'contact_prsn_fname'=>$userData['firstName'],
					'contact_prsn_lname'=>$userData['lastName'],
					'company_name'=>$userData['companyName'],
					'company_addr'=>$userData['address'],
					'city'=>$userData['cityId'],
					'neihborhood'=>$userData['neighborhoodId'],
					'password'=> base64_encode($userData['password']),
					'image'=>$image,
				); 

				$where="id=$userId";

				$update=$this->Apimodel->update_cond('provider_list', $where, $mydata);

				$fetchdetails=$this->Apimodel->get_cond('provider_list', "id='$userId'");

				if($fetchdetails->image!="")
				{
					$pic = base_url().'assets/images/profile/'.$fetchdetails->image;
				} else {
					$pic = base_url().'upload/noimg.png';
				}

				$array = [
					'providerId' => $fetchdetails->id,
					'serviceType' => $fetchdetails->owner_type,
					'serviceId' => $fetchdetails->service_type,
					'companyName' => $fetchdetails->company_name,
					'firstName' => $fetchdetails->contact_prsn_fname,
					'lastName' => $fetchdetails->contact_prsn_lname,
					'mobileNo' => $fetchdetails->contact_prsn_mobile,
					'address' => $fetchdetails->company_addr,
					'cityId' => $fetchdetails->city,
					'cityId' => $fetchdetails->city,
					'neighborhoodId' => $fetchdetails->neihborhood,
					'businessPic' => $pic,
					'password' => $fetchdetails->password,
				];

				if($update)
				{
					$this->response([
						'status'=>"1",
						'message' => 'Your Profile updated successfully !',
						'personalInfo'=>$array
					], 200);
				} else {
					$this->response([
						'status' => "0",
						'error' => "Some problems occurred, please try again."
					], 400);
				}

			} else {
				$this->response([
					'status' => "0",
					'error' => 'No provider found.'
				], 400);
			}

		}

	}

	public function providerLogin_post()
	{		
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj))
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['mobileNo'] = $this->post('mobileNo');
			$userData['password'] = $this->post('password');
		}

		$this->form_validation->set_rules('mobileNo', 'mobileNo', 'trim|required');	
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() === false) 
		{	

			if(form_error('mobileNo')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('mobileNo'))
				], 400);
			}

			if(form_error('password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('password'))
				], 400);
			}


		} else {

			$where = "contact_prsn_mobile = '".$userData['mobileNo']."' ";
			if ($this->Apimodel->count('provider_list', $where) != 1) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid MobileNo"
				], 400);

			}else{

				$fetchdetails = $this->Apimodel->get_cond('provider_list', $where);
				$pass= base64_encode($userData['password']);

				if($pass != $fetchdetails->password) 
				{
					$this->response([
						'status' =>"0",
						'error' => "Invalid Password"
					], 400);

				} else{

					if($fetchdetails->image!="")
					{
						$pic = base_url().'assets/images/profile/'.$fetchdetails->image;
					} else {
						$pic = base_url().'upload/noimg.png';
					}

					$array = [
						'status' => "1",
						'providerId' => $fetchdetails->id,
						'serviceType' => $fetchdetails->owner_type,
						'serviceId' => $fetchdetails->service_type,
						'companyName' => $fetchdetails->company_name,
						'firstName' => $fetchdetails->contact_prsn_fname,
						'lastName' => $fetchdetails->contact_prsn_lname,
						'mobileNo' => $fetchdetails->contact_prsn_mobile,
						'address' => $fetchdetails->company_addr,
						'cityId' => $fetchdetails->city,
						'cityId' => $fetchdetails->city,
						'neighborhoodId' => $fetchdetails->neihborhood,
						'businessPic' => $pic,
						'password' => $fetchdetails->password,
					];

					$array = $this->arrcheck($array);
					$this->response($array, 200);

				}
			}		

		}
	}

	public function recoveryProviderPassword_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj))
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['mobileNo'] = $this->post('mobileNo');
		}

		$this->form_validation->set_rules('mobileNo', 'mobileNo', 'trim|required');	
		if ($this->form_validation->run() === false) 
		{	

			if(form_error('mobileNo')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('mobileNo'))
				], 400);
			}

		} else {

			$where = "contact_prsn_mobile = '".$userData['mobileNo']."' ";
			if ($this->Apimodel->count('provider_list', $where) != 1) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid MobileNo"
				], 400);

			}else{

				$phone= $userData['mobileNo'];

				$passw = rand(100000, 999999);
				$bpass = base64_encode($passw);

				$frm= array('password'=>$bpass);

				$res = $this->db->update('provider_list', $frm, array('contact_prsn_mobile' =>$phone,'admin_status'=>1));

				$message = "Your New Password is " . $passw. " for Prosearch Ghana."; 

				$from = '(202) 952-4499';
				$to = $phone;

				$response = $this->twilio_lib->sms($from, $to, $message);

				if($response->IsError)
				{
					$this->response([
						'status' =>"0",
						'error' => "Permission to send an SMS has not been enabled for the region indicated by the 'To' number",
					], 400);

				} else{

					$array = [
						'status' =>"1",
						'message' =>"New Password has been Sent to Your Phone Number..",
						'MobileNo' =>$phone,
					];

					$array = $this->arrcheck($array);

					$this->response($array, 200);	
				}
			}
		}		

	}


	public function generate_numbers($start, $count, $digits)
	{
		$result = array();
		for ($n = $start; $n < $start + $count; $n++) {
			$result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
		}
		return $result;
	}

	public function generate_otp($length)
	{
		$characters = '123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) 
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function arrcheck($array)
	{
		array_walk_recursive($array, function (&$array, $key){
			$array = (null === $array)? '' : $array;
		}); 
		return $array;
	}

	public function hash($string) 
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}

	public function enc_password($password)
	{
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		return $encrypted_password;
	}
}
