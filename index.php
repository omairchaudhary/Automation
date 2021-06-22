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
	<title>UCP Automation!</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">


	<style>
	#mainpage{
		padding-top: 200px;
	  padding-right: 30px;
	  padding-bottom: 50px;
	  padding-left: 400px;
		font-size: 30px;
	}
	</style>
</head>
<body>
<?php include('attach/header.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="mainpage">
<p style="color:white">
	<!--Welcome to UCP Automation-->
</p>
<p style="color:white">
	<!--Please Select Use the Option Rooms > View Rooms and Control Devices-->
</P>
</div>


</body>
</html>
