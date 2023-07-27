<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Testimonial_model');
    }

    function index()
  	{

  		$header = array('title' => 'Testimonial');
  		$data = array(
              'heading' => 'List of Testimonial',
          );
          $this->load->view('admin/common/header', $header);
          $this->load->view('admin/common/sidebar');
          $this->load->view('admin/testimonial/list',$data);
          $this->load->view('admin/common/footer');
  	}

  function ajax_manage_page()
  	{
  		 $GetData = $this->Testimonial_model->get_datatables();
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

              $btn = ''.anchor(admin_url('testimonial/update/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-edit mr-1"></i>Edit</span>');

               if(!empty($row->image) && file_exists("uploads/testimonial/".$row->image))
            {
              $img ='<a href="'.base_url('uploads/testimonial/'.$row->image).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/testimonial/'.$row->image).'" style="width:70px"><a>';
            }
             else
              {
                  $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_profile.jpg').'" style="width:70px">';
              }
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
  	            $nestedData[] = $img;
                $nestedData[] = ucwords($row->name);
                $nestedData[] = ucwords($row->designation);
                $nestedData[] = ucfirst($desc);
  	            $nestedData[] = $btn;
  	            $data[] = $nestedData;
          }

      	$output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->Testimonial_model->count_all(),
                  "recordsFiltered" => $this->Testimonial_model->count_filtered(),
                  "data" => $data,
          );

      	echo json_encode($output);
  	}

    public function create()
  {
    $header = array('title'=> 'Add');
      $data = array(
                  'heading'=>'Add Testimonial',
                  'button'=>'Create',
                    'name' =>set_value('name'),
                    'designation' =>set_value('designation'),
                    'image' =>set_value('image'),           
                    'description' =>set_value('description'),           
                    'id' =>set_value('id'),
                   
          );
     $this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/testimonial/form',$data);
        $this->load->view('admin/common/footer');
  }

        public function create_action()
  {
    
    if(!empty($_FILES['image']['name']))
        {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/testimonial/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/testimonial/';
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
      'name'=>$_POST['name'],
      'designation'=>$_POST['designation'],
      'description'=>$_POST['description'],
      'image'=>$image,
      'created_date'=>date('Y-m-d H:i:s'),
    );

    $this->db->insert('testimonials',$data);
    $this->session->set_flashdata('message', 'Testimonial created successfully');
    redirect(admin_url('testimonial'));

  }
    
  function update($id)
    {
      $con="id ='".base64_decode($id)."'";
     $get_userdata=$this->Crud_model->get_single('testimonials',$con);

         $header = array('title' => 'update');
         $data = array(
             'heading' => 'Update',
             'button' => 'Update',
              'name'=>set_value('name',$get_userdata->name),
              'designation'=>set_value('designation',$get_userdata->designation),
              'image'=>set_value('image',$get_userdata->image),
              'description'=>set_value('description',$get_userdata->description),
              'id'=>$get_userdata->id,
         );
       $this->load->view('admin/common/header', $header);
         $this->load->view('admin/common/sidebar');
         $this->load->view('admin/testimonial/form',$data);
         $this->load->view('admin/common/footer');
    }

    function update_action()
  {
     if($_FILES['image']['name']!='')
        {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/testimonial/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/testimonial/';
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
                     @unlink('uploads/testimonial/'.$_POST['old_image']);
                  }
        }

          else{
               $image  = $_POST['old_image'];
        }
         $data=array(
      'name'=>$_POST['name'],
      'designation'=>$_POST['designation'],
      'description'=>$_POST['description'],
      'image'=>$image,
    );

    $this->Crud_model->SaveData('testimonials',$data,"id='".$_POST['id']."'");
    $this->session->set_flashdata('message', 'Testimonial updated successfully');
    redirect(admin_url('testimonial'));

  }
  
    
    

    

}//end controller


