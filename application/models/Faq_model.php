<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    
class Faq_model extends My_Model {

    var $column_order = array(null,'faqs.title','faqs.image','faqs.description',null); //set column field database for datatable orderable
    var $order = array('faqs.id' => 'DESC');

    function __construct() {
        parent::__construct();
    }

    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from('faqs');
        
        $i = 0;
        $new_str = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['search']['value']);
        if($new_str) {
            $explode_string = explode(' ', $new_str);
            foreach ($explode_string as $show_string) {
                $cond  = " ";
                $cond.=" ( faqs.title LIKE '%".trim($show_string)."%' ";
                $cond.=" OR  faqs.description LIKE '%".trim($show_string)."%') ";
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