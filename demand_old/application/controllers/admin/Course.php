<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data['header'] = '';
        $this->admin_login();
        $config['upload_path']          = './assets/images/courses';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
	}

	public function index($page=1)
	{
		if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Course List';
        $this->data['tab'] = 'products';
        $this->data['main'] = admin_view('product/index');
        $course = $this->Course_model->getAll($offset, $show_per_page);
        $this->data['course'] = $course['results'];
        $config['base_url'] = admin_url('course/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $course['total'];
        $config['per_page'] = $show_per_page;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['use_page_numbers'] = true;
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = true;

        $this->pagination->initialize($config);
        $this->data['paginate'] = $this->pagination->create_links();
		$this->load->view(admin_view('default'),$this->data);
	}

    public function course_transaction(){
        $this->data['title'] = 'Transaction List';
        $this->data['tab'] = 'trans';
        $this->data['main'] = admin_view('product/txn');
        $this->data['orders'] = $this->db->get('orders')->result();
        $this->load->view(admin_view('default'),$this->data);
    }

	public function add($id=false)
	{
        $this->data['title'] = 'Add Service';
        $this->data['tab'] = 'add_products';
		$this->data['main'] = admin_view('product/add');
		$this->data['course'] = $this->Course_model->getNew();
        $this->data['course']->gender = "Male";

        if ($id) {
            $this->data['course'] = $course = $this->Course_model->getRow($id);
            if(!isset($course)){
               show_404();
                exit();
            }
        }
		$this->form_validation->set_rules('frm[title]', 'Product title', 'required');
		$this->form_validation->set_rules('frm[description]', 'Product description', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			$formdata['id'] = $id;
            
			//$images = $this->input->post('image');
			if ($this->upload->do_upload('image'))
			{
				$data = $this->upload->data();
				$formdata['image'] = $data['file_name'];
			}
			
			$id = $this->Course_model->save($formdata);
            //echo $this->db->last_query();die();
			$this->session->set_flashdata("success", "Course detail saved");
            redirect(admin_url('course/add/' . $id));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Course_model->save($c);
            $this->session->set_flashdata("success", "Course activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Course_model->save($c);
            $this->session->set_flashdata("success", "Course deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Course_model->delete($id);
            $this->session->set_flashdata('success', 'Course deleted successfully ');
        }
        redirect(admin_url('course'));
	}

}

/* End of file Products.php */
/* Location: ./application/controllers/admin/Products.php */