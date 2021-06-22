
<?php
require_once 'config/config_db.php';
session_start();
/*$host       = "localhost"; 
$username   = "root"; 
$password   = "";
$database   = "dummy";
$conn = mysqli_connect($host,$username,$password,$database) or die(mysqli_error($conn)); */
if(!isset($_GET["code"]))
{
    exit("CAN'T Find the page you requested");
}

$code = $_GET["code"];
$getemailquery = mysqli_query($conn,"SELECT email FROM resetpasswords where code= '$code'");
if(mysqli_num_rows($getemailquery)==0)
{
    exit("cant find any page");

}
if(isset($_POST["new_password"]))
{
    $pwd = $_POST["new_password"];
     
    $row = mysqli_fetch_array($getemailquery);
    $email = $row["email"];

    $query = mysqli_query($conn,"UPDATE users SET password= '$pwd' WHERE email = '$email'");


    if($query){
        $query= mysqli_query($conn,"DELETE FROM resetpasswords where code= '$code'");
        exit("password updated");
    }
    else{
        exit("something went wrong");
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <style>
    .wrapper{
      width: 500px;
      padding: 20px;
    }
    .wrapper h2 {text-align: center}
    .wrapper form .form-group span {color: red;}
    .d-inline-block align-top{
      display: inline-block;
  margin-left: auto;
  margin-right: auto;

  width:180px;
  height:180px;
    }
  </style>
</head>
<body>
    <main class="container wrapper">
        <section>
            <h2>Reset Password</h2>
            <p>Please fill out this form to reset your password.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" value="">
                    <!--<span class="help-block"><?php echo $new_password_err; ?></span>-->
                </div>
               <!-- <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>-->
                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-primary" value="Submit">
                    <!--<a class="btn btn-block btn-link bg-light" href="welcome.php">Cancel</a>-->
                </div>
            </form>
        </section>
    </main>
</body>

</html>