<?php 
include("classes/methods.php");
session_start();
if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];

}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["post_id"])){
        $post_id = $_POST["post_id"];
    }
    $likescount = methods::getNumberOfLikesByPostId($post_id);
}
