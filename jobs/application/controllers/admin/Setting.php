<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {

  public function __construct()
  {
    parent::__construct();

  }
  function index()
  {
   $row = $this->Crud_model->get_single('settingss');

    $header = array('title' => 'Settings');

    $data = array(
            'heading' => 'General Settings',

      'website_name' =>$row->website_name,
      'phone' =>$row->phone,
      'email' =>$row->email,
      'logo' =>$row->logo,
      'address' =>$row->address,
      'favicon' =>$row->favicon,
      'facebook' =>$row->facebook,
      'twitter' =>$row->twitter,
      'linkedin' =>$row->linkedin,
      'instagram' =>$row->instagram,
      'youtube' =>$row->youtube,
      'id' =>$row->id,
        );
   $this->load->view('admin/common/header', $header);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/setting',$data);
        $this->load->view('admin/common/footer');

  }

  public function update_action()
{
        if($_FILES['logo']['name']!='')
        {
            $_POST['logo']= rand(0000,9999)."_".$_FILES['logo']['name'];
            $config2['image_library'] = 'gd2';
            $config2['source_image'] =  $_FILES['logo']['tmp_name'];
            $config2['new_image'] =   getcwd().'/uploads/logo/'.$_POST['logo'];
            $config2['allowed_types'] = 'JPG|PNG|jpg|png|gif|GIF|JPEG|jpeg';

            $config2['maintain_ratio'] = FALSE;

            $this->image_lib->initialize($config2);
            if(!$this->image_lib->resize())
            {
                $this->session->set_flashdata('image_error', 'This file type is not allowed');
                $this->index();
                return;
            }
           else
            {

                 @unlink('uploads/logo/'.$_POST['old_logo']);
                 $logo  = $_POST['logo'];
            }
        }
        else
        {
           $logo  = $_POST['old_logo'];
        }
        if($_FILES['favicon']['name']!='')
        {
            $_POST['favicon']= rand(0000,9999)."_".$_FILES['favicon']['name'];
            $config2['image_library'] = 'gd2';
            $config2['source_image'] =  $_FILES['favicon']['tmp_name'];
            $config2['new_image'] =   getcwd().'/uploads/logo/'.$_POST['favicon'];
            $config2['allowed_types'] = 'JPG|PNG|jpg|png|gif|GIF|JPEG|jpeg|ico';
            $config2['width'] = '16px';
            $config2['height'] = '16px';
            $config2['maintain_ratio'] = FALSE;

            $this->image_lib->initialize($config2);
            if(!$this->image_lib->resize())
            {
                $this->session->set_flashdata('image_error', 'This file type is not allowed');
                $this->index();
                return;
            }
           else
            {
                 @unlink('uploads/logo/'.$_POST['old_favicon']);
                 $favicon  = $_POST['favicon'];
            }
        }
        else
        {
           $favicon  = $_POST['old_favicon'];
        }

    $data = array(
          'website_name' => ucwords($this->input->post('website_name')),
          'logo' => $logo,
          'favicon' => $favicon,
      );
    $id=$this->input->post('id');
    $this->Crud_model->SaveData("setting",$data,"id='".$id."'");

    $this->session->set_flashdata('message', 'Logo updated successfully');
    redirect(admin_url('setting'));
}

function contact_setting()
{
   $data = array(
          'phone' => $this->input->post('phone'),
          'email' => $this->input->post('email'),
          'address' => $this->input->post('address'),
          'facebook' => $this->input->post('facebook'),
          'twitter' => $this->input->post('twitter'),
          'linkedin' => $this->input->post('linkedin'),
          'instagram' => $this->input->post('instagram'),
          'youtube' => $this->input->post('youtube'),
      );
    $id=$this->input->post('setting_id');
    $this->Crud_model->SaveData("setting",$data,"id='".$id."'");

    $this->session->set_flashdata('message', 'Contact has been updated successfully');
    redirect(admin_url('setting'));
}



}
