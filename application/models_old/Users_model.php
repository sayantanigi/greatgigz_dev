<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends My_Model {
var $column_order = array(null,'users.userType','users.username','users.email','users.mobile','users.created','users.status',null); //set column field database for datatable orderable

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
                    $cond.=" ( users.username LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  users.email LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  users.mobile LIKE '%".trim($show_string)."%') ";
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
    function getChat()
   {
        $this->db->select('chat.*,users.username,CONCAT(users.firstname," ",users.lastname) as full_name,users.profilePic,to_user.username as to_username,CONCAT(to_user.firstname," ",to_user.lastname) as to_fullname,to_user.profilePic as to_profile');
       $this->db->from('chat');
       $this->db->join('users','users.userId=chat.userfrom_id');
       $this->db->join('users to_user','to_user.userId=chat.userto_id');
       //$this->db->where();
        $query = $this->db->get();
       return $query->result();
   }
   function getmessage($con)
   {
        $this->db->select('chat.*,users.username,CONCAT(users.firstname," ",users.lastname) as full_name,users.profilePic,to_user.username as to_username,CONCAT(to_user.firstname," ",to_user.lastname) as to_fullname,to_user.profilePic as to_profile');
       $this->db->from('chat');
       $this->db->join('users','users.userId=chat.userfrom_id');
       $this->db->join('users to_user','to_user.userId=chat.userto_id');
       $this->db->where($con);
        $query = $this->db->get();
       return $query->row();
   }
   function get_jobbidding($cond)
   {
        $this->db->select('job_bid.*,job_bid.user_id as userid,users.username,CONCAT(users.firstname," ",users.lastname) as full_name,users.profilePic,postjob.user_id,postjob.id as post_id');
       $this->db->from('job_bid');
       $this->db->join('postjob','postjob.id=job_bid.postjob_id','left');
       $this->db->join('users','users.userId=job_bid.user_id','left');
       $this->db->where($cond);
        $query = $this->db->get();
       return $query->result();
   }

    function get_users()
   {
        $this->db->select('users.*,rt.worker_id,AVG(rt.rating) as rate,category.category_name,');
       $this->db->from('users');
       $this->db->join('category','category.id=users.serviceType','left');
       $this->db->join('employer_rating rt','rt.worker_id=users.userId','left');
      
       $this->db->where('users.userType','1');
       $this->db->group_by('rt.worker_id');
       $this->db->order_by('rate','DESC');
         $this->db->limit(3);
        $query = $this->db->get();
       return $query->result();
   }
    function users_detail($cond)
   {
        $this->db->select('users.*,category.category_name');
       $this->db->from('users');
       $this->db->join('category','category.id=users.serviceType','left');
      $this->db->where($cond);
        $query = $this->db->get();
       return $query->row();
   }

    function getcount()
{
   $this->db->select('users.*,category.category_name');
       $this->db->from('users');
       $this->db->join('category','category.id=users.serviceType','left');
  $this->db->where('users.userType','1');
  $this->db->order_by('users.userId','desc');
   $query = $this->db->get();
  return $query->result();
}
  function fetchdata($limit, $start)
{

 $this->db->select('users.*,category.category_name');
       $this->db->from('users');
       $this->db->join('category','category.id=users.serviceType','left');
  $this->db->where('users.userType','1');
   $this->db->limit($limit, $start);
   $this->db->order_by('users.userId','desc');
   $data = $this->db->get();

 $output = '';
 if(!empty($data))
 {
  foreach($data->result_array() as $row)
  {
    if(!empty($row['firstname'])){
      $name= $row['firstname'].' '.$row['lastname'];
    }
    else{
      $name=$row['username'];
    }
    if(strlen($row['short_bio'])>100){
    $desc= substr($row['short_bio'], 0,100).'...';}
    else {
      $desc= $row['short_bio'];
    }
   $output .= '
   <div class="emply-resume-list">

      <div class="emply-resume-info">
      <h3><a href="#" title="">'.$name.'</a></h3>
                                               <span>'.$row['category_name'].'</span>
                                              
                                               <p><i class="la la-map-marker"></i>'. $row['address'].'</p>
                                               <p>'.$desc.'</p>
                                           </div>

                                 <div class="shortlists" style="width:50px;">
                <a href="'.base_url('worker-detail/'.base64_encode($row['userId'])).'" title="">View Profile<i class="la la-plus"></i></a>
                                    </div>
                                </div>';
  }
 }
 else
 {
  $output .= ' <div class="emply-resume-list">
                   <div class="emply-resume-thumb">
                  <h2>No Data Found</h2>
                    </div>
                    </div>';
 }
 return $output;
}

   ////////////////////// ajax list employer///////////////////////
function get_employercount()
{
   $this->db->select('users.*,category.category_name');
       $this->db->from('users');
       $this->db->join('category','category.id=users.serviceType','left');
  $this->db->where('users.userType','2');
  $this->db->order_by('users.userId','desc');
   $query = $this->db->get();
  return $query->result();
}
  function employer_fetchdata($limit, $start)
{

 $this->db->select('users.*,category.category_name');
       $this->db->from('users');
       $this->db->join('category','category.id=users.serviceType','left');
  $this->db->where('users.userType','2');
   $this->db->limit($limit, $start);
   $this->db->order_by('users.userId','desc');
   $data = $this->db->get();

 $output = '';
 if(!empty($data))
 {
  foreach($data->result_array() as $row)
  {
       $get_post=$this->Crud_model->GetData('postjob','',"user_id='".$row['userId']."'");
    if(!empty($row['firstname'])){
      $name= $row['firstname'].' '.$row['lastname'];
    }
    else{
      $name=$row['username'];
    }
    if(strlen($row['short_bio'])>100){
    $desc= substr($row['short_bio'], 0,100).'...';}
    else {
      $desc= $row['short_bio'];
    }
     if(!empty($row['profilePic']) && file_exists('uploads/users/'.$row['profilePic'])){
    $profile_pic= '<img src="'.base_url('uploads/users/'.$row['profilePic']).'" alt="" />';
   }
   else{
     $profile_pic= '<img src="'.base_url('uploads/users/user.png').'" alt="" />';
   }
   $output .= '
   <div class="emply-resume-list">
     <div class="emply-resume-thumb">'.$profile_pic.'</div>
      <div class="emply-resume-info">
      <h3><a href="#" title="">'.$name.'</a></h3>
                                               <span>'.$row['category_name'].'</span>
                                              
                                               <p><i class="la la-map-marker"></i>'. $row['address'].'</p>
                                               <p>'.$desc.'</p>
                                                <p>Post Job '.count($get_post).'</p>
                                           </div>

                                 <div class="shortlists" style="width:50px;">
                <a href="'.base_url('employerdetail/'.base64_encode($row['userId'])).'" title="">View Profile<i class="la la-plus"></i></a>
                                    </div>
                                </div>';
  }
 }
 else
 {
  $output .= ' <div class="emply-resume-list">
                   <div class="emply-resume-thumb">
                  <h2>No Data Found</h2>
                    </div>
                    </div>';
 }
 return $output;
}
////////////////////// end ajax list employer///////////////////////





}
