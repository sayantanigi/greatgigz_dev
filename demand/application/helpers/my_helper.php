<?php
function admin_url($file = '', $redirect = false)
{
    $CI =& get_instance();
    $f = $CI->config->item('admin_folder');
    $url = site_url($f) . '/';
    if ($file <> '') {
        $url .= $file;
    }
    if ($redirect) {
        $cur = urlencode(current_url());
        $url .= '?redirect_to=' . $cur;
    }
    return $url;
}

function admin_view($view = '')
{
    $CI = &get_instance();
    $f = $CI->config->item('admin_view');
    return $f . '/' . $view;
}

function front_view($view = '')
{
    $CI = &get_instance();
    $f = $CI->config->item('front_view');
    return $f . '/' . $view;
}

function inr_rs($amt)
{
    return ' <i class="fa fa-inr"></i> ' . number_format($amt, 2);
}

function upload_dir($file = '')
{
    $CI = &get_instance();
    $f = $CI->config->item('upload_folder');
    return $f . '/' . $file;
}

function theme_url($file = '')
{
    $CI = &get_instance();
    $f = $CI->config->item('themes');
    $url = base_url('/content/themes/' . $f . '/' . $file);
    return $url;
}

function theme_option($optname)
{
    $CI = &get_instance();
    $v = $CI->Setting_model->get_option_value($optname);
    return $v;
}

function theme_option1($optname)
{
    $CI = &get_instance();
    $v = $CI->Option_model->get_option_value($optname);
    return $v;
}
function getDayName($id)
{
    $arr = array(1 => 'Sun', 2 => 'Mon', 3 => 'Tue', 4 => 'Wed', 5 => 'Thu', 6 => 'Fri', 7 => 'Sat');
    return $arr[$id];
}

function getDayIndex($name)
{
    $arr = array(1 => 'Sun', 2 => 'Mon', 3 => 'Tue', 4 => 'Wed', 5 => 'Thu', 6 => 'Fri', 7 => 'Sat');
    $id = 0;
    foreach ($arr as $index => $d) {
        if ($name == $d) {
            $id = $index;
        }
    }
    return $id;
}


function get_country($id){
    $CI = get_instance();
    $d = $CI->db->get_where('countries', array('id' => $id))->row();
    return $d->country_name;
}

function is_login(){
    return isset($_SESSION['userId']) && $_SESSION['userId'] > 0;
}

function userId(){
    return $_SESSION['userId'];
}

function userType(){
    return $_SESSION['user_type'];
}

function memberType(){
    return $_SESSION['member_type'];
}

function check_value()
{
    $CI = &get_instance();
    $v = $CI->User_model->check_value();
    return $v;
}

function get_member_type($id){
     $member_type = "";
     $CI = & get_instance();
     $query = $CI->db->get_where('member',array('userId'=>$id));
             if ($query->num_rows() > 0) {
                  $member_type = $query->row('member_type');
             }
      return  $member_type;      
}

function get_member($id){
    if($id==1){
        return 'Union';
    }
    if($id==2){
        return 'Non-Union';
    }
    if($id==3){
        return 'General Contractor';
    }
    if($id==4){
        return 'Sub Contractor';
    }

}
function islogin(){
    return isset($_SESSION['commonUser']) && $_SESSION['commonUser'] > 0;
}

function userid2(){
    return $_SESSION['commonUser']['userId'];
}

function isprologin(){
    return isset($_SESSION['commonUser']) && $_SESSION['commonUser'] > 0;
}

