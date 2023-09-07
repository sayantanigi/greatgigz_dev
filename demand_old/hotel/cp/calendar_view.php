<?php
include ("access.php");
include ("header.php");
include("../includes/conf.class.php");
include("../includes/admin.class.php");
date_default_timezone_set($bsiCore->config['conf_hotel_timezone']);
$monthNames = array("January" => 1, "February" => 2, "March" => 3, "April" => 4, "May" => 5, "June" => 6, "July" => 7, "August" => 8, "September" => 9, "October" => 10, "November" => 11, "December" => 12);
if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date('Y');
$time = time();
$today         = date("Y/n/j", $time);
$current_month = date("n", $time);
$current_year  = date("Y", $time);
$cMonth        = 1;
$cYear         = $_REQUEST["year"];
$prev_year     = $cYear;
$next_year     = $cYear;
$prev_month    = $cMonth-1;
$next_month    = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#year').change(function(){
			window.location = 'calendar_view.php?year='+$('#year').val();
		});	
		
		$('#roomtype').change(function(){
			if($('#roomtype').val() != 0){
				capacityConmboShow();
				$('#submitButton').show();
			}else{
				$('#submitButton').hide(); 
			}
		});
		
		if($('#roomtype').val() != 0){
			capacityConmboShow();
			$('#submitButton').show();
		}
		
		function capacityConmboShow(){
			var querystr = 'actioncode=5&roomtype='+$('#roomtype').val(); 	
				$.post("admin_ajax_processor.php", querystr, function(data){											 
					if(data.errorcode == 0){
						$('#roomcapid').html(data.chtml)
					}else{
						$('#roomcapid').html(data.chtml)
					}
			    }, "json");	
		}
		
		$('#refresh').click(function(){
			window.location = 'calendar_view.php';
		});
	});
</script>
<div id="container-inside"> <span style="font-size:16px; font-weight:bold"> CALENDER VIEW OF AVAILABILITY</span>
 <hr />
 <form action="" method="post" id="form1">
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
   <tr>
    <td colspan="2"><?php echo $bsiAdminMain->getYearcombo($cYear);?>
     &nbsp;
     <?php if(isset($_POST['submit'])){ echo $bsiAdminMain->getRoomtypeCal($_POST['roomtype'])."&nbsp;&nbsp;";  } else { echo $bsiAdminMain->getRoomtypeCal()."&nbsp;&nbsp;"; }?>
     <span id="roomcapid"></span>&nbsp;&nbsp;<span style="display:none; " id="submitButton">
     <input type="submit" name="submit" id="submit" value="Submit" style="background: #EFEFEF;"/>
     </span></td>
   </tr>
  </table>
  <hr />
  <table width="100%">
   <tr>
    <td align="center" valign="top"><table width="100%"  cellpadding="3" cellspacing="2" border="0">
      <?php
				echo '<tr style="height:37px;"><td style="text-decoration:underline; font-size:14px;" valign="middle"><b>Month</b></td></tr><tr><td><hr></td></tr>';
				foreach($monthNames as $key => $month){ 
					if($current_month == $month && $current_year == $cYear){
						echo '<tr style="background-color:#ffdf80; height:37px;"><td><b>'.$key.'</b></td></tr><tr><td><hr></td></tr>';
					}else{
						if($month % 2 == 0){
							echo '<tr style="background-color:#F2F2F2; height:37px;"><td><b>'.$key.'</b></td></tr><tr><td><hr></td></tr>';
						}else{
							echo '<tr style="background-color:#FFFFFF; height:37px;"><td><b>'.$key.'</b></td></tr><tr><td><hr></td></tr>';
						}
					}
				}
			?>
     </table></td>
    <td align="center" width="90%" valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="2">
       <?php
			echo "<tr style='height:37px;'>";
			echo $bsiAdminMain->getdaysName();
			echo "</tr><tr><td colspan='37'><hr></td></tr>"; 
			foreach($monthNames as $key => $month){ 
				$timestamp = mktime(0, 0, 0, $month, 1, $cYear);
				$maxday    = date("t",$timestamp);
				$thismonth = getdate ($timestamp);
				$startday  = $thismonth['wday'];
				$no_of_td  = $maxday+$startday;
				//YYYY-MM-DD date format
				$date_form = "$cYear-$month-";
				
				if(isset($_POST['submit'])){
					if(isset($_POST['capacity_id']) && $_POST['capacity_id'] != 0){
						$sql = 'where roomtype_id='.$_POST['roomtype'].' and capacity_id='.$_POST['capacity_id'];
					}else{
						$sql = 'where roomtype_id='.$_POST['roomtype'];
					}
				}else{
					$sql = '';
				}
				$sql=$mysqli->query("SELECT count(*) AS no_of_room FROM `bsi_room` ".$sql);
				$row = $sql->fetch_assoc();
				$no_of_room = $row['no_of_room'];
				if($current_month == $month && $current_year == $cYear){
					$trColor = 'background-color:#ffdf80;';
				}else{
					if($month % 2 == 0){
						$trColor = 'background-color:#F2F2F2;';
					}else{
						$trColor = 'background-color:#FFFFFF;';
					}
				}
				
				echo '<tr style="height:37px;font-size:8px; '.$trColor.'">'; 
				for ($i=0; $i<($maxday+$startday); $i++) {
					if($i<$startday){
						$dt=$date_form."0";
					}else{
						$dt=$date_form.($i - $startday + 1);
					}
					$bookroom=0;
				   if(isset($_POST['submit'])){	
				   
				         
						 $result22=$mysqli->query("SELECT `booking_id` FROM `bsi_bookings` WHERE '".$dt."' between `start_date` and DATE_SUB(end_date, INTERVAL 1 DAY)");
						 if($result22->num_rows){
							 
							 while($row=$result22->fetch_assoc()){
								 if(isset($_POST['capacity_id']) && $_POST['capacity_id'] != 0){
								 //if($_POST['capacity_id'] > 0){
									 $add_query1111=" and rm.capacity_id='".$_POST['capacity_id']."'";
								 }else{
									  $add_query1111="";
								 } 
								 $res66=$mysqli->query("select rs.room_id from bsi_reservation rs,bsi_room rm 													where rs.room_id=rm.room_ID and rs.room_type_id='".$_POST['roomtype']."' and rs.bookings_id='".$row['booking_id']."' ". $add_query1111."");
							
											
									
										$bookroom+=$res66->num_rows;
									
									
							 }
						 } 
					
				   }else{
					   $result = $mysqli->query("SELECT count(br.room_type_id) as counter FROM bsi_bookings as bb, bsi_reservation as br, bsi_room as bro, bsi_roomtype as brt, bsi_capacity as bc WHERE bb.booking_id = br.bookings_id and bro.room_id = br.room_id and bro.roomtype_id = brt.roomtype_ID and bro.capacity_id = bc.id and '".$dt."' between bb.start_date and DATE_SUB(bb.end_date, INTERVAL 1 DAY)");
					    if($result->num_rows){
							$rowcount = $result->fetch_assoc();
							$bookroom=$rowcount['counter'];
						}
				   }
								   					
					if($i < $startday){ 
						echo "<td></td>"; 
					}else{
						if($bookroom>0){
							$noOfRoom = $no_of_room - $bookroom;
						}else{																					
								$noOfRoom = $no_of_room;							
							
						}
						
						if($no_of_room){
							$color = '#bffcc1';
							$font_color="#000000";
						}if($no_of_room==$bookroom){
							$color = '#f3747f';
							$font_color="#000000";
						}
												
						if($i == 0 || $i == 6 || $i == 7 || $i == 13 || $i == 14 || $i == 20 || $i == 21 || $i == 27 || $i == 28 || $i == 34 || $i == 35){							
							if($time > strtotime($date_form.($i - $startday + 1))){
								if($today == $date_form.($i - $startday + 1)){
									$color = '#36a4ed';
									$font_color="#ffffff";
								}else{
									$color = '#f2f2f2';
									$font_color="#cccaca";
								}
									
							}
																					
							echo "<td align='center' bgcolor='#ffbc5b' style='color:".$font_color.";' valign='middle' >".($i - $startday + 1)."<br/><div style='background-color:".$color."; font-size:11px; font-weight:bold;'>".$noOfRoom. "</div></td>";
								
						}else{
							if($time > strtotime($date_form.($i - $startday + 1))){
								
								if($today == $date_form.($i - $startday + 1)){
									$color = '#36a4ed';
									$font_color="#000000";
								}else{
									$color = '#f2f2f2';
									$font_color="#ababac";
								}
							}
							
							echo "<td align='center' valign='middle' >". ($i - $startday + 1) ."<br/><div style='background-color:".$color."; font-size:11px; font-weight:bold; color:".$font_color."; '>".$noOfRoom. "</div></td>";
						}
					}
				}
				for($td=$no_of_td; $td<38-1; $td++){  
					echo "<td></td>"; 
				}
				 echo "</tr> <tr><td colspan=\"37\"><hr></td></tr>"; 
			}
		 ?>
      <tr>
       <td colspan="37"></td>
      </tr>
      <tr>
       <td colspan="37"></td>
      </tr>
     </table></td>
   </tr>
  </table>
  <table cellpadding="3" cellspacing="0" width="100%">
   <tr>
    <td colspan="3"><b>LEGEND:</b></td>
   </tr>
   <tr>
    <td width="20px" height="22px"><div style="background-color:#36a4ed">&nbsp;</div></td>
    <td>CURRENT DATE</td>
    <td></td>
   </tr>
   <tr>
    <td width="20px" height="22px"><div style="background-color:#cfcfcf">&nbsp;</div></td>
    <td>PAST DATE</td>
    <td></td>
   </tr>
   <tr>
    <td width="20px" height="22px"><div style="background-color:#bffcc1">&nbsp;</div></td>
    <td>ALL AVAILABLE</td>
    <td></td>
   </tr>
   <tr>
    <td width="20px" height="22px"><div style="background-color:#f3747f">&nbsp;</div></td>
    <td>NOT AVAILABLE</td>
    <td valign="baseline" align="right"></td>
   </tr>
  </table>
 </form>
</div>

<?php include("footer.php"); ?>
