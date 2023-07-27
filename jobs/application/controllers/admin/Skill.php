<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Skill_model');
	}
	function index()
	{

		$header = array('title' => 'skill');
		$data = array(
            'heading' => 'List of skills',
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/manage_master/skill_list',$data);
        $this->load->view('admin/common/footer');
	}

	function ajax_manage_page()
	{

		 $GetData = $this->Skill_model->get_datatables();
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

            $btn = ''.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal"
              onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';

            
	            $no++;
	            $nestedData = array();
	          $nestedData[] = $no;
	            $nestedData[] = ucwords($row->skill);
	            $nestedData[] = $btn;
	            $data[] = $nestedData;
        }

    	$output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Skill_model->count_all(),
                "recordsFiltered" => $this->Skill_model->count_filtered(),
                "data" => $data,
        );

    	echo json_encode($output);
	}

	public function create_action()
	{
		$get_data=$this->Crud_model->get_single('skills',"skill='".$_POST['skill']."'");
		
        if(empty($get_data))
        {
		$data=array(
			'skill'=>$_POST['skill'],
      'created_date'=>date('Y-m-d H:i:s'),
		);

		$this->db->insert('skills',$data);
    $this->session->set_flashdata('message', 'skill created successfully');
    echo "1"; exit;
	}

      else{
        echo "0"; exit;
      }

	}

   public function get_value()
    {
      $get_data=$this->Crud_model->get_single('skills',"id='".$_POST['id']."'");
     
      $data=array(
        'id'=>$get_data->id,
        'skill'=>$get_data->skill,
       
      );

      echo json_encode($data);exit;
  }

    function update_action()
    {
      
    $get_data=$this->Crud_model->get_single_record('skills',"skill='".$_POST['skill']."' and id!='".$_POST['id']."'");
      if(empty($get_data))
      {
       $data = array(
              'skill'=> $_POST['skill'],
              
             );
       $this->Crud_model->SaveData('skills',$data,"id='".$_POST['id']."'");
        $this->session->set_flashdata('message', 'skill Updated successfully');

       echo 1; exit;
     }
     else{
      echo 0; exit;
     }

    }

    ///////////////////// import excel sheet////////////////////

public function import_excel()
  {

      $file = $_FILES['excel_file']['tmp_name'];
        $this->load->library('Excel');
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true);

        $arrayCount = count($allDataInSheet);
        $i = 1;
        $fields_fun=array();
        foreach ($allDataInSheet as $key)
        {

           if($i>0)
           {
              $fields_fun[] = $key;
           }


            $i++;
        }

        $removed = array_shift($fields_fun);

        if(!isset($fields_fun))
        {
            $this->session->set_flashdata('message', 'Excel sheet is blank');
            redirect(admin_url('skill'));
        }
        $data = $fields_fun;

            if(!empty($data)){
            foreach ($data as $val)
            {
                if($val[0] !='skill')
                {
                if($val[0]!='')
                {
                     
                             if(!empty($val[0]))
                             {
                              $skill=$val[0];
                             }
                             else
                             {
                               $skill="";
                             }
                           $data = array(
                                          'skill' => $skill,
                                          'created_date'=> date('Y-m-d H:i:s'),
                                          );

                            $this->Crud_model->SaveData('skills',$data);
                }
                }
            }

        $this->session->set_flashdata('message', 'Import file upload successfully');
      }
      else{
         $this->session->set_flashdata('message', 'Error');
      }
          redirect(admin_url('skill'));
  }

        /////////////////  end import excel sheet////////////////////

}
