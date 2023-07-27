<?php
include_once("../includes/db.conn.php");

$sql=$mysqli->query("select * from bsi_language where `lang_default`=true");

$row_default_lang=$sql->fetch_assoc();
if(isset($_SESSION['language1']))
$langauge_selcted=$mysqli->real_escape_string($_SESSION['language1']);
else
$langauge_selcted=$row_default_lang['lang_code'];
$sql1=$mysqli->query("select * from bsi_language where  lang_code='$langauge_selcted' ");
$row_visitor_lang=$sql1->fetch_assoc();
include("languages/".$row_visitor_lang['lang_file']);
?>