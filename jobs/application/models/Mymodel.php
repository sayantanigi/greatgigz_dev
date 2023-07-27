<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends MY_Model {

	public function insert($table, $data)
	{

		if($this->db->insert($table, $data)) {

			return true;

		} else {

			return false;

		}
	}

	    function get_favoritejob($cond)
    {
        $this->db->select('fav.*,postjob.job_title,postjob.job_type ,category.category_name');
        $this->db->from('favorite_jobs as fav');
        $this->db->join('postjob','postjob.id=fav.postjob_id','left');
        $this->db->join('category','category.id=postjob.category_id','left');
        $this->db->where($cond);
        $this->db->order_by('fav.id','desc');
         $query = $this->db->get();
        return $query->result();
    }

		function get_subscriptionData($cond)
	 {
			 $this->db->select('employer.*,subscription.subscription_name,subscription.subscription_amount ,subscription.subscription_duration');
			 $this->db->from('employer_subscription as employer');
			 $this->db->join('subscription','subscription.id=employer.subscription_id','left');
			 $this->db->where($cond);
				$query = $this->db->get();
			 return $query->result();
	 }
	 
	  function get_shortlist_jobs($con)
    {

        $this->db->select('applied.*,post.job_title,post.job_type,category.category_name');
        $this->db->from('applied_jobs as applied');
        $this->db->join('postjob as post','post.id=applied.job_id','left');
        $this->db->join('category','category.id=post.category_id','left');
        $this->db->where($con);
         $query = $this->db->get();
        return $query->result();
    }
    
    function get_location()
   {
        $this->db->select('postjob.*,AVG(postjob.location) as local');
       $this->db->from('postjob');
       $this->db->group_by('postjob.location');
       $this->db->order_by('postjob.location','asc');
        // $this->db->limit(3);
        $query = $this->db->get();
       return $query->result();
   }
   
   function oneweekexpiry_subscription()
   {
        $this->db->select('emp.*,u.email,CONCAT(u.firstname," ",u.lastname) as fullname');
       $this->db->from('employer_subscription as emp');
       $this->db->join('users as u',"u.userId=emp.employer_id",'left');
       $this->db->where('emp.end_date >= NOW() - INTERVAL 7 DAY');
       $this->db->group_by('emp.employer_id');
       $this->db->order_by('emp.id','DESC');
        $query = $this->db->get();
       return $query->result();
   }
   function onedayexpiry_subscription()
   {
        $this->db->select('emp.*,u.email,CONCAT(u.firstname," ",u.lastname) as fullname');
       $this->db->from('employer_subscription as emp');
       $this->db->join('users as u',"u.userId=emp.employer_id",'left');
       $this->db->where('emp.end_date >= NOW() - INTERVAL 1 DAY');
       $this->db->group_by('emp.employer_id');
       $this->db->order_by('emp.id','DESC');
        $query = $this->db->get();
       return $query->result();
   }
   
   function list_notification($cond)
   {
        $this->db->select('notification.*,job.job_title,job.company_logo');
       $this->db->from('notification');
       $this->db->join('postjob as job',"job.id=notification.job_id",'left');
        $this->db->where($cond);
        $query = $this->db->get();
       return $query->result();
   }
 


}//end model
