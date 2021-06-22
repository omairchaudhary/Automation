<?php include('config/config_db.php');
session_start();
if($_SESSION['loggedin'] != true){
	header("location:login.php");
}
$rac = '';
$rfan = '';
$rdoors = '';
$rprojector = '';
$rplight = '';
$rslight = '';
if(isset($_GET['id'])){
	$rid = $_GET['id'];
	$query = "SELECT * from rooms where id = $rid limit 1";
	$rooms = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$room = mysqli_fetch_array($rooms);
	$rname = $room['name'];
	$rac = $room['ac'];
	$rfan = $room['fan'];
	$rdoors = $room['doors'];
	$rprojector = $room['projector'];
	$rplight = $room['plight'];
	$rslight = $room['slight'];
	$rtemp = $room['temperature'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manage Rooms</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include('attach/header.php');?>
<ul class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="viewroom.php">View Rooms</a></li>
  <li>Manage <?php echo $rname;?> Controls</li>
</ul>
<div class="container">
	<?php
	if(isset($_POST['manage_room'])){
		// $r_name = mysqli_real_escape_string($conn, $_POST['r_name']);
		$r_ac = isset($_POST['r_ac']) ? $_POST['r_ac']: "off";
		$r_fan = isset($_POST['r_fan']) ? $_POST['r_fan']: "off";
		$r_doors = isset($_POST['r_doors']) ? $_POST['r_doors']: "off";
		$r_projector = isset($_POST['r_projector']) ? $_POST['r_projector']: "off";
		$rp_light = isset($_POST['rp_light']) ? $_POST['rp_light']: "off";
		$rs_light = isset($_POST['rs_light']) ? $_POST['rs_light']: "off";
		$r_temp = isset($_POST['r_temp']) ? $_POST['r_temp']: '16';
		$sql = "UPDATE `rooms` set
		`ac` = '$r_ac',
		`fan` = '$r_fan',
		`doors` = '$r_doors',
		`projector` ='$r_projector',
		`plight` = '$rp_light',
		`slight` = '$rs_light',
		`temperature`= '$r_temp'
		WHERE `id` = $rid";
		//echo $sql;
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if(!$result){
			echo "Fail";
	 }
	 else{
	 echo '<div class="success">Data Inserted! Page Will Now Refresh Automatically!</div>';
	 }
	 	header("Refresh:1; url=rooms.php?id=".$rid."",true,303);
	}
	?>
	<form method="POST" class="formbuttons" enctype="multipart/form-data" action="" name="addroom_type" style="width:100%;">
	<div class="page-menubtns" style="margin-right: 50px;">
		<div class="optionbtn">
			<span>AC Status <i class="fa fa-thermometer"></i> <br>
				<label class="switch">
				  <input type="checkbox" name="r_ac" value="on" <?php if ($rac == "on"): echo "checked"; ?>
				  <?php endif ?>>
				  <span class="slider round"></span>
				</label>
			</span>
		</div>
		<div class="optionbtn">
			<span>Fan Status <i class="fa fa-fan"></i><br>
				<label class="switch">
				  <input type="checkbox" name="r_fan" value="on" <?php if ($rfan == "on"): echo "checked"; ?>

				  <?php endif ?>>
				  <span class="slider round"></span>
				</label>
			</span>
		</div>
		<div class="optionbtn">
			<span>Door Locks <i class="fa fa-lock"></i><br>
				<label class="switch">
				  <input type="checkbox" name="r_doors" value="on" <?php if ($rdoors == "on"): echo "checked"; ?>

				  <?php endif ?>>
				  <span class="slider round"></span>
				</label>
			</span>
		</div>
		<div class="optionbtn">
			<span>Projector Status <i class="fa fa-parking-circle"></i><br>
				<label class="switch">
				  <input type="checkbox" name="r_projector" value="on" <?php if ($rprojector == "on"): echo "checked"; ?>

				  <?php endif ?>>
				  <span class="slider round"></span>
				</label>
			</span>
		</div>
		<div class="optionbtn">
			<span>Primary Light <i class="fa fa-light"></i><br>
				<label class="switch">
				  <input type="checkbox" name="rp_light" value="on" <?php if ($rplight == "on"): echo "checked"; ?>

				  <?php endif ?>>
				  <span class="slider round"></span>
				</label>
			</span>
		</div>
		
		<div class="optionbtn" style="margin-top: 0px; margin-right:30px;">
			<span>Secondary Light <i class="fa fa-light"></i><br>
			
				<label class="switch">
				  <input type="checkbox" name="rs_light" value="on" <?php if ($rslight == "on"): echo "checked"; ?>
				  <?php endif ?>>
				  <span class="slider round"></span>
				</label>
			</span>
		</div>

	</div>
	
	<div style="margin-right:700px;">
	<div class="clearfix"></div>
	<br>
	<br>
	<h2 class="white">TEMPERATURE:</h2>
	<div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
  		<input type="text" id="number" name="r_temp" value="<?php if ($rac == "on"){echo "$rtemp";} else{
  			echo "AC is Off";}?>" min="16" max="30" <?php if ($rac != "on"){echo "readonly";}?> />
  <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
	<br>
	<br>
	<div style="padding-right:30px;">
		<button type="submit" name="manage_room" class="addButton">Submit</button>
	</div>
</div>
	<br>
	<br>
	<!--// include('chartjs2.html'); -->

	</form>
</div>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
<?php if($rac == "on"){?>
function increaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  //value = isNaN(value) ? 30 : value;
  if(value <= 0){
  	value= value+15;
  }
  if(value > 29){
  	document.getElementById('number').value = '30';
  }else{
  value++;
  document.getElementById('number').value = value;
	}
}
function decreaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 16 : value;
  value < 1 ? value = 1 : '';
  if(value !=16){
  value--;
  document.getElementById('number').value = value;
	}
	else{
  	alert("Minimum Temperature Reached!");
  }
}
<?php } ?>
</script>
<?php include('charttable.php'); ?>
</html>
