<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Contact_model');
	}

	function index() {
    	$get_contact=$this->Crud_model->GetData('contact_us');
		$header = array('title' => 'Enquiry Management');
		$data = array(
			'heading' => 'Enquiry Management',
            'get_contact' => $get_contact
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/contact/list',$data);
        $this->load->view('admin/footer');
	}

	function ajax_manage_page() {
	    $cond = "1=1";
	    $contact = $_POST['SearchData6'];
        $from_date = $_POST['SearchData5'];
        
		if($contact!='') {
            $cond .=" and contact_us.id  = '".$contact."' ";
        }

        if($from_date!='') {
            $cond .=" and contact_us.created_date >= '".date('Y-m-d',strtotime($from_date))."' ";
        }
		
		$GetData = $this->Contact_model->get_datatables($cond);
		if(empty($_POST['start'])) {
    		$no=0;
       	} else {
            $no =$_POST['start'];
        }

        $data = array();
        foreach ($GetData as $row) {
            $no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = $row->name;
			$nestedData[] = $row->email;
			$nestedData[] = $row->subject;
			$nestedData[] = $row->message;
			$nestedData[] = date('d-m-Y',strtotime($row->update_date));
			$data[] = $nestedData;
        }

    	$output = array(
			"draw" => $_POST['draw'],
            "recordsTotal" => $this->Contact_model->count_all($cond),
            "recordsFiltered" => $this->Contact_model->count_filtered($cond),
            "data" => $data,
        );
    	echo json_encode($output);
	}

	/*public function get_value() {
		$specialist_data=$this->Crud_model->get_single('specialist',"id='".$_POST['id']."'");
		if(!empty($specialist_data->specialist_image)) {
            if(!file_exists("uploads/specialist/".$specialist_data->specialist_image)) {
                $img ='<img class="rounded service-img mr-1" src="'.base_url('specialist/no_image.png').'">';
            } else {
               $img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/specialist/'.$specialist_data->specialist_image).'" >';
            }
        } else {
        	$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
        }
		$data=array(
			'id'=>$specialist_data->id,
			'specialist_name'=>$specialist_data->specialist_name,
			'image'=>$img,
			'old_image'=>$specialist_data->specialist_image,
		);
		echo json_encode($data);exit;
  	}

    function update_action() {
      	if(isset($_FILES['specialist_image']['name'])!='' ) {
			$_POST['specialist_image']= rand(0000,9999)."_".$_FILES['specialist_image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['specialist_image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/specialist/'.$_POST['specialist_image'];
			$config2['upload_path'] =  getcwd().'/uploads/specialist/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
          	} else {
                $image  = $_POST['specialist_image'];
             	@unlink('uploads/specialist/'.$_POST['old_image']);
          	}
        } else {
           	$image  = $_POST['old_image'];;
        }
    	$get_data=$this->Crud_model->get_single_record('specialist',"specialist_name='".$_POST['specialist_name']."' and id!='".$_POST['id']."'");
      	if(empty($get_data)) {
			$data = array(
				'specialist_name'=> $_POST['specialist_name'],
				'specialist_image'=>$image,
				'update_date'=>date('Y-m-d H:i:s'),
			);
       		$this->Crud_model->SaveData('specialist',$data,"id='".$_POST['id']."'");
        	$this->session->set_flashdata('message', 'Skill Set updated successfully');
       		echo 1; exit;
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
      		echo 0; exit;
     	}
    }

	public function delete() {
        if(isset($_POST['cid'])) {
            $this->Crud_model->DeleteData('specialist',"id='".$_POST['cid']."'");
        }
    }*/
}
