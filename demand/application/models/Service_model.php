<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'service';
	}

	function getPage($slug){
		return $this -> db -> get_where($this -> table, array('slug' => $slug)) -> row();
	}

}

/* End of file Service_model.php */
/* Location: ./application/models/Service_model.php */