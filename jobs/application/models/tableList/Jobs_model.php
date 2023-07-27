<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jobs_model extends My_Model {
var $column_order = array(null,'job.user_id','job.category_id','job.job_title','job.job_type',null); //set column field database for datatable orderable

    var $order = array('job.id' => 'DESC');

    function __construct()
    {
        parent::__construct();
    }

	private function _get_datatables_query()
	{
		$this->db->select('job.*,u.firstname,u.lastname,c.category_name');
        $this->db->from('postjob as job');
        $this->db->join('users as u','u.userId=job.user_id','left');
        $this->db->join('category as c','c.id=job.category_id','left');
         //$this->db->where($cond);
		$i = 0;

        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string)
                {
                    $cond  = " ";
                    $cond.=" ( u.firstname LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  u.lastname LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  job.job_title LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  c.category_name LIKE '%".trim($show_string)."%') ";
                    $this->db->where($cond);
                }
            }
        $i++;

        if(isset($_POST['order'])) // here order processing
        {
            //print_r($this->column_order);exit;
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

	function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        //$this->db->where($cond);
        return $query->result();
    }

	 public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }


	function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_jobview($cond)
   {
       $this->db->select('job.*,u.firstname,u.lastname,c.category_name');
        $this->db->from('postjob as job');
        $this->db->join('users as u','u.userId=job.user_id','left');
        $this->db->join('category as c','c.id=job.category_id','left');
       $this->db->where($cond);
        $query = $this->db->get();
       return $query->row();
   }
}
