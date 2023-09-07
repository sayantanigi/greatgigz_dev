<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends AI_Controller {

	public function __construct()
	{
		parent::__construct(); 
		//Do your magic here
	}
	public function index($slug)
	{
		$this->data['title'] = $slug;
		$this->data['load'] = 'page';
		$this->data['result'] = $this->Pages_model->getCms($slug);
		
		// $this->data['waction'] = $this->db->get_where('cms',array('slug'=>$slug,'id'=>12))->row();
		// echo $this->db->last_query();die();
		// $this->data['taction'] = $this->db->get_where('cms',array('slug'=>$slug,'id'=>13))->row();
		
		$this->load->front_view('default',$this->data); 
	}

}

/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */