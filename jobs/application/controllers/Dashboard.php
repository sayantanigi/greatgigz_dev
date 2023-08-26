<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('commonUser')) {
            redirect(base_url('login'));
        }
        $this->load->model('Users_model');
        $this->load->model('Post_job_model');
    }

    function index() {
        $cond="users.userId='".$_SESSION['commonUser']['userId']."' and users.status='1'";
        $data['getuser']=$this->Users_model->get_users($cond);
        //print_r($data); die;
        if(!empty($data['getuser']->skills)) {
            $skillid=$data['getuser']->skills;
        } else {
            $skillid=0;
        }
        $data['get_skill']=$this->Crud_model->GetData('skills','',"id IN(".$skillid.")");
        $this->load->view('common/header');
        $this->load->view('user/dashboard',$data);
        $this->load->view('common/footer');
    }

    function profile() {
        $data['getuser']=$this->Crud_model->get_single('users',"userId='".$_SESSION['commonUser']['userId']."' and  status='1' and userType='2'");
        $data['get_state']=$this->Crud_model->GetData('states');
        $data['get_country']=$this->Crud_model->GetData('countries');
        $data['get_city']=$this->Crud_model->GetData('cities');
        $this->load->view('common/header');
        $this->load->view('user/edit_profile',$data);
        $this->load->view('common/footer');
    }

    public function update_profile() {
        $validate=$this->Crud_model->get_single_record('users',"mobile='".$_POST['mobile']."' and userId!='".$_SESSION['commonUser']['userId']."'");
        if(!empty($validate)) {
            $data=array(
                'result'=>0,
                'data'=>'phone',
            );
        } else {
            $validate=$this->Crud_model->get_single_record('users',"email='".$_POST['email']."' and userId!='".$_SESSION['commonUser']['userId']."'");
            if(!empty($validate)) {
                $data=array(
                    'result'=>0,
                    'data'=>'email',
                );
            }
        }
        if(empty($validate)) {
            if($_FILES['profilePic']['name']!='') {
                $_POST['profilePic']= rand(11111,99999)."_".$_FILES['profilePic']['name'];
                $config2['image_library'] = 'gd2';
                $config2['source_image'] =  $_FILES['profilePic']['tmp_name'];
                $config2['new_image'] =   getcwd().'/uploads/users/'.$_POST['profilePic'];
                $config2['upload_path'] =  getcwd().'/uploads/users/';
                $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
                $config2['maintain_ratio'] = FALSE;
                $this->image_lib->initialize($config2);
                if(!$this->image_lib->resize()) {
                    echo('<pre>');
                    echo ($this->image_lib->display_errors());
                    exit;
                } else {
                    $profile  = $_POST['profilePic'];
                    @unlink('uploads/users/'.$_POST['old_profile']);
                }
            } else {
                $profile  =$_POST['old_profile'];
            }
            $fullname = $this->input->post('firstname',TRUE).$this->input->post('lastname',TRUE);
            if (empty($fullname) || $fullname == '') {
                $fullname =$this->input->post('firstname',TRUE).'-'.$this->input->post('lastname',TRUE);
            }
            $slug = strtolower(url_title($fullname));
            $slug_url =$this->Users_model->get_unique_url($slug);
            $data=array(
                'firstname' =>$this->input->post('firstname',TRUE),
                'lastname' =>$this->input->post('lastname',TRUE),
                'job_title' =>$this->input->post('job_title',TRUE),
                'email' =>$this->input->post('email',TRUE),
                'mobile' =>$this->input->post('mobile',TRUE),
                'ext' =>$this->input->post('ext',TRUE),
                'fax' =>$this->input->post('fax',TRUE),
                'company' =>$this->input->post('company',TRUE),
                'organization_type' =>$this->input->post('organization_type',TRUE),
                'address1' =>$this->input->post('address1',TRUE),
                'address2' =>$this->input->post('address2',TRUE),
                'city' =>$this->input->post('city',TRUE),
                'state' =>$this->input->post('state',TRUE),
                'other' =>$this->input->post('other',TRUE),
                'zipcode' =>$this->input->post('zipcode',TRUE),
                'country' =>$this->input->post('country',TRUE),
                    'profilePic' =>$profile,
                'short_bio' =>$this->input->post('short_bio',TRUE),
                'slug_url' =>$slug_url,
            );
            $this->Crud_model->SaveData('users',$data,"userId='".$_SESSION['commonUser']['userId']."'");
            $this->session->set_flashdata('message', 'profile updated successfully !!');
            $data=array(
                'result'=>1,
                'data'=>1,
            );
        }
        echo json_encode($data); exit;
    }

    ////////////////////////  jobseeker profile ///////////////////
    function jobseeker_profile() {
        $data['get_jobseeker']=$this->Crud_model->get_single('users',"userId='".$_SESSION['commonUser']['userId']."' and status='1' and userType='1'");
        $data['get_category']=$this->Crud_model->GetData('category','',"status='1'",'',"(category_name)asc");
        $data['get_skills']=$this->Crud_model->GetData('skills',"");
        $data['get_education']=$this->Crud_model->GetData('user_education','',"user_id='".$_SESSION['commonUser']['userId']."'");
        $data['get_workexperience']=$this->Crud_model->GetData('user_workexperience','',"user_id='".$_SESSION['commonUser']['userId']."'");
        $this->load->view('common/header');
        $this->load->view('user/jobseeker_profile',$data);
        $this->load->view('common/footer');
    }

    function update_jobseekerprofile() {
        $validate=$this->Crud_model->get_single_record('users',"mobile='".$_POST['mobile']."' and userId!='".$_SESSION['commonUser']['userId']."'");
        if(!empty($validate)) {
            $data=array(
                'result'=>0,
                'data'=>'phone',
            );
        } else {
            $validate=$this->Crud_model->get_single_record('users',"email='".$_POST['email']."' and userId!='".$_SESSION['commonUser']['userId']."'");
            if(!empty($validate)) {
                $data=array(
                    'result'=>0,
                    'data'=>'email',
                );
            }
        }

        if(empty($validate)) {
            if($_FILES['jobseeker_resume']['name'] != '') {
                $src = $_FILES['jobseeker_resume']['tmp_name'];
                $filEnc = time();
                $avatar ='CV'.rand(11111, 99999).$_FILES['jobseeker_resume']['name'];
                $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                $dest = getcwd() . '/uploads/jobseeker_resume/' . $avatar1;
                if (move_uploaded_file($src, $dest)) {
                    $jobseeker_resume  = $avatar1;
                    @unlink('uploads/jobseeker_resume/'.$_POST['old_resume']);
                }
            } else {
                $jobseeker_resume =$_POST['old_resume'];
            }
            if($_FILES['profile']['name']!='') {
                $_POST['profile']= rand(0000,9999)."_".$_FILES['profile']['name'];
                $config2['image_library'] = 'gd2';
                $config2['source_image'] =  $_FILES['profile']['tmp_name'];
                $config2['new_image'] =   getcwd().'/uploads/users/'.$_POST['profile'];
                $config2['upload_path'] =  getcwd().'/uploads/users/';
                $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
                $config2['maintain_ratio'] = FALSE;
                $this->image_lib->initialize($config2);
                if(!$this->image_lib->resize()) {
                    echo('<pre>');
                    echo ($this->image_lib->display_errors());
                    exit;
                } else {
                    $profile  = $_POST['profile'];
                    @unlink('uploads/users/'.$_POST['old_profile']);
                }
            } else {
                $profile  =$_POST['old_profile'];
            }
            $fullname = $this->input->post('firstname',TRUE).$this->input->post('lastname',TRUE);
            if (empty($fullname) || $fullname == '') {
                $fullname =$this->input->post('firstname',TRUE).'-'.$this->input->post('lastname',TRUE);
            }
            $slug = strtolower(url_title($fullname));
            $slug_url =$this->Users_model->get_unique_url($slug);
            $update_jobseeker=array(
                'profilePic' =>$profile,
                'professional_title' =>$this->input->post('professional_title',TRUE),
                'firstname' =>$this->input->post('firstname',TRUE),
                'lastname' =>$this->input->post('lastname',TRUE),
                'email' =>$this->input->post('email',TRUE),
                'mobile' =>$this->input->post('mobile',TRUE),
                'dob' =>$this->input->post('dob',TRUE),
                'address' =>$this->input->post('address1',TRUE),
                'job_title' =>$this->input->post('job_title',TRUE),
                'skills' =>implode(',', $_POST['skill_id']),
                // 'position' =>$this->input->post('position',TRUE),
                'job_type' =>$this->input->post('job_type',TRUE),
                'experience' =>$this->input->post('experience',TRUE),
                'category_id' =>$this->input->post('category_id',TRUE),
                //'expected_category' =>$this->input->post('expected_category',TRUE),
                'salary' =>$this->input->post('salary',TRUE),
                'short_bio' =>$this->input->post('short_bio',TRUE),
                'resume'=>$jobseeker_resume,
                'slug_url' =>$slug_url,
            );
            //print_r($update_jobseeker); die;
            $this->Crud_model->SaveData('users',$update_jobseeker,"userId='".$_POST['userid']."'");
            $this->Crud_model->DeleteData('user_education',"user_id='".$_POST['userid']."'");
            $this->Crud_model->DeleteData('user_workexperience',"user_id='".$_POST['userid']."'");
            $count = count($this->input->post('education',TRUE));
            for ($i=0; $i < $count; $i++) {
                $update_class=array(
                    'user_id'=>$this->input->post('userid',TRUE),
                    'education'=>$this->input->post('education',TRUE)[$i],
                    'college_name'=>$this->input->post('university_institute',TRUE)[$i],
                    'marks'=>$this->input->post('marks',TRUE)[$i],
                    'passing_of_year'=>$this->input->post('year',TRUE)[$i],
                    'created_date'=>date('Y-m-d H:i:s'),
                );
                $this->Crud_model->SaveData('user_education',$update_class);
            }

            $count1 = count($this->input->post('employer_name',TRUE));
            for ($i=0; $i < $count1; $i++) {
                $update_workexperience=array(
                    'user_id'=>$this->input->post('userid',TRUE),
                    'company_name'=>$this->input->post('employer_name',TRUE)[$i],
                    'status'=>$this->input->post('status',TRUE)[$i],
                    'from_date'=>$this->input->post('start_date',TRUE)[$i],
                    'to_date'=>$this->input->post('end_date',TRUE)[$i],
                    'designation'=>$this->input->post('designation',TRUE)[$i],
                    'description'=>$this->input->post('job_profile',TRUE)[$i],
                    'created_date'=>date('Y-m-d H:i:s'),
                );
                $this->Crud_model->SaveData('user_workexperience',$update_workexperience);
            }

            $this->load->library('email');
            $email=$_POST['email'];
            $data=array(
                'name'=>$_POST['firstname'].' '.$_POST['lastname']
            );
            $htmlContent = $this->load->view('email_template/jobseeker_profile',$data,TRUE);
            $config = array(
                'protocol' => 'ssmtp',
                'smtp_host' => 'ssl://ssmtp.googlemail.com',
                'smtp_port' => 587,
                'smtp_user' => 'no-reply@phillyhire.com',
                'smtp_pass' => 'o6,V%19+!Jo1',
                'smtp_crypto' => 'security',
                'mailtype' => 'html',
                'smtp_timeout' => '4',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );
            $this->email->initialize($config);
            $this->email->from('no-reply@phillyhire.com','Phillyhire');
            $this->email->to($email);
            $this->email->subject('Completion of profile with CV is Successfully');
            $this->email->message($htmlContent);
            $this->email->send();
            $this->session->set_flashdata('message', 'profile updated successfully !!');
            $data=array(
                'result'=>1,
                'data'=>1,
            );
        }
        echo json_encode($data); exit;
    }
    ///////////////////// end jobseeker profile/////////////////

    function subscription() {
        $cond="employer.employer_id='".$_SESSION['commonUser']['userId']."'";
        $data['list_subscription']=$this->mymodel->get_subscriptionData($cond);
        $data['cms_pricing']=$this->Crud_model->get_single('manage_cms',"id='4'");
        $this->load->view('common/header');
        $this->load->view('user/subscription_plan',$data);
        $this->load->view('common/footer');
    }

    function my_jobs() {
        $data['get_postjob'] = $this->Crud_model->GetData('postjob', '', "user_id='".$_SESSION['commonUser']['userId']."' AND posted_from = 'Job Portal'",'','(id)desc','');
        $this->load->view('common/header');
        $this->load->view('user/postjob/job_list',$data);
        $this->load->view('common/footer');
    }

    function update_jobpost($slug_url) {
        $data['get_postjob'] = $this->Crud_model->get_single('postjob', "post_slug_url='".$slug_url."'");
        $data['get_category']=$this->Crud_model->GetData('category','',"status='1'",'',"(category_name) asc");
        $data['settingss']=$this->Crud_model->GetData('settingss','phone',"",'','','','1');
        $data['get_skills']=$this->Crud_model->GetData('skills',"");
        $this->load->view('common/header');
        $this->load->view('user/postjob/jobpost_form',$data);
        $this->load->view('common/footer');
    }

    function change_password() {
        $this->load->view('common/header');
        $this->load->view('user/change_password');
        $this->load->view('common/footer');
    }

    function applied_job() {
        $cond="applied_jobs.user_id='".$_SESSION['commonUser']['userId']."'";
        $data['list_appliedjob']=$this->Post_job_model->get_appliedjob($cond);
        $this->load->view('common/header');
        $this->load->view('user/jobseeker/applied_job',$data);
        $this->load->view('common/footer');
    }

    function applicant_list() {
        $data['get_job']=$this->Crud_model->GetData('postjob','id,job_title',"user_id='".$_SESSION['commonUser']['userId']."'",'','(id) desc');
        $this->load->view('common/header');
        $this->load->view('user/employer/applicant_list',$data);
        $this->load->view('common/footer');
    }

    //////////////////// applicant listing data ///////////////////////////
    function applicantlist_data() {
        sleep(1);
        $job_title = $this->input->post('job_title');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        if(isset($job_title) && !empty($job_title) || isset($start_date) && !empty($start_date) || isset($end_date) && !empty($end_date)){
            $total_count=$this->Post_job_model->applicantlist_count($job_title,$start_date,$end_date);
        } else {
            $total_count=0;
        }
        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = '#';
        $config['total_rows'] = $total_count;
        $config['per_page'] =10;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        // $config['full_tag_open'] = '<ul pagination pull-right>';
        // $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active'><a href='#'>";
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 3;
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $start = ($page - 1) * $config['per_page'];
        if(isset($job_title) && !empty($job_title) || isset($start_date) && !empty($start_date) || isset($end_date) && !empty($end_date)){
            $getdata=$this->Post_job_model->applicantlist_fetchdata($config["per_page"],$start,$job_title,$start_date,$end_date);
        } else{
            $getdata=$this->Post_job_model->applicantlist_fetchdata($config["per_page"],$start,$job_title,$start_date,$end_date);
        }
        $output = array(
            'pagination_link'  => $this->pagination->create_links(),
            'applicant_list'   =>$getdata
        );
        echo json_encode($output);
    }
    //////////////////// end  applicant listing data //////////////////////

    /*-------------- jobseeker list ---------------*/
    function jobseeker_list() {
        $this->load->view('common/header');
        $this->load->view('user/employer/jobseeker_list');
        $this->load->view('common/footer');
    }

    function jobseekerlist_data() {
        $this->load->model('Commonmodel');
        sleep(1);
        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = '#';
        $config['total_rows'] =$this->Commonmodel->jobseekerlist_count();
        $config['per_page'] =10;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active'><a href='#'>";
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 3;
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $start = ($page - 1) * $config['per_page'];

        $output = array(
            'pagination_link'  => $this->pagination->create_links(),
            'jobseeker_list'   =>$this->Commonmodel->jobseekerlist_fetchdata($config["per_page"], $start)
        );
        echo json_encode($output);
    }
    /*-------------- end jobseeker list ------------*/
}
