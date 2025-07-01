<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $digit1 = $digit2 = $digit3 = $digit4 = $digit5 = $digit6 = $digit7 = "";
    if (isset($_POST["digit1"])) {
        $digit1 = $_POST["digit1"];
    }
    if (isset($_POST["digit2"])) {
        $digit2 = $_POST["digit2"];
    }
    if (isset($_POST["digit3"])) {
        $digit3 = $_POST["digit3"];
    }
    if (isset($_POST["digit4"])) {
        $digit4 = $_POST["digit4"];
    }
    if (isset($_POST["digit5"])) {
        $digit5 = $_POST["digit5"];
    }
    if (isset($_POST["digit6"])) {
        $digit6 = $_POST["digit6"];
    }
    if (isset($_POST["digit7"])) {
        $digit7 = $_POST["digit7"];
    }
    $originalOTP = "";

    if(isset($_POST["otp"]))
        $originalOTP = $_POST["otp"];

    $userOTP = $digit1.$digit2.$digit3.$digit4.$digit5.$digit6.$digit7;
    
    if(isset($userOTP) && isset($originalOTP)){
        if($userOTP == $originalOTP)
           {
            header("Location: ChangePassword.php");
           }
        else{
            $_SESSION["WrongOTP"] = true;
            header("Location: ../index.php");
        }
    }
    else if(!isset($userOTP))
        {
            $_SESSION["setall"] = true;
            header("Location: OTP.php"); 
        }
}


