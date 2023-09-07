<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Admin_Controller extends CI_Controller
{
    var $is_login;
    function __construct()
    {
        parent::__construct();
        $this->output->nocache();
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->output->nocache();
        // if (!$this->session->userdata('userid')) {
        //     $this->session->set_flashdata('errormsg', 'Session out!! Please login agin');
        //     redirect(admin_url('users/login'));
        // }
        $this->data['active_tabs']     = 'dashboard';
        $this->data['dashboard_title'] = 'Dashboard';
        $this->load->library(array(
            'pagination'
        ));
    }
    
    function admin_login(){
        if (!$this->session->userdata('userid')) {
            $this->session->set_flashdata('errormsg', 'Session out!! Please login agin');
            redirect(admin_url('users/login'));
        }
    }
}
class AI_Controller extends CI_Controller
{
    var $data, $login, $email;
    var $user = false;
    var $city = false;
    var $cart = array();
    function __construct()
    {
        parent::__construct();
        $this->output->nocache();
        $this->data['seo_description'] = '';
        $this->data['seo_keywords']    = '';
        $this->data['og_image']        = base_url('assets/img/logo.png');
        $this->data['settings'] = $this->Setting_model->all_options();
        $this->data['about'] = $this->Cms_model->getPage('about-us');
        $this->data['photos'] = $this->Gallery_model->listAll('gallery_photos');
    }

    
}

