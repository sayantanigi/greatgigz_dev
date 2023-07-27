<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tableList/Subscribers_model');
        $this->load->model('Users_model');
    }

    function index()
  	{

  		$header = array('title' => 'subscriber');
  		$data = array(
              'heading' => 'List of subscribers',
          );
          $this->load->view('admin/common/header', $header);
          $this->load->view('admin/common/sidebar');
          $this->load->view('admin/tableList/subscriber_list',$data);
          $this->load->view('admin/common/footer');
  	}

  function ajax_manage_page()
  	{
     
  		 $GetData = $this->Subscribers_model->get_datatables();
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
  
            $btn='<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->id.')">Delete</span>';
            if($_POST['select_all']=="true")
            {
                $chked = "checked";
            }else{

                $chked = "";
            }
  	            $no++;
  	            $nestedData = array();
  	          $nestedData[] = $no;
               $nestedData[] ='<input type="checkbox" class="sub_childitem" name="sub_childitem[]" onclick="return check_data();"  value="'.$row->id.'" '.$chked.'>';
               
                $nestedData[] = $row->email;
               
  	            $nestedData[] = $btn;
  	            $data[] = $nestedData;
          }

      	$output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->Subscribers_model->count_all(),
                  "recordsFiltered" => $this->Subscribers_model->count_filtered(),
                  "data" => $data,
          );

      	echo json_encode($output);
  	}

   
     public function delete()
    {
        if(isset($_POST['cid']))
        {
          
           $this->Crud_model->DeleteData('subscriber',"id='".$_POST['cid']."'");
           
        }
    }

    function deleteAllItem()
    {
        $subscriberId=explode(',', @$_POST['subscriberId']);
        foreach($subscriberId as $key)
        {
            
            $this->Crud_model->DeleteData('subscriber',"id='".$key."'");
        }
       
        echo "1"; exit;
     

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
            redirect(admin_url('subscribers'));
        }


        $data = $fields_fun;

            if(!empty($data)){
            foreach ($data as $val)
            {
                if($val[0] !='Email ID')
                {
                if($val[0]!='')
                {
                             if(!empty($val[0]))
                             {
                              $email=$val[0];
                             }
                             else
                             {
                               $email="";
                             }
              
                           $data = array(
                                         
                                          'email' =>$email,
                                          'created_date'=> date('Y-m-d H:i:s'),
                                          );

                            $this->Crud_model->SaveData('subscriber',$data);

                }
                }
            }

        $this->session->set_flashdata('message', 'Import file upload successfully');
      }
      else{
         $this->session->set_flashdata('message', 'Error');
      }
          redirect(admin_url('subscribers'));
}

        /////////////////  end import excel sheet////////////////////

}//end controller


