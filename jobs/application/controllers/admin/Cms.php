<?php 
defined('BASEPATH')  OR exit('No direct script are allowed');
 class Cms extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->model('Cmsmodel');
    }
    public function index()
    {
       $header = array('title' => 'cms');
        $data = array(
            'heading' => 'List of cms',
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/cms/list',$data);
        $this->load->view('admin/common/footer');
  }

  public function ajax_manage_page()   

{
        $get_cms = $this->Cmsmodel->get_datatables();
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
            
             $btn = ''.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#viewModal" onclick="view_data('.$row->id.')" data-placement="right"><i class="far fa-eye mr-1"></i></span>';
              $btn .= '| '.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i></span>'; 
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
                    "recordsTotal" => $this->Cmsmodel->count_all(),
                    "recordsFiltered" => $this->Cmsmodel->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
  public function create_action()
    {
         
   $get_data=$this->Crud_model->get_single('manage_cms',"title='".$_POST['title']."'");
   if($_FILES['image']['name']!='' )
        {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/cms/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/cms/';
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
                  }
        }

          else{
               $image  = "";
        }
 if(empty($get_data))
      {
          $data = array(
                  'title'=> $_POST['title'],
                  'description'=>$_POST['description'],
                  'image'=>$image,
                  'created_date'=> date('Y-m-d H:i:s'),
                 );
    
            $this->Crud_model->SaveData('manage_cms',$data);
            $this->session->set_flashdata('message', 'CMS created successfully');
            echo "1"; exit;
         } 
         else {
              echo "0"; exit;
            } 
    }

     public function get_value()
  {
    $get_data=$this->Crud_model->get_single('manage_cms',"id='".$_POST['id']."'");
  if(!empty($get_data->image) && file_exists("uploads/cms/".$get_data->image))
        {
               $img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/cms/'.$get_data->image).'" width="100px" height="100px">';
          
        }

        else
        {
            $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'" width="100px" height="100px">';
        }
    $data=array(
      'id'=>$get_data->id,
      'title'=>$get_data->title,
      'description'=>$get_data->description,
      'image'=>$get_data->image,
      'img'=>$img,
    );
    echo json_encode($data);exit;
  }
   
 public function update_action()
    {     
      $update_data=$this->Crud_model->get_single_record('manage_cms',"title ='".$_POST['title']."' and id!='".$_POST['id']."'");
      if($_FILES['image']['name']!='' )
        {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/cms/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/cms/';
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
                     @unlink('uploads/cms/'.$_POST['old_image']);
                  }
        }

          else{
               $image  = $_POST['old_image'];
        }
      if(empty($update_data))
      {
        $data=array(
        'title'=>$_POST['title'],
        'description'=>$_POST['description'],
        'image'=>$image,
        );
        $this->Crud_model->SaveData('manage_cms',$data,"id='".$_POST['id']."'");
        $this->session->set_flashdata('message', 'cms Updated successfully');
        echo "1";exit;
      }
      else
      {
        echo "0";exit;
      } 

    }

    public function view()
  {
    $get_data=$this->Crud_model->get_single('manage_cms',"id='".$_POST['id']."'");
  
    $data=array(
      'description'=>$get_data->description,
    );
    echo json_encode($data);exit;
  }
}