<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->library('email');
		 $this->load->library(array('email'));
	}

	public function oneweek_expirysubscription()
	{
    $Date=date('Y-m-d');
   $expDate= date('Y-m-d', strtotime($Date. ' + 7 days'));
   $get_data=$this->Crud_model->GetData('employer_subscription','',"end_date='".$expDate."'","employer_id","(id)desc");
		//$get_data=$this->mymodel->oneweekexpiry_subscription();
		if(!empty($get_data))
		{
		foreach($get_data as $key)
		{		
    $get_user=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId='".$key->employer_id."'",'','','','1');	
      				 $data=array(
                          'name'=>$get_user->firstname.' '.$get_user->lastname,
                        
                          );

  $htmlContent = $this->load->view('email_template/1week_expiresubscription',$data,TRUE);
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
  $this->email->to($get_user->email);
  $this->email->subject('One Week before Expiry of subscription Confirmation message from Phillyhire');
  $this->email->message($htmlContent);
  $this->email->send();
      			}
      				
	}
	}

	function oneday_expirysubscription()
	{
$Date=date('Y-m-d');
$expDate= date('Y-m-d', strtotime($Date. ' + 1 days'));
$get_data=$this->Crud_model->GetData('employer_subscription','',"end_date='".$expDate."'","employer_id","(id)desc");
		 // $get_data=$this->mymodel->onedayexpiry_subscription();
		 
		if(!empty($get_data))
		{
		foreach($get_data as $key)
		{	
		   
      	$get_user=$this->Crud_model->GetData('users','userId,email,firstname,lastname',"userId='".$key->employer_id."'",'','','','1');  
               $data=array(
                          'name'=>$get_user->firstname.' '.$get_user->lastname,
                        
                          );

  $htmlContent = $this->load->view('email_template/1day_expiresubscription',$data,TRUE);
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
  $this->email->to($get_user->email);
  $this->email->subject('One Day before Expiry of subscription Confirmation message from Phillyhire');
  $this->email->message($htmlContent);
  $this->email->send();
      			}
      		
      				
	}
	}
}