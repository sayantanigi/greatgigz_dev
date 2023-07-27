<?php 
defined('BASEPATH')  OR exit('No direct script are allowed');
 class Faq extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->model('modelHome/Faq_model');
    }
    public function index()
    {
       $header = array('title' => 'faq');
        $data = array(
            'heading' => 'List of FAQ',
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/manage_master/faq_list',$data);
        $this->load->view('admin/common/footer');
  }

  public function ajax_manage_page()   

{
        $get_cms = $this->Faq_model->get_datatables();
        if(empty($_POST['start']))
   {

    $no=0;
       }
       else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($get_cms as $row) 
        {
            
              $btn = '<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i></span>'; 
          if(strlen($row->description)>100)
          {
            $desc=substr($row->description,0,100).'...';
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
                    "recordsTotal" => $this->Faq_model->count_all(),
                    "recordsFiltered" => $this->Faq_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
  public function create_action()
    {
         
   $get_data=$this->Crud_model->get_single('faq',"title='".$_POST['title']."'");
   
 if(empty($get_data))
      {
          $data = array(
                  'title'=> $_POST['title'],
                  'description'=>$_POST['description'],
                  'created_date'=> date('Y-m-d H:i:s'),
                 );
    
            $this->Crud_model->SaveData('faq',$data);
            $this->session->set_flashdata('message', 'FAQ created successfully');
            echo "1"; exit;
         } 
         else {
              echo "0"; exit;
            } 
    }

     public function get_value()
  {
    $get_data=$this->Crud_model->get_single('faq',"id='".$_POST['id']."'");
 
    $data=array(
      'id'=>$get_data->id,
      'title'=>$get_data->title,
      'description'=>$get_data->description,
    );
    echo json_encode($data);exit;
  }
   
 public function update_action()
    {     
      $update_data=$this->Crud_model->get_single_record('faq',"title ='".$_POST['title']."' and id!='".$_POST['id']."'");
     
      if(empty($update_data))
      {
        $data=array(
        'title'=>$_POST['title'],
        'description'=>$_POST['description'],
        );
        $this->Crud_model->SaveData('faq',$data,"id='".$_POST['id']."'");
        $this->session->set_flashdata('message', 'FAQ Updated successfully');
        echo "1";exit;
      }
      else
      {
        echo "0";exit;
      } 

    }

    
}