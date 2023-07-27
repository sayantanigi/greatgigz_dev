<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Employers extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tableList/Employers_model');
        $this->load->model('Users_model');
    }

    function index()
  	{

  		$header = array('title' => 'employer');
  		$data = array(
              'heading' => 'List of Employers',
          );
          $this->load->view('admin/common/header', $header);
          $this->load->view('admin/common/sidebar');
          $this->load->view('admin/tableList/employer_list',$data);
          $this->load->view('admin/common/footer');
  	}

  function ajax_manage_page()
  	{
      $cond="users.userType='2'";
  		 $GetData = $this->Employers_model->get_datatables($cond);
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

              $btn = ''.anchor(admin_url('employers/view/'.base64_encode($row->userId)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>View</span>');
              $btn.= '| '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->userId.')"><i class="fa fa-trash mr-1"></i></span>';
           
  	            $no++;
  	            $nestedData = array();
  	          $nestedData[] = $no;
                $nestedData[] = $row->firstname.' '.$row->lastname;
                $nestedData[] = ucfirst($row->organization_type);
                $nestedData[] = $row->email;
                $nestedData[] = $row->mobile;
  	  	
  	            $nestedData[] = $btn;
  	            $data[] = $nestedData;
          }

      	$output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->Employers_model->count_all($cond),
                  "recordsFiltered" => $this->Employers_model->count_filtered($cond),
                  "data" => $data,
          );

      	echo json_encode($output);
  	}

   

  	function view($id)
  	 {
  			 $this->load->model('Users_model');
  			 $cond="users.userId ='".base64_decode($id)."'";
  	 $get_userdata=$this->Users_model->get_users($cond);
       $cond="employer.employer_id='".base64_decode($id)."'";
       $list_subscription=$this->mymodel->get_subscriptionData($cond);
  			 $header = array('title' => 'user view');
  			 $data = array(
  					 'heading' => 'Employers',
  					 'get_data' =>$get_userdata,
             'list_subscription' =>$list_subscription,
  			 );
  			 $this->load->view('admin/common/header', $header);
  			 $this->load->view('admin/common/sidebar');
  			 $this->load->view('admin/tableList/employer_view',$data);
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
            redirect(admin_url('employers'));
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
                                          'userType' =>2,
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
          redirect(admin_url('employers'));
}

        /////////////////  end import excel sheet////////////////////

}//end controller


