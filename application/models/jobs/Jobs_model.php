<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jobs_model extends My_Model {
var $column_order = array(null,null,'postjob.job_title','postjob.status',null); //set column field database for datatable orderable

    var $order = array('postjob.id' => 'DESC');

    function __construct()
    {
        parent::__construct();
    }

  private function _get_datatables_query()
  {
    $this->db->select('postjob.*,category.category_name,CONCAT(users.firstname,"",users.lastname) as fullname,sub_category.sub_category_name' );
        $this->db->from('postjob');
        $this->db->join('category','category.id=postjob.category_id');
        $this->db->join('users','users.userId=postjob.user_id');
        $this->db->join('sub_category','sub_category.id=category.id');
      // $this->db->where($cond);
    $i = 0;

        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string)
                {
                    $cond  = " ";
                    $cond.=" (  postjob.job_title LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  postjob.status LIKE '%".trim($show_string)."%') ";
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
       // $this->db->where();
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
    function viewdata($con)
    {
        $this->db->select('postjob.*,category.category_name,CONCAT(users.firstname," ",users.lastname) as fullname,users.username,users.address as user_address,sub_category.sub_category_name' );
        $this->db->from('postjob');
        $this->db->join('category','category.id=postjob.category_id');
        $this->db->join('users','users.userId=postjob.user_id');
        $this->db->join('sub_category','sub_category.id=category.id');
        $this->db->where($con);
         $query = $this->db->get();
        return $query->row();
    }


////////////////// slug url ///////////////////////////
     function get_unique_url($url, $id = false)
    {
        $this->db->select('post_slug_url, id');
        $this->db->where('post_slug_url', $url);
        $rest = $this->db->get('postjob');
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->id == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_unique_url($url, $id);
            }
        }
    }
/////////////////// end slug url ////////////////////////

    function postjobdata($con)
    {
        $this->db->select('postjob.*,category.category_name,users.profilePic,sub_category.sub_category_name' );
        $this->db->from('postjob');
        $this->db->join('category','category.id=postjob.category_id','left');
        $this->db->join('users','users.userId=postjob.user_id','left');
        $this->db->join('sub_category','sub_category.id=postjob.subcategory_id','left');
        $this->db->where($con);
        $this->db->order_by('postjob.id','desc');
         $query = $this->db->get();
        return $query->result();
    }


    function get_appliedjob($cond)
    {
        $this->db->select('applied_jobs.*,postjob.job_title,postjob.job_type,category.category_name');
        $this->db->from('applied_jobs');
        $this->db->join('postjob','postjob.id=applied_jobs.job_id','left');
        $this->db->join('category','category.id=postjob.category_id','left');
        $this->db->where($cond);
        $this->db->order_by('applied_jobs.appliedjob_id','desc');
         $query = $this->db->get();
        return $query->result();
    }



  /////////////// pagination joblist start///////////////////

  function make_query($title, $location,$category_id,$search_title,$search_location,$jobtype,$price)
{

 $query = "SELECT * FROM postjob WHERE is_delete = '0'";

 if(isset($title) && !empty($title))
 {

  $query .= " AND job_title like '%".$title."%'";

 }
 if(isset($location) && !empty($location))
 {

  $query .= "
   AND location like '%".$location."%'";

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
  if(isset($price) && !empty($price))
 {
        $query.=" and (";

        foreach ($price as $key => $value) {
        $amount=explode('-', $value);
      $min=$amount[0];
      $max=$amount[1];
          if($key==0){
          $query.="  minimum_rate>='".$min."' AND maximum_rate<='".$max."' ";
        }
        else
        {
          $query.="or  minimum_rate>='".$min."' AND maximum_rate<='".$max."' ";
        }

        }
        $query.=")";
 }

         if(isset($search_title)&& !empty($search_title))
  {
     $query .= " AND job_title like '%".$search_title."%'";
  }
  if(isset($search_location) && !empty($search_location))
 {

  $query .= "
   OR location like '%".$search_location."%'";

 }

 return $query;


}
  function getcount($title, $location,$category_id,$search_title,$search_location,$jobtype,$price)
{
 $query = $this->make_query($title, $location,$category_id,$search_title,$search_location,$jobtype,$price);
 $data = $this->db->query($query);
 return $data->num_rows();
}
  function fetchdata($limit, $start, $title, $location,$category_id,$search_title,$search_location,$jobtype,$price,$category_url,$company_url,$location_url)
{
   if(!empty($category_id) || !empty($title) || !empty($location)|| !empty($search_title) || !empty($search_location) || !empty($jobtypear) || !empty($price))
    {
 $query = $this->make_query($title, $location,$category_id,$search_title,$search_location,$jobtype,$price);

 $query .= ' LIMIT '.$start.', ' . $limit;

 $data = $this->db->query($query);
  }
  elseif(!empty($category_url)){
     $query = "SELECT * FROM postjob WHERE is_delete = '0' AND category_id='".$category_url."'";

   $query .= ' LIMIT '.$start.', ' . $limit;

   $data = $this->db->query($query);

 }
 elseif(!empty($company_url)){
     $query = "SELECT * FROM postjob WHERE is_delete = '0' AND company_name='".$company_url."'";

   $query .= ' LIMIT '.$start.', ' . $limit;

   $data = $this->db->query($query);

 }
    elseif(!empty($location_url)){
     $query = "SELECT * FROM postjob WHERE is_delete = '0' AND location='".$location_url."'";

   $query .= ' LIMIT '.$start.', ' . $limit;

   $data = $this->db->query($query);

 }

 else{
   $query = $this->make_query($title, $location,$category_id,$search_title,$search_location,$jobtype,$price);

 $query .= ' LIMIT '.$start.', ' . $limit;

 $data = $this->db->query($query);
 }
 $output = '';
 if($data->num_rows() > 0)
 {
  foreach($data->result() as $row)
  {
   //$row=$this->Crud_model->get_single('users',"userId='".$row['user_id']."'");
   $get_category=$this->Crud_model->get_single('category',"id='".$row->category_id."'");

   if(!empty($row->company_logo) && file_exists('uploads/company_logo/'.$row->company_logo)){
    $companylogo= '<img src="'.base_url('uploads/company_logo/'.$row->company_logo).'" class="img-responsive" alt="" style="max-width: 100%;height: 80px;"/>';
   }
   else{
     $companylogo= '<img src="'.base_url('uploads/no_image.png').'" class="img-responsive" alt="" style="max-width: 100%;height: 80px;"/>';
   }
   if($row->job_type=='Full Time')
   {
    $jobtype='<div class="work-time text-center col-md-2">'.ucfirst($row->job_type).'</div>';
   }
   if($row->job_type=='Part Time')
   {
    $jobtype='<div class="work-time part text-center col-md-2">'.ucfirst($row->job_type).'</div>';
   }
   if($row->job_type=='Freelancer')
   {
    $jobtype='<div class="work-time Free text-center col-md-2">'.ucfirst($row->job_type).'</div>';
   }
   if(strlen($row->description)>170)
   {
     $desc=substr($row->description, 0,170).'...';
   }
   else{
     $desc=$row->description;
   }
   $output .= ' <div class="sorting_content">
                 <div class="tab-image">'.$companylogo.'</div>
                 <div class="overflow">
                   <div class="text-shorting">
                      <h1 class="col-md-10 col-sm-10"><a href="'.base_url('job-detail/'.$row->post_slug_url).'">'.ucfirst($row->job_title).'</a><br/><span>'.ucfirst($get_category->category_name).'</span></h1>
                    '.$jobtype.'
                   </div>
                <div class="bottom_text">
                  <div class="contact_details col-md-8 col-sm-8">
                    <span><strong>Location: <i class="fa fa-globe"></i></strong> '.$row->location.'</span>
                  </div>
                  <div class="contact_details col-md-4 col-sm-4">
                   <span><strong class="btn btn-warning" onclick="return favorite_job('.$row->id.');">Favorite Job</strong></span>
                  </div>
                  <p class="col-md-12">'.ucfirst($desc).'</p>
                </div>
                </div>
              </div> ';
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

  ///////////// end pagination joblist///////////////////////


/////////////// pagination applicantlist start///////////////////

  function applicantmake_query($job_title, $start_date,$end_date)
{

if(isset($job_title) && !empty($job_title) || isset($start_date) && !empty($start_date) || isset($end_date) && !empty($end_date)){
 $query = "SELECT * FROM applied_jobs WHERE status = 1";

 if(isset($job_title) && !empty($job_title))
 {

  $query .= " AND job_id ='".$job_title."'";

 }
 if(isset($start_date) && !empty($start_date))
 {
  $statrtdate=date('Y-m-d',strtotime($start_date));
  $query .= " AND LEFT(created_date,10) >='".$statrtdate."'";

 }
 if(isset($end_date) && !empty($end_date))
 {
  $enddate=date('Y-m-d',strtotime($end_date));
  $query .= " AND LEFT(created_date,10)<='".$enddate."'";

 }
 if(!empty($start_date) && !empty($end_date))
 {
  $statrtdate=date('Y-m-d',strtotime($start_date));
  $enddate=date('Y-m-d',strtotime($end_date));
  $query .= " AND LEFT(created_date,10)>='".$statrtdate."' AND LEFT(created_date,10)<='".$enddate."'";

 }

 return $query;
 }

}
  function applicantlist_count($job_title, $start_date,$end_date)
{
 $query = $this->applicantmake_query($job_title, $start_date,$end_date);
 $data = $this->db->query($query);
 return $data->num_rows();
}
  function applicantlist_fetchdata($limit, $start, $job_title, $start_date,$end_date)
{
  if(isset($job_title) && !empty($job_title) || isset($start_date) && !empty($start_date) || isset($end_date) && !empty($end_date)){
 $query = $this->applicantmake_query($job_title, $start_date,$end_date);

 $query .= ' LIMIT '.$start.', ' . $limit;

 $data = $this->db->query($query);
 //print_r($this->db->last_query()); exit;
 }
 else{
   $query = "SELECT * FROM applied_jobs WHERE status = 0";

    $query .= ' LIMIT '.$start.', ' . $limit;

    $data = $this->db->query($query);
 }
 $output = '';
 if($data->num_rows() > 0)
 {
  foreach($data->result() as $row)
  {
   $get_user=$this->Crud_model->get_single('users',"userId='".$row->user_id."'");
   $get_job=$this->Crud_model->get_single('postjob',"id='".$row->job_id."'");

   if(!empty($get_user->profilePic) && file_exists('uploads/users/'.$get_user->profilePic)){
    $profile= '<img src="'.base_url('uploads/users/'.$get_user->profilePic).'" class="img-responsive" alt="" width="70" height="70"/>';
   }
   else{
     $profile= '<img src="'.base_url('uploads/no_profile.jpg').'" class="img-responsive" alt="" width="70" height="70"/>';
   }
    
    if($row->job_status=='pending')
   {
    $jobstatus='<td style="vertical-align: text-top;"><span class="btn btn-danger" onclick="return change_status('.$row->appliedjob_id.')">Pending</span></td>';
   }
   else if($row->job_status=='shortlist'){
    $jobstatus='<td style="vertical-align: text-top;"><span class="btn btn-warning">Short List</span></td>';
   }
   $output .= ' <tr>
                    <td><div class="col-md-4 col-sm-4 p-l p-r">'.$profile.'</div>
                      <div class="overflow col-md-8 col-sm-8 p-l">
                        <div class="text-shorting">
                          <h1>'.ucfirst($get_user->firstname.' '.$get_user->lastname).'</h1>
                          <p>'.ucfirst($get_user->job_title).'</p>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="bottom-text"><a href="javascript:void(0)"><i class="fa fa-eye"></i> Click to View Message</a></div>
                    </td>
                    <td style="vertical-align: text-top;"><h1>'.ucfirst($get_job->job_title).'</h1></td>
                    <td style="vertical-align: text-top;"><a href="'.base_url('uploads/jobseeker_resume/'.$row->resume).'" download><i class="fa fa-file-pdf-o"></i> '.$row->resume.'</a></td>
                     '.$jobstatus.'
                    <td style="vertical-align: text-top;"><a href="'.base_url('jobseeker-resume/'.$row->slug_url).'" class="btn btn-success btn-sm text-white"><i class="fa fa-eye"></i></a>
               <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white" onclick="return delete_item('.$row->appliedjob_id.')">
               <i class="fa fa-trash"></i></a></td>
                  </tr>  ';
  }
 }
 else
 {
  $output .= '<tr><td colspan="4"><center>Sorry, No candidate found for this post</center></td></tr>';
 }
 return $output;
}

  /////////////// end pagination applicantlist//////////////////////




}
