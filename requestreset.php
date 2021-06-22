<?php


  // Initialize sessions
  session_start();
 /* $host       = "localhost"; 
$username   = "root"; 
$password   = "";
$database   = "dummy";
$conn = mysqli_connect($host,$username,$password,$database) or die(mysqli_error($conn)); */


require_once 'config/config_db.php';
if(isset($_POST["submit"])){

  $useremailrquery = mysqli_query($conn,"SELECT * FROM user");
  $row = mysqli_fetch_array($useremailrquery);

  $emailTo = $_POST['email'];
  if( $row["email"]==$emailTo){
  $code= uniqid(true);
  $query= mysqli_query($conn,"INSERT INTO resetpasswords(code,email) VALUES('$code','$emailTo')");
  if(!$query){
    exit("error");
  }
  }
  
  namespace MyProject;

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'class.phpmailer.php';
require 'class.smtp.php';
require 'PHPMailerAutoload.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
    //Load Composer's autoloader
//require 'vendor/autoload.php';



    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'omairmansha@gmail.com';                     //SMTP username
        $mail->Password   = 'umairchaudhary';                               //SMTP password
        $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('omairmansha@gmail.com', 'UCP');
        $mail->addAddress("$emailTo");     //Add a recipient
        
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');
      

                
        //Content
        $url= "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetpassword.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset LINK';
        $mail->Body    = "<h1>You request a passsoword reset </h1>
                            CLICK <a href='$url'>This Link</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


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
                     <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
              <input type="submit"  class="btn btn-block btn-outline-primary" name="submit" value="Submit">
            </div>
            </form>
    </section>
  </main>
</body>
</html>