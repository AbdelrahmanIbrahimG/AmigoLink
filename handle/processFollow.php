<?php
include(__DIR__ . '/../classes/methods.php');

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["to_follow_user_id"])){
        $toFollow = $_POST["to_follow_user_id"];
    if(isset($_SESSION["user_id"])){
        $follower_id = $_SESSION["user_id"];
    }
    if(isset($follower_id) && isset($toFollow)){
       $isFollower =  methods::checkIfFollowing($follower_id,$toFollow);
       if(!$isFollower)
            methods::follow($follower_id , $toFollow);
        else
            methods::unfollow($follower_id,$toFollow);
            header("Location: ../home.php");
    }
    }
}