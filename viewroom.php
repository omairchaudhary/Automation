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
	<title>Veiw and Manage a Room</title>
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
  <li>View Room</li>
</ul>
<table width="60%" cellpadding="10px" border="1px solid" align="center">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Building Name</th>
		<th>Room Type</th>
		<th>Manage</th>
	</tr>
<?php
$sql = "SELECT * FROM rooms order by id asc";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($room = mysqli_fetch_array($result)) {
	$rsid = $room['id'];
	$rname = $room['name'];
	$rbuildid = $room['building_id'];
	$rtypeid = $room['room_type'];
$buildquery = mysqli_query($conn, "SELECT * FROM `buildings` where id = $rbuildid") or die(mysqli_error($conn));

$buildresult = mysqli_fetch_array($buildquery);
	$rbuildname = $buildresult['name'];
	/*if(!$rbuildname)
	{
		$qquery = mysqli_query($conn, "DELETE  FROM 'rooms' where id = $rtypeid") or die(mysqli_error($conn));
	}*/
$typequery = mysqli_query($conn, "SELECT * FROM `room_types` where id = $rtypeid") or die(mysqli_error($conn));
$typeresult = mysqli_fetch_array($typequery);
	$rtypename = $typeresult['name'];
?>
	<tr>
		<td><?php echo $rsid;?></td>
		<td><?php echo $rname;?></td>
		<td><?php echo $rbuildname;?></td>
		<td><?php echo $rtypename;?></td>
		<td><a href="rooms.php?id=<?php echo $rsid;?>">Manage</a> <a href="addtime.php?id=<?php echo $rsid;?>">Schedule</a><a href="viewroom.php?delete=<?php echo $rsid;?>"> Remove</a></td>
	</tr>
<?php }?>
</table>
<?php
if(isset($_GET['delete'])){
			$id = $_GET['delete'];
			$delete = "DELETE FROM `rooms` WHERE id = '$id' limit 1";
			mysqli_query($conn, $delete);
		header("location:viewroom.php?success=1");
	}
		?>
</body>
</html>
