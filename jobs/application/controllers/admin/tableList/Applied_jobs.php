<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applied_jobs extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tableList/Applied_jobs_model');
        
    }

    function index()
  	{

  		$header = array('title' => 'Applied jobs');
  		$data = array(
              'heading' => 'List of Applied Jobs',
          );
          $this->load->view('admin/common/header', $header);
          $this->load->view('admin/common/sidebar');
          $this->load->view('admin/tableList/appliedjob_list',$data);
          $this->load->view('admin/common/footer');
  	}

  function ajax_manage_page()
  	{
     
  		 $GetData = $this->Applied_jobs_model->get_datatables();
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

              // $btn = ''.anchor(admin_url('applied-jobs/view/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>View</span>');
              // $btn.= '| '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->userId.')"><i class="fa fa-trash mr-1"></i></span>';
            if($row->job_status=='shortlis'){
                      $jobstatus= "<span class='badge badge-warning'>Short List</span>";
                    } if($row->job_status=='finalselected')
                    {

                      $jobstatus= "<span class='badge badge-success'>Selected</span>";
                    }
                    else{
                      $jobstatus='<span class="badge badge-danger">Pending</span>';
                    }
                   
  	            $no++;
  	            $nestedData = array();
  	          $nestedData[] = $no;
                $nestedData[] = ucwords($row->firstname.' '.$row->lastname);
                 $nestedData[] = ucwords($row->category_name);
                $nestedData[] = ucwords($row->job_title);
                $nestedData[] = $row->job_type;
                $nestedData[] = '<a href="'.base_url('uploads/jobseeker_resume/'.$row->resume).'">'.$row->resume.'</a>';
  	            $nestedData[] = $jobstatus;
  	            $data[] = $nestedData;
          }

      	$output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->Applied_jobs_model->count_all(),
                  "recordsFiltered" => $this->Applied_jobs_model->count_filtered(),
                  "data" => $data,
          );

      	echo json_encode($output);
  	}

   

  	function view($id)
  	 {
  			 
  			 $cond="job.id ='".base64_decode($id)."'";
  	 $get_data=$this->Jobs_model->get_jobview($cond);

  			 $header = array('title' => 'job view');
  			 $data = array(
  					 'heading' => 'Jobs View',
  					 'get_data' => $get_data,
  			 );
  			 $this->load->view('admin/common/header', $header);
  			 $this->load->view('admin/common/sidebar');
  			 $this->load->view('admin/tableList/jobs_view',$data);
  			 $this->load->view('admin/common/footer');
  	 }

    

     public function delete()
    {
        if(isset($_POST['cid']))
        {
          $get_user=$this->Crud_model->get_single('postjob',"user_id='".$_POST['cid']."'");
          if(!empty($get_user->company_logo) && file_exists('uploads/company_logo/'.$get_user->company_logo))
          {
            @unlink('uploads/users/'.$get_user->company_logo);
          }
           $this->Crud_model->DeleteData('users',"userId='".$_POST['cid']."'");
           $this->Crud_model->DeleteData('postjob',"user_id='".$_POST['cid']."'");
        }
    }


   

}//end controller


