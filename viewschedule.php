<?php
include('config/config_db.php');
session_start();
if($_SESSION['loggedin'] != true){
	header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Veiw Schedule</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php include('attach/header.php');?>
	<ul class="breadcrumb">
		<li><a href="index.php">Home</a></li>
		<li>Rooms</li>
		<li>View Schedules</li>
	</ul>

<table width="60%" cellpadding="10px" border="1px solid" align="center">
	<tr>
		<!--<th>ID</th>-->
		<th> Room Name</th>
        <th> Start Time</th>
        <th> End Time</th>
		<th>Manage</th>
	</tr>

    <?php
$sql = "SELECT * from `schedule`";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($R_result = mysqli_fetch_array($result)) {
	$rsid = $R_result['id'];
	$rname = $R_result['name'];
	$st_dt = $R_result['start_time'];
    $ed_dt = $R_result['end_time'];


    //$rquery = mysqli_query($conn, "SELECT * FROM `schedule` where id = $rsid") or die(mysqli_error($conn));
//$R_result = mysqli_fetch_array($rquery);


?>

<tr>
		<!--<td><?php echo $rsid;?></td>-->
		<td><?php echo $rname;?></td>
    <td><?php echo $st_dt;?></td>
		<td><?php echo $ed_dt;?></td>
		<td><a href="viewschedule.php?delete=<?php echo $rsid;?>"> Remove</a></td>
	</tr>

    <?php }?>
</table>
<?php
if(isset($_GET['delete'])){
			$id = $_GET['delete'];
			$delete = "DELETE FROM `schedule` WHERE id = '$rsid' limit 1";
			mysqli_query($conn, $delete);
		header("location:viewschedule.php?success=1");
	}
		?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</body>
</html>
