<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends AI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('paypal_lib');	
	}
	public function placeorder(){


		if(!islogin()){
			redirect('login','refresh');
		}

		if($frm = $this->input->post('frm')){


			$res = $this->db->insert('orders',$frm);

			$frm['orderId'] = $this->db->insert_id();


			
			$this->pay_pal($frm);

			if($res == true){
                //$this->session->set_flashdata('success', 'Thank you for Your  us !');
				redirect(site_url('payment'));
			}
		}
	}
	public function pay_pal($frm)
	{
		$user  = $this->db->get_where('users',array('id'=>userid2()))->row();
		//print_r($user->firstname);die();
		
		$name=$user->firstname.' '.$user->lastname;
		$email=$user->email;
		$orderId=$frm['orderId'];
		$price=$frm['amount'];


		
 				$returnURL = base_url().'paypal/success'; //payment success url


				$cancelURL = base_url().'paypal/cancel'; //payment cancel url
				$notifyURL = base_url().'paypal/ipn'; //ipn url
				
				
				$this->paypal_lib->add_field('return', $returnURL);
				$this->paypal_lib->add_field('cancel_return', $cancelURL);
				$this->paypal_lib->add_field('notify_url', $notifyURL);
				$this->paypal_lib->add_field('item_name',$orderId);
				$this->paypal_lib->add_field('custom',101);
				$this->paypal_lib->add_field('first_name',$name);
				
				$this->paypal_lib->add_field('email',$email);
				//$this->paypal_lib->add_field('day_phone_b','9611954971');
				$this->paypal_lib->add_field('amount',$price);
				//$this->paypal_lib->add_field('amount',$total);
				$this->paypal_lib->paypal_auto_form();

				exit;

			}


		}

		/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */