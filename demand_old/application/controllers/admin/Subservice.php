<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subservice extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
		$config['upload_path']          = './assets/images/service';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
        $this->data['title'] = '';
        $this->data['tab'] = '';
	}

	public function index($page = 1)
	{	
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Sub Service';
        $this->data['tab'] = 'sub_service';
        $this->data['main'] = admin_view('subservice/index');
        $cms = $this->Master_model->getAll($offset, $show_per_page,'sub_service');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('subservice/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $cms['total'];
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

	public function add($id=false)
	{
        $this->data['title'] = 'Add Sub Service';
        $this->data['tab'] = 'add_sub_service';
		$this->data['main'] = admin_view('subservice/add');
        $this->data['service'] = $this->db->get_where('service',array('status'=>1))->result();
		$this->data['pages'] = $this->Master_model->getNew('sub_service');
        $this->data['pages']->gender = "Male";
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id,'sub_service');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
		$this->form_validation->set_rules('frm[name]', 'Service Title', 'required');
		//$this->form_validation->set_rules('frm[uploaded_by]', 'cms Author', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			$formdata['id'] = $id;            

			// if ($this->upload->do_upload('image'))
			// {
			// 	$data = $this->upload->data();
			// 	$formdata['image'] = $data['file_name'];
			// }
			
			$id = $this->Master_model->save($formdata);
			$this->session->set_flashdata("success", "Sub Service added");
            redirect(admin_url('subservice'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

	function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('subservice');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c,'sub_service');
            $this->session->set_flashdata("success", "Service Pages activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('subservice');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c,'sub_service');
            $this->session->set_flashdata("success", "Service Pages deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Master_model->delete($id,'sub_service');
            $this->session->set_flashdata('success', 'Service deleted successfully ');
        }
        redirect(admin_url('subservice'));
	}

}

/* End of file Subservice.php */
/* Location: ./application/controllers/admin/Subservice.php */