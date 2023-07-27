<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Mailer extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model('Compose_email_model');
	}
	function index()
	{
   
		$header = array('title' => 'mailer');
    
		$data = array(
            'heading' => 'List of mailers',
           
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/draft_list',$data);
        $this->load->view('admin/common/footer');
	}

  function ajax_manage_page()
  {

    $cond="compose.type='draft'";
     $GetData = $this->Compose_email_model->get_datatables($cond);
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
             $btn = ''.anchor(admin_url('mailer/view/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2" title="View"><i class="far fa-eye mr-1"></i></span>');
            $btn.='|'.anchor(admin_url('mailer/update/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2" title="Edit"><i class="far fa-edit mr-1"></i></span>');
              $no++;
              $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] =date('d-M-Y',strtotime($row->created_date));
            $nestedData[] =ucwords($row->subject);
           $nestedData[] = '<a href="javascript:void(0)" onclick="return recipient_list('.$row->id.')">List of Recipients</a>';
              $nestedData[] = $btn;
              $data[] = $nestedData;
        }

      $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Compose_email_model->count_all($cond),
                "recordsFiltered" => $this->Compose_email_model->count_filtered($cond),
                "data" => $data,
        );

      echo json_encode($output);
  }

   public function composeemail()
  {
    $list_employers=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userType='2' and status='1'");
    $list_jobseekers=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userType='1' and status='1'");
    $list_subscriber=$this->Crud_model->GetData('subscriber','',"");
    $header = array('title'=> 'Compose');
      $data = array(
                  'heading'=>'Compose New Email',
                  'button'=>'Create',
                    'subject' =>set_value('subject'),
                    'body' =>set_value('body'),
                    'attachment' =>set_value('attachment'),           
                    'employer_id' =>set_value('employer_id'),           
                    'jobseeker_id' =>set_value('jobseeker_id'),           
                    'subscriber_id' =>set_value('subscriber_id'),           
                    'employerid' =>array('employerid'),           
                    'jobseekerid' =>array('jobseekerid'),           
                    'subscriberid' =>array('subscriberid'),           
                             
                    'id' =>set_value('id'),
                    'list_employers' =>$list_employers,
                    'list_jobseekers' =>$list_jobseekers,
                    'list_subscriber' =>$list_subscriber,
                   
          );
     $this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/compose_email',$data);
        $this->load->view('admin/common/footer');
  }

  function save_composeemail()
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
      'subject'=>$_POST['subject'],
      'body'=>$_POST['body'],
      'attachment'=>$attachment,
      'employer_id'=>$employer_id,
      'jobseeker_id'=>$jobseeker_id,
      'subscriber_email'=>$subscriber_id,
      'created_date'=>date('Y-m-d H:i:s'),
    );
     $this->Crud_model->SaveData('compose_email',$data);
     $lastid=$this->db->insert_id();
    if(isset($_POST['send']))
    {
      
       $data1=array(
      'type'=>'send',
    );
       $this->Crud_model->SaveData('compose_email',$data1,"id='".$lastid."'");
      // echo "success"; exit;
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
  $this->email->to('info@phillyhire.com');
  $this->email->bcc($recipientArr);
  $this->email->subject($get_data->subject);
  $this->email->message($htmlContent);
  $this->email->send();
      $this->session->set_flashdata('message', 'Sent successfully !!');
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

     public function update($id)
      {
        $compose_id=base64_decode($id);
        $update_data=$this->Crud_model->get_single('compose_email',"id='".$compose_id."'");
    $list_employers=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userType='2' and status='1'");
    $list_jobseekers=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userType='1' and status='1'");
    $list_subscriber=$this->Crud_model->GetData('subscriber','',"");
    $employerid = explode(",", $update_data->employer_id);
      $jobseekerid = explode(",", $update_data->jobseeker_id);
      $subscriberid = explode(",", $update_data->subscriber_email);
       if(!empty($update_data->employer_id))
        {
          $employers=$update_data->employer_id;
        }
        else{
          $employers=0;
        }
      
        if(!empty($update_data->jobseeker_id))
        {
          $jobseekers=$update_data->jobseeker_id;
        }
        else{
          $jobseekers=0;
        }
          $get_employer=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$employers.")");
        $get_jobseeker=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$jobseekers.")");
      $header=array('title'=>'update');
      $data=array(
          'heading'=>'Update Compose Email',
          'button'=>'Update',
        'subject'=>set_value('subject',$update_data->subject),
        'body'=>set_value('body',$update_data->body),
        'attachment'=>set_value('attachment',$update_data->attachment),
        'employerid' =>$employerid,           
        'jobseekerid' =>$jobseekerid,           
        'subscriberid' =>$subscriberid,           
        'subscriber_id' =>set_value('subscriber_id',$update_data->subscriber_email),           
        'employer_id' =>set_value('employer_id',$update_data->employer_id),           
        'jobseeker_id' =>set_value('jobseeker_id',$update_data->jobseeker_id),           
       
        'list_employers' =>$list_employers,
        'list_jobseekers' =>$list_jobseekers,
        'list_subscriber' =>$list_subscriber,
        'get_employer' =>$get_employer,
        'get_jobseeker' =>$get_jobseeker,
        'id'=>$compose_id,
      );
        $this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/compose_email',$data);
        $this->load->view('admin/common/footer');
      
      }

       function update_composeemail()
      {
         if($_FILES['attachment']['name'] != '') {
      $src = $_FILES['attachment']['tmp_name'];
      $filEnc = time();
      $avatar ='mail'.rand(11111, 99999)."-".$_FILES['attachment']['name'];
      $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
      $dest = getcwd() . '/uploads/composeemail_attachment/' . $avatar1;

      if (move_uploaded_file($src, $dest)) {
        $attachment  = $avatar1;
         @unlink('uploads/composeemail_attachment/'.$_POST['old_attachment']);
      }
    } else {

      $attachment =$_POST['old_attachment'];
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
    );
    $this->Crud_model->SaveData('compose_email',$data,"id='".$_POST['id']."'");
     if(isset($_POST['send']))
    {
       $data1=array(
      'type'=>'send',
    );
       $this->Crud_model->SaveData('compose_email',$data1,"id='".$_POST['id']."'");
       $get_data=$this->Crud_model->get_single('compose_email',"id='".$_POST['id']."'");
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
        $get_jobseeker=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$jobseekerid.") and status='1'");
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
  $this->email->to('info@phillyhire.com');
  $this->email->bcc($recipientArr);
  $this->email->subject($get_data->subject);
  $this->email->message($htmlContent);
  $this->email->send();
    $this->session->set_flashdata('message', 'Sent successfully !!');
    redirect(admin_url("sent-mail"));
    }
    if(isset($_POST['save_and_draft']))
    {
       $data1=array(
      'type'=>'draft',
    );
       $this->Crud_model->SaveData('compose_email',$data1,"id='".$_POST['id']."'");
        $this->session->set_flashdata('message', 'Draft mail updated Successfully!');
          redirect(admin_url("mailer"));
    }

  
      }

       public function view($id)
      {
        $compose_id=base64_decode($id);
        $update_data=$this->Crud_model->get_single('compose_email',"id='".$compose_id."'");
        if(!empty($update_data->employer_id))
        {
          $employerid=$update_data->employer_id;
        }
        else{
          $employerid=0;
        }
      
        if(!empty($update_data->jobseeker_id))
        {
          $jobseekerid=$update_data->jobseeker_id;
        }
        else{
          $jobseekerid=0;
        }
          $get_employer=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$employerid.")");
        $get_jobseeker=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$jobseekerid.")");
    
      $header=array('title'=>'view');
      $data=array(
          'heading'=>'View Draft',
        'subject'=>set_value('subject',$update_data->subject),
        'body'=>$update_data->body,
        'attachment'=>set_value('attachment',$update_data->attachment),
        'subscriber_email'=>set_value('subscriber_email',$update_data->subscriber_email),
        'get_employer'=>$get_employer,
        'get_jobseeker'=>$get_jobseeker,
      );
        $this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/draft_view',$data);
        $this->load->view('admin/common/footer');
      
      }

      function list_recipients()
      {
        $get_data=$this->Crud_model->get_single('compose_email',"id='".$_POST['id']."'");
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
          $get_employer=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$employerid.")");
        $get_jobseeker=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$jobseekerid.")");

        $html=' <div class="card-body">';
                 if(!empty($get_employer)){
             $html.= '<div class="form-group">
                <label>Employers :</label>
                <p>';
                  foreach($get_employer as $key){
                $html.=$key->email.' ('.ucwords($key->firstname.' '.$key->lastname).') '. ", ";
                     } 
                 $html.= '</p>
                       </div>';
                 }
             if(!empty($get_jobseeker)){
             $html.= '<div class="form-group">
                <label>Jobseekers :</label>
                <p>';
                  foreach($get_jobseeker as $key){
                $html.=$key->email.' ('.ucwords($key->firstname.' '.$key->lastname).') '. ", ";
                     } 
                 $html.= '</p>
                       </div>';
                 }
              if(!empty($get_data->subscriber_email)){
            $html.='<div class="form-group">
                <label>Subscribers :</label>
               <p style="word-break: break-all;"> '.@$get_data->subscriber_email.'</p>
              </div>';
            }
               
          $html.='</div>';
          echo $html;
      }

      /////////////////// start sent mail //////////////////////

      function sent_mail()
      {
        $header = array('title' => 'sent');
    
    $data = array(
            'heading' => 'List of sent mail',
           
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/sentmail_list',$data);
        $this->load->view('admin/common/footer');
      }
       function list_sendmail()
      {
        $cond="compose.type='send'";
     $GetData = $this->Compose_email_model->get_datatables($cond);
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
             $btn = ''.anchor(admin_url('resend/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success mr-2">Resend</span>');
            $btn.= '<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash mr-1"></i></span>';
           
              $no++;
              $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] =date('d-M-Y',strtotime($row->created_date));
            $nestedData[] =ucwords($row->subject);
           $nestedData[] = '<a href="javascript:void(0)" onclick="return recipient_list('.$row->id.')">List of Recipients</a>';
              $nestedData[] = $btn;
              $data[] = $nestedData;
        }

      $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Compose_email_model->count_all($cond),
                "recordsFiltered" => $this->Compose_email_model->count_filtered($cond),
                "data" => $data,
        );

      echo json_encode($output);
      }
    
    function resend($id)
    {
        $compose_id=base64_decode($id);
        $update_data=$this->Crud_model->get_single('compose_email',"id='".$compose_id."'");
    $list_employers=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userType='2' and status='1'");
    $list_jobseekers=$this->Crud_model->GetData('users','userId,firstname,lastname,email',"userType='1' and status='1'");
    $list_subscriber=$this->Crud_model->GetData('subscriber','',"");
    $employerid = explode(",", $update_data->employer_id);
      $jobseekerid = explode(",", $update_data->jobseeker_id);
      $subscriberid = explode(",", $update_data->subscriber_email);
       if(!empty($update_data->employer_id))
        {
          $employers=$update_data->employer_id;
        }
        else{
          $employers=0;
        }
      
        if(!empty($update_data->jobseeker_id))
        {
          $jobseekers=$update_data->jobseeker_id;
        }
        else{
          $jobseekers=0;
        }
          $get_employer=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$employers.")");
        $get_jobseeker=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId in(".$jobseekers.")");
      $header=array('title'=>'update');
      $data=array(
          'heading'=>'Resend Email',
          'button'=>'Update',
        'subject'=>set_value('subject',$update_data->subject),
        'body'=>set_value('body',$update_data->body),
        'attachment'=>set_value('attachment',$update_data->attachment),
        'employerid' =>$employerid,           
        'jobseekerid' =>$jobseekerid,           
        'subscriberid' =>$subscriberid,           
        'subscriber_id' =>set_value('subscriber_id',$update_data->subscriber_email),           
        'employer_id' =>set_value('employer_id',$update_data->employer_id),           
        'jobseeker_id' =>set_value('jobseeker_id',$update_data->jobseeker_id),           
       
        'list_employers' =>$list_employers,
        'list_jobseekers' =>$list_jobseekers,
        'list_subscriber' =>$list_subscriber,
        'get_employer' =>$get_employer,
        'get_jobseeker' =>$get_jobseeker,
        'id'=>$compose_id,
      );
        $this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/email_management/resend_email',$data);
        $this->load->view('admin/common/footer');
    }
    
    function resendemail_action()
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
       public function sendmail_delete()
    {
        if(isset($_POST['cid']))
        {
          $get_data=$this->Crud_model->get_single('compose_email',"id='".$_POST['cid']."'");
          if(!empty($get_data->attachment) && file_exists('uploads/composeemail_attachment/'.$get_data->attachment))
          {
            @unlink('uploads/composeemail_attachment/'.$get_data->attachment);
          }
           $this->Crud_model->DeleteData('compose_email',"id='".$_POST['cid']."'");
          
        }
    }
      /////////////////// end  sent mail //////////////////////

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

}
