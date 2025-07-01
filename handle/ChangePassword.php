<?php 
include("../classes/methods.php");
session_start();



$email = "";
if(isset($_SESSION["forgotemail"])){
    $email = $_SESSION["forgotemail"];
  }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["password"]) && isset($_POST["confirmPassword"])){
        $pass1 = $_POST["password"];
        $pass2 = $_POST["confirmPassword"];
        if($pass1 == $pass2){
           if(methods::updatePassword($email , $pass1))
            {
                $_SESSION["password_changed"] = true;
                header("Location: ../index.php");
            }
            else 
             $ex  = "an error occured";
        }
        else{
            $notmatch = "passwords does not match";
        }
    }
    else {
        $allfeilds = "please enter all feilds";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/all.min.css"/>
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/changepassword.css"/>
</head>
<body>
        <!-- start header -->
        <div class="header">
      <div class="logo">
        <a href="../home.php"><h2>Facebook</h2></a>
      </div>
      <div class="help">
        <a href="help.php">
            <p>need help </p>
            <span><i class="fa-solid fa-question"></i></span>
        </a>
    </div>
    </div>
    <!-- end header -->
<div class="mainDiv">
  <div class="cardStyle">
    <form action="ChangePassword.php" method="POST" name="signupForm" id="signupForm">
    <div class="notmatchphp"><?php echo isset($notmatch) ? $notmatch : '' ?></div>
    <div class="allfeilds"><?php echo isset($allfeilds) ? $allfeilds : '' ?></div>
    <div class="ex"><?php echo isset($ex) ? $ex : '' ?></div>
      <img src="../images/logoo.png" id="signupLogo"/>
      
      <h2 class="formTitle">
        Login to your account
      </h2>
      
    <div class="inputDiv">
      <label class="inputLabel" for="password">New Password</label>
      <input type="password" id="password" name="password" required>
    </div>
      
    <div class="inputDiv">
      <label class="inputLabel" for="confirmPassword">Confirm Password</label>
      <input type="password" id="confirmPassword" name="confirmPassword">
    </div>
    
    <div class="buttonWrapper">
      <button type="submit" id="submitButton" onclick="validateSignupForm()" class="submitButton pure-button pure-button-primary">
        <span>Continue</span>
      </button>
    </div>
      
  </form>
  </div>
</div>
</body>
</html>