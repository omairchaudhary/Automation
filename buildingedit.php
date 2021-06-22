<?php include('config/config_db.php');
session_start();
if($_SESSION['loggedin'] != true){
	header("location:login.php");
}
$buildingid = "";
$buildingname = "";
if (isset($_GET['id'])) {
	$bid = $_GET['id'];
	$query = "SELECT * FROM `buildings` where id = '$bid' limit 1";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$building = mysqli_fetch_array($result);
	$buildingid = $building['id'];
	$buildingname = $building['name'];
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
  <li><a href="viewbuilding.php">View Buildings</a></li>
  <li>Edit <?php echo $buildingname;?></li>
</ul>
<div class="container">
<?php if(isset ($_POST['editbuilding'])){
	$bname = mysqli_real_escape_string($conn, $_POST['bname']);
		$sql="UPDATE `buildings` set `name` = '$bname' WHERE `id` = '$bid' ";
		$result = mysqli_query($conn, $sql) or die('');
		if(!$result){
			echo "Fail";
	 }
	 else{
	 echo '<div class="success">You have updated Building successfully</div>';
	 }
	 header("Refresh:1; url=buildingedit.php?id=".$bid."",true,303);
}
?>
<form method="POST" enctype="multipart/form-data" action="" name="updatebuilding">
	<table cellpadding="5" align="center" width="100%" class="fields-table">
		<tr>
			<th>Building Name</th>
		</tr>
		<tr>
			<td><input type="text" name="bname" value="<?php echo $buildingname;?>" required></td>
		</tr>
		<tr><td><button type="submit" name="editbuilding" class="addButton">Submit</button></td></tr>
	</table>
</form>
</div>
</body>
</html>