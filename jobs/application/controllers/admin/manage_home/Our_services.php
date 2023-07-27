<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Our_services extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelHome/Our_service_model');
	}
	function index()
	{
   
		$header = array('title' => 'our service');
		$data = array(
            'heading' => 'List of our services',
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/manage_master/ourservice_list',$data);
        $this->load->view('admin/common/footer');
	}

	 public function ajax_manage_page()   

{
        $get_data = $this->Our_service_model->get_datatables();
        if(empty($_POST['start']))
   {

    $no=0;
       }
       else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($get_data as $row) 
        {
            
              $btn = '<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>'; 
            
           if(strlen($row->description)>50)
          {
            $desc=substr($row->description,0,50).'...';
          }
          else {
            $desc=$row->description;
          }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
             $nestedData[] = ucwords($row->title);
            $nestedData[] = $desc;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Our_service_model->count_all(),
                    "recordsFiltered" => $this->Our_service_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create_action()
  {
    $get_data=$this->Crud_model->get_single('our_service',"title='".$_POST['title']."'");
    if(empty($get_data)){
    $data=array(
      'title'=>$_POST['title'],
      'description'=>$_POST['description'],
      'created_date'=>date('Y-m-d H:i:s'),
    );

    $this->db->insert('our_service',$data);
    $this->session->set_flashdata('message', 'Our service added successfully');
    echo "1"; exit;
  }
  else{
    echo "0"; exit;
  }
    
  }

   public function get_value()
    {
      $get_data=$this->Crud_model->get_single('our_service',"id='".$_POST['id']."'");
     
      $data=array(
        'id'=>$get_data->id,
        'title'=>$get_data->title,
        'description'=>$get_data->description,
      );
     
      echo json_encode($data);exit;
  }

    function update_action()
    {
         
      $get_data=$this->Crud_model->get_single_record('our_service',"title='".$_POST['title']."' and id!='".$_POST['id']."'");
      if(empty($get_data))
      {    
       $data = array(
      'title'=>$_POST['title'],
      'description'=>$_POST['description'],             
             );
       $this->Crud_model->SaveData('our_service',$data,"id='".$_POST['id']."'");
        $this->session->set_flashdata('message', 'Our service updated successfully');

       echo 1; exit;
     }else{
      echo "0"; exit;
     }
    
    }
   

}