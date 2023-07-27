<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends My_Model {
var $column_order = array(null,'emp.employer_id','emp.subscription_id','emp.no_of_post','emp.amount','emp.payment_status',null); //set column field database for datatable orderable

    var $order = array('emp.id' => 'DESC');

    function __construct()
    {
        parent::__construct();
    }

	private function _get_datatables_query()
	{
		$this->db->select('emp.*,u.firstname,u.lastname,s.subscription_name');
        $this->db->from('employer_subscription as emp');
        $this->db->join('users as u','u.userId=emp.employer_id','left');
        $this->db->join('subscription as s','s.id=emp.subscription_id','left');
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
                    $cond.=" OR  emp.emp_title LIKE '%".trim($show_string)."%' ";
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

    function get_orderview($cond)
   {
       $this->db->select('emp.*,u.firstname,u.lastname,u.email as userEmail,s.subscription_name');
        $this->db->from('employer_subscription as emp');
        $this->db->join('users as u','u.userId=emp.employer_id','left');
        $this->db->join('subscription as s','s.id=emp.subscription_id','left');
       $this->db->where($cond);
        $query = $this->db->get();
       return $query->row();
   }
}
