<?php
session_start();
include("../includes/db.conn.php");
include("../includes/conf.class.php");
/*if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0){
	$_SESSION['msglog']="capcha code is incorrect!"; 
	header("location:index.php");
	exit;
}else{*/
$action = $bsiCore->ClearInput($_POST['loginform']);
if(isset($_REQUEST['lang'])){
$_SESSION['language1']=$_REQUEST['lang'];
}
switch($action){
	case 1: if(isset($_POST['password']) && isset($_POST['username'])){

if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0){
	$_SESSION['msglog']="capcha code is incorrect!"; 
	header("location:index.php");
	exit;
}else{
	
				$username = $mysqli->real_escape_string($_POST['username']);
				$password = $_POST['password'];
				$result   = $mysqli->query("select * from bsi_admin where pass='".md5($password)."' and  username='".$username."'");
				$count=$result->num_rows;
				if($count){
					$row = $result->fetch_assoc();
					$_SESSION['cppassBSI']     = $row['pass'];
					$_SESSION['cpusernameBSI'] = $row['username'];
					$_SESSION['cpuidBSI']      = $row['id']; 
					$_SESSION['cpaccessidBSI'] = $row['access_id']; 
					$mysqli->query("update bsi_admin set last_login=CURRENT_TIMESTAMP where id=".$row['id']);
					header("location:admin-home.php");
					exit;
				}else{
					$_SESSION['msglog']="username or password is incorrect"; 
					header("location:index.php");
					exit;
				}
			}
	}
	break;
	
	case 2: if(isset($_POST['emailid'])){
				$emailid = $mysqli->real_escape_string($_POST['emailid']);
				$result  = $mysqli->query("select * from bsi_admin where email='".$emailid."'");
				if($result->num_rows){
					include("../includes/mail.class.php");
					$bsiMail       = new bsimail();
					$temp_password = substr(uniqid(), -6, 6);
					$row           = $result->fetch_assoc();
					
					$mysqli->query("update bsi_admin set pass='".md5($temp_password)."' where id=".$row['id']);
					$subject =  "Hotel Admin Panel : Your password has been reset";
                    $body    =  "Hi,<br><br>" .
								"Your new login information is: <br><br>" .
								"Username: " . $row['username'] . "<br>" .
								"Password: " . $temp_password . "<br><br>" ."Thanking You.";
					$bsiMail->sendEMail($emailid, $subject, $body);			
					$_SESSION['msg'] = "RESET";
					header("location:index.php");
					exit;
				}else{
					$_SESSION['msg'] = "Email id does not exists.";
					header("location:index.php");
					exit;
				}
			}
	break;
}

/*}*/
?>