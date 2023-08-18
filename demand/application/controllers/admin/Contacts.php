<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
                $this->data['title'] = 'Contacts';
                $this->data['tab'] = 'contacts';
	}

	public function index($page=1)
	{

		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['main'] = admin_view('contact/index');
        $contact = $this->Master_model->getAll($offset, $show_per_page,'contacts');
        // if ($this->input->get('btnsearch')) {
        //     $q = $this->input->get('q');
        //     if ($q <> '') {
        //         $likes = array(
        //             'first_name' => $q, 'last_name' => $q, 'email_id' => $q
        //         );
        //         $members = $this->Service_model->getAllSearched($offset, $show_per_page, $likes);
        //     }
        // }
        $this->data['contacts'] = $contact['results'];
        $config['base_url'] = admin_url('contact/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $contact['total'];
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
        function delete($id){
                if ($id > 0) {
            $this->User_model->delete($id,'contacts');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(admin_url('contacts'));
        }



public function number_list($page=1)
    {
 //echo 'hiii';die();
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['main'] = admin_view('enquiry/auth_number');
        $enquiry = $this->Master_model->getAllnumber($offset, $show_per_page,'mobile_numbers');
       
        $this->data['enquiry'] = $enquiry['results'];
        $config['base_url'] = admin_url('contacts/number_list');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $enquiry['total'];
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

     function number_delete($id){
            if ($id > 0) {
            $this->User_model->delete($id,'mobile_numbers');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(admin_url('contacts/number_list'));
        }


}

/* End of file Contacts.php */
/* Location: ./application/controllers/admin/Contacts.php */