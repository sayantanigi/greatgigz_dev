<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends AI_Controller {

    function __construct() {
        parent::__construct();
        $this->data['title'] = '';
        $this->load->model('Master_model'); 
       $this->load->library('Twilio_lib'); 
        

    }

    public function index() {
        if(isprologin()){
            redirect(site_url('edit-profile'),'refresh');
        }
        $this->data['title'] = 'Prosearchghana';
        $this->data['load'] = 'home';
        $this->data['banner'] = $this->db->get_where('teams',array('status'=>1))->result();
        $this->data['service'] = $this->db->get_where('service',array('status'=>1))->result();
        $this->data['sub_service'] = $this->db->order_by('name','ASC')->get_where('sub_service',array('status'=>1))->result();
        $this->data['city'] = $this->db->order_by('name','ASC')->get_where('city',array('status'=>1,'parent_city'=>0))->result();
        $this->data['testimonial'] = $this->db->limit(4)->get_where('testimonials',array('status'=>1))->result();
        $this->load->front_view('default', $this->data);
    }
    public function search_provider(){
        $this->data['title'] = 'Prosearchghana'; 
        $this->data['load'] = 'error_auth';
        $service = $this->input->post('service');
        $city = $this->input->post('city');
        $neighbor = $this->input->post('neihborhood');
        $counneigh = $this->db->get_where('provider_list', array('service_type' =>$service,'city'=>$city,'neihborhood'=>$neighbor,'status'=>1,'admin_status'=>1))->num_rows();
        //echo $this->db->last_query();die;
        $councity = $this->db->get_where('provider_list', array('service_type' =>$service,'city'=>$city,'status'=>1,'admin_status'=>1))->num_rows();
        $countsr=$this->db->get('searchmsg')->row();
        $stime=$countsr->s_time;
        $smsg=$countsr->name;
        $cu_date= date("Y-m-d H:i:s");
        $sip=$this->input->ip_address();
        $prvid= $this->db->order_by('id','desc')->limit(1)->get_where('search_attempt',array('ip'=>$sip))->row();
        $this->db->insert('search_attempt',array('ip' =>$sip,'created'=>$cu_date,'status'=>1));
        
        $edate = date("Y-m-d H:i:s",strtotime($prvid->created));
        $cdate = date("Y-m-d H:i:s",strtotime($cu_date));
        $date1=date_create($edate);
        $date2=date_create($cdate);
        $diff=date_diff($date2,$date1);
        $hrs=$diff->format("%H");
        //echo $hrs;
         $start = new DateTime($prvid->created);
         $end = new DateTime($cu_date);
        $interval = $start->diff($end);
        $hrs = $interval->d * 24 + $interval->h;
        //echo $hrs." hours "; 

        //$c=$this->db->get_where('search_attempt',array('ip' =>$sip))->num_rows();
        //echo $c;
        $query = $this->db->query("SELECT * FROM search_attempt WHERE `created` <= '$cu_date' AND `ip`='$sip'");
        $c=$query->num_rows();
        //echo $c;
        if($c > $stime){
            $this->session->set_flashdata('error', $smsg);
            if($hrs>24){
            $this->db->query("DELETE FROM search_attempt WHERE `created`< '$cu_date' AND `ip`='$sip'");
            //echo $this->db->last_query();
        } }
        else{

        if($councity > 0){
            $this->session->set_userdata('service',$service);
            $this->session->set_userdata('city',$city);
            $this->session->set_userdata('neighborhood',$neighbor);
          redirect(site_url('auth-number')); 
        }
        if($counneigh >0){
            $this->session->set_userdata('service',$service);
            $this->session->set_userdata('city',$city);
            $this->session->set_userdata('neighborhood',$neighbor);
          redirect(site_url('auth-number'));  

        }

        else{
             $this->session->set_flashdata('error', '<p style="font-size:30px; font-style: normal;">'.'Sorry! </br> <p style="font-size:20px; font-style: italic;"> We did not find a match for your search criteria. ProSearch is working to include more businesses and services in your area. Please come back later.'.'</p></p>');
        }
    }
        $this->load->front_view('default', $this->data);

    }
    public function auth_number(){
         if(isprologin()){
            redirect(site_url('edit-profile'),'refresh');
        }
      $this->data['title'] = 'Prosearchghana | Authenticating Number';
      $this->data['load'] = 'auth_number';  
      $this->data['service'] = $this->db->get_where('service',array('status'=>1))->result();
       
      $this->load->front_view('default', $this->data);
    }
 

    public function provider_list()
    {
      $this->data['title'] = 'Prosearchghana  | Serch Provider List';
      $this->data['load'] = 'provider_list';
        $service = $this->input->get('ser');
        $city = $this->input->get('city');
        $neighbor = $this->input->get('neighbor');
        $this->data['subservice'] = $this->db->get_where('sub_service',array('service_id' =>$service,'status'=>1))->result();
        $counneigh = $this->db->get_where('provider_list', array('service_type' =>$service,'city'=>$city,'neihborhood'=>$neighbor,'status'=>1,'admin_status'=>1))->num_rows();
        //echo $this->db->last_query();
        $councity = $this->db->get_where('provider_list', array('service_type' =>$service,'city'=>$city,'status'=>1,'admin_status'=>1))->num_rows();
        if($counneigh >0)
        {
        $this->data['provider_detl'] = $this->db->get_where('provider_list',array('service_type'=>$service,'city'=>$city,'neihborhood'=>$neighbor,'status'=>1,'admin_status'=>1))->result();
        
        }
         else if($councity >0) 
         {
            $this->session->set_flashdata('error','<p style="font-size:20px; color:blue; font-style: normal;">'.'The type of Business/Service Provider/Artisan you were looking for is not available in your selected Location. However, there are some available options in other parts of the city!'.'</p>');
            
            $this->data['provider_detl'] = $this->db->get_where('provider_list',array('service_type'=>$service,'city'=>$city,'status'=>1,'admin_status'=>1))->result();
        }
        
    //echo $this->db->last_query();die;
      $this->load->front_view('default', $this->data);
    }
    public function profile_otp_send(){
        $phone = $this->input->post('phonep');
            $sql = "SELECT * FROM `provider_list` WHERE (contact_prsn_mobile = '$phone') AND status = 1";
            $check = $this->db->query($sql)->num_rows();
           // echo $this->db->last_query();
            if($check>0){
                echo 0;
            }
            else{
             $otp = rand(100000, 999999);
//nosms  $otp=1;
             $this->session->set_userdata('psession_otp',$otp);
                $message = "Your One Time Password is " . $otp;
                $from = '(202) 952-4499';
                $to = $phone;
/*yessms*/      $response = $this->twilio_lib->sms($from, $to,$message);
//nosms  $response=1;
                if($response){
                    echo 1;
                }
        }
    }
     public function create_profile(){
      $this->data['title'] = 'Prosearchghana  | Create Profile';
      $this->data['load'] = 'create_profile';
      $this->data['service'] = $this->db->get_where('service',array('status'=>1))->result();
    $this->data['city'] = $this->db->get_where('city',array('parent_city'=>0,'status'=>1))->result();
    $this->form_validation->set_rules('frm[owner_type]', 'Business/Service Provider', 'required');
      $this->form_validation->set_rules('frm[service_type]', 'Business/Service type', 'required');
        //$s_type = $this->input->post('service_type');
        //$stringf =  implode(',',(array) $s_type);
    //    $this->form_validation->set_rules('frm[company_name]', 'Company Name', 'required');

//        $this->form_validation->set_rules('image', 'Government issued ID', 'required');
        $this->form_validation->set_rules('frm[contact_prsn_fname]', 'Contact Person First Name', 'required');
        $this->form_validation->set_rules('frm[contact_prsn_lname]', 'Contact Person Last Name', 'required');
        $this->form_validation->set_rules('frm[contact_prsn_mobile]', 'Contact Person mobile No', 'required|is_unique[provider_list.contact_prsn_mobile]');
       
        $this->form_validation->set_rules('frm[company_addr]', 'Company Address', 'required');
        $this->form_validation->set_rules('frm[city]', 'City', 'required');
        $this->form_validation->set_rules('neihborhood', 'Neighborhood', 'required');
       
        
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('agreecheckbox', 'Agreeing to our T&C and Privacy Policy', 'trim|required|greater_than[0]');
        $this->form_validation->set_rules('con_pass', 'Confirm password', 'required|matches[password]');

        if ($this->form_validation->run() === TRUE) {
            $frm = $this->input->post('frm');
            $config['upload_path']          = 'assets/images/profile/';
            $config['overwrite'] = FALSE;
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            
            $this->load->library('upload', $config);

            if($this->upload->do_upload('image')) //if there is an image to be uploaded we check whether there is only 1 face on it
            {
                $data = $this->upload->data();
                $frm['image'] = $data['file_name'];            
                $this->session->set_flashdata('error', "image name=".$frm['image']);
                $imagename = '/home1/prosear5/public_html/'.$config['upload_path'].$frm['image'];
                $shellstring='~/detectface.sh '.$imagename;
                $out = shell_exec($shellstring);
                //$this->session->set_flashdata('error', 'number of faces on '.$imagename.'='.$out);
                
                if ($out != 1) //1 face?
                {
                    $ret=mail('support@prosearchghana.com', 'suspicious ID submitted by the user '.$frm[contact_prsn_mobile], 'please check the image:'.$imagename);
                    
                    
                    if($ret ==true){
                        //$this->session->set_flashdata('success', "Your Email Sent Successfully");
                    }
                    else{
                        $this->session->set_flashdata('error', "email sending error");
                    }
                }
            }
            else
            {
                //print_r('image upload problem2: '.$this->upload->display_errors());  die; 
                if($frm['image']!='')
                {
                   $this->session->set_flashdata('error', $this->upload->display_errors());
                }
            }
            
            $otp = $this->input->post('profile_otp');
            $sessp_otp=$this->session->userdata('psession_otp');
            $frm['vcode'] = $sessp_otp;
            $frm['status'] = 1;

            $frm['neihborhood'] = $this->input->post('neihborhood');
            $frm['password'] = base64_encode($this->input->post('password')); //was base64_encode()
            $res = $this->db->insert('provider_list',$frm);
            if($res == true){ 
                $uid=$this->db->insert_id();
                $this->session->set_userdata('userids',$uid);
                $this->session->set_flashdata('success', 'You have registered successfully');
                redirect(site_url('edit-profile'));
            }
            else{
                $this->session->set_flashdata('error', 'Some error is occured');
            }

        }
        else
        {
           // print_r("error, frm[image]=".$frm['image']." data[file_name]=".$data['file_name']);
           //print_r('data: '.$this->data);
        }
    $this->load->front_view('default',$this->data);
    }
    
 public function otpverify(){

    $otp = $this->input->post('otpp');
    $sessp_otp=$this->session->userdata('psession_otp');
    
    if ($otp == $sessp_otp) {
        echo 1;
    } else {
        echo 0;
    }

    }
    
     public function prov_auth() {
        $this->data['title'] = 'Prosearchghana';
        $this->data['load'] = 'provider_auth';
        $this->load->front_view('default', $this->data);
    }
    
     public function forget_password() {
        $this->data['title'] = 'Prosearchghana | Forgot Password';
        $this->data['load'] = 'forget_pass';
       $this->form_validation->set_rules('contact_prsn_mobile', 'Phone Number', 'required');
            if($this->form_validation->run() === TRUE) {
            $phone = $this->input->post('contact_prsn_mobile');
            //$frm['password'] = base64_encode($this->input->post('password'))  //was base64_encode()
            $sql = "SELECT * FROM `provider_list` WHERE (contact_prsn_mobile = '$phone') AND status = 1 AND admin_status = 1";
            $check = $this->db->query($sql)->num_rows();
           // echo $this->db->last_query();
            if($check>0){
            $passw = rand(100000, 999999);
            $bpass = base64_encode($passw);  //was base64_encode()
            $frm= array('password'=>$bpass);
            $res = $this->db->update('provider_list',$frm,array('contact_prsn_mobile' =>$phone,'admin_status'=>1));
                $message = "Your New Password is " . $passw;
                $from = '(202) 952-4499';
                $to = $phone;
                $response = $this->twilio_lib->sms($from, $to,$message);
                $this->session->set_flashdata('success', 'New Password has been Sent to Your Phone Number.. ');
            }
         else{
                $this->session->set_flashdata('error', 'Enter Valid Phone Number');
            }
           
        }
        $this->load->front_view('default', $this->data);
    }
    
    public function edit_profile(){
         if(!isprologin()){
            redirect(site_url(),'refresh');
        }
        if(isprologin()){
            $user = userid2();
             $this->data['pdetail'] = $this->db->get_where('users',array('userId'=>$user))->row();
        }
        $this->data['title'] = 'Prosearchghana | Edit Profile';
        $this->data['load'] = 'edit_profile';
        $this->data['city'] = $this->db->get_where('city',array('parent_city'=>0,'status'=>1))->result();

        $this->data['neigh'] = $this->db->get_where('states')->result();

        //print_r($_POST);die;
        $this->form_validation->set_rules('frm[owner_type]', '"Do you own a business or are you a service provider/Artisan"', 'required');
        $this->form_validation->set_rules('frm[service_type]', 'Business/Service type', 'required');
    //    $this->form_validation->set_rules('frm[company_name]', 'Company Name', 'required');
//        $this->form_validation->set_rules('image', 'Government issued ID', 'required');
        $this->form_validation->set_rules('frm[firstname]', 'Contact Person First Name', 'required');
        $this->form_validation->set_rules('frm[lastname]', 'Contact Person Last Name', 'required');
        $this->form_validation->set_rules('frm[address]', 'Company Address', 'required');
        $this->form_validation->set_rules('frm[city]', 'City', 'required');
        $this->form_validation->set_rules('neihborhood', 'Neighborhood', 'required');
       
        
        $this->form_validation->set_rules('password', 'New Password', 'required');
        $this->form_validation->set_rules('con_pass', 'Confirm password', 'required|matches[password]');
       //print_r($_POST);die;

        if ($this->form_validation->run() === TRUE) {
            $frm = $this->input->post('frm');
/*
            $config['upload_path']          = 'assets/images/profile/';
            $config['overwrite'] = FALSE;
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);
        


            if($this->upload->do_upload('image'))
            {
                $data = $this->upload->data();
                $frm['image'] = $data['file_name'];
            }
            else
            {
                //print_r('image upload problem2: '.$this->upload->display_errors());  die; 
            }            
*/

            $frm['neihborhood']=$this->input->post('neihborhood');
            $frm['password'] = base64_encode($this->input->post('password'));  //was base64_encode()
            $res = $this->db->update('provider_list',$frm,array('id' => $user));
            //echo $this->db->last_query();die;
            if($res == true){
                $this->session->set_flashdata('success', 'Your Profile updated successfully !');
                 redirect(site_url('edit-profile'));
            }
            else{
                $this->session->set_flashdata('error', 'Some error is occured');
                redirect(site_url('edit-profile'));
            }
        }


        $this->load->front_view('default', $this->data);
    }

    public function about() {
        $this->data['title'] = 'Prosearchghana';
        $this->data['load'] = 'about';
        $this->data['abt'] = $this->db->get_where('cms',array('id'=>1))->row();
        $this->data['service'] = $this->db->get_where('service',array('status'=>1))->result();
        $this->load->front_view('default', $this->data);
    }

    public function service() {
        $this->data['title'] = 'Prosearchghana';
        $this->data['load'] = 'service';
        $this->data['service'] = $this->db->get_where('service',array('status'=>1))->result();
        $this->load->front_view('default', $this->data);
    }

    public function career() {
        $this->data['title'] = 'Prosearchghana';
        $this->data['load'] = 'career';
        $this->data['abt'] = $this->db->get_where('cms',array('id'=>2))->row();
        $this->load->front_view('default', $this->data);
    }

    public function terms() {
        $this->data['title'] = 'Prosearchghana';
        $this->data['load'] = 'term';
        $this->data['abt'] = $this->db->get_where('cms',array('id'=>4))->row();
        $this->load->front_view('default', $this->data);
    }

    public function privacy() {
        $this->data['title'] = 'Prosearchghana';
        $this->data['load'] = 'privacy';
        $this->data['abt'] = $this->db->get_where('cms',array('id'=>3))->row();
        $this->load->front_view('default', $this->data);
    }
    
/*    
function phone_check($phone_number)
{
    $regex = '/^\+?[0-9]+$/';
    $phone_number = trim($phone_number);
    if (!preg_match($regex, $phone_number)) {
        $this->form_validation->set_message('phone_check', 'Your Phone Number field '.$phone_number.' is not valid.');
        return false;
    }
    return true;
} 

*/

function contact(){
 $this->data['title'] = 'Prosearchghana| Contact Us';
 $this->data['load'] = 'contact';
 $this->form_validation->set_rules('frm[firstname]', 'First Name', 'required');
 $this->form_validation->set_rules('frm[lastname]', 'Last Name', 'required');
 
// $this->form_validation->set_rules('frm[email]', 'Email', 'required');
 $this->load->helper('email');
 #$this->form_validation->set_rules('frm[email]', 'Email', 'trim|required|valid_email');
 $this->form_validation->set_rules('frm[email]', 'Email', 'trim|valid_email');
 
 

// $this->form_validation->set_rules('frm[phone]', 'Phone Number', 'required|trim|callback_phone_check');
// $this->form_validation->set_rules('frm[phone]', 'Phone Number', 'required|trim|regex_match[/^\+?[0-9]+$/]');
  $this->form_validation->set_rules('frm[phone]', 'Phone Number', 'required|trim|min_length[7]');

 $this->form_validation->set_rules('frm[message]', 'Message', 'required');

 if ($this->form_validation->run() == TRUE) {
    $frm = $this->input->post('frm');
        //print_r($frm);die;
    $res = $this->db->insert('contacts',$frm);

        //mail t admin
        // $name = $frm['firstname'];
        // $email = $frm['email'];
        // $message = $frm['message'];
        // $htmlContent = "
        // <table align='center' style='width:650px; text-align:center; background:#8e88881f;'>
        // <tbody>
        // <tr style='height:50px;background-color:#ffeabf;'>
        // <td valign='middle' style='color:white;'><img src='" . base_url() . "fassets/images/logo.png' alt='vocaldoctor' title='Vocal Doctor'  style='width:210px;height:130px' /></td>
        // </tr>
        // <tr>
        // <td valign='top' align='center' colspan='2'>
        // <table align='center' style='height:380px; color:#000; width:600px;'>
        // <tbody>
        // <tr>
        // <td style='width:8px;'>&nbsp;</td>
        // <td align='center' style='font-size:28px;border-top:1px dashed #ccc;' colspan='3'>Hello, Admin</td>
        // </tr>
        // <tr>
        // <td valign='top' align='center' colspan='2'>
        // <p>".$name." contact you.Here are the details.</p>
        // <br><br>
        // <table align='center' style='color:#000; width:600px;'>
        // <tbody>
        // <tr align='center'>
        // <td><b>Name </b>: ".$name."</td>
        // </tr>
        // <tr align='center'>
        // <td><b>Email </b>:".$email."</td>
        // </tr>
        // <tr align='center'>
        // <td><b>Message </b>:".$message."</td>
        // </tr>


        // </tbody>
        // </table>
        // <a></a>
        // <br>
        // Best Regards,<br>
        // Union Républicaine <br><br>
        // <strong>Email:</strong>support@unionrepublican<br><br>
        // This is an automated response, please DO NOT reply.
        // </td>
        // </tr>
        // </tbody>
        // </table>
        // </td>
        // </tr>
        // </tbody>
        // </table>
        // ";

        // $this->load->library('email');
        // $this->email->set_mailtype("html");
        // $this->email->from($email, $name);
        // $this->email->to(theme_option('email'));

        // $this->email->subject($subject.' | Enquiry');

        // $this->email->message($htmlContent);

        //$this->email->send();
        
/*test1        
    $this->load->library('email');
    $this->email->set_mailtype("html");
    $txt = $this->email->from('support@prosearchghana.com','');
    $txt = $this->email->to('lkelemen@kolumbus.fi');
    $txt = $this->email->subject('you got feedback form '.$frm[email]);
    $txt = $this->email->message($frm[message]);

    $ret = $this->email->send();
test1*/ 

//    $txt='mail data, receiver:'.'lkelemen@kolumbus.fi'.' subject:'.'you got feedback form '.$frm[email].' message content:'.$frm[message];



/*
    if ( ! function_exists('mail'))
    {
        $this->session->set_flashdata('error', "there is no mail function.");
    }
    else {
        $this->session->set_flashdata('error', "there is mail function.");
    }

*/


    //print_r('form message='.$frm[message]); die;
    $ret=mail('support@prosearchghana.com, info@prosearchghana.com', 'you got feedback from '.$frm[email], $frm[message]);
    
    
    if($ret ==true){
        //$this->session->set_flashdata('success', "Your Email Sent Successfully");
    }
    else{
        $this->session->set_flashdata('error', "Oops ! you cant send message.");
    }

  

    if($res == true){
        $this->session->set_flashdata('success', 'Thank you for contacting us! We will get back to you soon');
        redirect(site_url('contact'));
    }

     
     //$this->load->front_view('default', $this->data); 
 }
else
{
    //redirect(site_url('contact'));
}

    $this->load->front_view('default', $this->data);
}


public function login_ajax()
{
    $uname = $this->input->post('uname');
    $words = explode(' ', $uname);
    $mobile = $words[1];
    $password = md5($this->input->post('password')); //was base64_encode()
    //$sql = "SELECT * FROM `users` WHERE (mobile = '$uname') AND password = '$password' AND status = 1 AND admin_status=1";
    $sql = "SELECT * FROM `users` WHERE mobile = '$mobile' AND password = '$password' AND status = 1 AND email_verified=1";
    $check = $this->db->query($sql)->num_rows();
    $user = $this->db->query($sql)->row();
    //echo $this->db->last_query();
    //print_r($user->id);die;
    if($check>0){
        //$_SESSION['userid'] = $user->id;
        //$this->session->set_userdata('userids',$user->id);
        $sess['commonUser'] =array(
            "userId"=>$user->userId,
            "companyname"=>$user->companyname,
            "firstname"=>$user->firstname,
            "lastname"=>$user->lastname,
            "userEmail"=>$user->email,
            "userMobile"=>$user->mobile,
            "UserLoggedIn"=>TRUE,
            'userType'=>$user->userType,
            //"name"=>$checkLoginUser->firstname.' '.$checkLoginUser->lastname,
            //"email"=>$checkLoginUser->email,
            //"userType"=>$checkLoginUser->userType,
        );
        $this->session->set_userdata($sess);
        echo 1;

    }else{
        echo 2;
    }

}

public function signup(){
    $name = $this->input->post('name');
    $email = $this->input->post('email');
    $mobile = $this->input->post('mobile');
    $password = $this->input->post('password');
    $check_email = $this->db->get_where('users',array('email'=>$email))->num_rows();
    if($check_email>0){
        echo 2;
        exit();
    }

    $arr = array(
        'firstname'=>$name,
        'email'=>$email,
        'mobile'=>$mobile,
        'password'=>md5($password),
        'status'=>1
    );
    if($this->db->insert('users',$arr)){
        echo 1;
    }else{
        echo 0;
    }
    

}

public function city_ajax()
{
    $id = $this->input->post('id');
    $count = $this->db->get_where('city',array('parent_city'=>$id))->num_rows();
    if($count >0){
    $this->db->order_by("UPPER(name)","asc");
    $this->data['neigh'] = $this->db->get_where('city',array('parent_city'=>$id))->result();

    //echo $this->db->last_query();die;
    }else{
    $this->db->order_by("UPPER(name)","asc");
    $this->data['neigh'] = $this->db->get_where('city',array('id'=>$id))->result();
    //echo $this->db->last_query();die;
    }
    return $this->load->front_view('get_city',$this->data);
}
public function subservice_ajax()
{
    $subservice_id = $this->input->post('subservice');
    // sorted in home.php $this->db->order_by("UPPER(name)","asc");
    $this->data['subservice'] = $this->db->get_where('sub_service',array('service_id'=>$subservice_id,'status'=>1))->result();
    
    return $this->load->front_view('get_subservice',$this->data);


}
public function login()
{
    $this->data['load'] = 'login';
    $validate = array(array('field' => 'email', 'label' => 'Email ID', 'rules' => 'required'), array('field' => 'password', 'label' => 'Password', 'rules' => 'required'));
    $this->form_validation->set_rules($validate);


    if($this->form_validation->run() == TRUE){
        $email = $this->input->post('email');
        $pass = md5($this->input->post('password'));
                //$p= md5($pass);
        $url = $this->input->post('url');
        $query = $this->db->query('SELECT * FROM users WHERE email="'.$email.' " AND password="'.$pass.'" AND status="1"');die;
        $user = $query->row();
                //echo $this->db->last_query();die;
        if($query ->num_rows() > 0){
            $this->session->set_userdata('email',$user->email);
            $this->session->set_userdata('userid',$user->id);
            $this->session->set_flashdata('success', 'Login Successful');
            if(isset($_SESSION['last_url'])) {
                redirect($_SESSION["last_url"]);
                $this->session->unset_userdata('last_url');
            }
            if(!empty($url)){
                redirect($url);
            }else{
                redirect(site_url('myaccount'));
            }


        }
        else{
            $this->session->set_flashdata('error', 'Invalid Email/Password. Try again');
            if(!empty($url)){
                redirect(site_url('login?url='.$url));
            }else{
                redirect(site_url('login'));
            }

        }

    }
        //$this->data['faq'] = $this->Faq_model->getRow('1');
    $this->load->front_view('default',$this->data);
}
function forgot_password() {
    $this->data['title'] = 'Quoteshipping | 404-error';
    $this->data['load'] = 'forgot_password';
    $this->load->front_view('default', $this->data);
}
function myaccount() {
    $this->data['title'] = 'Quoteshipping | 404-error';
    $this->data['load'] = 'myaccount';
    $userid=$this->session->userdata("userid");
    $this->data['user_detail']=$this->db->get_where('users',array('id'=>$userid))->row();
    $check = $this->db->get_where('orders',array('userid'=>$userid,'payment_status'=>1))->num_rows();
    if($check>0){
        $this->data['corse_detl']= $this->db->get_where('courses',array('status'=>1))->result();
    }else{
        $this->data['corse_detl']= array();
    }
    
    $this->load->front_view('default', $this->data);
}
public function change_pass(){ 

    $this->data['title'] = 'Quoteshipping | 404-error';
    $this->data['load'] = 'change_password';
    $userid=$this->session->userdata("userid");
    $this->data['user_detail']=$this->db->get_where('users',array('id'=>$userid))->row();
    $validate = array(array('field' => 'new_pass', 'label' => 'New Password', 'rules' => 'required'), array('field' => 'con_pass', 'label' => 'Confirm Password', 'rules' => 'required'));
    $this->form_validation->set_rules($validate);


    if ($this->form_validation->run() == TRUE) {
        $new_pass=md5($this->input->post('new_pass'));

        $confirm_pass=md5($this->input->post('con_pass'));
            //print_r($confirm_pass);die();

        if ($new_pass==$confirm_pass) {
            $this->db->where('id',$userid)->update('users',array('password'=>$confirm_pass));
            $this->session->set_flashdata("success", "Password Changed Successfully");
        }else{
            $this->session->set_flashdata('error', 'New password confirm password does not matched');
        }

    }
    $this->load->front_view('default', $this->data);
}
public function sign_out()
{
    $this->session->unset_userdata('userids');
    $this->session->sess_destroy();
    $this->session->set_flashdata('success', 'Logout successfully');

    redirect(site_url(''));
}
public function signup1()
{
    $this->data['load'] = 'signup';
    $this->form_validation->set_rules('frm[firstname]', 'First Name', 'required');
    $this->form_validation->set_rules('frm[lastname]', 'Last Name', 'required');
    $this->form_validation->set_rules('frm[phone]', 'Phone No', 'required|is_unique[users.phone]');
    $this->form_validation->set_rules('frm[gender]', 'Gender', 'required');
    $this->form_validation->set_rules('frm[email]', 'Email', 'required|is_unique[users.email]');
    $this->form_validation->set_rules('frm[password]', 'Password', 'required');
    if ($this->form_validation->run() == TRUE) {
        $frm = $this->input->post('frm');

        $frm['status']=1;
        $frm['password'] = md5($frm['password']);
        $res = $this->Master_model->save($frm,'users');
        if($res == true){
            $this->session->set_flashdata('success', 'You have registerd successfully !');
            redirect(site_url('login'));
        }
        else{
            $this->session->set_flashdata('error', 'Some error is occured');
            redirect(site_url('sign-up'));
        }
    }

    $this->load->front_view('default',$this->data);
}

public function sendMessage()
{
    $arr = array(
        'firstname'=>$this->input->post('firstname'),
        'lastname'=>$this->input->post('lastname'),
        'email'=>$this->input->post('email'),
        'phone'=>$this->input->post('phone'),
        'help'=>$this->input->post('help'),
        'descr'=>$this->input->post('comment')
    );
    $this->db->insert('enquiry',$arr);
    echo 1;
}


function error_page() {
    $this->data['title'] = 'Prosearchghana | 404-error';
    $this->data['header'] = '404-error ';
    $this->data['load'] = '404';

    $this->load->front_view('default', $this->data);
}


}
