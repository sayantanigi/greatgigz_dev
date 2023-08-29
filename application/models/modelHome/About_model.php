<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class About_model extends CI_Model {
	var $column_order = array(null,'about_us.title','about_us.description',null); //set column field database for datatable orderable
    //var $column_search = array('ms.country_name','md.state_name','mc.city_name','mc.status'); //set column field database for datatable searchable 
    var $order = array('about_us.id' => 'ASC'); 

    function __construct() {
        parent::__construct();
    }
	
	private function _get_datatables_query() {
		$this->db->select('about_us.*');
        $this->db->from('about_us');
		$i = 0;
        if($_POST['search']['value']) {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) {  
                $cond  = " ";
                $cond.=" (  about_us.title LIKE '%".trim($show_string)."%' ";
                $cond.=" OR  about_us.description LIKE '%".trim($show_string)."%') ";
                $this->db->where($cond);
            }
        }
        $i++;
        
        if(isset($_POST['order'])) {
            //print_r($this->column_order);exit;
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

	function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	public function count_all() {    
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

	function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
}