<?php
/**
* @package BSI
* @author BestSoft Inc see README.php
* @copyright BestSoft Inc.
* See COPYRIGHT.php for copyright notices and details.
*/
class BookingProcess
{
	private $guestsPerRoom		= 0;
	private $checkInDate		= '';
	private $checkOutDate		= '';
	private $noOfNights			= 0;
	private $noOfRooms			= 0;  
	private $mysqlCheckInDate	= '';
	private $mysqlCheckOutDate	= '';	
	public  $clientdata			= array();		
	private $expTime			= 0;	
	private $roomIdsOnly		= '';
	
	private $pricedata			= array();
	private $taxAmount 			= 0.00;
	private $taxPercent			= 0.00;
	private $grandTotalAmount 	= 0.00;	
	private $currencySymbol		= '';
	
	private $depositenabled		= false;
	
	private $taxWithPrice;
	public $clientId			= 0;
	public $clientName			= '';
	public $clientEmail			= '';
	public $bookingId			= 0;
	public $paymentGatewayCode	= '';		
	public $totalPaymentAmount 	= 0.00;	
	public $invoiceHtml			= '';
	
	function __construct() {		
	    
//	    echo " new bookingprocess class enters";
	    
		$this->setMyRequestParams();
//		echo " after setMyRequestParams";

		$this->removeSessionVariables();
//		echo " after removeSessionVariables";

		$this->checkAvailability();
//		echo " after checkAvailability";
		
		$this->saveClientData();
//		echo " after saveClientData";
		
		$this->saveBookingData();
//		echo " after saveBookingData";

		
		$this->createInvoice();
//		echo " after createInvoice";
		
//	    echo "<br><br>new bookingprocess class exits";
	}
	
	private function setMyRequestParams(){ 
		global $bsiCore;
		
//		echo "<br>setMyRequestParams enters";
		
		$this->setMyParamValue($this->guestsPerRoom, 'SESSION', 'sv_guestperroom', 0, true);	
//		echo "<br>setMyRequestParams after setting guest per room";


		$this->setMyParamValue($this->checkInDate, 'SESSION', 'sv_checkindate', NULL, true);
		$this->setMyParamValue($this->checkOutDate, 'SESSION', 'sv_checkoutdate', NULL, true);
		$this->setMyParamValue($this->noOfNights, 'SESSION', 'sv_nightcount', 0, true);
		$this->setMyParamValue($this->mysqlCheckInDate, 'SESSION', 'sv_mcheckindate', NULL, true);
		$this->setMyParamValue($this->mysqlCheckOutDate, 'SESSION', 'sv_mcheckoutdate', NULL, true);
		$this->setMyParamValue($this->roomIdsOnly, 'SESSION', 'dv_roomidsonly', '', true);		
		$this->setMyParamValue($this->reservationdata2, 'SESSION', 'dvars_details2', NULL, true);	
		$this->setMyParamValue($this->reservationdata, 'SESSION', 'dvars_details', NULL, true);						
		$this->setMyParamValue($this->pricedata, 'SESSION', 'dvars_roomprices', NULL, true);		
				
		$this->setMyParamValue($this->clientdata['title'], 'POST', 'title', true); 
//		echo "<br>setMyRequestParams after setting title";	
		
		$this->setMyParamValue($this->clientdata['firstname'], 'POST', 'firstname', '', true);
//		echo "<br>setMyRequestParams after setting firstname";		
		
		$this->setMyParamValue($this->clientdata['lastname'], 'POST', 'lastname', '', true);
		$this->setMyParamValue($this->clientdata['address'], 'POST', 'str_addr', '', true);
		$this->setMyParamValue($this->clientdata['city'], 'POST', 'city', '', true);
		$this->setMyParamValue($this->clientdata['state'], 'POST', 'state', '', true);
		$this->setMyParamValue($this->clientdata['zipcode'], 'POST', 'zipcode', '', true);
		$this->setMyParamValue($this->clientdata['country'], 'POST', 'country', '', true);
		$this->setMyParamValue($this->clientdata['phone'], 'POST', 'phone', '', true);
		$this->setMyParamValue($this->clientdata['fax'], 'POST', 'fax', '', false); //optionlal
		$this->setMyParamValue($this->clientdata['email'], 'POST', 'email', '', true);
		$this->setMyParamValue($this->clientdata['password'], 'POST', 'password', '', true);
		$this->setMyParamValue($this->clientdata['id_type'], 'POST', 'id_type', '', true);
		$this->setMyParamValue($this->clientdata['id_number'], 'POST', 'id_number', '', true);
		$this->setMyParamValue($this->clientdata['message'], 'POST', 'message', '', false);
		$this->setMyParamValue($this->clientdata['clientip'], 'SERVER', 'REMOTE_ADDR', '', false);					
		$this->setMyParamValue($this->paymentGatewayCode, 'POST', 'payment_type','', true);	
		
		$this->bookingId		= time();		
		$this->expTime 			= intval($bsiCore->config['conf_booking_exptime']);	
		$this->currencySymbol 	= $bsiCore->currency_symbol();
		$this->taxPercent 		= $bsiCore->config['conf_tax_amount'];
		$this->clientName 		= $this->clientdata['firstname']." ". $this->clientdata['lastname'];
		$this->clientEmail		= $this->clientdata['email'];
		$this->noOfRooms		= count(explode(",", $this->roomIdsOnly));
		$this->taxWithPrice     = $bsiCore->config['conf_price_with_tax'];
			
		if($bsiCore->config['conf_enabled_deposit'])
			$this->depositenabled = true;			
		
		$this->taxAmount 			= $this->pricedata['totaltax'];
		$this->grandTotalAmount 	= $this->pricedata['grandtotal'];
		$this->totalPaymentAmount 	= $this->pricedata['advanceamount'];
	
	}
	
	private function setMyParamValue(&$membervariable, $vartype, $param, $defaultvalue, $required = false){
		global $bsiCore;
		
//		echo "<br>setMyParamValue params, membervariable=".$membervariable." vartype=".$vartype." param=".$param." defaultvalue=".$defaultvalue." required=".$required;
		
		switch($vartype){
			case "POST": 
				if($required){if(!isset($_POST[$param])){$this->invalidRequest(9);} 
					else{$membervariable = $bsiCore->ClearInput($_POST[$param]);}}
				else{if(isset($_POST[$param])){$membervariable = $bsiCore->ClearInput($_POST[$param]);} 
					else{$membervariable = $defaultvalue;}}				
				break;	
			case "GET":
				if($required){if(!isset($_GET[$param])){$this->invalidRequest(9);} 
					else{$membervariable = $bsiCore->ClearInput($_GET[$param]);}}
				else{if(isset($_GET[$param])){$membervariable = $bsiCore->ClearInput($_GET[$param]);} 
					else{$membervariable = $defaultvalue;}}				
				break;	
			case "SESSION":
				if($required){if(!isset($_SESSION[$param])){$this->invalidRequest(9);} 
					else{$membervariable = $_SESSION[$param];}}
				else{if(isset($_SESSION[$param])){$membervariable = $_SESSION[$param];} 
					else{$membervariable = $defaultvalue;}}				
				break;	
			case "REQUEST":
				if($required){if(!isset($_REQUEST[$param])){$this->invalidRequest(9);}
					else{$membervariable = $bsiCore->ClearInput($_REQUEST[$param]);}}
				else{if(isset($_REQUEST[$param])){$membervariable = $bsiCore->ClearInput($_REQUEST[$param]);}
					else{$membervariable = $defaultvalue;}}				
				break;
			case "SERVER":
				if($required){if(!isset($_SERVER[$param])){$this->invalidRequest(9);}
					else{$membervariable = $_SERVER[$param];}}
				else{if(isset($_SERVER[$param])){$membervariable = $_SERVER[$param];}
					else{$membervariable = $defaultvalue;}}				
				break;			
		}		
	}	
	
	private function invalidRequest($errocode = 9){		
		header('Location: booking-failure.php?error_code='.$errocode.'');
		die;
	}
	
	private function removeSessionVariables(){
		if(isset($_SESSION['sv_checkindate'])) unset($_SESSION['sv_checkindate']);
		if(isset($_SESSION['sv_checkoutdate'])) unset($_SESSION['sv_checkoutdate']);
		if(isset($_SESSION['sv_mcheckindate'])) unset($_SESSION['sv_mcheckindate']);
		if(isset($_SESSION['sv_mcheckoutdate'])) unset($_SESSION['sv_mcheckoutdate']);	
		if(isset($_SESSION['sv_nightcount'])) unset($_SESSION['sv_nightcount']);
		if(isset($_SESSION['sv_guestperroom'])) unset($_SESSION['sv_guestperroom']);
		if(isset($_SESSION['sv_childcount'])) unset($_SESSION['sv_childcount']);	
		if(isset($_SESSION['svars_details'])) unset($_SESSION['svars_details']);
		if(isset($_SESSION['dvars_details'])) unset($_SESSION['dvars_details']);
		if(isset($_SESSION['dv_roomidsonly'])) unset($_SESSION['dv_roomidsonly']);	
		if(isset($_SESSION['dvars_roomprices'])) unset($_SESSION['dvars_roomprices']);
	}
	 
	/* Check Immediate Booking Status For Concurrent Access */
	private function checkAvailability(){
		global $mysqli;
		$sql1 = "
		SELECT resv.room_id
		  FROM bsi_reservation resv, bsi_bookings boks
		 WHERE     resv.bookings_id = boks.booking_id
			   AND ((NOW() - boks.booking_time) < ".$this->expTime.")
			   AND boks.is_deleted = FALSE
			   AND resv.room_id IN (".$this->roomIdsOnly.")
			   AND (('".$this->mysqlCheckInDate."' BETWEEN boks.start_date AND DATE_SUB(boks.end_date, INTERVAL 1 DAY))
				OR (DATE_SUB('".$this->mysqlCheckOutDate."', INTERVAL 1 DAY) BETWEEN boks.start_date AND DATE_SUB(boks.end_date, INTERVAL 1 DAY))
				OR (boks.start_date BETWEEN '".$this->mysqlCheckInDate."' AND DATE_SUB('".$this->mysqlCheckOutDate."', INTERVAL 1 DAY))
				OR (DATE_SUB(boks.end_date, INTERVAL 1 DAY) BETWEEN '".$this->mysqlCheckInDate."' AND DATE_SUB('".$this->mysqlCheckOutDate."', INTERVAL 1 DAY)))";				
		$sql = $mysqli->query($sql1);
		if($sql->num_rows){	
			$sql->close();
			$this->invalidRequest(13);
			die;
		}
		$sql->close();
	}
	
	private function saveClientData(){
		global $bsiCore;
		global $mysqli;
		$sql1 = $mysqli->query("SELECT client_id FROM bsi_clients WHERE email = '".$this->clientdata['email']."'");
		if($sql1->num_rows > 0){
			$clientrow = $sql1->fetch_assoc();
			$this->clientId = $clientrow["client_id"];	
			$passworddt=($this->clientdata['password'] != "")? "password='".md5($this->clientdata['password'])."'," : "";
			
			$sql2 = $mysqli->query("UPDATE bsi_clients SET first_name = '".$this->clientdata['firstname']."', surname = '".$this->clientdata['lastname']."', title = '".$this->clientdata['title']."', street_addr = '".$this->clientdata['address']."', city = '".$this->clientdata['city']."' , province = '".$this->clientdata['state']."', zip = '".$this->clientdata['zipcode']."', country = '".$this->clientdata['country']."', phone = '".$this->clientdata['phone']."', fax = '".$this->clientdata['fax']."',  id_type = '".$this->clientdata['id_type']."',  id_number = '".$this->clientdata['id_number']."', ".$passworddt." additional_comments = '".$this->clientdata['message']."', ip = '".$this->clientdata['clientip']."' WHERE client_id = ".$this->clientId);			 	
		}else{
			$sql2 = $mysqli->query("INSERT INTO bsi_clients (first_name, surname, title, street_addr, city, province, zip, country, phone, fax, email, password,  id_type, id_number, additional_comments, ip) values('".$this->clientdata['firstname']."', '".$this->clientdata['lastname']."', '".$this->clientdata['title']."', '".$this->clientdata['address']."', '".$this->clientdata['city']."' , '".$this->clientdata['state']."', '".$this->clientdata['zipcode']."', '".$this->clientdata['country']."', '".$this->clientdata['phone']."', '".$this->clientdata['fax']."', '".$this->clientdata['email']."', '".md5($this->clientdata['password'])."', '".$this->clientdata['id_type']."', '".$this->clientdata['id_number']."', '".$this->clientdata['message']."', '".$this->clientdata['clientip']."')");
			//$this->clientId = mysql_insert_id();	
			$this->clientId = $mysqli->insert_id;		
		}
		$sql1->close();		 
	}
	
	private function saveBookingData(){
		global $mysqli;
		$sql = $mysqli->query("INSERT INTO bsi_bookings (booking_id, booking_time, start_date, end_date, client_id, total_cost, payment_amount, payment_type, special_requests) values(".$this->bookingId.", NOW(), '".$this->mysqlCheckInDate."', '".$this->mysqlCheckOutDate."', ".$this->clientId.", ".$this->grandTotalAmount.", ".$this->totalPaymentAmount.", '".$this->paymentGatewayCode."', '".$this->clientdata['message']."')");
		
		foreach($this->reservationdata as $revdata){
			foreach($revdata['availablerooms'] as $rooms){				
			$sql = $mysqli->query("INSERT INTO bsi_reservation (bookings_id, room_id, room_type_id) values(".$this->bookingId.",  ".$rooms['roomid'].", ".$revdata['roomtypeid'].")");
			} 
		}
	}	
	
	private function createInvoice(){
		global $mysqli;
		global $bsiCore;
		$this->invoiceHtml = '<table style="font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#999999; width:700px; border:none;" cellpadding="4" cellspacing="1"><tbody><tr><td align="left" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;" colspan="4">'.$mysqli->real_escape_string(BOOKING_DETAILS_TEXT).'</td></tr>
		<tr><td align="left" style="background:#ffffff;">'.$mysqli->real_escape_string(INV_BOOKING_NUMBER).'</td><td align="left" style="background:#ffffff;" colspan="3">'.$this->bookingId.'</td></tr>
		<tr><td align="left" style="background:#ffffff;">'.$mysqli->real_escape_string(INV_CUSTOMER_NAME).'</td><td align="left" style="background:#ffffff;" colspan="3">'.$this->clientName.'</td></tr>	
		<tr height="8px;"><td align="left" style="background:#ffffff;" colspan="4"></td></tr>
		<tr><td align="center" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(CHECKIN_DATE_TEXT).'</td><td align="center" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(CHECKOUT_DATE_TEXT).'</td><td align="center" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(TOTAL_NIGHT_TEXT).'</td><td align="center" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(TOTAL_ROOMS_TEXT).'</td></tr>
		<tr><td align="center" style="background:#ffffff;">'.$this->checkInDate.'</td><td align="center" style="background:#ffffff;">'.$this->checkOutDate.'</td><td align="center" style="background:#ffffff;">'.$this->noOfNights.'</td><td align="center" style="background:#ffffff;">'.$this->noOfRooms.'</td></tr>
		<tr height="8px;"><td align="left" style="background:#ffffff;" colspan="4">&nbsp;</td></tr>
		<tr><td align="center" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(NUMBER_OF_ROOM_TEXT).'</td><td align="center" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(ROOM_TYPE_TEXT).'</td><td align="center" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(MAXI_OCCUPENCY_TEXT).'</td><td align="right" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(GROSS_TOTAL_TEXT).'</td></tr>';		
			
		foreach($this->reservationdata2 as $revdata){
			$child_title2=($revdata['child_flag2'])? " + ".$revdata['childcount3']." ".CHILD_TEXT."":""; 
				$this->invoiceHtml.= '<tr><td align="center" style="background:#ffffff;">'.$revdata['roomno'].'</td><td align="center" style="background:#ffffff;">'.$revdata['roomtype'].' ('.$revdata['capacitytitle'].')</td><td align="center" style="background:#ffffff;">'.$revdata['capacity'].' '.INV_ADULT.' '.$child_title2;		
				$this->invoiceHtml.= '</td><td align="right" style="background:#ffffff;">'.(($bsiCore->config['conf_invoice_currency']=='1')? $bsiCore->get_currency_symbol($_SESSION['sv_currency']).$bsiCore->getExchangemoney($revdata['grosstotal'],$_SESSION['sv_currency']) : $this->currencySymbol.number_format($revdata['grosstotal'], 2 ) ).'</td></tr>';
			
		}
		
		$this->invoiceHtml.= '<tr height="8px;"><td align="left" style="background:#ffffff;" colspan="4"></td></tr><tr><td colspan="3" align="right" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(SUB_TOTAL_TEXT).'</td><td align="right" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.(($bsiCore->config['conf_invoice_currency']=='1')? $bsiCore->get_currency_symbol($_SESSION['sv_currency']).$bsiCore->getExchangemoney($this->pricedata['subtotal'],$_SESSION['sv_currency']) : $this->currencySymbol.number_format($this->pricedata['subtotal'], 2)).'</td></tr>';
					
		if($this->taxPercent > 0 &&  $this->taxWithPrice == 0){ 	
		$this->invoiceHtml.= '<tr><td colspan="3" align="right" style="background:#ffffff;">'.$mysqli->real_escape_string(TAX_TEXT).'('.number_format($this->taxPercent, 2 , '.', '').'%)</td><td align="right" style="background:#ffffff;">(+) '.(($bsiCore->config['conf_invoice_currency']=='1')?  $bsiCore->get_currency_symbol($_SESSION['sv_currency']).$bsiCore->getExchangemoney($this->taxAmount,$_SESSION['sv_currency']) : $this->currencySymbol.number_format($this->taxAmount, 2)).'</td></tr><tr><td colspan="3" align="right" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(GRAND_TOTAL_TEXT).'</td><td align="right" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.(($bsiCore->config['conf_invoice_currency']=='1')?  $bsiCore->get_currency_symbol($_SESSION['sv_currency']).$bsiCore->getExchangemoney($this->grandTotalAmount,$_SESSION['sv_currency']) : $this->currencySymbol.number_format($this->grandTotalAmount, 2)).'</td></tr>';
		}else{
			$this->invoiceHtml.= '<tr><td colspan="3" align="right" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.GRAND_TOTAL_TEXT.'</td><td align="right" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.(($bsiCore->config['conf_invoice_currency']=='1')? $bsiCore->get_currency_symbol($_SESSION['sv_currency']).$bsiCore->getExchangemoney($this->grandTotalAmount,$_SESSION['sv_currency'])  : $this->currencySymbol.number_format($this->grandTotalAmount, 2)).'</td></tr>';	
		}
		if($this->depositenabled && ($this->pricedata['advancepercentage'] > 0 && $this->pricedata['advancepercentage'] < 100)){
			
			$this->invoiceHtml.= '<tr><td colspan="3" align="right" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(ADVANCE_PAYMENT_TEXT).'(<span style="font-size: 10px;">'.number_format($this->pricedata['advancepercentage'], 2 , '.', '').'% '.$mysqli->real_escape_string(OF_GRAND_TOTAL_TEXT).'</span>)</td><td align="right" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.(($bsiCore->config['conf_invoice_currency']=='1')? $bsiCore->get_currency_symbol($_SESSION['sv_currency']).$bsiCore->getExchangemoney($this->totalPaymentAmount,$_SESSION['sv_currency']) : $this->currencySymbol.number_format($this->totalPaymentAmount, 2)).'</td></tr>';
		} 
		$this->invoiceHtml.= '</tbody></table>';
		
		if($this->clientdata['message'] != ""){

			$this->invoiceHtml.= '<br /><table  style="font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#999999; width:700px; border:none;" cellpadding="4" cellspacing="1">
			
			<tr><td align="left" colspan="2" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(ADDITIONAL_REQUESTS_TEXT).'</td></tr>
			<tr><td align="left" style="background:#ffffff;">'.$this->clientdata['message'].'</td></tr>
			
			
			
			</table>';					
		}
		
		
		if($this->paymentGatewayCode == "poa"  or  $this->paymentGatewayCode == "poamm"){
			$paymentGatewayDetails = $bsiCore->loadPaymentGateways();
			if($this->paymentGatewayCode == "poa") {
    			$payoptions = $paymentGatewayDetails['poa']['name'];		
			}
			else {
    			$payoptions = $paymentGatewayDetails['poamm']['name'];		
			}
			
			$this->invoiceHtml.= '<br><table  style="font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#999999; width:700px; border:none;" cellpadding="4" cellspacing="1"><tr><td align="left" colspan="2" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;">'.$mysqli->real_escape_string(INV_PAY_DETAILS).'</td></tr><tr><td align="left" width="30%" style="font-weight:bold; font-variant:small-caps;background:#ffffff;">'.$mysqli->real_escape_string(INV_PAY_OPTION).'</td><td align="left" style="background:#ffffff;">'.$payoptions.'</td></tr><tr><td align="left" width="30%" style="font-weight:bold; font-variant:small-caps; background:#ffffff;">'.$mysqli->real_escape_string(INV_TXN_ID).'</td><td align="left" style="background:#ffffff">NA</td></tr></table>';					
		}
		
		/* insert the invoice data in bsi_invoice table */
		$insertInvoiceSQL = $mysqli->query("INSERT INTO bsi_invoice(booking_id, client_name, client_email, invoice) values(".$this->bookingId.", '".$this->clientName."', '".$this->clientdata['email']."', '".$this->invoiceHtml."')");	
	}
}
?>