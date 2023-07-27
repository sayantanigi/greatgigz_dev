<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelHome/Featured_service_model');
	}
	function index()
	{
   
		$header = array('title' => 'service');
		$data = array(
            'heading' => 'List of featured services',
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/manage_master/featured_service_list',$data);
        $this->load->view('admin/common/footer');
	}

	 public function ajax_manage_page()   

{
        $get_data = $this->Featured_service_model->get_datatables();
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
             if(!empty($row->image) && file_exists("uploads/featured_service/".$row->image))
            {
               
                 $img ='<a href="'.base_url('uploads/featured_service/'.$row->image).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/featured_service/'.$row->image).'" width="100px" height="100px"><a>';
          }

          else
          { 
              $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'" width="100px" height="100px">';
          }

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
            $nestedData[] = $img.' '.ucwords($row->title);
           
            $nestedData[] = $desc;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Featured_service_model->count_all(),
                    "recordsFiltered" => $this->Featured_service_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create_action()
  {
    
    if($_FILES['image']['name']!='')
        {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/featured_service/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/featured_service/';
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
        $title = $this->input->post('title',TRUE);
              if (empty($title) || $title == '') {
                  $title =$this->input->post('title');
              }
              $slug = strtolower(url_title($title));
              $slug_url =$this->Featured_service_model->get_unique_url($slug);
    $data=array(
      'title'=>$title,
      'description'=>$_POST['description'],
      'image'=>$image,
      'slug_url'=>$slug_url,
      'created_date'=>date('Y-m-d H:i:s'),
    );

    $this->db->insert('featured_service',$data);
    $this->session->set_flashdata('message', 'service added successfully');
    echo "1"; exit;
    
  }

   public function get_value()
    {
      $get_data=$this->Crud_model->get_single('featured_service',"id='".$_POST['id']."'");
      if(!empty($get_data->image) && file_exists("uploads/featured_service/".$get_data->image))
        {
             
        $img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/featured_service/'.$get_data->image).'" width="50px" height="50px">';
          
        }

        else
        { 
            $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'" width="50px" height="50px">';
        }
      $data=array(
        'id'=>$get_data->id,
        'title'=>$get_data->title,
        'image'=>$img,
        'old_image'=>$get_data->image,
        'description'=>$get_data->description,
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
                  $config2['new_image'] =   getcwd().'/uploads/featured_service/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/featured_service/';
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
                     @unlink('uploads/featured_service/'.$_POST['old_image']);
                  }
        }
          
          else{
               $image  = $_POST['old_image'];;
        }                  
   
      $title = $this->input->post('title',TRUE);
              if (empty($title) || $title == '') {
                  $title =$this->input->post('title');
              }
              $slug = strtolower(url_title($title));
              $slug_url =$this->Featured_service_model->get_unique_url($slug);
    $data=array(
               'title'=>$title,
               'description'=> $_POST['description'],
              'image'=>$image,
              'slug_url'=>$slug_url,
             
             );
       $this->Crud_model->SaveData('featured_service',$data,"id='".$_POST['id']."'");
        $this->session->set_flashdata('message', 'service updated successfully');

       echo 1; exit;
    
    }
   

}