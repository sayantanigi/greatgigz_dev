<?php 
session_start();
if(isset($_SESSION['cppassBSI'])) :
   unset($_SESSION['cppassBSI']);
   session_destroy();
   sleep(3);
   header('Location: index.php');
else :
   session_destroy();
   sleep(3);
   header('Location: index.php'); 
endif;
?> 