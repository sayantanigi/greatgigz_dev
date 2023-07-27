<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Subscription_model');
	}
	function index()
	{

			$header = array('title' => 'subscription');
		$data = array(
            'heading' => 'List of subscriptions',
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/subscription/list',$data);
        $this->load->view('admin/common/footer');
	}

    public function ajax_manage_page()

{
        $GetData = $this->Subscription_model->get_datatables();
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

             $btn = anchor(admin_url('subscription/update/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-edit mr-1"></i></span>');
              if($row->subscription_name!='free'){
              $btn.='|'.'<span data-placement="right" class="btn btn-sm text-danger mr-2"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash mr-1"></i></span>';
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($row->subscription_name);
			$nestedData[] = $row->subscription_duration.' '.'Month';
             $nestedData[] = $row->no_of_post;
            $nestedData[] = $row->subscription_amount;

            $nestedData[] = $btn;
            $data[] = $nestedData;
        }

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Subscription_model->count_all(),
                    "recordsFiltered" => $this->Subscription_model->count_filtered(),
                    "data" => $data,
                );

        echo json_encode($output);
    }
	 public function create()
  {
    $header = array('title'=> 'Add');
      $data = array(
                  'heading'=>'Add subscription',
                  'button'=>'Create',
                    //'action'=>admin_url('Event/create_action'),
                    'subscription_name' =>set_value('subscription_name'),
                    'subscription_amount' =>set_value('subscription_amount'),
                    'subscription_duration' =>set_value('subscription_duration'),
                    'no_of_post' =>set_value('no_of_post'),
                    'subscription_id' =>set_value('subscription_id'),
                    'service' =>set_value('service'),
                    'id' =>set_value('id'),

          );
     $this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/subscription/form',$data);
        $this->load->view('admin/common/footer');
  }
		public function create_action()
	{

		 $data = array(

              'subscription_name'=> $_POST['subscription_name'],
              'subscription_amount'=> $_POST['subscription_amount'],
              'subscription_duration'=> $_POST['subscription_duration'],
              'no_of_post'=> $_POST['no_of_post'],
              'created_date'=> date('Y-m-d H:i:s'),
             );
        $this->Crud_model->SaveData('subscription',$data);
        $last_id=$this->db->insert_id();
       $count = count($this->input->post('service'));
         for ($i=0; $i < $count; $i++)
        {

                $log = array(
                   'service'=>$_POST['service'][$i],
                    'subscription_id'=>$last_id,
                     'created_date'=>date('Y-m-d H:m:s'),
                );
              $this->Crud_model->SaveData('subscription_service',$log);
              }
        $this->session->set_flashdata('message', 'subscription created successfully');
        redirect(admin_url('subscription'));

	}

      public function update($id)
      {
        $sub_id=base64_decode($id);
        $update_sub=$this->Crud_model->get_single('subscription',"id='".$sub_id."'");
    $sub_offer=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$update_sub->id."'");

      $header=array('title'=>'update');


      $data=array(
      	  'heading'=>'update subscription',
                  'button'=>'Update',
       // 'action'=>site_url('Subscription/update_action'),
        'subscription_name'=>set_value('subscription_name',$update_sub->subscription_name),
        'subscription_amount'=>set_value('subscription_amount',$update_sub->subscription_amount),
        'subscription_duration'=>set_value('subscription_duration',$update_sub->subscription_duration),
        'no_of_post'=>set_value('no_of_post',$update_sub->no_of_post),

        'id'=>$sub_id,

        'sub_offer'=>$sub_offer,
      );
      	$this->load->view('admin/common/header',$header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/subscription/form',$data);
        $this->load->view('admin/common/footer');

      }


	public function update_action()
	{

		 $data = array(

              'subscription_name'=> $_POST['subscription_name'],
              'subscription_amount'=> $_POST['subscription_amount'],
              'subscription_duration'=> $_POST['subscription_duration'],
              'no_of_post'=> $_POST['no_of_post'],
              'created_date'=> date('Y-m-d H:i:s'),
             );
        $this->Crud_model->SaveData('subscription',$data,"id='".$_POST['id']."'");

        $last_id=$_POST['id'];
        $this->Crud_model->DeleteData('subscription_service',"subscription_id='".$_POST['id']."'");
       $count = count($this->input->post('service'));
         for ($i=0; $i < $count; $i++)
        {

                $log = array(
                   'service'=>$_POST['service'][$i],

                    'subscription_id'=>$last_id,
                     'created_date'=>date('Y-m-d H:m:s'),


                );
             $this->Crud_model->SaveData('subscription_service',$log);

              }

        $this->session->set_flashdata('message', 'subscription updated successfully');
        redirect(admin_url('subscription'));

	}

   public function delete()
    {
        if(isset($_POST['cid']))
        {

           $this->Crud_model->DeleteData('subscription',"id='".$_POST['cid']."'");
           $this->Crud_model->DeleteData('subscription_service',"subscription_id='".$_POST['cid']."'");
            $this->Crud_model->DeleteData('employer_subscription',"subscription_id='".$_POST['cid']."'");
        }
    }




}
