<?php
  // Initialize sessions
  session_start();

require_once 'config/config_db.php';
//if(isset($_SESSION['user_id'])!="") {
  //  header("location: welcome.php");
//}



	 if(isset($_POST['username'])){
	 $username = mysqli_real_escape_string($conn, $_POST['username']);
	 $password = mysqli_real_escape_string($conn, $_POST['password']);
			 $sql = "SELECT * FROM user WHERE name = '$username' AND password = '$password'";
			 $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			 $res = mysqli_num_rows($result);
				 if($res > 0)
				 {
										 header("location:index.php");
										 $_SESSION['loggedin'] = true;
											 $_SESSION['username'] = $username;
											 exit();
				 }else {
?>
						 <div class="wrong"><?php echo "Something Went Wrong!";?></div>
				 <?php
			 } }
			 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign in</title>
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
  <main>
    <section class="container wrapper">
      <h2 class="display-4 pt-3">UCP Automation</h2>

          <p class="text-center">Please fill this form to Login.</p>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">


            <div class="form-group">
             <label for="username">Username</label>
             <input type="text" name="username" id="username" class="form-control" value="" required>
            <!-- <span class="text-danger"><?php if (isset($username_error)) echo $username_error; ?></span>-->
           </div>

           <div class="form-group">
             <label for="password">Password</label>
             <input type="password" name="password" id="password" class="form-control" value="" >
             <!--<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>-->
           </div>

            <div class="form-group">
              <input type="submit"  class="btn btn-block btn-outline-primary" name="login" value="Login">
            </div>
            <p>Forget Password <a href="requestreset.php">Click Here?</a>.</p>
          </form>
    </section>
  </main>
</body>
</html>
