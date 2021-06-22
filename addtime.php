
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
	<title>Add Time</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">




<?php
//session_start();
//$host       = "localhost";
//$username   = "root";
//$password   = "";
//$database   = "iot";
//$conn = mysqli_connect($host,$username,$password,$database) or die(mysqli_error($conn));

//$query = ("SELECT * FROM schedule");
//$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

if(isset ($_POST['save_dt'])){
	$rooms=$_POST['name'];
	$st_dt = mysqli_real_escape_string($conn, $_POST['start-dt']);
    $ed_dt = mysqli_real_escape_string($conn, $_POST['end-dt']);
		$sql="INSERT into `schedule`(`name`,`start_time`,`end_time`) VALUES('$rooms','$st_dt','$ed_dt')";
		$result = mysqli_query($conn, $sql) or die('');
		if(!$result){
			echo "Fail";
	 }
	 else{
	 echo '<div class="success">You have insert Room Time successfully</div>';
	 }
}
?>


</head>
<body>
	<?php include('attach/header.php');?>
	<ul class="breadcrumb">
	  <li><a href="index.php">Home</a></li>
	  <li>Rooms</li>
	  <li>Schedule Room</li>
	</ul>
<form method="POST" enctype="multipart/form-data" action="" name="addtime">
	<table align="center" width="115.99%" class="fields-table"  cellpadding="20px" border="1px solid">
        <tr>
		    <th>Select Options</th>
		</tr>
        <tr>
			<td><select name="name">
				<option value="">Select Room</option>
				<?php
				 $rquery = "SELECT * from `rooms`";
				 $rresult = mysqli_query($conn, $rquery) or die('');
				    while($roomname = mysqli_fetch_array($rresult)) { ?>
					<option value="<?php echo $roomname['name'];?>"> <?php echo $roomname['name'];?></option>
				     <?php } ?>
			            </select></td>
		                 </tr>
		<tr>
			<th>Start Time</th>
		</tr>
		<tr>
			<td><input type="datetime-local" name="start-dt" required></td>
		</tr>
        <tr>
			<th>End Time</th>
		</tr>
		<tr>
			<td><input type="datetime-local" name="end-dt" required></td>
		</tr>
		<tr>
			<td><button type="submit" name="save_dt" class="addButton">Submit</button></td>
		</tr>

	</table>
</form>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</body>
</html>
