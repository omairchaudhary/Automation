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
	<title>Veiw Buildings</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include('attach/header.php');?>
		                <?php 
			if(isset($_GET['success'])){
				echo '<p id="hide" class="success">Record Deleted Successfully! </p>';
			}
			?>
<ul class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li>View Building</li>
</ul>
<table width="60%" cellpadding="10px" border="1px solid" align="center">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Manage</th>
	</tr>
<?php
$sql = "SELECT * FROM buildings order by id asc";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($building = mysqli_fetch_array($result)) {
	$bdid = $building['id'];
	$bdname = $building['name'];
?>
	<tr>
		<td><?php echo $bdid;?></td>
		<td><?php echo $bdname;?></td>
		<td><a href="buildingedit.php?id=<?php echo $bdid;?>">Edit</a> <!--<a href="viewbuilding.php?delete=<?php echo $bdid;?>"> Remove</a></td>-->
	</tr>
<?php }?>
</table>
<?php
if(isset($_GET['delete'])){
			$id = $_GET['delete'];
			$delete = "DELETE FROM `buildings` WHERE id = '$id' limit 1";
			mysqli_query($conn, $delete);
		header("location:viewbuilding.php?success=1");
	}
		?>
</body>
</html>