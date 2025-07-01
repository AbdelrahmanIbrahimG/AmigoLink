<?php 
include(__DIR__ . '/../classes/methods.php');
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}else{
  $user_id = $_SESSION['user_id'];
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["password1"]) && isset($_POST["password2"])){
        $pass1 = $_POST["password1"];
        $pass2 = $_POST["password2"];
        $email = methods::getEmailFromId($user_id);
        methods::updatePassword($email,$pass1);
        $_SESSION["password_updated"] = true;
        header("Location: ../settings.php");
    }
}