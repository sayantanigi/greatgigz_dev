<?php 
include("access.php");
if(isset($_POST['submitRoom'])){
	include("../includes/db.conn.php"); 
	include("../includes/conf.class.php");
	include("../includes/admin.class.php");
	$bsiAdminMain->add_edit_room();
	header("location:room_list.php");	
	exit;
}
include("header.php"); 
include("../includes/conf.class.php");
include("../includes/admin.class.php");
if(isset($_GET['rid']) && $_GET['rid'] != ""){
	$rid = $bsiCore->ClearInput($_GET['rid']);
	$cid = $bsiCore->ClearInput($_GET['cid']);
	if($rid != 0 && $cid != 0){
		$sql=$mysqli->query($bsiAdminMain->getRoomsql($rid, $cid));
		$row = $sql->fetch_assoc();
		$sql1=$mysqli->query($bsiAdminMain->getRoomtypesql($row['roomtype_id']));
		$rowrt = $sql1->fetch_assoc();
		$sql2=$mysqli->query($bsiAdminMain->getCapacitysql($row['capacity_id']));
		$rowca = $sql2->fetch_assoc();
		$roomtypeCombo = $rowrt['type_name'].'<input type="hidden" name="roomtype_id" value="'.$row['roomtype_id'].'" />';
		$capacityCombo = $rowca['title'].'<input type="hidden" name="capacity_id" value="'.$row['capacity_id'].'" />';
	}else{
		$row = NULL;
		$roomtypeCombo = $bsiAdminMain->generateRoomtypecombo();
		$capacityCombo = $bsiAdminMain->generateCapacitycombo();
	}
}else{
	header("location:room_list.php");
	exit;
}
?>  
 <link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
      <div id="container-inside">
      <span style="font-size:16px; font-weight:bold"><?php echo ROOM_ADD_AND_EDIT; ?></span>
      <hr />
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="form1">
          <table cellpadding="5" cellspacing="2" border="0">
            <tr>
              <td><strong><?php echo NUMBER_OF_ROOM;?>:</strong></td> 
              <td valign="middle"><input type="text" name="no_of_room" id="no_of_room" class="required digits" value="<?=$row['NoOfRoom']?>" style="width:50px;" /> &nbsp;&nbsp;<?php echo EXAMPLE; ?>: 1, 2</td><input type="hidden" name="pre_room_cnt" value="<?=$row['NoOfRoom']?>" />
            </tr>
            <tr>
              <td><strong><?php echo ROOM_TYPE_ADD_EDIT;?>:</strong></td>
              <td><?=$roomtypeCombo;?></td>
            </tr>
            <tr>
              <td><strong><?php echo NO_OF_ADULT;?>:</strong></td>
              <td><?=$capacityCombo;?></td>
            </tr>
              <tr>
              <td><strong><?php echo MAX_CHILD_PER_ROOM; ?>:</strong></td>
              <td><input type="text" name="child_per_room" value="<?php echo $row['no_of_child']; ?>" style="width:40px;"/> (<?php echo LEAVE_BLANK_IF_NONE_TEXT; ?>)</td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" value="<?php echo ADD_EDIT_SUBMIT; ?>" name="submitRoom" style="background:#e5f9bb; cursor:pointer; cursor:hand;" /></td>
            </tr>
          </table>
        </form>
      </div>
<script type="text/javascript">
	$().ready(function() {
		$("#form1").validate();
		
     });
         
</script>      
<script src="js/jquery.validate.js" type="text/javascript"></script>
<?php include("footer.php"); ?> 
