<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_template extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model('Email_template_model');
	}
	function index($flag='')
	{

		$header = array('title' => 'template');

		$data = array(
            'heading' => 'List of Templates',
            'flag' => $flag,
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/template_list',$data);
        $this->load->view('admin/common/footer');
	}

  function ajax_manage_page($flag='')
  {

     $GetData = $this->Email_template_model->get_datatables();
        if(empty($_POST['start']))
      {

        $no=0;
        }
        else{
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row)
        {
          $btn='';
          if($flag=='existing-template')
          {
            $btn.=anchor(admin_url('add-use-template/'.base64_encode($row->id)),'<input type="radio"> USE');
          }
          else{
            $btn .= ''.anchor(admin_url('email_template/view/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2" title="View"><i class="far fa-eye mr-1"></i></span>');
            $btn.='|'.anchor(admin_url('email_template/update/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2" title="Edit"><i class="far fa-edit mr-1"></i></span>');
             $btn.='|'.'<span data-placement="right" class="btn btn-sm btn-danger mr-2" onclick="Delete(this,'.$row->id.')" title="Delete"><i class="fa fa-trash mr-1"></i></span>';
           }

            if(!empty($row->attachment) && file_exists('uploads/email/'.$row->attachment))
            {
              $attach='<i class="fas fa-paperclip"></i> <a href="'.base_url('uploads/email/'.$row->attachment).'">'.$row->attachment.'</a>';
            }
            else{
              $attach='';
            }
              $no++;
              $nestedData = array();
            $nestedData[] = $no;
              $nestedData[] = ucwords($row->subject);
           $nestedData[] = $attach;
              $nestedData[] = $btn;
              $data[] = $nestedData;
        }

      $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Email_template_model->count_all(),
                "recordsFiltered" => $this->Email_template_model->count_filtered(),
                "data" => $data,
        );

      echo json_encode($output);
  }

   public function create()
  {
    $header = array('title'=> 'Add');
      $data = array(
                  'heading'=>'Add Template',
                  'button'=>'Create',
                    'subject' =>set_value('subject'),
                    'body' =>set_value('body'),
                    'attachment' =>set_value('attachment'),
                    'id' =>set_value('id'),

          );
     $this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/template_form',$data);
        $this->load->view('admin/common/footer');
  }

  function create_action()
  {
    if($_FILES['attachment']['name'] != '') {
      $src = $_FILES['attachment']['tmp_name'];
      $filEnc = time();
      $avatar ='email'.rand(11111, 99999)."-".$_FILES['attachment']['name'];
      $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
      $dest = getcwd() . '/uploads/email/' . $avatar1;

      if (move_uploaded_file($src, $dest)) {
        $attachment  = $avatar1;
      }
    } else {

      $attachment ='';
    }
    $data=array(
      'subject'=>$this->input->post('subject',TRUE),
      'body'=>$_POST['body'],
      'attachment'=>$attachment,
      'created_date'=>date('Y-m-d H:i:s'),
    );
    $this->db->insert('email_template',$data);

     $this->session->set_flashdata('message', 'template created Successfully!');
    redirect(admin_url("template"));
  }

     public function update($id)
      {
        $template_id=base64_decode($id);
        $update_data=$this->Crud_model->get_single('email_template',"id='".$template_id."'");

      $header=array('title'=>'update');
      $data=array(
          'heading'=>'Update Template',
          'button'=>'Update',
        'subject'=>set_value('subject',$update_data->subject),
        'body'=>set_value('body',$update_data->body),
        'attachment'=>set_value('attachment',$update_data->attachment),
        'id'=>$template_id,
      );
        $this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/template_form',$data);
        $this->load->view('admin/common/footer');

      }

      function update_action()
      {
         if($_FILES['attachment']['name'] != '') {
      $src = $_FILES['attachment']['tmp_name'];
      $filEnc = time();
      $avatar ='email'.rand(11111, 99999)."-".$_FILES['attachment']['name'];
      $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
      $dest = getcwd() . '/uploads/email/' . $avatar1;

      if (move_uploaded_file($src, $dest)) {
        $attachment  = $avatar1;
         @unlink('uploads/email/'.$_POST['old_attachment']);
      }
    } else {

      $attachment =$_POST['old_attachment'];
    }
    $data=array(
      'subject'=>$this->input->post('subject',TRUE),
      'body'=>$_POST['body'],
      'attachment'=>$attachment,
    );
    $this->Crud_model->SaveData('email_template',$data,"id='".$_POST['id']."'");
     $this->session->set_flashdata('message', 'template updated Successfully!');
    redirect(admin_url("template"));
      }

       public function view($id)
      {
        $template_id=base64_decode($id);
        $update_data=$this->Crud_model->get_single('email_template',"id='".$template_id."'");

      $header=array('title'=>'view');
      $data=array(
          'heading'=>'View Template',
        'subject'=>set_value('subject',$update_data->subject),
        'body'=>$update_data->body,
        'attachment'=>set_value('attachment',$update_data->attachment),
      );
        $this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/template_view',$data);
        $this->load->view('admin/common/footer');

      }

      public function delete()
    {
        if(isset($_POST['cid']))
        {
          $get_data=$this->Crud_model->get_single('email_template',"id='".$_POST['cid']."'");
          if(!empty($get_data->attachment) && file_exists('uploads/email/'.$get_data->attachment))
          {
            @unlink('uploads/email/'.$get_data->attachment);
          }
           $this->Crud_model->DeleteData('email_template',"id='".$_POST['cid']."'");

        }
    }

		///////////////////// add use template ///////////////////////////
		function add_use_template($id)
		{
		 $template_id=base64_decode($id);
			 $update_data=$this->Crud_model->get_single('email_template',"id='".$template_id."'");
		$list_employers=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userType='2' and status='1'");
	 $list_jobseekers=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userType='1' and status='1'");
	 $list_subscriber=$this->Crud_model->GetData('subscriber','',"");
		 $header=array('title'=>'Add');
		 $data=array(
				 'heading'=>'Use Template',
			 'subject'=>set_value('subject',$update_data->subject),
			 'body'=>set_value('body',$update_data->body),
			 'attachment'=>set_value('attachment',$update_data->attachment),
			 'id'=>$template_id,
				'list_employers' =>$list_employers,
			 'list_jobseekers' =>$list_jobseekers,
			 'list_subscriber' =>$list_subscriber,
		 );
			 $this->load->view('admin/common/header',$header);
			 $this->load->view('admin/common/sidebar');
			 $this->load->view('admin/email_management/usetemplate_form',$data);
			 $this->load->view('admin/common/footer');
		}

		function save_usetemplate()
 {
	 if($_FILES['attachment']['name'] != '') {
		 $src = $_FILES['attachment']['tmp_name'];
		 $filEnc = time();
		 $avatar ='mail'.rand(11111, 99999)."-".$_FILES['attachment']['name'];
		 $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
		 $dest = getcwd() . '/uploads/composeemail_attachment/' . $avatar1;

		 if (move_uploaded_file($src, $dest)) {
			 $attachment  = $avatar1;
		 }
	 } else {

		 $attachment ='';
	 }
	 if(!empty($_POST['employer_id']))
	 {
		 $employer_id=$_POST['employer_id'];
	 }
	 else{
		 $employer_id='';
	 }
	 if(!empty($_POST['jobseeker_id']))
	 {
		 $jobseeker_id=$_POST['jobseeker_id'];
	 }
	 else{
		 $jobseeker_id='';
	 }
	 if(!empty($_POST['subscriber_id']))
	 {
		 $subscriber_id=$_POST['subscriber_id'];
	 }
	 else{
		 $subscriber_id='';
	 }
	 $data=array(
		 'subject'=>$this->input->post('subject',TRUE),
		 'body'=>$_POST['body'],
		 'attachment'=>$attachment,
		 'employer_id'=>$employer_id,
		 'jobseeker_id'=>$jobseeker_id,
		 'subscriber_email'=>$subscriber_id,
		 'created_date'=>date('Y-m-d H:i:s'),
	 );
	 $this->db->insert('compose_email',$data);
	$lastid=$this->db->insert_id();
    if(isset($_POST['send']))
    {
      
       $data1=array(
      'type'=>'send',
    );
       $this->Crud_model->SaveData('compose_email',$data1,"id='".$lastid."'");
       $get_data=$this->Crud_model->get_single('compose_email',"id='".$lastid."'");
        if(!empty($get_data->employer_id))
        {
          $employerid=$get_data->employer_id;
        }
        else{
          $employerid=0;
        }
      
        if(!empty($get_data->jobseeker_id))
        {
          $jobseekerid=$get_data->jobseeker_id;
        }
        else{
          $jobseekerid=0;
        }
          $get_employer=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$employerid.") and status='1'");
        $get_jobseeker=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$jobseekerid.") and status='1' ");
        $employer_email='';
        if(!empty($get_employer))
        {
         foreach($get_employer as $key)
         {
          $employer_email.=$key->email.', ';
         }
        }
        else{
          $employer_email.='';
        }
       
         $jobseeker_email='';
        if(!empty($get_jobseeker))
        {
         foreach($get_jobseeker as $key)
         {
          $jobseeker_email.=$key->email.', ';
         }
        }
         else{
          $jobseeker_email.='';
        }
       
$this->load->library('email');
 $data=array(
    'body'=>$get_data->body,
    'attachment'=>$get_data->attachment,
  );
   $htmlContent = $this->load->view('admin/email_management/admin_email_template',$data,TRUE);
      $config = array(
      'protocol' => 'ssmtp', 
    'smtp_host' => 'ssl://ssmtp.googlemail.com',
    'smtp_port' => 587,
    'smtp_user' => 'info@phillyhire.com',
    'smtp_pass' => '{Y8E8UFYBeP*',
    'smtp_crypto' => 'security',
    'mailtype' => 'html',
    'smtp_timeout' => '4',
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
  );
    $recipientArr = array($employer_email,$jobseeker_email,$get_data->subscriber_email);
  $this->email->initialize($config);
  $this->email->from('info@phillyhire.com','Phillyhire');
  $this->email->to($recipientArr);
  $this->email->subject($get_data->subject);
  $this->email->message($htmlContent);
  $this->email->send();
    $this->session->set_flashdata('message', 'Send successfully !!');
     redirect(admin_url("sent-mail"));
    }
    if(isset($_POST['save_and_draft']))
    {
      
       $data1=array(
      'type'=>'draft',
    );
       $this->Crud_model->SaveData('compose_email',$data1,"id='".$lastid."'");
        $this->session->set_flashdata('message', 'Draft mail Successfully!');
         redirect(admin_url("mailer"));
    }

 }
	 ///////////////////// end add use template ///////////////////////////

}
