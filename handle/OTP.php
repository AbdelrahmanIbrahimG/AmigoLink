<?php 

// this script handle the email sending and takes the otp from the user to check it in another php file 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("../phpMailer/src/Exception.php");
require("../phpMailer/src/PHPMailer.php");
require("../phpMailer/src/SMTP.php");





$Toemail = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["email"]) && filter_var($_POST["email"] , FILTER_VALIDATE_EMAIL)!= false)
        {
            $Toemail = $_POST["email"];
            $_SESSION["forgotemail"] = $_POST["email"];

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "abdelrahmanibrahim425@gmail.com";
            $mail->Password = "njmtklatnuxnapmr";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;

            $mail->setFrom("abdelrahmanibrahim425@gmail.com","OTP Verification Code");
            $mail->addAddress($Toemail);
            $mail->isHTML(true);
            $mail->Subject = "Verification Code";

            $OtpList = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            $stringofotp = "";
            for($i = 0 ; $i < 7; $i++){
                $index = random_int(0,strlen($OtpList)-1);
                $stringofotp.=$OtpList[$index];
            }
            
            $mail->Body = $stringofotp;
                $mail->send();

            // we could have used session to check for the otp in the other php script but we used 
            // input hidden method
        }
     
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/all.min.css"/>
    <link rel="stylesheet" href="../css/otp.css" />
    <script defer src="../js/otp.js"></script>
  </head>
  <body>
        <!-- start header -->
        <div class="header">
      <div class="logo">
        <a href="../home.php"><h2>Amigolink</h2></a>
      </div>
      <div class="help">
        <a href="help.html">
            <p>need help </p>
            <span><i class="fa-solid fa-question"></i></span>
        </a>
    </div>
    </div>
    <!-- end header -->
    <div class="cont">
      <div class="container">
        <div class="text">
          <h2>verify your account</h2>
          <p>we emailed you the seven digit code toyour #email</p>
          <p>enter the code to confirm your email</p>
        </div>
        <div class="numbers">
          <form action="OTPChecker.php" method="POST">
          <input type="hidden" name="otp" value="<?php echo isset($stringofotp) ? $stringofotp : '' ?>">
            <input
              class="code"
              type="text"
              min="0"
              max="9"
              placeholder="0"
              name="digit1"
              required />
            <input
              class="code"
              type="text"
              name="digit2"
              min="0"
              max="9"
              placeholder="0"
              required />
            <input
              class="code"
              name="digit3"
              type="text"
              min="0"
              max="9"
              placeholder="0"
              required />
            <input
              class="code"
              type="text"
              name="digit4"
              min="0"
              max="9"
              placeholder="0"
              required />
            <input
              class="code"
              type="text"
              name="digit5"
              min="0"
              max="9"
              placeholder="0"
              required />
            <input
              class="code"
              type="text"
              name="digit6"
              min="0"
              max="9"
              placeholder="0"
              required />
            <input
              class="code"
              type="text"
              name="digit7"
              min="0"
              max="9"
              placeholder="0"
              required />
            <br />
            <div class="submit-button">
              <input id="submit" type="submit" value="verify" disabled />
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
