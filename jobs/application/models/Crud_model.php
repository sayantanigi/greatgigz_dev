<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class Crud_model extends CI_Model
{   
	function __construct()
    {
        parent::__construct();
        
    }
	
	public function GetData($table,$field='',$condition='',$group='',$order='',$limit='',$result='')
    {
  
        if($field != '')
        $this->db->select($field);
        if($condition != '')
        $this->db->where($condition);
        if($order != '')
        $this->db->order_by($order);
        if($limit != '')
        $this->db->limit($limit);
        if($group != '')
        $this->db->group_by($group);
        if($result != '')
        {
            $return =  $this->db->get($table)->row();
        }else{
            $return =  $this->db->get($table)->result();
        }
        return $return;
    }

    

	public function SaveData($table,$data,$condition='')
    {
    	$DataArray = array();
        if(!empty($condition))
        {
            $data['modified']=date("Y-m-d H:i:s");
        }
        else if(empty($condition))
        {
            $data['created']=date("Y-m-d H:i:s");
            $data['modified']=date("Y-m-d H:i:s");
        }
        $table_fields = $this->db->list_fields($table);
        foreach($data as $field=>$value)
        {
            if(in_array($field,$table_fields))
            {
                $DataArray[$field]= $value;
            }
        }
       
        if($condition != '')
    	{
    		$this->db->where($condition);
    		$this->db->update($table, $DataArray);
    	}else{
    		$this->db->insert($table, $DataArray);
    	}
    }

    public function DeleteData($table,$condition='',$limit='')
    {
       if($condition != '')
        $this->db->where($condition);
        if($limit != '')
        $this->db->limit($limit);
        $this->db->delete($table);
    } 
    //get single data
    function get_single($table, $cond='')
    {   
        if($cond != '')
        $this->db->where($cond);
        return $this->db->get($table)->row();
    }
    
    function get_single_record($tablename,$condition)
    {
        $this->db->where($condition);   
        return $this->db->get($tablename)->row();
    }
    
    ////////////////// slug url ///////////////////////////
     function get_unique_url($url, $id = false)
    {
        $this->db->select('slug_url, appliedjob_id ');
        $this->db->where('slug_url', $url);
        $rest = $this->db->get('applied_jobs');
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->appliedjob_id == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_unique_url($url, $id);
            }
        }
    }
/////////////////// end slug url ////////////////////////
   
}
?>