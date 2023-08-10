<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Testimonial_model');
    }

    function index() {
		$header = array('title' => 'Testimonials');
		$data = array(
			'heading' => 'Testimonials'
		);
		$this->load->view('admin/header', $header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/testimonial/list',$data);
		$this->load->view('admin/footer');
	}

	public function ajax_manage_page() {
		$get_data = $this->Testimonial_model->get_datatables();
		if(empty($_POST['start'])) {
			$no=0;
		} else {
			$no =$_POST['start'];
		}

		$data = array();
		foreach ($get_data as $row) {
			$btn = '<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getTestimonialValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';
			$btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2" onclick="testimonialDelete(this,'.$row->id.')" style="margin-left: 8px;">Delete</span>';

			if(strlen($row->description)>50) {
				$desc=substr($row->description,0,50).'...';
			} else {
				$desc=$row->description;
			}

			if(!empty($row->image)) {
				if(!file_exists("uploads/testimonial/".$row->image)) {
					$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
				} else {
					$img ='<a href="'.base_url('uploads/testimonial/'.$row->image).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/testimonial/'.$row->image).'"><a>';
				}
			} else {
				$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
			}

			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucwords($row->name);
			$nestedData[] = ucwords($row->designation);
			$nestedData[] = $img;
			$nestedData[] = strip_tags($desc);
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

	public function create_action() {
		$get_data=$this->Crud_model->get_single('testimonial',"name LIKE '%".$_POST['fname']."%'");
		if(isset($_FILES['testimonial_image']['name'])!='' ) {
			$_POST['testimonial_image']= rand(0000,9999)."_".$_FILES['testimonial_image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['testimonial_image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/testimonial/'.$_POST['testimonial_image'];
			$config2['upload_path'] =  getcwd().'/uploads/testimonial/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image  = $_POST['testimonial_image'];
			}
		} else {
			$image  = "";
		}

		if(empty($get_data)){
			$data=array(
				'name'=>$_POST['fname'],
				'designation'=>$_POST['designation'],
				'description'=>$_POST['description'],
				'image'=>$image,
				'created_date'=>date('Y-m-d H:i:s'),
			);
			$this->db->insert('testimonial',$data);
			$this->session->set_flashdata('message', 'Testimonial created successfully');
			echo "1"; exit;
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo "0"; exit;
		}
	}

	public function get_value() {
		$get_data=$this->Crud_model->get_single('testimonial',"id='".$_POST['id']."'");
		if(!empty($get_data->image)) {
			if(!file_exists("uploads/testimonial/".$get_data->image)) {
				$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
			} else {
				$img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/testimonial/'.$get_data->image).'" style="width: 100px">';
			}
		} else {
			$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
		}
		$data=array(
			'id'=>$get_data->id,
			'fname'=>$get_data->name,
			'designation'=>$get_data->designation,
			'image'=>$img,
			'description'=>$get_data->description,
			'old_image'=>$get_data->image,
		);
		echo json_encode($data);exit;
	}

	function update_action() {
		if(isset($_FILES['testimonial_image']['name'])!='' ) {
			$_POST['testimonial_image'] = rand(0000,9999)."_".$_FILES['testimonial_image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $_FILES['testimonial_image']['tmp_name'];
			$config2['new_image'] = getcwd().'/uploads/testimonial/'.$_POST['testimonial_image'];
			$config2['upload_path'] = getcwd().'/uploads/testimonial/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image = $_POST['testimonial_image'];
				@unlink('uploads/testimonial/'.$_POST['old_image']);
			}
		} else {
			$image = $_POST['old_image'];
		}

		$get_data=$this->Crud_model->get_single_record('testimonial',"name='".$_POST['fname']."' and id !='".$_POST['id']."'");
		if(empty($get_data)) {
			$data = array(
				'name'=>$_POST['fname'],
				'designation'=>$_POST['designation'],
				'description'=>$_POST['description'],
				'image'=>$image,
			);
			$this->Crud_model->SaveData('testimonial',$data,"id='".$_POST['id']."'");
			$this->session->set_flashdata('message', 'Testimonial updated successfully');
			echo 1; exit;
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo "0"; exit;
		}
	}

	public function delete() {
        if(isset($_POST['cid'])) {
			$this->Crud_model->DeleteData('testimonial',"id='".$_POST['cid']."'");
			$this->session->set_flashdata('message', 'Testimonial deleted successfully');
			echo 1; exit;
        }
    }
}
//end controller
/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
