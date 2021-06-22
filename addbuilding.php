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
	<title>Add Room Type</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include('attach/header.php');?>
<div class="container">
<ul class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li>Buildings</li>
  <li>Add Building</li>
</ul>
<?php if(isset ($_POST['addbuilding'])){
	$bname = mysqli_real_escape_string($conn, $_POST['bname']);
		$sql="INSERT into `buildings`(`name`) VALUES('$bname')";
		$result = mysqli_query($conn, $sql) or die('');
		if(!$result){
			echo "Fail";
	 }
	 else{
	 echo '<div class="success">You have inserted Building successfully</div>';
	 }
}
?>
<form method="POST" enctype="multipart/form-data" action="" name="addroom_type">
	<table cellpadding="5" align="center" width="100%" class="fields-table">
		<tr>
			<th>Enter Building Name</th>
		</tr>
		<tr>
			<td><input type="text" name="bname" required></td>
		</tr>
		<tr><td><button type="submit" name="addbuilding" class="addButton">Submit</button></td></tr>
	</table>
</form>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>
</html>
