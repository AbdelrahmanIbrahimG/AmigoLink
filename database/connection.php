<?php 
$servername = "localhost";
$username = "root";
$password = "boody41596328";
$dbname = "amigolink";

$con = mysqli_connect($servername , $username , $password , $dbname);
if(!$con){
 die("something went wrong" . mysqli_connect_error());
}
