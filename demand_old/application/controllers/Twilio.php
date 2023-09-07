<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Twilio extends AI_Controller
{

    function  __construct()
    {
        parent::__construct();
        $this->load->library('Twilio_lib'); 
    }

    public function sendSms()
    {
        $mobile=$this->input->post('mobile_number');
        $fullname = $this->input->post('fullname');
        $service = $this->input->post('service');
        $city = $this->input->post('city');
        $neighbor = $this->input->post('neighborhood');

        $cu_date= date("Y-m-d H:i:s");       
        $otp = rand(100000, 999999);
        $numbers = array(
            'contact_name'=>$fullname,
            'mobile_number'=>$mobile,
            'verification_code'=>$otp,
            'verified'=>0
        );

        $this->session->set_userdata('session_otp',$otp);
        $message = "Hi ".$fullname." Your One Time Password is " . $otp;
        $from = '(202) 952-4499';
        $to = $mobile;
        $nmdb = $this->db->get_where('mobile_numbers',array('mobile_number'=>$mobile,'verified'=>1))->num_rows();
        $nmrow = $this->db->get_where('mobile_numbers',array('mobile_number'=>$mobile,'verified'=>1))->row();
        $edate = date("Y-m-d",strtotime($nmrow->created));
        $cdate = date("Y-m-d",strtotime($cu_date));
        $date1=date_create($edate);
        $date2=date_create($cdate);
        $diff=date_diff($date1,$date2);
        $days=$diff->format("%a");
        if($nmdb > 0){
            if($days > 90){

                $this->db->update('mobile_numbers',array('verification_code' =>$otp,'verified'=>0,'created'=>$cu_date), array('mobile_number' => $mobile));
                echo json_encode(array("type"=>"success", "message"=>"A OTP Has been sent to your mobile number :".$to));        
                $response =$this->twilio_lib->sms($from, $to,$message);
                if($response->IsError){
                    echo 1;
                }
                else{
                    echo 2;
                }

            }
        }
        else {

            $response = $this->twilio_lib->sms($from, $to,$message);
            if($response->IsError){
                echo json_encode(array("type"=>"error", "message"=>"Permission to send an SMS has not been enabled for the region indicated by the 'To' number: ".$to));

            }
            else{
                $this->db->insert('mobile_numbers',$numbers);
                echo json_encode(array("type"=>"success", "message"=>"OTP Has been sent to your mobile number :".$to));
            }      

        }       

    }

    public function verify_OTP()
    {
        $otp = $this->input->post('otp');
        $sess_otp=$this->session->userdata('session_otp');
       // echo json_encode(array("type"=>"success", "message"=>"<h4>your otp is </h4>"+$otp));
        $service = $this->input->post('service');
        $city = $this->input->post('city');
        $neighbor = $this->input->post('neighborhood');
        $data= array('verified' =>1);

        if ($otp == $sess_otp) 
        {
            $this->db->update('mobile_numbers', $data, array('verification_code' => $sess_otp));
            $this->session->unset_userdata('session_otp');
            echo json_encode(array("type"=>"success", "message"=>"<h4>Your mobile number is verified!</h4>"));
        } else {
            echo json_encode(array("type"=>"error", "message"=>"<h4 style='color:red'>Mobile number verification failed!! You have entered wrong OTP.</h4>"));
        }

    }

}
