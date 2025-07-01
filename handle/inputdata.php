<?php
session_start();
include(__DIR__.'/../classes/methods.php');
$done = false;
if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["text"]) && !empty($_POST["text"])){
        $text = $_POST["text"];
        $done = true;
    }
    if (isset($_FILES["iorv"]) && !empty($_FILES["iorv"])) {
        $file = $_FILES["iorv"];
        if ($file["error"] == UPLOAD_ERR_OK) {
            $fileName = $file["name"];
            $fileType = $file["type"];
            $fileSize = $file["size"];
            $tempFilePath = $file["tmp_name"];

            // Specify your upload directory

            $uploadDir = "C:\\xampp\\htdocs\\AmigoLink\\userImagesVedios"; // Use double backslashes
            $newFilePath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
            
            $tostore = $fileName;
            // Move the file to the desired location
            move_uploaded_file($tempFilePath, $newFilePath);

            $done = true;
        }

    }     
    if($done)
        methods::InserPost($user_id , $tostore , $text);
     header("Location: ../home.php");


} 
?>
