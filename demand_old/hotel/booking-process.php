<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

session_start();
include("includes/db.conn.php");
include("includes/conf.class.php");
$sql=$mysqli->query("select * from bsi_language where `lang_default`=true");
$row_default_lang=$sql->fetch_assoc();
include("languages/".$row_default_lang['lang_file']);

// Twilio requires the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
//require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php';
require '../twilio-php-master/src/Twilio/autoload.php';

// Twilio uses the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;


//echo "http referer=".$_SERVER['HTTP_REFERER']." server name=".$_SERVER['SERVER_NAME'];

$pos2 = strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME']);

if(!$pos2){
	header('Location: booking-failure.php?error_code=9');
}

include("includes/mail.class.php");

//echo " after include mail class";

include("includes/process.class.php");
//echo " after include process class";



$bookprs = new BookingProcess();

//echo " bookprs=".$bookprs;
//echo "<br>paymentGatewayCode=".$bookprs->paymentGatewayCode;

switch($bookprs->paymentGatewayCode){	
	case "poa":
		processPayOnArrival();
		break;
		
	case "poamm":
		processPayOnArrival_MM();
		break;
		
	case "pp": 		
		processPayPal();
		break;	
					
	case "cc":
		processCreditCard();
		break;	
				
	case "an":
		processAuthorizeNet();
		break;
		
	case "2co":
		process2Checkout();
		break;
		
			
	case "st":
		processStripe();
		break;
		
			
	default:
		processOther();
}

function sendsms($tophone, $msg) {
    
        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'AC84203b7fc281974097281c79d1939d50';
        $token = '702216e2dd0dc71f5b6a00d5d055ff67';
        $client = new Client($sid, $token);
        
        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
            // the number you'd like to send the message to
            '+'.$tophone,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+12029524499',
                // the body of the text message you'd like to send
                'body' => $msg
            ]
        );    
    
}

/* PAY ON ARIVAL: MANUAL PAYMENT */	
function processPayOnArrival(){	
	global $bookprs;
	global $bsiCore; 
	global $mysqli;	
	$bsiMail = new bsiMail();
	$emailContent=$bsiMail->loadEmailContent();
	$subject    = $emailContent['subject'];
	$mysqli->query("UPDATE bsi_bookings SET payment_success=true WHERE booking_id = ".$bookprs->bookingId);
	$mysqli->query("UPDATE bsi_clients SET existing_client = 1 WHERE email = '".$bookprs->clientEmail."'");		
	$emailBody  = "Dear ".$bookprs->clientName.",<br><br>";
	$emailBody .= $emailContent['body']."<br><br>";
	$emailBody .= $bookprs->invoiceHtml;
	$emailBody .= '<br><br>'.$mysqli->real_escape_string(PP_REGARDS).',<br>'.$bsiCore->config['conf_hotel_name'].'<br>'.$bsiCore->config['conf_hotel_phone'];
	$emailBody .= '<br><br><font style=\"color:#F00; font-size:10px;\">[ '.$mysqli->real_escape_string(PP_CARRY).' ]</font>';	

	$returnMsg = $bsiMail->sendEMail($bookprs->clientEmail, $subject, $emailBody);
	
	if ($returnMsg == true) {		
		
		$notifyEmailSubject = "Booking no.".$bookprs->bookingId." - Notification of Room Booking by ".$bookprs->clientName;				
		$notifynMsg = $bsiMail->sendEMail($bsiCore->config['conf_hotel_email'], $notifyEmailSubject, $bookprs->invoiceHtml);
		
		sendsms($bookprs->clientdata['phone'], "Your booking number is ".$bookprs->bookingId. " at ".$bsiCore->config['conf_hotel_name']);
		header('Location: booking-confirm.php?success_code=1');
		die;
	}else {
		header('Location: booking-failure.php?error_code=25');
		die;
	}	
	//header('Location: booking-confirm.php?success_code=1');
}

/* PAY ON ARIVAL: MOBILE MONEY */	
function processPayOnArrival_MM(){	
	global $bookprs;
	global $bsiCore; 
	global $mysqli;	
	$bsiMail = new bsiMail();
	$emailContent=$bsiMail->loadEmailContent();
	$subject    = $emailContent['subject'];
	$mysqli->query("UPDATE bsi_bookings SET payment_success=true WHERE booking_id = ".$bookprs->bookingId);
	$mysqli->query("UPDATE bsi_clients SET existing_client = 1 WHERE email = '".$bookprs->clientEmail."'");		
	$emailBody  = "Dear ".$bookprs->clientName.",<br><br>";
	$emailBody .= $emailContent['body']."<br><br>";
	$emailBody .= $bookprs->invoiceHtml;
	$emailBody .= '<br><br>'.$mysqli->real_escape_string(PP_REGARDS).',<br>'.$bsiCore->config['conf_hotel_name'].'<br>'.$bsiCore->config['conf_hotel_phone'];
	$emailBody .= '<br><br><font style=\"color:#F00; font-size:10px;\">[ '.$mysqli->real_escape_string(PP_CARRY).' ]</font>';	

	$returnMsg = $bsiMail->sendEMail($bookprs->clientEmail, $subject, $emailBody);
	
	if ($returnMsg == true) {		
		
		$notifyEmailSubject = "Booking no.".$bookprs->bookingId." - Notification of Room Booking by ".$bookprs->clientName;				
		$notifynMsg = $bsiMail->sendEMail($bsiCore->config['conf_hotel_email'], $notifyEmailSubject, $bookprs->invoiceHtml);
		
		sendsms($bookprs->clientdata['phone'], "Your booking number is ".$bookprs->bookingId. " at ".$bsiCore->config['conf_hotel_name']);
		header('Location: booking-confirm.php?success_code=1');
		die;
	}else {
		header('Location: booking-failure.php?error_code=25');
		die;
	}	
	//header('Location: booking-confirm.php?success_code=1');
}


/* PAYPAL PAYMENT */ 
function processPayPal(){
	global $bookprs;
	global $bsiCore;
	echo "<script language=\"JavaScript\">";
	echo "document.write('<form action=\"paypal.php\" method=\"post\" name=\"formpaypal\">');";
	echo "document.write('<input type=\"hidden\" name=\"amount\"  value=\"".(($bsiCore->config['conf_payment_currency']=='1')? $bsiCore->getExchangemoney($bookprs->totalPaymentAmount,$_SESSION['sv_currency']) : number_format($bookprs->totalPaymentAmount, 2))."\">');";
	echo "document.write('<input type=\"hidden\" name=\"invoice\"  value=\"".$bookprs->bookingId."\">');";
	echo "document.write('</form>');";
	echo "setTimeout(\"document.formpaypal.submit()\",500);";
	echo "</script>";	
}
/* CREDIT CARD PAYMENT */
function processCreditCard(){
	global $bookprs;
	global $bsiCore;	
	$paymentAmount = number_format($bookprs->totalPaymentAmount, 2, '.', '');
	
	echo "<script language=\"javascript\">";
	echo "document.write('<form action=\"offlinecc-payment.php\" method=\"post\" name=\"form2checkout\">');";
	echo "document.write('<input type=\"hidden\" name=\"x_invoice_num\" value=\"".$bookprs->bookingId."\"/>');";
	echo "document.write('<input type=\"hidden\" name=\"total\" value=\"".(($bsiCore->config['conf_payment_currency']=='1')? $bsiCore->getExchangemoney($paymentAmount,$_SESSION['sv_currency']) : $paymentAmount)."\">');"; 
	echo "document.write('</form>');";
	echo "setTimeout(\"document.form2checkout.submit()\",500);";
	echo "</script>";
}

function processAuthorizeNet(){
	global $bookprs;
	global $bsiCore;	
	$_SESSION['paymentAmount']=$bookprs->totalPaymentAmount;
	$_SESSION['bookingId']=$bookprs->bookingId;
	header('Location: an_direct_post.php');
	die;
}

/* PAYPAL PAYMENT */ 
function process2Checkout(){
	global $bookprs;
	global $bsiCore;
	$paymentGatewayDetails = $bsiCore->loadPaymentGateways();
	$_SESSION['paymentAmount']=$bookprs->totalPaymentAmount;
	echo "<script language=\"JavaScript\">";
	echo "document.write('<form action=\"https://www.2checkout.com/checkout/spurchase\" method=\"post\" name=\"twocopayment\">');";
	echo "document.write('<input type=\"hidden\" name=\"sid\" value=\"".$paymentGatewayDetails['2co']['account']."\" >');";
	echo "document.write('<input type=\"hidden\" name=\"mode\" value=\"2CO\" >');";
	//echo "document.write('<input type=\"hidden\" name=\"demo\" value=\"N\"/>');";
	echo "document.write('<input type=\"hidden\" name=\"li_0_type\" value=\"product\" >');";
	echo "document.write('<input type=\"hidden\" name=\"li_0_name\" value=\"Booking : ".$bsiCore->config['conf_hotel_name']."\" >');";
	echo "document.write('<input type=\"hidden\" name=\"li_0_price\" value=\"".$bookprs->totalPaymentAmount."\" >');";
	echo "document.write('<input type=\"hidden\" name=\"invoice\"  value=\"".$bookprs->bookingId."\">');";
	echo "document.write('</form>');";
	echo "setTimeout(\"document.twocopayment.submit()\",500);";
	echo "</script>";	
}

function processStripe(){
	global $bookprs;
	global $bsiCore;	
	$_SESSION['clientEmail']=$bookprs->clientEmail;
	$_SESSION['paymentAmount']=$bookprs->totalPaymentAmount;
	$_SESSION['bookingId']=$bookprs->bookingId;
	header('Location: stripe-processor.php');
	die;
}
/* OTHER PAYMENT */
function processOther(){
	/* not implemented yet */
	header('Location: booking-failure.php?error_code=22');
	die;
}
?>