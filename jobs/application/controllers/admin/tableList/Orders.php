<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tableList/Order_model');
    }

    function index()
  	{

  		$header = array('title' => 'payment');
  		$data = array(
              'heading' => 'List of Payments',
          );
          $this->load->view('admin/common/header', $header);
          $this->load->view('admin/common/sidebar');
          $this->load->view('admin/tableList/order_list',$data);
          $this->load->view('admin/common/footer');
  	}

  function ajax_manage_page()
  	{
     
  		 $GetData = $this->Order_model->get_datatables();
          if(empty($_POST['start']))
     		{

      		$no=0;
         	}
          else{
              $no =$_POST['start'];
          }
          $data = array();
          foreach ($GetData as $row)
          {

              $btn = ''.anchor(admin_url('orders/view/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>View</span>');
              // $btn.= '| '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->userId.')"><i class="fa fa-trash mr-1"></i></span>';
            if($row->payment_status=='pending')
            {
              $status='<span class="badge badge-danger">Pending</span>';
            }
            elseif($row->payment_status=='succeeded'){
              $status='<span class="badge badge-success">Completed</span>';
            }
  	            $no++;
  	            $nestedData = array();
  	          $nestedData[] = $no;
                $nestedData[] = ucwords($row->firstname.' '.$row->lastname);
                 $nestedData[] = ucwords($row->subscription_name);
                $nestedData[] = $row->no_of_post;
                $nestedData[] = $row->amount;
                $nestedData[] = $status;
  	            $nestedData[] = $btn;
  	            $data[] = $nestedData;
          }

      	$output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->Order_model->count_all(),
                  "recordsFiltered" => $this->Order_model->count_filtered(),
                  "data" => $data,
          );

      	echo json_encode($output);
  	}

   

  	function view($id)
  	 {
  			 
  			 $cond="emp.id ='".base64_decode($id)."'";
  	 $get_data=$this->Order_model->get_orderview($cond);
     $list_of_service=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$get_data->subscription_id."'");

  			 $header = array('title' => 'order view');
  			 $data = array(
  					 'heading' => 'Subscription Plan Detail',
  					 'get_data' => $get_data,
             'list_of_service' => $list_of_service,
  			 );
  			 $this->load->view('admin/common/header', $header);
  			 $this->load->view('admin/common/sidebar');
  			 $this->load->view('admin/tableList/order_view',$data);
  			 $this->load->view('admin/common/footer');
  	 }

    

   

}//end controller


