<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paypal extends AI_Controller{

   function  __construct(){
    parent::__construct();

        // Load paypal library & product model
    $this->load->library('paypal_lib'); 
        //$this->load->model('product');
}

function success(){
        //$this->cart->destroy();
    $user_id = $this->session->userdata('userid');
    $paypalInfo= $this->input->post();
         //echo "<pre>";
         //print_r($user_id);
         //print_r($paypalInfo);die;

    if(@$paypalInfo["payment_status"]=='Completed'){

        $id=$paypalInfo['custom'];
        $txn_id=$paypalInfo['txn_id'];
        $amount=$paypalInfo['payment_gross'];
        $status=$paypalInfo['payment_status'];
        $orderId = $paypalInfo['item_name'];
        $created_at=$paypalInfo['payment_date'];


        $arr = array(
            'user_id'=>$user_id,
            'txn_id'=>$txn_id,
            'order_id'=>$orderId,
            'payment_gross'=>$amount,
            'payment_status'=>$status,
        );

        $this->db->insert('payments',$arr);

        $arr1 = array(
            'payment_status'=>1
        );
        $this->db->where('id',$orderId);
        $this->db->update('orders',$arr1);
        $sql = "SELECT orders.*,courses.video_link,courses.id FROM `orders` JOIN courses ON orders.course_id = courses.id WHERE orders.id = ".$orderId;

        $query = $this->db->query($sql)->row();
        $user = $this->db->get_where('users',array('id'=>$user_id))->row();
        $link = site_url('assets/video/'.$query->video_link);
        $htmlContent = "
            <table align='center' style='width:650px; text-align:center; background:#8e88881f;'>
            <tbody>
            <tr style='height:50px;background-color:#ffeabf;'>
            <td valign='middle' style='color:white;'><img src='" . base_url() . "fassets/images/logo.png' alt='vocaldoctor' title='Vocal Doctor'  style='width:210px;height:130px' /></td>
            </tr>
            <tr>
            <td valign='top' align='center' colspan='2'>
            <table align='center' style='height:380px; color:#000; width:600px;'>
            <tbody>
            <tr>
            <td style='width:8px;'>&nbsp;</td>
            <td align='center' style='font-size:28px;border-top:1px dashed #ccc;' colspan='3'>Hello, " . $user->fname . "</td>
            </tr>
            <tr>
            <td valign='top' align='center' colspan='2'>
            <p>Your Order Placed automated successfully.</p>
            <br><br>
            <table align='center' style='color:#000; width:600px;'>
            <tbody>
            <tr align='center'>
            <td><strong>Transaction ID: &nbsp; ".$txn_id."</strong></td>
            </tr>
            <tr align='center'>
            <td><strong>Paid Amount: &nbsp; ".$amount."</strong></td>
            </tr>
            
            
            </tbody>
            </table>
            <a></a>
            <br>
            Best Regards,<br>
            theVocaldoctor.com <br><br>
            <strong>Email:</strong>support@thevocaldoctor.com<br><br>
            This is an automated response, please DO NOT reply.
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            ";
        
        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->from('hello@heavenlysoundspianoandvoice.com', 'Vocal Doctor');
        $this->email->to($user->email);

        $this->email->subject('Vocal doctor');
        
        
        
        
        $this->email->message($htmlContent);
        
        $this->email->send();
        

    }

    if(@$paypalInfo["payment_status"]=='Pending'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update payments set payment_status='0' where id=$id");
        $this->artwork_shipping($id);

        $this->session->set_flashdata('error', 'Payment is Pending');


    }

    if(@$paypalInfo["payment_status"]=='Denied'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update payments set payment_status='2' where id=$id");

        $this->session->set_flashdata('error', 'Payment has denied');

    }

    if(@$paypalInfo["payment_status"]=='Failed'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update payments set payment_status='3' where id=$id");

        $this->session->set_flashdata('error', 'Payment has been Failed');

    }

    if(@$paypalInfo["payment_status"]=='Refused'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update payments set payment_status='4' where id=$id");
        $this->session->set_flashdata('error', 'Payment has been Refused');

    }






    $this->data['status']=@$paypalInfo['payment_status'];
    $this->data['load'] = 'thank';
    $this->load->front_view('default', $this->data);

}

public function thank()
{
        // print_r($paypalInfo);die;

    $this->data['load'] = 'thank';
    $this->load->front_view('default', $this->data);
}

function cancel(){
        // Load payment failed view
   $this->data['main'] = 'cancel';
   $this->load->front_view('default',$this->data);
}

function ipn(){
        // Paypal posts the transaction data
    $paypalInfo = $this->input->post();

    if(!empty($paypalInfo)){
            // Validate and get the ipn response
        $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
        if($ipnCheck){
                // Insert the transaction data in the database
            $data['user_id']        = $paypalInfo["custom"];
            $data['product_id']        = $paypalInfo["item_number"];
            $data['txn_id']            = $paypalInfo["txn_id"];
            $data['payment_gross']    = $paypalInfo["mc_gross"];
            $data['currency_code']    = $paypalInfo["mc_currency"];
            $data['payer_email']    = $paypalInfo["payer_email"];
            $data['payment_status'] = $paypalInfo["payment_status"];

            $this->product->insertTransaction($data);
        }
    }
}
}