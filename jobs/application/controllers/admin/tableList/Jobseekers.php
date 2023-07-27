<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Jobseekers extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tableList/Jobseekers_model');
        $this->load->model('Users_model');
    }

    function index()
  	{

  		$header = array('title' => 'jobseeker');
  		$data = array(
              'heading' => 'List of Jobseekers',
          );
          $this->load->view('admin/common/header', $header);
          $this->load->view('admin/common/sidebar');
          $this->load->view('admin/tableList/jobseeker_list',$data);
          $this->load->view('admin/common/footer');
  	}

  function ajax_manage_page()
  	{
      $cond="users.userType='1'";
  		 $GetData = $this->Jobseekers_model->get_datatables($cond);
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

              $btn = ''.anchor(admin_url('jobseekers/view/'.base64_encode($row->userId)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>View</span>');
              $btn .= '|'.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->userId.')">Delete</span>';
           
  	            $no++;
  	            $nestedData = array();
  	          $nestedData[] = $no;
                $nestedData[] = ucwords($row->firstname.' '.$row->lastname);
                $nestedData[] = ucfirst($row->job_title);
                $nestedData[] = $row->email;
                $nestedData[] = $row->mobile;
  	  	
  	            $nestedData[] = $btn;
  	            $data[] = $nestedData;
          }

      	$output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->Jobseekers_model->count_all($cond),
                  "recordsFiltered" => $this->Jobseekers_model->count_filtered($cond),
                  "data" => $data,
          );

      	echo json_encode($output);
  	}

   

  	function view($id)
  	 {
  			$this->load->model('Users_model');
         $cond="users.userId ='".base64_decode($id)."'";
     $get_userdata=$this->Users_model->get_users($cond);
     if(!empty($get_userdata->skill_id))
     {
      $skillid=$get_userdata->skill_id;
     }
     else{
      $skillid=0;
     }
     $get_skill=$this->Crud_model->GetData('skills','',"id IN(".$skillid.")");
     $get_category=$this->Crud_model->get_single('category','',"id='".@$get_userdata->category_id."'");
     $list_education=$this->Crud_model->GetData('user_education','',"user_id='".@$get_userdata->userId."'");
     $list_workexperience=$this->Crud_model->GetData('user_workexperience','',"user_id='".@$get_userdata->userId."'");

  			 $header = array('title' => 'jobseeker view');
  			 $data = array(
  					 'heading' => 'JobbSeeker',
  					 'get_userdata' => $get_userdata,
             'get_skill' => $get_skill,
             'get_category' => $get_category,
             'list_education' => $list_education,
             'list_workexperience' => $list_workexperience,
  			 );
  			 $this->load->view('admin/common/header', $header);
  			 $this->load->view('admin/common/sidebar');
  			 $this->load->view('admin/tableList/jobseeker_view',$data);
  			 $this->load->view('admin/common/footer');
  	 }

    
     public function delete()
    {
        if(isset($_POST['cid']))
        {
          $get_user=$this->Crud_model->get_single('users',"userId='".$_POST['cid']."'");
          if(!empty($get_user->profilePic) && file_exists('uploads/users/'.$get_user->profilePic))
          {
            @unlink('uploads/users/'.$get_user->profilePic);
          }
           $this->Crud_model->DeleteData('users',"userId='".$_POST['cid']."'");
           $this->Crud_model->DeleteData('user_education',"user_id='".$_POST['cid']."'");
           $this->Crud_model->DeleteData('user_workexperience',"user_id='".$_POST['cid']."'");
        }
    }

    ///////////////////// import excel sheet////////////////////

public function import_excel()
  {

      $file = $_FILES['excel_file']['tmp_name'];
        $this->load->library('Excel');
        //read file from path

        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true);

        $arrayCount = count($allDataInSheet);
        $i = 1;
        $fields_fun=array();
        foreach ($allDataInSheet as $key)
        {

           if($i>0)
           {
              $fields_fun[] = $key;
           }


            $i++;
        }

        $removed = array_shift($fields_fun);

        if(!isset($fields_fun))
        {
            $this->session->set_flashdata('message', 'Excel sheet is blank');
            redirect(admin_url('jobseekers'));
        }


        $data = $fields_fun;

            if(!empty($data)){
            foreach ($data as $val)
            {
                if($val[0] !='Firstname' || $val[1] !='Lastname')
                {
                if($val[0]!='')
                {
                      if($val[1]!='')
                      {
                        
                            if(!empty($val[4]))
                                {
                                 $phone=$val[4];
                                }
                                else
                                {
                                  $phone="";
                                }
                         if(!empty($val[3]))
                             {
                              $email=$val[3];
                             }
                             else
                             {
                               $email="";
                             }
                            if(!empty($val[2]))
                             {
                              $job_title=$val[2];
                             }
                             else
                             {
                               $job_title="";
                             }
                            if(!empty($val[1]))
                             {
                              $lastname=$val[1];
                             }
                             else
                             {
                               $lastname="";
                             }
                             if(!empty($val[0]))
                             {
                              $firstname=$val[0];
                             }
                             else
                             {
                               $firstname="";
                             }
               $fullname =$firstname.$lastname;
              if (empty($fullname) || $fullname == '') {
                  $fullname =$firstname.$lastname;
              }
              $slug = strtolower(url_title($fullname));
              $slug_url =$this->Users_model->get_unique_url($slug);
                           $data = array(
                                          'firstname' => $firstname,
                                          'lastname' => $lastname,
                                          'job_title' => $job_title,
                                          'email' =>$email,
                                          'password' =>md5(123456),
                                          'userType' =>1,
                                          'mobile' =>$phone,
                                          'slug_url' =>$slug_url,
                                          'created_date'=> date('Y-m-d H:i:s'),
                                          );

                            $this->Crud_model->SaveData('users',$data);
                        }

                }
                }
            }

        $this->session->set_flashdata('message', 'Import file upload successfully');
      }
      else{
         $this->session->set_flashdata('message', 'Error');
      }
          redirect(admin_url('jobseekers'));
}

        /////////////////  end import excel sheet////////////////////

}//end controller

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
