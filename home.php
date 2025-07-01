<?php 
include(__DIR__ . '/classes/methods.php');

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}else{
  $user_id = $_SESSION['user_id'];
}
  // if(!empty($posts)){
  // //posts.post_id, posts.post_date, posts.file, posts.content
  //     foreach($posts as $post){
  //         echo $post["post_id"] . " " . $post["post_date"] ." ". $post["post_file"] ." " . $post["content"] . "<br>";
  //     }
  // }

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
    <!-- profile page -->


  </head>
  <body">
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
      <div class="middle">
        <form action="handle/inputdata.php" enctype="multipart/form-data" method="POST">
          <div class="ques">
            <input type="text" name="text" placeholder="what is on your mind <?php echo methods::getNameFromId($user_id)  ?> ?" /> 
            <div class="submit" id="click-post">
              <span>Post</span>
            </div>
            <div class="plus-box" id="plus-box">
              <i class="fa-solid fa-plus"></i>
            </div>
            <input name="iorv" type="file" id="fileInput" accept="image/*,video/*" style="display: none" />
            <input type="submit" id="submit-post" hidden>
          </div>
        </form>
                <!-- start real -->
                <?php 
                  // $posts = methods::getPostsOfUserUsingId(7);
                  $posts = methods::getPostsofFollowing($user_id);
if (!empty($posts)) {
  foreach ($posts as $post) {
      echo '<div class="p-c-container">
        <div class="post-card">
            <div class="left-con">
                <a href="profile.php?user_id='. $post["creator_id"] .'"><img src="images/' . methods::getProfileImageByid($post["creator_id"]) . '" alt="" /></a>
            </div>
            <div class="right-con">
                <div class="userinfo">
                <a href="profile.php?user_id='. $post["creator_id"] .'">' . methods::getNameFromId($post["creator_id"]) . '</a><span> @'. methods::GetHandleById($post["creator_id"] ) .'</span> <span> ' . $post["post_date"] . '</span>
               </div>
              <div class="post-text">
               <p>' . $post["content"] . '</p>
            </div>';

        // Check if the file is an image
              if (pathinfo($post["file"], PATHINFO_EXTENSION) === 'jpg' || pathinfo($post["file"], PATHINFO_EXTENSION) === 'jpeg' || pathinfo($post["file"], PATHINFO_EXTENSION) === 'png') {
                  echo '<div class="image"><img src="userImagesVedios/'. $post["file"] . '" alt="" /></div>';
              } elseif (pathinfo($post["file"], PATHINFO_EXTENSION) === 'mp4') {
                  // Check if the file is a video
                  echo '<div class="video">
                          <video controls autoplay src="userImagesVedios/'. $post["file"] . '"></video>
                        </div>';
              }

          echo '<div class="post-info">
                  <div class="likes"><a href=""><img src="images/like.png" alt="like icon"> <span>'. methods::getNumberOflikesByPostId($post["post_id"]) .' likes</span></a></div>
                        <a href="comment.php?post_id=' . $post["post_id"] . '"&creator_id = " '.$post["creator_id"]  .'"">'. methods::getNumberOfPostComments($post["post_id"])  . ' comments</a>
                      </div>
                    </div>
                  </div>
              </div>';
              
                }
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
    <script src="js/mainpage.js"></script>
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
