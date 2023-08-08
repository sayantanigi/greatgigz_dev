<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jobs/Jobs_model');
		 $this->load->model('Users_model');
	}

	public function index()
	{
		$data['setting']=$this->Crud_model->get_single('setting');
		$data['list_featuredjob']=$this->Crud_model->GetData('postjob',"","is_delete='0'",'','(id)desc','8');
		$data['list_services']=$this->Crud_model->GetData('our_service');
		$data['list_category']=$this->Crud_model->GetData('category','',"status='1'");
    $data['list_company']=$this->Crud_model->GetData('postjob','id,post_slug_url,company_name',"is_delete='0'","company_name",'(id) desc');
    // $data['list_location']=$this->Crud_model->GetData('postjob','AVG(location) as local',"is_delete='0'","location",'(location) desc');
     $data['list_location']=$this->mymodel->get_location();
     $data['cms_featuredservices']=$this->Crud_model->get_single('manage_cms',"id='5'");
     $data['cms_findjob']=$this->Crud_model->get_single('manage_cms',"id='6'");
     $data['cms_join']=$this->Crud_model->get_single('manage_cms',"id='7'");
		$this->load->view('jobs/common/header');
		$this->load->view('jobs/home',$data);
		$this->load->view('jobs/common/footer');
	}

	function about_us()
 {
		 $this->load->view('common/header');
		 $this->load->view('frontend/about_us');
		 $this->load->view('common/footer');
 }
	/*------------------- save contact ----------------------*/
 function contact()
 {
		 $this->load->view('common/header');
		 $this->load->view('frontend/contact');
		 $this->load->view('common/footer');
 }

	 function save_contact()
 {
	 $data=array(
		 'name'=>$_POST['name'],
		 'email'=>$_POST['email'],
		 'subject'=>$_POST['subject'],
		 'message'=>$_POST['message'],
	 );
			 if($this->mymodel->insert('contact_us',$data))
		 {
			 $this->session->set_flashdata('message', 'Contact Detail Successfully !');

		 }
		 else{
			 $this->session->set_flashdata('message', 'Error!');

		 }
			redirect(base_url('contact'));
 }
 /*------------------- end save contact ----------------------*/

	function job_listing()
	{
		$data['get_category']=$this->Crud_model->GetData('category','',"status='1'");
		  $this->load->view('common/header');
		  $this->load->view('frontend/job_listing',$data);
		  $this->load->view('common/footer');
	}

 function search_result()
  {
    $data['get_category']=$this->Crud_model->GetData('category','',"status='1'");
      $this->load->view('jobs/common/header');
      $this->load->view('jobs/frontend/job_listing',$data);
      $this->load->view('jobs/common/footer');
  }

	////////////////////// start ajax job list //////////////////////
	function fetch_data()
  {

   sleep(1);

   $category_id = $this->input->post('category_id');
   $title = $this->input->post('title_keyword');
   $location = $this->input->post('location');
   $jobtype = $this->input->post('jobtype');
   $price = $this->input->post('price');

    $search_title = $this->input->post('search_title');
    $search_location = $this->input->post('search_location');
    $category_url = $this->input->post('category_url');
    $company_url = $this->input->post('company_url');
    $location_url = $this->input->post('location_url');
    if(!empty($category_id) || !empty($title) || !empty($location)|| !empty($search_title) || !empty($search_location) || !empty($jobtypear) || !empty($price))
    {
    $total_count=$this->Jobs_model->getcount($title, $location,$category_id,$search_title,$search_location,$jobtype,$price);

    }
    if(!empty($category_url)){
  $get_postjobcategory=$this->Crud_model->GetData('postjob','',"category_id='".$category_url."' and is_delete='0'");
  $total_count=count($get_postjobcategory);
  }
  if(!empty($company_url)){
  $get_postjobcompany=$this->Crud_model->GetData('postjob','',"company_name='".$company_url."' and is_delete='0'");
  $total_count=count($get_postjobcompany);
  }
  if(!empty($location_url)){
  $get_postjoblocation=$this->Crud_model->GetData('postjob','',"company_name='".$location_url."' and is_delete='0'");
  $total_count=count($get_postjoblocation);
}
  else{
      $total_count=$this->Jobs_model->getcount($title, $location,$category_id,$search_title,$search_location,$jobtype,$price);
  }

   $this->load->library('pagination');
   $config = array();
   $config['base_url'] = '#';
   $config['total_rows'] = $total_count;
   $config['per_page'] =10;
   $config['uri_segment'] = 3;
   $config['use_page_numbers'] = TRUE;
   // $config['full_tag_open'] = '<ul pagination pull-right>';
   // $config['full_tag_close'] = '</ul>';
   $config['first_tag_open'] = '<li>';
   $config['first_tag_close'] = '</li>';
   $config['last_tag_open'] = '<li>';
   $config['last_tag_close'] = '</li>';
   $config['next_link'] = '&gt;';
   $config['next_tag_open'] = '<li>';
   $config['next_tag_close'] = '</li>';
   $config['prev_link'] = '&lt;';
   $config['prev_tag_open'] = '<li>';
   $config['prev_tag_close'] = '</li>';
   $config['cur_tag_open'] = "<li class='active'><a href='#'>";
   $config['cur_tag_close'] = '</a></li>';
   $config['num_tag_open'] = '<li>';
   $config['num_tag_close'] = '</li>';
   $config['num_links'] = 3;
   $this->pagination->initialize($config);
   $page = $this->uri->segment(4);
   //echo $page;die;
   $start = ($page - 1) * $config['per_page'];

    if(!empty($category_id) || !empty($title) || !empty($location)|| !empty($search_title) || !empty($search_location) || !empty($jobtypear) || !empty($price))
    {
   	$getdata=$this->Jobs_model->fetchdata($config["per_page"], $start, $title, $location,$category_id,$search_title,$search_location,$jobtype,$price,$category_url,$company_url,$location_url);
   }
    elseif(!empty($category_url))
    {
    $getdata=$this->Jobs_model->fetchdata($config["per_page"], $start, $title, $location,$category_id,$search_title,$search_location,$jobtype,$price,$category_url,$company_url,$location_url);

    }
    elseif(!empty($company_url))
    {
    $getdata=$this->Jobs_model->fetchdata($config["per_page"], $start, $title, $location,$category_id,$search_title,$search_location,$jobtype,$price,$category_url,$company_url,$location_url);

    }
    elseif(!empty($location_url))
    {
    $getdata=$this->Jobs_model->fetchdata($config["per_page"], $start, $title, $location,$category_id,$search_title,$search_location,$jobtype,$price,$category_url,$company_url,$location_url);

    }
    else{
      $getdata=$this->Jobs_model->fetchdata($config["per_page"], $start, $title, $location,$category_id,$search_title,$search_location,$jobtype,$price,$category_url,$company_url,$location_url);
    }
   $output = array(
    'pagination_link'  => $this->pagination->create_links(),
    	'joblist'   =>$getdata,
    // 'keyword'   =>$this->input->post('search_title'),
     //'keyword_location'   =>$this->input->post('search_location'),
   );
   echo json_encode($output);
  }
 ////////////////////// end ajax job list //////////////////////


  function job_detail($slug_url)
  {
  	$data['jobdetail']=$this->Crud_model->get_single('postjob',"post_slug_url='".$slug_url."'");
  	$data['get_users']=$this->Crud_model->get_single('users',"userId='".@$_SESSION['commonUser']['userId']."' and userType='1'");
  	$data['get_appliedjob']=$this->Crud_model->get_single('applied_jobs',"user_id='".@$_SESSION['commonUser']['userId']."' and job_id='".$data['jobdetail']->id."'");
		 $data['list_similarjob']=$this->Crud_model->GetData('postjob',"","is_delete='0'",'','(id)desc','5');
  	 $this->load->view('common/header');
		  $this->load->view('frontend/job_detail',$data);
		  $this->load->view('common/footer');
  }

	////////////////// candidadate lisitng /////////////////////////

 function candidate_listing()
 {
	 $data['get_category']=$this->Crud_model->GetData('category','',"status='1'");
	  $data['get_skills']=$this->Crud_model->GetData('skills','',"status='1'");
	 $this->load->view('common/header');
		 $this->load->view('frontend/candidate_listing',$data);
		 $this->load->view('common/footer');
 }

 function list_candidate_data()
  {

   sleep(1);

   $category_id = $this->input->post('category_id');
   $skill_id = $this->input->post('skill_id');
   $jobtype = $this->input->post('jobtype');
   $title = $this->input->post('title_keyword');
   $location = $this->input->post('location');
   $price = $this->input->post('price');

    $total_count=$this->Users_model->getcount($title, $location,$category_id,$price,$skill_id,$jobtype);
   $this->load->library('pagination');
   $config = array();
   $config['base_url'] = '#';
   $config['total_rows'] = $total_count;
   $config['per_page'] =10;
   $config['uri_segment'] = 3;
   $config['use_page_numbers'] = TRUE;

   $config['first_tag_open'] = '<li>';
   $config['first_tag_close'] = '</li>';
   $config['last_tag_open'] = '<li>';
   $config['last_tag_close'] = '</li>';
   $config['next_link'] = '&gt;';
   $config['next_tag_open'] = '<li>';
   $config['next_tag_close'] = '</li>';
   $config['prev_link'] = '&lt;';
   $config['prev_tag_open'] = '<li>';
   $config['prev_tag_close'] = '</li>';
   $config['cur_tag_open'] = "<li class='active'><a href='#'>";
   $config['cur_tag_close'] = '</a></li>';
   $config['num_tag_open'] = '<li>';
   $config['num_tag_close'] = '</li>';
   $config['num_links'] = 3;
   $this->pagination->initialize($config);
   $page = $this->uri->segment(3);
   $start = ($page - 1) * $config['per_page'];

    $getdata=$this->Users_model->fetchdata($config["per_page"], $start, $title, $location,$category_id,$price,$skill_id,$jobtype);

   $output = array(
    'pagination_link'  => $this->pagination->create_links(),
      'candidatelist'   =>$getdata,
   );
   echo json_encode($output);
  }
 ////////////////// end candidadate lisitng /////////////////////

 function pricing()
{
	$data['get_pricing']=$this->Crud_model->GetData('subscription','','','','','');
     $data['cms_pricing']=$this->Crud_model->get_single('manage_cms',"id='4'");
	$this->load->view('common/header');
		$this->load->view('frontend/pricing',$data);
		$this->load->view('common/footer');
}

/*=========== Start emmployer listing and detail============= */

  function employer_listing()
  {
    $data['list_employer']=$this->Crud_model->GetData('users','slug_url,userId,firstname,lastname',"userType='2' and status='1'");
      $this->load->view('common/header');
      $this->load->view('frontend/employer_listing',$data);
      $this->load->view('common/footer');
  }

  function get_emplyerData()
  {
    $data['get_employerData']=$this->Crud_model->GetData('users','slug_url,userId,firstname,lastname',"firstname like'".$_POST['value']."%' and userType='2' and status='1'");
    $data['alpha']=$_POST['value'];
    $this->load->view('frontend/employer_data',$data);
  }

  function employer_detail($slug_url=false)
  {
    if($slug_url==false)
    {
      show_404();
      exit();
    }
    else{
      $data['get_employer']=$this->Crud_model->get_single('users',"slug_url='".$slug_url."' and userType='2' and status='1'");
    $this->load->view('common/header');
      $this->load->view('frontend/employer_detail',$data);
      $this->load->view('common/footer');
    }

  }
  /*=========== end emmployer listing and detail============= */

}
