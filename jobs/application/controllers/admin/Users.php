<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
    }

    function index() {
  		$header = array('title' => 'users');
  		$data = array(
            'heading' => 'List of users',
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/user/list',$data);
        $this->load->view('admin/common/footer');
  	}

    function ajax_manage_page() {
        $GetData = $this->Users_model->get_datatables();
        if(empty($_POST['start'])) {
      		$no=0;
        } else {
              $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row) {
            $btn = ''.anchor(admin_url('users/update/'.base64_encode($row->userId)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-edit mr-1"></i>Edit</span>');
            $btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->userId.')">Delete</span>';
            if($row->userType==1) {
                $type='Job Seeker';
            } elseif($row->userType==2) {
                $type='Employer';
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $type;
            $nestedData[] = $row->firstname.' '.$row->lastname;
            $nestedData[] = ucfirst($row->job_title);
            $nestedData[] = $row->email;
            $nestedData[] = $row->mobile;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Users_model->count_all(),
            "recordsFiltered" => $this->Users_model->count_filtered(),
            "data" => $data,
        );
      	echo json_encode($output);
  	}

    function update($id) {
        $con="userId ='".base64_decode($id)."'";
        $get_userdata=$this->Crud_model->get_single('users',$con);
        $header = array('title' => 'user update');
        $data = array(
            'heading' => 'Update',
            'button' => 'Update',
            'firstname'=>set_value('firstname',$get_userdata->firstname),
            'lastname'=>set_value('lastname',$get_userdata->lastname),
            'job_title'=>set_value('job_title',$get_userdata->job_title),
            'email'=>set_value('email',$get_userdata->email),
            'mobile'=>set_value('mobile',$get_userdata->mobile),
            'userType'=>set_value('userType',$get_userdata->userType),
            'id'=>$get_userdata->userId,
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/user/form',$data);
        $this->load->view('admin/common/footer');
    }

    function update_action() {
        $validate=$this->Crud_model->get_single_record('users',"mobile='".$_POST['mobile']."' and userId!='".$_POST['id']."'");
        if(!empty($validate)) {
            $data=array(
                'result'=>0,
                'data'=>'phone',
            );
        } else {
            $validate=$this->Crud_model->get_single_record('users',"email='".$_POST['email']."' and userId!='".$_POST['id']."'");
            if(!empty($validate)) {
                $data=array(
                    'result'=>0,
                    'data'=>'email',
                );
            }
        }
        if(empty($validate)) {
            $fullname = $this->input->post('firstname',TRUE).$this->input->post('lastname',TRUE);
            if (empty($fullname) || $fullname == '') {
                $fullname =$this->input->post('firstname',TRUE).$this->input->post('lastname',TRUE);
            }
            $slug = strtolower(url_title($fullname));
            $slug_url =$this->Users_model->get_unique_url($slug);
            $data=array(
                'firstname'=> $_POST['firstname'],
                'lastname'=> $_POST['lastname'],
                'job_title'=> $_POST['job_title'],
                'email'=> $_POST['email'],
                'mobile'=> $_POST['mobile'],
                'userType'=> $_POST['userType'],
                'slug_url' =>$slug_url,
            );
            $this->Crud_model->SaveData('users',$data,"userId='".$_POST['id']."'");
            $this->session->set_flashdata('message', 'user updated successfully');
            $data=array(
                'result'=>1,
                'data'=>1,
            );
        }
        echo json_encode($data); exit;
    }

    function view($id) {
        $con="userId ='".base64_decode($id)."'";
        $get_userdata=$this->Crud_model->get_single('users',$con);
        $header = array('title' => 'user view');
        $data = array(
            'heading' => 'User',
            'get_userdata' => $get_userdata
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/users/view',$data);
        $this->load->view('admin/common/footer');
    }

    public function change_status() {
        if($_POST['status']=='1') {
            $statuss='0';
        } else if($_POST['status']=='0'){
            $statuss='1';
        }
        $data=array(
            'status'=>$statuss
        );
        $this->Crud_model->SaveData("users",$data,"userId='".$_POST['id']."'");
    }

    public function delete() {
        if(isset($_POST['cid'])) {
            $get_user=$this->Crud_model->get_single('users',"userId='".$_POST['cid']."'");
            if(!empty($get_user->profilePic) && file_exists('uploads/users/'.$get_user->profilePic)) {
                @unlink('uploads/users/'.$get_user->profilePic);
            }
            $this->Crud_model->DeleteData('users',"userId='".$_POST['cid']."'");
            $this->Crud_model->DeleteData('user_education',"user_id='".$_POST['cid']."'");
            $this->Crud_model->DeleteData('user_workexperience',"user_id='".$_POST['cid']."'");
        }
    }
    
    public function get_states() {
        $id =$_POST['id'];
        $stateData = $this->Crud_model->GetData('states',"","country_id ='".$id."'");
        $html = "<option value=''>--Select State--</option>";
        foreach ($stateData as $row_data) {
            $html .= "<option value='".$row_data->id."'>".ucwords($row_data->name)."</option>";
        }
        echo $html;
    }

    public function get_city() {
        $id =$_POST['id'];
        $cityData = $this->Crud_model->GetData('cities',"","state_id ='".$id."'");
        $html = "<option value=''>--Select city--</option>";
        foreach ($cityData as $row_data) {
            $html .= "<option value='".$row_data->name."'>".ucwords($row_data->name)."</option>";
        }
       echo $html;
    }
}//end controller