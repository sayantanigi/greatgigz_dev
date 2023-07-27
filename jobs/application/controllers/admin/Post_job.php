<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_job extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Post_job_model');
	}
	function index()
	{
    //$get_category=$this->Crud_model->GetData('category');
		$header = array('title' => 'Post Job');
		$data = array(
            'heading' => 'Post Job',
            //'get_category' => $get_category
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/post_job/list',$data);
        $this->load->view('admin/footer');
	}

function ajax_manage_page()
	{
		 $GetData = $this->Post_job_model->get_datatables();
        if(empty($_POST['start']))
   		{

    		$no=0;
       	}
        else{
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row)
        {

          $btn = ''.anchor(admin_url('post_job/view/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>view</span>');

	            $no++;
	            $nestedData = array();
	          $nestedData[] = $no;
	            $nestedData[] = ucwords($row->post_title);
              $nestedData[] = ucwords($row->category_name);
              $nestedData[] = $row->duration;
              $nestedData[] = "USD"." ".$row->charges;
	  	//		 $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
	            $nestedData[] = $btn;
	            $data[] = $nestedData;
        }

    	$output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Post_job_model->count_all(),
                "recordsFiltered" => $this->Post_job_model->count_filtered(),
                "data" => $data,
        );

    	echo json_encode($output);
	}

	function view($id)
	 {
			 $con="postjob.id='".base64_decode($id)."'";
	 $get_post_job=$this->Post_job_model->viewdata($con);

			 $header = array('title' => 'Post Job');
			 $data = array(
					 'heading' => 'Post Job',
					 'get_post_job' => $get_post_job,
			 );
			 $this->load->view('admin/header', $header);
			 $this->load->view('admin/sidebar');
			 $this->load->view('admin/post_job/view',$data);
			 $this->load->view('admin/footer');
	 }
}
?>
