<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends Admin_Controller {

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
		$show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Cities';
        $this->data['tab'] = 'city';
        $this->data['main'] = admin_view('city/index');
        $cms = $this->Master_model->getAllcity($offset, $show_per_page,'city');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('city/index');
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
        $this->data['title'] = 'Add State';
        $this->data['tab'] = 'add_city';
		$this->data['main'] = admin_view('city/add');
        $this->data['city'] = $this->db->get_where('city',array('parent_city'=>0,'status'=>1))->result();
		$this->data['pages'] = $this->Master_model->getNew('city');
        $this->data['pages']->gender = "Male";
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id,'city');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
		$this->form_validation->set_rules('frm[name]', 'City Title', 'required');
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
			$this->session->set_flashdata("success", "City added");
            redirect(admin_url('city'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

	function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('city');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c,'city');
            $this->session->set_flashdata("success", "City activated");
        }
        redirect($redirect);
    }
     function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('city');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c,'city');
            $this->session->set_flashdata("success", "City deactivated");
        }
        redirect($redirect);
    }

    function delete($id){
        if ($id > 0) {
            $this->Master_model->delete($id,'city');
            $this->session->set_flashdata('success', 'City Deleted successfully ');
        }
        redirect(admin_url('city'));
    }
    public function add_neigh($id=false)
    {
        $this->data['title'] = 'Add City';
        $this->data['tab'] = 'add_ngh';
        $this->data['main'] = admin_view('city/add_neigh');
        $this->data['city'] = $this->db->get_where('city',array('parent_city'=>0,'status'=>1))->result();
        $this->data['pages'] = $this->Master_model->getNew('city');
        $this->data['pages']->gender = "Male";
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id,'city');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
        $this->form_validation->set_rules('frm[name]', 'Neighbour Name', 'required');
        //$this->form_validation->set_rules('frm[uploaded_by]', 'cms Author', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;            

            // if ($this->upload->do_upload('image'))
            // {
            //  $data = $this->upload->data();
            //  $formdata['image'] = $data['file_name'];
            // }
            
            $id = $this->Master_model->save($formdata);
            $this->session->set_flashdata("success", "Neighbourhood added");
            redirect(admin_url('city/view_neighbour'));
        }       
        $this->load->view(admin_view('default'),$this->data);
    }

public function view_neighbour($page = 1)
    {   
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Cities';
        $this->data['tab'] = 'neigh';
        $this->data['main'] = admin_view('city/view_neigh');
        $cms = $this->Master_model->getAllneigh($offset, $show_per_page,'city');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('city/view_neighbour');
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
    function neighactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('city/view_neighbour');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c,'city');
            $this->session->set_flashdata("success", "City activated");
        }
        redirect($redirect);
    }
    function neighdeactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('city/view_neighbour');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c,'city');
            $this->session->set_flashdata("success", "Neighbourhood deactivated");
        }
        redirect($redirect);
    }

	function neighdelete($id){
		if ($id > 0) {
            $this->Master_model->delete($id,'city');
            $this->session->set_flashdata('success', 'Neighbourhood Deleted successfully ');
        }
        redirect(admin_url('city/view_neighbour'));
	}
    public function upload_file(){
        $this->data['tab'] = 'add_city';
        $this->data['main'] = admin_view('city/add');
        $csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                
                //open uploaded csv file with read only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                
                // skip first line
                // if your csv file have no heading, just comment the next line
                fgetcsv($csvFile);
                
                //parse data from csv file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    //check whether member already exists in database with same email
                    $result = $this->db->get_where("city", array("id"=>$line[0]))->result();
                    if(count($result) > 0){
                        //update member data
                        $this->db->update("city", array("name"=>$line[1], "parent_city"=>$line[2], "status"=>$line[3]), array("id"=>$line[0]));
                    }else{
                        //insert member data into database
                        $this->db->insert("city", array("id"=>$line[0], "name"=>$line[1], "parent_city"=>$line[2], "status"=>$line[3]));
                        //echo $this->db->last_query();
                   }
                }
                
                //close opened csv file
                fclose($csvFile);

                $this->data["status"] = 'Success';
            }else{
                $this->data["status"] = 'Error';
            }
        }else{
            $this->data["status"] = 'Invalid file';
        }
        $this->load->view(admin_view('default'),$this->data);
    }

}

/* End of file city.php */
/* Location: ./application/controllers/admin/city.php */