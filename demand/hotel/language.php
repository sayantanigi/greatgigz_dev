<?php
if(isset($_REQUEST['lang'])){
$_SESSION['language']=$_REQUEST['lang'];
}

$sql= $mysqli->query("select * from bsi_language where `lang_default`=true");
$row_default_lang=$sql->fetch_assoc();
if(isset($_SESSION['language']))
$langauge_selcted=$mysqli->real_escape_string($_SESSION['language']);
else
$langauge_selcted=$row_default_lang['lang_code'];
$sql2=$mysqli->query("select * from bsi_language where  lang_code='$langauge_selcted' ");
$row_visitor_lang=$sql2->fetch_assoc();
include("languages/".$row_visitor_lang['lang_file']);

//******************************************
$sql_lang_select=$mysqli->query("select * from bsi_language order by lang_title");
$lang_dd='';
while($row_lang_select=$sql_lang_select->fetch_assoc()){
	if($row_lang_select['lang_code']==$langauge_selcted)
	$lang_dd.='<option value="'.$row_lang_select['lang_code'].'" selected="selected">'.$row_lang_select['lang_title'].'</option>';
	else
	$lang_dd.='<option value="'.$row_lang_select['lang_code'].'">'.$row_lang_select['lang_title'].'</option>';
}
//******************************************
?>