<?php include('config/config_db.php');
session_start();
if($_SESSION['loggedin'] != true){
	header("location:login.php");
}
$roomtypeid = "";
$roomtypename = "";
if (isset($_GET['id'])) {
	$rtid = $_GET['id'];
	$query = "SELECT * FROM `room_types` where id = '$rtid' limit 1";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$roomtype = mysqli_fetch_array($result);
	$roomtypeid = $roomtype['id'];
	$roomtypename = $roomtype['name'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Building</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include('attach/header.php');?>
<ul class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="viewbuilding.php">View Roomtypes</a></li>
  <li>Edit <?php echo $roomtypename;?></li>
</ul>
<div class="container">
<?php if(isset ($_POST['editbuilding'])){
	$rtname = mysqli_real_escape_string($conn, $_POST['roomtypename']);
		$sql="UPDATE `room_types` set `name` = '$rtname' WHERE `id` = '$rtid' ";
		$result = mysqli_query($conn, $sql) or die('');
		if(!$result){
			echo "Fail";
	 }
	 else{
	 echo '<div class="success">You have updated Room Type successfully</div>';
	 }
	 header("Refresh:1; url=roomtype_edit.php?id=".$rtid."",true,303);
}
?>
<form method="POST" enctype="multipart/form-data" action="" name="updatebuilding">
	<table cellpadding="5" align="center" width="100%" class="fields-table">
		<tr>
			<th>Building Name</th>
		</tr>
		<tr>
			<td><input type="text" name="roomtypename" value="<?php echo $roomtypename;?>" required></td>
		</tr>
		<tr><td><button type="submit" name="editbuilding" class="addButton">Submit</button></td></tr>
	</table>
</form>
</div>
</body>
</html>