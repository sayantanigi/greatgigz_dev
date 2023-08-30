<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model {
    var $column_order = array(null,'banner.page_name','banner.posted_for',null, null);
    var $order = array('banner.id' => 'asc');
    function __construct() {
        parent::__construct();
    }

    private function _get_datatables_query() {
        $this->db->select('banner.*');
        $this->db->from('banner');
        $i = 0;
        if($_POST['search']['value']) {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) {
                $cond  = " ";
                $cond.=" ( banner.page_name LIKE '%".trim($show_string)."%' ";
                $cond.=" OR banner.posted_for LIKE '%".trim($show_string)."%' ";
                $cond.=" OR banner.status LIKE '%".trim($show_string)."%') ";
                $this->db->where($cond);
            }
        }
        $i++;
        if(isset($_POST['order'])) {
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
