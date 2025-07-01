<?php
    session_start(); // to get error message if the user want to register with exsisting email 
    function handleData($data){
        // to remove spaces
        $data = trim($data);
        // remove backslashes
        $data = stripslashes($data);
        // special characters does not get treated as HTML or script code
        // example :
        // $userInput = "<script>alert('XSS Attack!');</script>";
        //echo htmlspecialchars($userInput); 
        $data = htmlspecialchars($data);

        return $data;
    }
    $fname_error = $sname_error = $email_error = $password_error = $lemail_error = $lpassword_error = "";
    $Fname = $Lname = $email = $password1 = $password2 = $lemail = $lpassword = "";
    $error = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["form_type"]) && $_POST["form_type"] == "register"){

        $Fname = $_POST["firstName"];
        $Lname = $_POST["lastName"];
        $email = $_POST["email"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];

        if($Fname == "")
          $fname_error = "enter your first name please from php";
        if($Lname == "")
          $sname_error = "enter your last name please from php";

          if (empty($email)) {
            $email_error = "enter your email please from php";
          }
          else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_error = "Enter a valid email address from php" ;
          }

        if($password1 == "")
          $password_error = "enter your first feild password please from php";
        else if($password2 == "")
        $password_error = "enter your second feild password please from php";
        else if(strlen($password1) < 8  || strlen($password2) < 8 )
        $password_error = "at least 8 chars";
        else if($password1 != $password2)
          $password_error = "passwords does not match from php";

        if($fname_error || $sname_error || $email_error || $password_error)
          $error = true;
    }
    else if(isset($_POST["form_type"]) && $_POST["form_type"] == "login"){
        $lemail = $_POST["Lemail"];
        $lpassword = $_POST["Lpassword"];

        if($lemail == "")
          $lemail_error = "enter your email plesase";
          else if( !filter_var($lemail, FILTER_VALIDATE_EMAIL)){
            $lemail_error = "Enter a valid email address from php" ;
          }
        if($lpassword == "")
          $lpassword_error = "enter your password please";

        if($lemail_error || $lpassword_error)
          $error = true;
    }

    if(!$error){
      if($_POST["form_type"] == "register"){
        $_SESSION["email"] = handleData($email);
          $_SESSION["fname"] = handleData($Fname);
          $_SESSION["lname"] = handleData($Lname);
          $_SESSION["password"] = handleData($password1);
          header("Location: handle/register.php");
          exit();
        }
      else if($_POST["form_type"] == "login"){
        $_SESSION["email"] = handleData($lemail);
        $_SESSION["password"] = handleData($lpassword);
          header("Location: handle/login.php");
          exit();
        }
    }
}
$EmailOrHandleAlreadyExsist = "";
$loginError = "";
$OTPError = "";
if(isset($_SESSION["errorexsists"]) && $_SESSION["errorexsists"] === true) 
  $EmailOrHandleAlreadyExsist = "email or handle already exists";


if(isset($_SESSION["login_error"]) && $_SESSION["login_error"] === true)
  $loginError = "email or user name is not correct";

if(isset($_SESSION["WrongOTP"]) && $_SESSION["WrongOTP"] === true)
  $OTPError = "wrong otp try out again";


unset($_SESSION["errorexsists"]);
unset($_SESSION["login_error"]);
unset($_SESSION["WrongOTP"]);


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Facebook</title>
    <!-- font awsome css file linker -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- main css file -->
    <link rel="stylesheet" href="css/loginAndSignup.css" />
  </head>
  <body>
    <!-- start header -->
    <div class="header">
      <div class="logo">
        <a href="home.php"><h2>Amigolink</h2></a>
      </div>
      <div id="dark-mode" class="dark-mode">
        <i class="fa-solid fa-moon"></i>
      </div>
      <div id="light-mode" class="light-mode">
        <i class="fa-solid fa-sun"></i>
      </div>
    </div>
    <!-- end header -->
    <!-- start landing -->
    <div class="landing">
      <div class="form" id="form">
        <!-- start register form / sign up form -->
        <form class="register-form" id="register-form" method="POST">
            <!-- to know if the request is from the first form or seocnd form -->
            <div class="email-exsist-error"> <?php echo isset($EmailOrHandleAlreadyExsist) ? $EmailOrHandleAlreadyExsist : ""; ?></div>
        <input type="hidden" name="form_type" value="register">
          <h2>Register</h2>
          <input id="first-name" name="firstName" type="text" placeholder="First Name *" />
          <div class="first-name-error"><?php echo isset($fname_error) ? $fname_error : ""; ?></div>
          <input name="lastName" id="second-name" type="text" placeholder="handle*" />
          <div class="last-name-error"><?php echo isset($sname_error) ? $sname_error : ""; ?></div>
          <input name="email" id="email" type="text" placeholder="Email *" />
          <div class="email-error"><?php echo isset($email_error) ? $email_error : ""; ?></div>
          <input name="password1" id="type-password" type="password" placeholder="Password *" />
          <input
          name="password2"
            id="retype-password"
            type="password"
            placeholder="Rewrite-Password *" />
          <div class="password-error"><?php echo isset($password_error) ? $password_error : ""; ?></div>
          <div class="submit">
            <div class="s">
              <input id="submit" type="submit" value="Create" />
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
          <p class="message">
            Already registered? <a href="#" id="signin">Sign In</a>
          </p>
        </form>
        <!-- end register form / sign up form -->
        <!-- start login form -->
        <form class="login-form" id="login-form" method="POST">
            <!-- to know if the request is from the first form or seocnd form -->
            <div class="login-error"><?php echo isset($loginError) ? $loginError : ""; ?></div>
            <div class="otp-error"><?php echo isset($OTPError) ? $OTPError : ""; ?></div>
        <input type="hidden" name="form_type" value="login">
          <h2>Login</h2>
          <input name="Lemail" id="Lemail" type="text" placeholder="Email" />
          <div class="login-email-error"><?php echo isset($lemail_error) ? $lemail_error : ""; ?></div>
          <input name="Lpassword" id="Lpassword" type="password" placeholder="Password" />
          <div class="login-password-error"><?php echo isset($lpassword_error) ? $lpassword_error : ""; ?></div>
          <div class="submit">
            <div class="s">
              <input id="Lsubmit" type="submit" value="Sign in" />
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>

          <p class="message">
            Not registered?
            <a href="#" id="createaccount">Create an account</a>
          </p>
          <div class="forget">
            <a href="handle/forgetPassword.html">forget password?</a>
          </div>
        </form>
        <!-- end login form -->
      </div>
    </div>
    <!-- end landing -->

    <!-- link jquery file  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- link main js file -->
    <script src="js/loginAndSignup.js"></script>

  </body>
</html>
