<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends My_Model {
var $column_order = array(null,'users.userType','users.firstname','users.job_title','users.email','users.mobile',null); //set column field database for datatable orderable

    var $order = array('users.userId' => 'DESC');

    function __construct()
    {
        parent::__construct();
    }

	private function _get_datatables_query()
	{
		$this->db->select('users.*');
        $this->db->from('users');
      // $this->db->where($cond);
		$i = 0;

        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string)
                {
                    $cond  = " ";
                    $cond.=" (users.firstname LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  users.email LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  users.job_title LIKE '%".trim($show_string)."%') ";
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

    ////////////////// slug url ///////////////////
     function get_unique_url($url, $id = false)
    {
        $this->db->select('slug_url, userId');
        $this->db->where('slug_url', $url);
        $rest = $this->db->get('users');
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->userId == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_unique_url($url, $id);
            }
        }
    }
    ////////////////// end slug url ///////////////////


    function get_jobseeker_resume($cond) {
        $this->db->select('applied_jobs.*,postjob.job_type');
        $this->db->from('applied_jobs');
        $this->db->join('postjob','postjob.id=applied_jobs.job_id','left');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->row();
    }

    function get_users($cond) {
        $this->db->select('users.*,countries.name as country_name,states.name as state_name,category.category_name');
        $this->db->from('users');
        $this->db->join('countries','countries.id=users.country','left');
        $this->db->join('states','states.id=users.state','left');
        $this->db->join('category','category.id=users.category_id','left');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->row();
    }

   ////////////////////// candidate list by ajax ///////////////////////
  function make_query($title, $location,$category_id,$skill_id,$jobtype,$sort_by)
 {

  $query = "SELECT * FROM users WHERE userType = '1' AND status='1'";

  if(isset($title) && !empty($title))
  {

   $query .= " AND job_title like '%".$title."%'";

  }
  if(isset($location) && !empty($location))
  {

   $query .= "
    AND address1 like '%".$location."%' or zipcode='".$location."'";

  }

  if(isset($category_id) && !empty($category_id))
  {

         $query.=" and (";

         foreach ($category_id as $key => $value) {
           if($key==0){
           $query.="  category_id ='".$value."'";
         }
         else
         {
           $query.="or  category_id ='".$value."'";
         }

         }
         $query.=")";
  }

       if(isset($skill_id) && !empty($skill_id))
   {
    $skill_filter = implode(",", $skill_id);
    $query .= " AND skill_id IN(".$skill_filter.")";
   }

   if(isset($jobtype) && !empty($jobtype))
  {

         $query.=" and (";

         foreach ($jobtype as $key => $value) {
           if($value=='All')
           {
              $query.="  job_type ='Full Time' or job_type ='Part Time' or job_type ='Freelancer'";
           }
           else{
           if($key==0){
           $query.="  job_type ='".$value."'";
         }
         else
         {
           $query.="or  job_type ='".$value."'";
         }
       }
         }
         $query.=")";
  }
    
     if(isset($sort_by)&& !empty($sort_by))
          {

             if($sort_by=='')
            {
              $query.=" ORDER BY userId desc";
            }
            else if($sort_by=='latest_candidate')
            {
              $query.=" ORDER BY userId desc";
            }
            else if($sort_by=='oldest_candidate')
            {
              $query.=" ORDER BY userId ASC";
            }
            else{
              $query.="ORDER BY userId desc";
             }

          }
  
  return $query;


 }
    function getcount($title, $location,$category_id,$skill_id,$jobtype,$sort_by)
{
 $query = $this->make_query($title, $location,$category_id,$skill_id,$jobtype,$sort_by);
 $data = $this->db->query($query);
 return $data->num_rows();
}
   function fetchdata($limit, $start, $title, $location,$category_id,$skill_id,$jobtype,$sort_by)
 {

  $query = $this->make_query($title, $location,$category_id,$skill_id,$jobtype,$sort_by);

  $query .= ' LIMIT '.$start.', ' . $limit;

  $data = $this->db->query($query);
  //print_r($this->db->last_query()); exit;
  $output = '';
  if($data->num_rows() > 0)
  {

   foreach($data->result() as $row)
   {
    if(!empty($row->skill_id))
    {
     $skillid=$row->skill_id;
    }
    else
    {
     $skillid=0;
    }
     $skill_id=$this->Crud_model->GetData('skills','',"id IN (".$skillid.")");

    if(!empty($row->profilePic) && file_exists('uploads/users/'.$row->profilePic)){
     $profile= '<img src="'.base_url('uploads/users/'.$row->profilePic).'" class="img-responsive" alt="" style="max-width: 100%;height: 80px;"/>';
    }
    else{
      $profile= '<img src="'.base_url('uploads/no_profile.jpg').'" class="img-responsive" alt="" style="max-width: 100%;height: 80px;"/>';
    }

     if(strlen($row->short_bio)>170)
     {
       $desc=substr($row->short_bio, 0,170).'...';
     }
     else{
       $desc=$row->short_bio;
     }
     $data_array='';
     if(!empty($skill_id)){

      foreach($skill_id as $value)
      {
       $data_array.=$value->skill.', ';
      }
     }

     else{
       $data_array.='';
     }

    $output .= ' <div class="sorting_content">
                  <div class="tab-image">'.$profile.'</div>
                 <div class="overflow">
                    <div class="text-shorting">
                      <h1>'.ucwords($row->firstname.' '.$row->lastname).'</h1>
                      <ul class="unstyled">
                        <li>'.ucwords($row->job_title).'</li>
                        <li><span><strong>Rate : </strong> <i class="fa fa-money"></i> $'.$row->salary.' / Month</span></li>
                      </ul>
                      <p></p>
                    </div>
                 <div class="bottom_text">
                   <div class="contact_details col-md-4 col-sm-4 p-l">
                     <span><strong>Location:</strong> '.$row->address1.'</span>
                   </div>
                   <div class="contact_details col-md-8 col-sm-8 p-l">
                     <span><strong>Skills:</strong> '.ucwords($data_array).'</span>
                   </div>
                   <p></p>
                   <p class="col-md-12 p-l">'.ucfirst($desc).'</p>
                 </div>
                 </div>
               </div>';
    
   }
  }
  else
  {
   $output .= '<div class="sorting_content">
                 <div class="overflow">
                           <h2><center>Sorry,No Data Found</center></h2>
                            </div>
                           </div>';
  }
  return $output;
 }
 ////////////////////// end candidate list by ajax///////////////////////

}
