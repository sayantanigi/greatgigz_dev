<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Categorymodel');
	}
	function index()
	{

		$header = array('title' => 'category');
		$data = array(
            'heading' => 'List of categories',
        );
        $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/category/list',$data);
        $this->load->view('admin/common/footer');
	}

	function ajax_manage_page()
	{

		 $GetData = $this->Categorymodel->get_datatables();
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

             if(!empty($row->category_image))
            {

              if(!file_exists("uploads/category/".$row->category_image))
              {
                  $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'" style="width:70px">';
              }
              else
              {

                 $img ='<a href="'.base_url('uploads/category/'.$row->category_image).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/category/'.$row->category_image).'" style="width:70px"><a>';
              }
          }

          else
          {
              $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'" style="width:70px">';
          }
	            $no++;
	            $nestedData = array();
	          $nestedData[] = $no;
	            $nestedData[] = $img.' '.ucwords($row->category_name);
	  			 $nestedData[] = date('d-M-Y',strtotime($row->update_date));
	            $nestedData[] = $btn;
	            $data[] = $nestedData;
        }

    	$output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Categorymodel->count_all(),
                "recordsFiltered" => $this->Categorymodel->count_filtered(),
                "data" => $data,
        );

    	echo json_encode($output);
	}

	public function create_action()
	{
		$get_data=$this->Crud_model->get_single('category',"category_name='".$_POST['category_name']."'");
		if(isset($_FILES['category_image']['name'])!='' )
        {
                  $_POST['category_image']= rand(0000,9999)."_".$_FILES['category_image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['category_image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/category/'.$_POST['category_image'];
                  $config2['upload_path'] =  getcwd().'/uploads/category/';
                  $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
                  $config2['maintain_ratio'] = FALSE;

                  $this->image_lib->initialize($config2);

                  if(!$this->image_lib->resize())
                  {
                      echo('<pre>');
                      echo ($this->image_lib->display_errors());
                      exit;
                  }
                  else{
                    $image  = $_POST['category_image'];
                  }
        }

          else{
               $image  = "";
        }
        $category_name = $this->input->post('category_name',TRUE);
              if (empty($category_name) || $category_name == '') {
                  $category_name =$this->input->post('category_name');
              }
              $slug = strtolower(url_title($category_name));
              $slug_url =$this->Categorymodel->get_unique_url($slug);
        if(empty($get_data))
        {
		$data=array(
			'category_name'=>$_POST['category_name'],
			'category_image'=>$image,
      'slug_url'=>$slug_url,
      'created_date'=>date('Y-m-d H:i:s'),
		);

		$this->db->insert('category',$data);
    $this->session->set_flashdata('message', 'Category created successfully');
    echo "1"; exit;
	}

      else{
        echo "0"; exit;
      }

	}

   public function get_value()
    {
      $category_data=$this->Crud_model->get_single('category',"id='".$_POST['id']."'");
      if(!empty($category_data->category_image))
        {

            if(!file_exists("uploads/category/".$category_data->category_image))
            {
                $img ='<img class="rounded service-img mr-1" src="'.base_url('category/no_image.png').'" width="100px" height="100px">';
            }
            else
            {

               $img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/category/'.$category_data->category_image).'" width="100px" height="100px">';
            }
        }

        else
        {
            $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'" width="100px" height="100px">';
        }
      $data=array(
        'id'=>$category_data->id,
        'category_name'=>$category_data->category_name,
        'image'=>$img,
        'old_image'=>$category_data->category_image,
      );

      echo json_encode($data);exit;
  }

    function update_action()
    {
      if(isset($_FILES['category_image']['name'])!='' )
        {
                  $_POST['category_image']= rand(0000,9999)."_".$_FILES['category_image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['category_image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/category/'.$_POST['category_image'];
                  $config2['upload_path'] =  getcwd().'/uploads/category/';
                  $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
                  $config2['maintain_ratio'] = FALSE;

                  $this->image_lib->initialize($config2);

                  if(!$this->image_lib->resize())
                  {
                      echo('<pre>');
                      echo ($this->image_lib->display_errors());
                      exit;
                  }
                  else{
                    $image  = $_POST['category_image'];
                     @unlink('uploads/category/'.$_POST['old_image']);
                  }
        }

          else{
               $image  = $_POST['old_image'];;
        }
    $category_name = $this->input->post('category_name',TRUE);
              if (empty($category_name) || $category_name == '') {
                  $category_name =$this->input->post('category_name');
              }
              $slug = strtolower(url_title($category_name));
              $slug_url =$this->Categorymodel->get_unique_url($slug);
    $get_data=$this->Crud_model->get_single_record('category',"category_name='".$_POST['category_name']."' and id!='".$_POST['id']."'");
      if(empty($get_data))
      {
       $data = array(
              'category_name'=>$_POST['category_name'],
              'category_image'=>$image,
              'slug_url'=>$slug_url,
              'update_date'=>date('Y-m-d H:i:s'),

             );
       $this->Crud_model->SaveData('category',$data,"id='".$_POST['id']."'");
        $this->session->set_flashdata('message', 'Category Updated successfully');

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
            redirect(admin_url('category'));
        }
        $data = $fields_fun;

            if(!empty($data)){
            foreach ($data as $val)
            {
                if($val[0] !='Category Name')
                {
                if($val[0]!='')
                {
                     
                             if(!empty($val[0]))
                             {
                              $category_name=$val[0];
                             }
                             else
                             {
                               $category_name="";
                             }
                $category=$category_name;
             if (empty($category_name) || $category_name == '') {
                  $category =$category_name;
              }
              $slug = strtolower(url_title($category));
              $slug_url =$this->Categorymodel->get_unique_url($slug);
                           $data = array(
                                          'category_name' => $category_name,
                                          'slug_url' => $slug_url,
                                          'created_date'=> date('Y-m-d H:i:s'),
                                          );

                            $this->Crud_model->SaveData('category',$data);
                }
                }
            }

        $this->session->set_flashdata('message', 'Import file upload successfully');
      }
      else{
         $this->session->set_flashdata('message', 'Error');
      }
          redirect(admin_url('category'));
  }

        /////////////////  end import excel sheet////////////////////

}
