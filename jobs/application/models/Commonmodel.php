<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commonmodel extends CI_Model 
{
	function __construct() 
	{ 
		parent::__construct(); 

	}
	
	/*--------- list of jobseeker in ajax page---*/
	function jobseekermake_query()
{

 $query = "SELECT * FROM users WHERE userType = '1' and status='1'";

 return $query;

}
  function jobseekerlist_count()
{
 $query = $this->jobseekermake_query();
 $data = $this->db->query($query);
 return $data->num_rows();
}
  function jobseekerlist_fetchdata($limit, $start)
{
  
 $query = $this->jobseekermake_query();

 $query .= ' LIMIT '.$start.', ' . $limit;

 $data = $this->db->query($query);
 
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
  
   $output .= ' <tr>
                       
                    <td style="vertical-align: text-top;"><h1>'.ucwords($row->firstname.' '.$row->lastname).'</h1></td>
                    <td style="vertical-align: text-top;"><h1>'.ucwords($row->job_title).'</h1></td>
                    <td style="vertical-align: text-top;">'.$row->address1.'</td>
                    
                    <td style="vertical-align: text-top;">'.ucwords($data_array).'</td>
                  </tr>  ';
  }
 }
 else
 {
  $output .= '<tr><td colspan="4"><center>Sorry, No candidate found</center></td></tr>';
 }
 return $output;
}
	/*--------- end list of jobseeker in ajax page---*/


	
}