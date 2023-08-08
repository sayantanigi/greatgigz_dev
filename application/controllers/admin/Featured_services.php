<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Featured_services extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Featured_services_model');
    }

    function index() {
		$get_category=$this->Crud_model->GetData('category',"id,category_name");
		$header = array('title' => 'our service');
		$data = array(
			'heading' => 'Our Services',
			'get_category' => $get_category,
		);
		$this->load->view('admin/header', $header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/featured_service/list',$data);
		$this->load->view('admin/footer');
	}

	public function ajax_manage_page() {
		$get_data = $this->Featured_services_model->get_datatables();
		if(empty($_POST['start'])) {
			$no=0;
		} else {
			$no =$_POST['start'];
		}

		$data = array();
		foreach ($get_data as $row) {
			$btn = '<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';
			$btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2" onclick="ourServicesDelete(this,'.$row->id.')" style="margin-left: 8px;">Delete</span>';

			if(strlen($row->description)>50) {
				$desc=substr($row->description,0,50).'...';
			} else {
				$desc=$row->description;
			}

			if(!empty($row->icon)) {
				if(!file_exists("uploads/featured_services/".$row->icon)) {
					$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
				} else {
					$img ='<a href="'.base_url('uploads/featured_services/'.$row->icon).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/featured_services/'.$row->icon).'"><a>';
				}
			} else {
				$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
			}

			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucwords($row->title);
			$nestedData[] = $img;
			$nestedData[] = strip_tags($desc);
			$nestedData[] = $btn;
			$data[] = $nestedData;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Featured_services_model->count_all(),
			"recordsFiltered" => $this->Featured_services_model->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function create_action() {
		$get_data=$this->Crud_model->get_single('featured_service',"title LIKE '%".$_POST['category_id']."%'");
		if(isset($_FILES['service_image']['name'])!='' ) {
			$_POST['service_image']= rand(0000,9999)."_".$_FILES['service_image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['service_image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/featured_services/'.$_POST['service_image'];
			$config2['upload_path'] =  getcwd().'/uploads/featured_services/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image  = $_POST['service_image'];
			}
		} else {
			$image  = "";
		}

		if(empty($get_data)){
			$data=array(
				'title'=>$_POST['title'],
				'description'=>$_POST['description'],
				'image'=>$image,
				'created_date'=>date('Y-m-d H:i:s'),
			);
			//echo "<pre>"; print_r($data); die;
			$this->db->insert('featured_service',$data);
			$this->session->set_flashdata('message', 'Featured service created successfully');
			echo "1"; exit;
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo "0"; exit;
		}
	}

	public function get_value() {
		$get_data=$this->Crud_model->get_single('featured_service',"id='".$_POST['id']."'");
		if(!empty($get_data->icon)) {
			if(!file_exists("uploads/featured_services/".$get_data->icon)) {
				$img ='<img class="rounded service-img mr-1" src="'.base_url('category/no_image.png').'">';
			} else {
				$img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/featured_services/'.$get_data->icon).'" style="width: 100px">';
			}
		} else {
			$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
		}
		$data=array(
			'id'=>$get_data->id,
			'category_id'=>$get_data->category_id,
			'icon'=>$img,
			'description'=>$get_data->description,
			'old_image'=>$get_data->icon,
		);
		echo json_encode($data);exit;
	}

	function update_action() {
		if(isset($_FILES['service_image']['name'])!='' ) {
			$_POST['service_image']= rand(0000,9999)."_".$_FILES['service_image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['service_image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/featured_services/'.$_POST['service_image'];
			$config2['upload_path'] =  getcwd().'/uploads/featured_services/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image  = $_POST['service_image'];
				@unlink('uploads/featured_services/'.$_POST['old_image']);
			}
		} else {
			$image  = $_POST['old_image'];
		}

		$get_data=$this->Crud_model->get_single_record('featured_service',"category_id='".$_POST['category_id']."' and id !='".$_POST['id']."'");
		if(empty($get_data)) {
			$data = array(
				'category_id'=>$_POST['category_id'],
				'description'=>$_POST['description'],
				'icon'=>$image,
			);
			$this->Crud_model->SaveData('featured_service',$data,"id='".$_POST['id']."'");
			$this->session->set_flashdata('message', 'Our service updated successfully');
			echo 1; exit;
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo "0"; exit;
		}
	}

	public function delete() {
        if(isset($_POST['cid'])) {
			$this->Crud_model->DeleteData('featured_service',"id='".$_POST['cid']."'");
			$this->session->set_flashdata('message', 'Our service deleted successfully');
			echo 1; exit;
        }
    }
}
//end controller
/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
