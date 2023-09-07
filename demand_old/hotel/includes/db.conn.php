<?php
define("MYSQL_SERVER", "localhost");
define("MYSQL_USER", "prosear5_dbhroot");
define("MYSQL_PASSWORD", "Prosear5_root00");
define("MYSQL_DATABASE", "prosear5_dbhotel");

$mysqli = new mysqli(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE); 
if (mysqli_connect_errno()) {  printf("Connect failed: %s
", mysqli_connect_error());  exit(); }
?>