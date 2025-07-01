<?php
// include(__DIR__."/classes/methods");
include(__DIR__ . '/classes/methods.php');
// methods::InserPost(4,"C:\\xampp\\htdocs\\AmigoLink\\userImagesVedios","this is good");
// $post = methods::getPostsOfUserUsingId(7);
// if(!empty($post)){
// //posts.post_id, posts.post_date, posts.file, posts.content
//     foreach($post as $posts){
//         echo $posts["post_id"] . " " . $posts["post_date"] ." ". $posts["file"] ." " .$posts["content"] . "<br>";
//     }
// }
// else
//     echo "nothing";
// echo methods::getProfileImageByid(7);
$users = methods::getRandomUsers();
foreach($users as $user){
  echo $user["username"] . " " . $user["handlename"] . " " . $user["profileimage"] . "<br>";
}
$r = $user["profileimage"];

    //<?php echo "userImagesVedios/e.png wow" ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="images/<?php echo  $r?>" alt="">
</body>
</html>