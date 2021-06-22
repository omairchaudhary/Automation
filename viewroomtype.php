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
	<title>Veiw Room Type</title>
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
  <li>View Room Type</li>
</ul>
<table width="60%" cellpadding="10px" border="1px solid" align="center">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Manage</th>
	</tr>
<?php
$sql = "SELECT * FROM room_types order by id asc";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($roomtype = mysqli_fetch_array($result)) {
	$rtid = $roomtype['id'];
	$rtname = $roomtype['name'];
?>
	<tr>
		<td><?php echo $rtid;?></td>
		<td><?php echo $rtname;?></td>
		<td><a href="roomtype_edit.php?id=<?php echo $rtid;?>">Edit</a> <a href="viewroomtype.php?delete=<?php echo $rtid;?>"> Remove</a></td>
	</tr>
<?php }?>
</table>
<?php
if(isset($_GET['delete'])){
			$id = $_GET['delete'];
			$delete = "DELETE FROM `room_types` WHERE id = '$id' limit 1";
			mysqli_query($conn, $delete);
		header("location:viewroomtype.php?success=1");
	}
		?>
</body>
</html>