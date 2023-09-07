<?php
/**
* @package BSI
* @author BestSoft Inc see README.php
* @copyright BestSoft Inc.
* See COPYRIGHT.php for copyright notices and details.
*/

class ajaxProcessor
{
	public $actionCode = 0;
	private $errorCode = 0;
	private $errorMsg = '';
	
	function ajaxProcessor() {		
		$this->setRequestParams();		
	}	
	
	private function setRequestParams() {		
		global $bsiCore;
		$this->setMyParamValue($this->actionCode, $bsiCore->ClearInput($_POST['actioncode']), 0, true);		
	}//end of function	
	
	private function setMyParamValue(&$membervariable, $paramvalue, $defaultvalue, $required = false){
		if($required){if(!isset($paramvalue)){$this->invalidRequest();}}
		if(isset($paramvalue)){$membervariable = $paramvalue;}else{$membervariable = $defaultvalue;}
	}//end of function	
	
	private function invalidRequest(){
		header('Location: booking-failure.php?error_code=9');
		die;
	}//end of function	
	
	/************************************************************************************
	 * Function for sending Error Message
	 * actioncode = unknown
	 ************************************************************************************/
	public function sendErrorMsg(){		
		$this->errorMsg = "unknown error";	
		echo json_encode(array("errorcode"=>99,"strmsg"=>$this->errorMsg));
	}//end of function	
	
	public function getCustomerDetails(){
		global $bsiCore;
		global $mysqli;
		$this->errorCode = 0;
		$this->errorMsg = "";	
		
		$existing_email = $bsiCore->ClearInput($_POST['existing_email']);			
		$login_password=$bsiCore->ClearInput($_POST['login_password']);
		$client_sql=$mysqli->query("select * from bsi_clients where email='".$existing_email."' and password='".md5($login_password)."' limit 1");
		
		if($client_sql->num_rows){	
			$client_row=$client_sql->fetch_assoc();		
			$title_array=array("Mr.","Ms.","Mrs.","Miss.","Dr.","Prof.");
			$select_title='<select name="title" class="textbox3">';
			
			for($p=0; $p<6; $p++){
				if($title_array[$p]==$client_row['title']){
					$select_title.='<option value="'.$title_array[$p].'" selected="selected">'.$title_array[$p].'</option>';
				}else{
					$select_title.='<option value="'.$title_array[$p].'" >'.$title_array[$p].'</option>';
				}
			}
			
			$select_title.='</select>';
			
			echo json_encode(array("errorcode"=>$this->errorCode, "title"=>$select_title, "first_name"=>$client_row['first_name'], "surname"=>$client_row['surname'],"street_addr"=>$client_row['street_addr'],"city"=>$client_row['city'],"province"=>$client_row['province'],"zip"=>$client_row['zip'],"country"=>$client_row['country'],"phone"=>$client_row['phone'],"fax"=>$client_row['fax'],"email"=>$client_row['email'], "id_type"=>$client_row['id_type'], "id_number"=>$client_row['id_number'] ));	
									
		}else{
			$this->errorCode = 1;
			$this->errorMsg  = "Email or Password Incorrect!!!!";
			echo json_encode(array("errorcode"=>$this->errorCode,"strmsg"=>$this->errorMsg));	
		}
	}//end of function	
	
	
	public function forgetpassword(){
		global $bsiCore;
		global $mysqli;
		$this->errorCode = 0;
		$this->errorMsg = "";	
		
		$existing_email = $bsiCore->ClearInput($_POST['existing_email']);	
		$client_sql=$mysqli->query("select * from bsi_clients where email='".$existing_email."'  limit 1");
		if($client_sql->num_rows){
			include("includes/mail.class.php");
					$bsiMail       = new bsimail();
					$temp_password = substr(uniqid(), -6, 6);
					//$row           = mysql_fetch_assoc($result);
					
					$mysqli->query("update bsi_clients set password='".md5($temp_password)."' where email='".$existing_email."'" );
					$subject =  $bsiCore->config['conf_hotel_name']." : Your password has been reset";
                    $body    =  "Hi,<br><br>" .
								"Your new login information is: <br><br>" .
								"Email: " . $existing_email . "<br>" .
								"Password: " . $temp_password . "<br><br>" ."Thanking You.";
					$bsiMail->sendEMail($existing_email, $subject, $body);	
					echo json_encode(array("errorcode"=>$this->errorCode));
		}else{
			$this->errorCode = 1;
			$this->errorMsg  = "Email  not exist in our database!!!!";
			echo json_encode(array("errorcode"=>$this->errorCode,"strmsg"=>$this->errorMsg));	
		}
	}

} //end of class
?>
