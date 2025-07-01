<?php 
include(__DIR__ . '/classes/methods.php');

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}else{
  $user_id = $_SESSION['user_id'];
}

$postID = "";
if (isset($_GET['post_id'])) {
    $_SESSION["post_id"] = $_GET['post_id'];
}
$postID = $_SESSION["post_id"];

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["comment"])){
    $comment = $_POST["comment"];
    if($comment != ""){
      methods::insertComment($postID , $user_id , $comment);
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
  </head>
  <body>
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

        <?php
        if($postID != ""){
            $post = methods::getPostByPostId($postID);
            $creator_id = $post["user_id"];
  echo '<div class="p-c-container">
        <div class="post-card">
            <div class="left-con">
                <a href="profile.php?user_id='. $creator_id .'"><img src="userImagesVedios/' . methods::getProfileImageByid($creator_id) . '" alt="" /></a>
            </div>
            <div class="right-con">
                <div class="userinfo">
                <a href="profile.php?user_id='. $creator_id .'">' . methods::getNameFromId($creator_id) . '</a><span> @'. methods::GetHandleById($creator_id ) .'</span> <span> ' . $post["post_date"] . '</span>
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
                  <div class="likes"><a href=""><img src="images/like.png" alt="like icon"> <span>'. methods::getNumberOflikesByPostId($post["post_id"]) .'  likes</span></a></div>
                        <a href="comment.php?post_id=' . $post["post_id"] . '""> '. methods::getNumberOfPostComments($post["post_id"])  . ' comments</a>
                      </div>
                    </div>
                  </div>
              </div>';
            
            }
?>
<div class="comments-container">
  <h2>Comments</h2>
  <div class="addcomment">
            <form action="comment.php" method="POST">
              <input type="text" name="comment" placeholder="Write a Comment" />
              <input type="submit" hidden id="sub">
            </form>
            <div id="post" class="send-btn">
              <span>Post</span>
              <i class="fa fa-paper-plane" aria-hidden="true"></i>
            </div>
          </div>
  <?php    


if($postID != ""){
     $comments = methods::getCommentsByPostId($postID);
     if($comments){
     foreach($comments as $comment){

      $userid = $comment["user_id"];
      $username = methods::getNameFromId($comment["user_id"]);
      $userimage = methods::getProfileImageByid($comment["user_id"]);
      $handlename = methods::GetHandleById($comment["user_id"]);
      $postdate = $comment["time"];
      $content = $comment["content"];


        echo  "<div class='comments'>
        <div class='left-comment'>
          <a href ='profile.php?user_id=". $userid ."'><img src='userImagesVedios/$userimage' alt='userImage' /></a>
        </div>
        <div class='right-comment'>
          <div class='first-row'>
            <span>$username</span>
            <span>$handlename</span>
            <span>$postdate</span>
          </div>
          <div class='content'>$content</div>
        </div>
      </div>";
     }
    }
    }    
?>

</div>

      </div>
      <!-- end middle -->
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
    <script src="js/comment.js"></script>
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
        <script>
    $(document).ready(function() {
        $(".like-btn").on("click", function(e) {
            e.preventDefault();

            var postId = $(this).data("post-id");
            var likeCountElement = $(this).find(".like-count");

            $.ajax({
                url: "togglelike.php",
                method: "POST",
                data: { post_id: postId, action: "like" },
                success: function(response) {
                    if (response.success) {
                        // Like toggled successfully, update the likes count dynamically
                        updateLikesCount(postId, likeCountElement);
                    } else {
                        console.error("Failed to toggle like.");
                    }
                },
                error: function() {
                    console.error("Failed to toggle like. AJAX request failed.");
                }
            });
        });

        // Function to update the likes count
        function updateLikesCount(postId, likeCountElement) {
            $.ajax({
                url: "countlikes.php",
                method: "POST",
                data: { post_id: postId },
                success: function(response) {
                    likeCountElement.text(response.likescount + " likes");
                },
                error: function() {
                    console.error("Failed to get likes count. AJAX request failed.");
                }
            });
        }
    });
</script>

  </body>
</html>
