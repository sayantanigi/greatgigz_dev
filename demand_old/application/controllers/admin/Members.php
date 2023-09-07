<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends AI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = 'Members';
        $this->data['tab'] = 'members';
        $config['upload_path']          = './assets/images/profile';
		$config['allowed_types']        = 'gif|jpg|png';
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
		$show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Provider';
        $this->data['tab'] = 'members';
        $this->data['main'] = admin_view('members/index');
        $members = $this->Master_model->getAllprovider($offset, $show_per_page,'provider_list');
        // if ($this->input->get('btnsearch')) {
        //     $q = $this->input->get('q');
        //     if ($q <> '') {
        //         $likes = array(
        //             'first_name' => $q, 'last_name' => $q, 'email_id' => $q
        //         );
        //         $members = $this->Service_model->getAllSearched($offset, $show_per_page, $likes);
        //     }
        // }
        $this->data['members'] = $members['results'];
        $config['base_url'] = admin_url('members/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $members['total'];
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
        $this->data['title'] = 'Add Rating';
        $this->data['tab'] = 'add_member';
		$this->data['main'] = admin_view('members/add');
		$this->data['member'] = $this->User_model->getNew();
        if ($id) {
            $this->data['member'] = $pages = $this->User_model->getRow($id,'provider_list');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
        else{ 
			$this->form_validation->set_rules('frm[rating]', 'Rating', 'required');
        }
		$this->form_validation->set_rules('frm[rating]', 'Ratings', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			
			$formdata['id'] = $id;
            
			$id = $this->User_model->save($formdata,'provider_list');
			$this->session->set_flashdata("success", "Rating detail saved");
            redirect(admin_url('members/add/' . $id));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

	function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members');
        if ($id) {
            $c['id'] = $id;
            $c['admin_status'] = 1;
            $this->User_model->save($c,'provider_list');
            $this->session->set_flashdata("success", "Provider activated successfully!");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members');
        if ($id) {
            $c['id'] = $id;
            $c['admin_status'] = 0;
            $this->User_model->save($c,'provider_list');
            $this->session->set_flashdata("success", "Provider deactivated successfully!");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->User_model->delete($id,'provider_list');
            $this->session->set_flashdata('success', 'Provider deleted successfully ');
        }
        redirect(admin_url('members'));
	}

}

/* End of file Members.php */
/* Location: ./application/controllers/admin/Members.php */