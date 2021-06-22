<?php include('config/config_db.php');
session_start();
if($_SESSION['loggedin'] != true){
	header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add Room</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include('attach/header.php');?>
<ul class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li>Rooms</li>
  <li>Add Room</li>
</ul>
<div class="container">
<?php if(isset ($_POST['addrooms'])){
	$building_id = $_POST['building_id'];
	$r_type = $_POST['r_type'];
	$r_name = mysqli_real_escape_string($conn, $_POST['r_name']);
		$sql="INSERT into `rooms`(`building_id`,`room_type`,`name`) VALUES('$building_id','$r_type','$r_name')";
		$result = mysqli_query($conn, $sql) or die('');
		if(!$result){
			echo "Fail";
	 }
	 else{
	 echo '<div class="success">You have insert Room Type successfully</div>';
	 }
}
?>
<form method="POST" enctype="multipart/form-data" action="" name="addroom_type">
	<table cellpadding="5" align="center" width="100%" class="fields-table">
		<tr>
			<th>Select Options</th>
		</tr>
		<tr>
			<td><select name="building_id">
				<option value="">Select Building</option>
				<?php
				$bquery = "SELECT * from `buildings` order by name";
				$bresult = mysqli_query($conn, $bquery) or die('');
				while($buildings = mysqli_fetch_array($bresult)) { ?>
					<option value="<?php echo $buildings['id'];?>"><?php echo $buildings['name'];?></option>
				<?php } ?>
			</select></td>
		</tr>
		<tr>
			<td><select name="r_type">
				<option value="">Select Room Type</option>
				<?php
				$rquery = "SELECT * from `room_types` order by name";
				$result = mysqli_query($conn, $rquery) or die('');
				while($rooms = mysqli_fetch_array($result)) { ?>
					<option value="<?php echo $rooms['id'];?>"><?php echo $rooms['name'];?></option>
				<?php } ?>
			</select></td>
		</tr>
		<tr>
			<th>Enter Room Name</th>
		</tr>
		<tr>
			<td><input type="text" name="r_name" required></td>
		</tr>
		<tr><td><button type="submit" name="addrooms" class="addButton">Submit</button></td></tr>
	</table>
</form>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>
</html>