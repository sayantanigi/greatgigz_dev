<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller {

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
        $this->data['title'] = 'Orders';
        $this->data['tab'] = 'orders';
        $this->data['main'] = admin_view('order/index');
        $cms = $this->Master_model->pendinggetAll($offset, $show_per_page,'orders');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('order/index');
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

    public function completed_orders($page = 1)
    {   
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Orders';
        $this->data['tab'] = 'completed_orders';
        $this->data['main'] = admin_view('order/index');
        $cms = $this->Master_model->completedgetAll($offset, $show_per_page,'orders');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('order/index');
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

        public function view($id=false)
    {
        $this->data['title'] = 'View Order';
        $this->data['tab'] = 'view_orders';
        $this->data['main'] = admin_view('order/add');
        $this->data['detail'] =$this->Master_model->getRow($id,'orders'); 
        $this->load->view(admin_view('default'),$this->data);
    }

    function changeStatus($id){
       if ($id > 0) {
            $arr = array(
                'status'=>1
            );
            $this->db->where('id',$id);
            $this->db->update('orders',$arr);
            $this->session->set_flashdata('success', 'Status Updated successfully ');
       }
       redirect(admin_url('orders'));
    }

	function delete($id){
		if ($id > 0) {
            $this->Master_model->delete($id,'sub_service');
            $this->session->set_flashdata('success', 'Service deleted successfully ');
        }
        redirect(admin_url('orders'));
	}

}

/* End of file Subservice.php */
/* Location: ./application/controllers/admin/Subservice.php */