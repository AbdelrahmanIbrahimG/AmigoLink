<?php
include(__DIR__ . '/classes/methods.php');

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}else{
  $user_id = $_SESSION['user_id'];
}
$userId = isset($_GET['user_id']) ? $_GET['user_id'] : '';


// handle changing photo profile page

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (isset($_FILES["profile-pic-image-file"]) && !empty($_FILES["profile-pic-image-file"])) {
    $file = $_FILES["profile-pic-image-file"];
    if ($file["error"] == UPLOAD_ERR_OK) {
        $fileName = $file["name"];
        $fileType = $file["type"];
        $fileSize = $file["size"];
        $tempFilePath = $file["tmp_name"];

        $uploadDir = "C:\\xampp\\htdocs\\AmigoLink\\userImagesVedios";
        $newFilePath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
        
        $tostore = $fileName;
        if(isset($user_id)){
        move_uploaded_file($tempFilePath, $newFilePath);
        methods::UpdateUserProfileImage($user_id , $tostore);
      }
    }
  }
  if (isset($_FILES["choose-background-image"]) && !empty($_FILES["choose-background-image"])) {
    $file = $_FILES["choose-background-image"];
    if ($file["error"] == UPLOAD_ERR_OK) {
        $fileName = $file["name"];
        $fileType = $file["type"];
        $fileSize = $file["size"];
        $tempFilePath = $file["tmp_name"];

        $uploadDir = "C:\\xampp\\htdocs\\AmigoLink\\userImagesVedios";
        $newFilePath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
        
        $tostore = $fileName;
        if(isset($user_id)){
        move_uploaded_file($tempFilePath, $newFilePath);
        methods::UpdataUserBackgroundImage($user_id , $tostore);
      }

 }
}
} 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>main</title>
    <!-- link google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300;1,700;1,800&display=swap"
      rel="stylesheet" />
    <!-- link fontawsome -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- link main css file -->
    <link rel="stylesheet" href="css/main.css" />
    <!-- link profile css -->
    <link rel="stylesheet" href="css/ProfilePage.css" />

    
  </head>
  <body >
 <!-- start header -->
 <div class="header">
      <div class="container">
      <div class="logo"><a href="home.php"><h2>AmigoLink</h2></a></div>
        <div class="search-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" id="live_search" placeholder="Search" />
          <div id="searchresult"></div>
        </div>

        <div class="open-close-nav-box" id="burger-box">
          <i class="fa-solid fa-bars"></i>
        </div>
        <div id="btns" class="buttons">
          <div id="light-mode" class="box light-mode">
            <i class="fa-solid fa-sun"></i>
          </div>
          <div id="dark-mode" class="box dark-mode" >
             <i class="fa-solid fa-moon"></i>
          </div>
          <div class="box">
            <a href=""><i class="fa-solid fa-bell"></i></a>
          </div>
          <div class="box">
            <a href="profile.php?user_id=<?php echo $user_id ?>"><i class="fa-solid fa-user"></i></a>
          </div>
        </div>
      </div>
    </div>
    <!-- end header -->

    <!-- start main page section -->
    <div class="main">
    <div class="left">
        <ul>
          <li>
            <a href="home.php">
              <div class="box"><i class="fa-solid fa-house"></i></div>
              <span>Home</span>
            </a>
          </li>
          <li>
            <a href="">
              <div class="box"><i class="fa-solid fa-bell"></i></div>
              <span>Notifications</span>
            </a>
          </li>
          <li>
          <a href='profile.php?user_id=<?php echo $user_id ?>'>
              <div class="box"><i class="fa-solid fa-user"></i></div>
              <span>Profile</span>
            </a>
          </li>
          <li>
            <a href="settings.php">
              <div class="box"><i class="fa-solid fa-gear"></i></div>
              <span>Settings</span>
            </a>
          </li>
          <li>
            <a href="include/logout.php">
              <div class="box"><i class="fas fa-sign-out"></i></div>
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </div>
      <?php 
      
      $ProfileImagepath = methods::getProfileImageByid($userId);
      $BackGroundpath = methods::getBackgroundImageByid($userId);
      $UserName = methods::getNameFromId($userId);
      $handle = methods::GetHandleById($userId);
      $noOfFollowers = methods::GetNoOfFollowersById($userId);
      $noOfFollowing = methods::GetNoOfFollowingById($userId);


      ?>
      <div class="middle">
      <div class="headerr">
      <div class="containerr">
        <div class="upperr">
          <?php
              if($userId == $_SESSION["user_id"]){
                echo '
                    <div id="icon-choose-background-image-btn" class="iconn">
                        <i class="fas fa-camera"></i>
                    </div>
                    ';
              }
          ?>
          <img src="userImagesVedios/<?php echo $BackGroundpath ?>" alt="" />
          <?php 
                  if($userId == $_SESSION["user_id"]){
                    echo '<form action="profile.php?user_id='.$user_id.'" method="POST" enctype="multipart/form-data">
                                    <input type="file" hidden name="choose-background-image" id="upload">
                                    <input type="submit" hidden id="choose-background-image-btn">
                          </form>';
                  }
          ?>
        </div>
        <div class="lowerr">
          <div class="imagee">
            <?php 
              if($userId == $_SESSION["user_id"]){
                echo '
                    <div id="icon-profile-image-btn" class="iconn">
                        <i class="fas fa-camera"></i>
                    </div>
                    ';
              }
            ?>
            <img src="userImagesVedios/<?php echo $ProfileImagepath ?>" alt="" />
            <?php 
              if($userId == $_SESSION["user_id"]){
                echo '
                    <form action="profile.php?user_id='. $userId .'" method="POST" enctype="multipart/form-data" >
                        <input id="choose-profile-image" name="profile-pic-image-file" type="file" hidden>
                        <input id="submit-profile-image-btn" type="submit" hidden>
                   </form>
                    ';
              }
            ?>
          </div>
          <div class="info">
            <div><?php echo $noOfFollowing ?> <span>following</span></div>
            <div><?php echo $noOfFollowers ?> <span>followers</span></div>

          </div>
        </div>
        <div class="namess">
          <h1 class="usernamee"><?php echo $UserName ?></h1>
          <p class="handlenamee">@<?php echo $handle ?></p>
        </div>
      </div>
    </div>
    <div class="hr">
      <hr />
    </div>

    <?php 
     $posts =  methods::getPostsOfUserUsingId($userId);
        foreach ($posts as $post) {
      echo '<div class="p-c-container">
              <div class="post-card">
                  <div class="left-con">
                      <a href="profile.php?user_id='. $userId .'"><img src="userImagesVedios/' . methods::getProfileImageByid($userId) . '" alt="" /></a>
                  </div>
                  <div class="right-con">
                      <div class="userinfo">
                      <a href="profile.php?user_id='. $userId .'">' . methods::getNameFromId($userId) . '</a><span> @'. methods::GetHandleById($userId ) .'</span> <span> ' . $post["post_date"] . '</span>
                     </div>
                    <div class="post-text">
                     <p>' . $post["content"] . '</p>
                  </div>';
      
              // check if the file is an image
                    if (pathinfo($post["file"], PATHINFO_EXTENSION) === 'jpg' || pathinfo($post["file"], PATHINFO_EXTENSION) === 'jpeg' || pathinfo($post["file"], PATHINFO_EXTENSION) === 'png') {
                        echo '<div class="image"><img src="userImagesVedios/'. $post["file"] . '" alt="" /></div>';
                    } elseif (pathinfo($post["file"], PATHINFO_EXTENSION) === 'mp4') {
                        // check if the file is a video
                        echo '<div class="video">
                                <video controls autoplay src="userImagesVedios/'. $post["file"] . '"></video>
                              </div>';
                    }
      
                echo '<div class="post-info">
                        <div class="likes"><a href=""><img src="images/like.png" alt="like icon"><span>3 likes</span></a></div>
                        
                        <a href="comment.php?post_id=' . $post["post_id"] . '"&creator_id = " '. $userId  .'"">'. methods::getNumberOfPostComments($post["post_id"])  . ' comments</a>
                    </div>
                </div>
          </div>
      </div>';
      
        }
    
    
    ?>

    </div>

    <div class="right">
      <div class="text"><h2>who to follow</h2></div>
        <?php
        $users = methods::getRandomUsers($user_id);
        foreach ($users as $user) {
            echo "
            <div class='card'>
                <div class='first'>
                    <a href='profile.php?user_id={$user['user_id']}'><img src='userImagesVedios/{$user['profileimage']}' alt='' /></a>
                </div>
                <div class='second'>
                    <p><a href='profile.php?user_id={$user['user_id']}'>{$user['username']}</a></p>
                    <p>@{$user['handlename']}</p>
                </div>
                <div class='third'>
                    <form action='handle/processFollow.php' method ='POST'>
                        <input name = 'to_follow_user_id' type='hidden' value='{$user['user_id']}'>
                        <input name = 'follow_submit' id = 'submit' type='submit' hidden >
                    </form>
                    <button class='follow_btn'>follow</button>
                </div>
            </div>";
        }
        ?>
     </div> 
        
    <!-- end main page section -->
    <script src="js/profile.js"></script>
    <script src="js/handleFollow.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {
              $("#live_search").keyup(function()
              {
                  var input = $(this).val();
                  // alert(input);
                  if(input != "")
                  $.ajax({
                        url:"livesearch.php",
                        method:"POST",
                        data:{input:input},
                          
                        success:function(data){
                          $("#searchresult").html(data);
                          $("#searchresult").css("display","block");
                        }
                  });
                else{
                  $("#searchresult").css("display","none");
                }
              });
        });
        </script>
  </body>
</html>