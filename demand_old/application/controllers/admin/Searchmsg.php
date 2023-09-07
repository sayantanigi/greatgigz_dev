<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Searchmsg extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
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
        $this->data['title'] = 'Search Message';
        $this->data['tab'] = 'srch_msg';
        $this->data['main'] = admin_view('searchmessage/index');
        $cms = $this->Master_model->getAll($offset, $show_per_page,'searchmsg');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('searchmsg/index');
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
        $this->data['title'] = 'Set Search message';
        $this->data['tab'] = 'add_srchmsg';
		$this->data['main'] = admin_view('searchmessage/add');
		$this->data['pages'] = $this->Master_model->getNew('searchmsg');
        $this->data['pages']->gender = "Male";
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id,'searchmsg');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
		$this->form_validation->set_rules('frm[name]', 'Message Title', 'required');
		$this->form_validation->set_rules('s_time', 'Search Time For All', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			$formdata['id'] = $id;  
            $formdata['s_time'] = $this->input->post('s_time');
            $arr  = array('s_time' =>$this->input->post('s_time'));
            $this->db->update('searchmsg',$arr);
            //echo $this->db->last_query();die;
                     

			// if ($this->upload->do_upload('image'))
			// {
			// 	$data = $this->upload->data();
			// 	$formdata['image'] = $data['file_name'];
			// }
			
			$id = $this->Master_model->save($formdata);
			$this->session->set_flashdata("success", "Search Message added");
            redirect(admin_url('searchmsg'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

	function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('searchmsg');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c,'searchmsg');
            $this->session->set_flashdata("success", "Message activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('searchmsg');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c,'searchmsg');
            $this->session->set_flashdata("success", "Message deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Master_model->delete($id,'searchmsg');
            $this->session->set_flashdata('success', 'Service deleted successfully ');
        }
        redirect(admin_url('searchmsg'));
	}

}

/* End of file Subservice.php */
/* Location: ./application/controllers/admin/Subservice.php */