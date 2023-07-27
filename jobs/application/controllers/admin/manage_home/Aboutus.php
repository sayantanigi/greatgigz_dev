<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelHome/About_model');
	}
	function index()
	{
   
		$header = array('title' => 'about');
		$data = array(
            'heading' => 'Manage About us',
           
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/manage_master/aboutus_list',$data);
        $this->load->view('admin/common/footer');
	}

	 public function ajax_manage_page()   

{
        $get_data = $this->About_model->get_datatables();
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
            
              $btn = '<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right" title="Edit"><i class="far fa-edit mr-1"></i></span>'; 
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
            $nestedData[] =ucwords($row->title);
            $nestedData[] =$desc;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->About_model->count_all(),
                    "recordsFiltered" => $this->About_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create_action()
  {
     
    $data=array(
      'title'=>$_POST['title'],
      'description'=>$_POST['description'],
    );

    $this->db->insert('about_us',$data);
    $this->session->set_flashdata('message', 'about us added successfully');
    echo "1"; exit;
    
  }

   public function get_value()
    {
      $get_data=$this->Crud_model->get_single('about_us',"id='".$_POST['id']."'");
            if(!empty($get_data->video) && file_exists('uploads/video/'.$get_data->video)){
                  
          $video=' <video width="200" controls>
           <source src="'.base_url('uploads/video/'.$get_data->video).'" style="width:50px;height:50px;" type="video/mp4"> </video>';
                        } else{                                               
          $video='<img  class="img-circle img-responsive" src="'.base_url('uploads/dummy_video.png').'" style="width:60px;height: 60px;"/>';
                  }
      $data=array(
        'id'=>$get_data->id,
        'title'=>$get_data->title,
        'description'=>$get_data->description,
        'old_video'=>$get_data->video,
        'video'=>$video,
      );
     
      echo json_encode($data);exit;
  }

    function update_action()
    {
      if($_POST['id']==3){
      if ($_FILES['video']['error'] == '') {
      $file_element_name = 'video';
      $config['upload_path'] = getcwd() . '/uploads/video/';
      $config['allowed_types'] = '*';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if (!$this->upload->do_upload($file_element_name)) {
        $error = $this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
        $data = array('error' => $error);
      }

      $upload_quotation_file = $this->upload->data();
      $video = $upload_quotation_file['file_name'];
      @unlink('uploads/video/' . $_POST['old_video']);
    } else {
      $video = $_POST['old_video'];
    }
  }
  else{
    $video='';
  }

       $data = array(
              'title'=> $_POST['title'],
              'description'=> $_POST['description'],
              'video'=> $video,
             );
       $this->Crud_model->SaveData('about_us',$data,"id='".$_POST['id']."'");
        $this->session->set_flashdata('message', 'about us updated successfully');

       echo 1; exit;
    
    }


}