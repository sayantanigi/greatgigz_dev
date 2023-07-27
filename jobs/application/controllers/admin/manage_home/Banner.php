<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelHome/Banner_model');
	}
	function index()
	{
   
		$header = array('title' => 'banner');
		$data = array(
            'heading' => 'List of banner',
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/managehome/banner_list',$data);
        $this->load->view('admin/footer');
	}

	 public function ajax_manage_page()   

{
        $get_data = $this->Banner_model->get_datatables();
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
             if(!empty($row->image) && file_exists("uploads/banner/".$row->image))
            {
               
                 $img ='<a href="'.base_url('uploads/banner/'.$row->image).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/banner/'.$row->image).'" ><a>';
          }

          else
          { 
              $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'" >';
          }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $img.' '.ucwords($row->heading);
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Banner_model->count_all(),
                    "recordsFiltered" => $this->Banner_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create_action()
  {
    
    if(isset($_FILES['image']['name']))
        {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/banner/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/banner/';
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
       
    $data=array(
      'heading'=>$this->input->post('name',TRUE),
      'image'=>$image,
      'created_date'=>date('Y-m-d H:i:s'),
    );

    $this->db->insert('banner',$data);
    $this->session->set_flashdata('message', 'Banner added successfully');
    echo "1"; exit;
    
  }

   public function get_value()
    {
      $banner_data=$this->Crud_model->get_single('banner',"id='".$_POST['id']."'");
      if(!empty($banner_data->image))
        {
            
            if(!file_exists("uploads/banner/".$banner_data->image))
            {  
              $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
            }
            else
            { 
                
               $img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/banner/'.$banner_data->image).'" >';
            }
        }

        else
        { 
            $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
        }
      $data=array(
        'id'=>$banner_data->id,
        'heading'=>$banner_data->heading,
        'image'=>$img,
        'old_image'=>$banner_data->image,
      );
     
      echo json_encode($data);exit;
  }

    function update_action()
    {
      if(isset($_FILES['image']['name']))
        {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/banner/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/banner/';
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
                     @unlink('uploads/banner/'.$_POST['old_image']);
                  }
        }
          
          else{
               $image  = $_POST['old_image'];;
        }                  
   
       $data = array(
              'heading'=>$this->input->post('name',TRUE),
              'image'=>$image,
             
             );
       $this->Crud_model->SaveData('banner',$data,"id='".$_POST['id']."'");
        $this->session->set_flashdata('message', 'Banner Updated successfully');

       echo 1; exit;
    
    }





    

}