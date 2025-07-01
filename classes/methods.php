<?php 
include(__DIR__ . '/../database/connection.php');

define("con",$con);
class methods{
    public static function register($email , $username , $handlename , $password){
        if(self::EmailExistsOrHandle($email , $handlename) || $email == "bodeidris44@gmail.com"){      // we use self instead of this beacuse its static methods in php
            return false;
        }else{
            $password = password_hash($password , PASSWORD_DEFAULT);
            $sqlstat = "INSERT INTO USERS(email,username,handlename,password) values(?,?,?,?)";
            $stat = mysqli_stmt_init(con);
            mysqli_stmt_prepare($stat,$sqlstat);
            mysqli_stmt_bind_param($stat , "ssss",$email , $username ,$handlename , $password);
            mysqli_stmt_execute($stat);
            $userid = mysqli_insert_id(con);
            mysqli_stmt_close($stat);
            return $userid;
        }
    }
    public static function EmailExistsOrHandle($email , $handlename) {
        $query = "SELECT COUNT(user_id) from users where email = ?";
        $query2 = "SELECT COUNT(user_id) from users where handlename = ?";

        $stat = mysqli_stmt_init(con);
        if(mysqli_stmt_prepare($stat , $query)){
            mysqli_stmt_bind_param($stat, "s" ,$email);
            mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
            if($result){
                $row = mysqli_fetch_assoc($result);
                if($row["COUNT(user_id)"] > 0){
                    mysqli_stmt_close($stat);
                    return true;
                }
            }
        }
        if(mysqli_stmt_prepare($stat,$query2)){
            mysqli_stmt_bind_param($stat , "s" , $handlename);
            mysqli_stmt_execute($stat);
            $res = mysqli_stmt_get_result($stat);
            if($res){
                $row = mysqli_fetch_assoc($res);
                if($row["COUNT(user_id)"] > 0)
                {
                    mysqli_stmt_close($stat);
                    return true;
                }
            }
        }
        mysqli_stmt_close($stat);
        return false;
    }
    
    public static function login($email , $password){
        // echo $password ."<br>";
        // $password = password_hash($password, PASSWORD_DEFAULT);
        // echo $password ."<br>";
        // $query = "SELECT id from users WHERE email = ? AND password = ?;";    => invalid beacuse password_hash produce diffrent hash each time
        if ($email == "bodeidris44@gmail.com" && $password == "adminamigolink") {
            // Redirect for admin login
            header("Location: ../admin.php");
            exit(); 
        }else{
        $query = "SELECT user_id , password from users WHERE email = ?";
        $stat = mysqli_stmt_init(con);
        mysqli_stmt_prepare($stat , $query);
        mysqli_stmt_bind_param($stat , "s" , $email );
        mysqli_stmt_execute($stat);
        $result = mysqli_stmt_get_result($stat);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password , $row["password"])) // verify the hashed password
                return $row["user_id"];
        }
        return false;
    }
    }
    public static function updatePassword($email , $newpass){
        $newpass  = password_hash($newpass , PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = ? Where email = ?";
        $stat = mysqli_stmt_init(con);
        if(mysqli_stmt_prepare($stat , $query)){
            mysqli_stmt_bind_param($stat, "ss" , $newpass , $email );
            mysqli_stmt_execute($stat);
            mysqli_stmt_close($stat);
            return true;
        }
        return false;
    }
    public static function getNameFromId($id){
        $query = "SELECT username from users WHERE user_id = ?";
        $stat = mysqli_stmt_init(con);
        mysqli_stmt_prepare($stat , $query);
        mysqli_stmt_bind_param($stat , "i" , $id);
        mysqli_stmt_execute($stat);
        $res = mysqli_stmt_get_result($stat);
        if($res && mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);
            return $row["username"];
        }
        else
        {
            mysqli_stmt_close($stat);
            return false;
        }
    }
    public static function getEmailFromId($id){
        $query = "SELECT email from users WHERE user_id = ?";
        $stat = mysqli_stmt_init(con);
        mysqli_stmt_prepare($stat , $query);
        mysqli_stmt_bind_param($stat , "i" , $id);
        mysqli_stmt_execute($stat);
        $res = mysqli_stmt_get_result($stat);
        if($res && mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);
            return $row["email"];
        }
        else
        {
            mysqli_stmt_close($stat);
            return false;
        }
    }
    // file -> filename   content -> text 
    public static function InserPost($userid,$photopath , $text){
        $currentDate = date('Y-m-d H:i:s');
        $stat = mysqli_stmt_init(con);
        if(isset($photopath) && isset($text)){
            $query = "INSERT INTO posts(user_id , post_date , file , content) values(?,?,?,?)";
            mysqli_stmt_prepare($stat , $query);
            mysqli_stmt_bind_param($stat , "isss" , $userid , $currentDate , $photopath , $text);
            mysqli_stmt_execute($stat);
            mysqli_stmt_close($stat);
        }
        else if(isset($photopath)){
            $query = "INSERT INTO posts(user_id , post_date , file ) values(?,?,?)";
            mysqli_stmt_prepare($stat , $query);
            mysqli_stmt_bind_param($stat , "iss" ,  $userid , $currentDate , $photopath);
            mysqli_stmt_execute($stat);
            mysqli_stmt_close($stat);
        }
        else if(isset($text)){
            $query = "INSERT INTO posts(user_id , post_date , content) values(?,?,?)";
            mysqli_stmt_prepare($stat , $query);
            mysqli_stmt_bind_param($stat , "iss" , $userid , $currentDate , $text);
            mysqli_stmt_execute($stat);
            mysqli_stmt_close($stat);
        }
    }

    public static function getPostsOfUserUsingId($userid){
        $query = "SELECT posts.post_id, posts.post_date, posts.file, posts.content
                    FROM posts
                    JOIN users ON posts.user_id = users.user_id
                    WHERE users.user_id = ?
                    ORDER BY posts.post_date DESC";
        $stat = mysqli_stmt_init(con);
        if(mysqli_stmt_prepare($stat , $query)){
            mysqli_stmt_bind_param($stat , "i" ,  $userid);
            mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
            if($result && mysqli_num_rows($result) > 0){
                $posts = array(); 
                while ($row = mysqli_fetch_assoc($result)) {
                    $posts[] = $row;  // add each post to the array in php done this way
                }
                return $posts;
                 mysqli_stmt_close($stat);
            }
            else
            {
                mysqli_stmt_close($stat);
                return [];
            }
        }
        return false;
        
    }
    public static function getPostByPostId($postId) {
        $query = "SELECT user_id, post_id, post_date, file, content
                    FROM posts
                    WHERE post_id = ?";     
        $stat = mysqli_stmt_init(con);
        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "i", $postId);
                        mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
            if ($result && $row = mysqli_fetch_assoc($result)) {
                mysqli_stmt_close($stat);
                    return $row;
            } else {
                mysqli_stmt_close($stat);
                return false;
            }
        }
        return false;
    }
    
    public static function getProfileImageByid($id){
        $query = "SELECT profileimage FROM users WHERE user_id = ?";
        $stat = mysqli_stmt_init(con);
    
        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "i", $id);
            mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
    
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                return $row['profileimage'];
            }
        }
    
        return false;
    }
    public static function getBackgroundImageByid($id){
        $query = "SELECT backgroundcover FROM users WHERE user_id = ?";
        $stat = mysqli_stmt_init(con);
    
        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "i", $id);
            mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
    
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                return $row['backgroundcover'];
            }
        }
    
        return false;
    }
    public static function GetNoOfFollowersById($userid){
        $query = "SELECT COUNT(follower_id) from follow WHERE following_id = ?";
        $stat  = mysqli_stmt_init(con);
         mysqli_stmt_prepare($stat , $query);
         mysqli_stmt_bind_param($stat , "i" , $userid);
         mysqli_stmt_execute($stat);
         $res = mysqli_stmt_get_result($stat);
         if($res){
            $row = mysqli_fetch_assoc($res);
           return $row["COUNT(follower_id)"];
         }
         return false;
    }
    public static function GetNoOfFollowingById($userid){
        $query = "SELECT COUNT(following_id) from follow WHERE follower_id = ?";
        $stat  = mysqli_stmt_init(con);
         mysqli_stmt_prepare($stat , $query);
         mysqli_stmt_bind_param($stat , "i" , $userid);
         mysqli_stmt_execute($stat);
         $res = mysqli_stmt_get_result($stat);
         if($res){
            $row = mysqli_fetch_assoc($res);
            return $row["COUNT(following_id)"];
         }
         return false;
    }
    public static function GetHandleById($userId){
        $query = "SELECT handlename FROM users WHERE user_id = ?";
        $stat = mysqli_stmt_init(con);
    
        if(mysqli_stmt_prepare($stat , $query)){
            mysqli_stmt_bind_param($stat , "i" ,  $userId);
            mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
    
            if($result && mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $handle = $row["handlename"];
                mysqli_stmt_close($stat);
                return $handle;
            } else {
                mysqli_stmt_close($stat);
                return false;
            }
        }
        return false;
    }

    public static function getPostsofFollowing($userId) {
        $query = "SELECT posts.post_id, posts.post_date, posts.file, posts.content, users.user_id as creator_id
                  FROM posts
                  JOIN users ON posts.user_id = users.user_id
                  LEFT JOIN follow ON posts.user_id = follow.following_id
                  WHERE follow.follower_id = ?
                  ORDER BY RAND()";
    
        $stat = mysqli_stmt_init(con);
    
        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "i", $userId);
            mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
    
            if ($result && mysqli_num_rows($result) > 0) {
                $posts = array();
    
                while ($row = mysqli_fetch_assoc($result)) {
                    $posts[] = $row;
                }
    
                mysqli_stmt_close($stat);
                return $posts;
            } else {
                mysqli_stmt_close($stat);
                return [];
            }
        }
    
        return false;
    }
    
    
        
    public static function getRandomUsers($userId){
        $query = "SELECT u.user_id, u.username, u.handlename, u.profileimage
                  FROM users u
                  WHERE u.user_id != ? AND u.user_id NOT IN (
                      SELECT f.following_id FROM follow f WHERE f.follower_id = ?
                  )
                  ORDER BY RAND()
                  LIMIT 3";
    
        $stat = mysqli_stmt_init(con);
        mysqli_stmt_prepare($stat, $query);
        mysqli_stmt_bind_param($stat, "ii", $userId, $userId);
        mysqli_stmt_execute($stat);
        $res = mysqli_stmt_get_result($stat);
        $users = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $users[] = $row;
        }
        return $users;
    }
    
    public static function follow($follower_id, $tofollow) {
        $currentDate = date('Y-m-d H:i:s');
        $query = "INSERT INTO follow(follower_id, following_id, follow_date) VALUES (?, ?, ?)";
        $stat = mysqli_stmt_init(con);
        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "iis", $follower_id, $tofollow, $currentDate);
            if (mysqli_stmt_execute($stat)) {

                return true;
            } else {
                return false;
            }
            
        } else {
            return false;
        }
        mysqli_stmt_close($stat);

    }
    public static function checkIfFollowing($loggedInUserId, $userIdToFollow) {
        $query = "SELECT COUNT(*) as count FROM follow WHERE follower_id = ? AND following_id = ?";
        
        $stat = mysqli_stmt_init(con);
        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "ii", $loggedInUserId, $userIdToFollow);
            mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
    
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                mysqli_stmt_close($stat);
    
                return $count > 0;
            }
        }
    
        mysqli_stmt_close($stat);
        return false;
    }
    public static function unfollow($follower_id, $toUnfollow) {
        $query = "DELETE FROM follow WHERE follower_id = ? AND following_id = ?";
        
        $stat = mysqli_stmt_init(con);
        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "ii", $follower_id, $toUnfollow);
            mysqli_stmt_execute($stat);
            mysqli_stmt_close($stat);
        }
    }
    public static function insertComment($postId, $userId, $commentText) {
        $currentDate = date('Y-m-d H:i:s');
        $sql = "INSERT INTO comments (post_id, user_id, content, time) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init(con);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "iiss", $postId, $userId, $commentText, $currentDate);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    
    
    public static function getCommentsByPostId($postId) {
        $query = "SELECT * FROM comments WHERE post_id = ? ORDER BY(time) DESC";
        $stat = mysqli_stmt_init(con);
        if (mysqli_stmt_prepare($stat, $query)) {
             mysqli_stmt_bind_param($stat, "i", $postId);
                if (mysqli_stmt_execute($stat)) {
                    $result = mysqli_stmt_get_result($stat);           
                    if ($result) {
                        $comments = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                        $comments[] = $row;
                    }
                     if (!empty($comments)) {
                        mysqli_stmt_close($stat);
                        return $comments;
                    }
                }
            }
        }
        mysqli_stmt_close($stat);
        return false;
    }
    

    public static function getAllUsers()
    {
        $sql = "select * from users";
        $result = mysqli_query(con, $sql);

    $users = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    return $users;
    }


    public static function deleteUser($user_id)
    {
        $sql = "DELETE FROM users WHERE user_id = ?";
    
        $stmt = mysqli_stmt_init(con);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } 

    }
    public static function getNumberOfPostComments($postId){
        $query = "SELECT COUNT(comment_id) as comment_count FROM comments WHERE post_id = ?";
        $stat  = mysqli_stmt_init(con);
        mysqli_stmt_prepare($stat , $query);
        mysqli_stmt_bind_param($stat , "i" , $postId);
        mysqli_stmt_execute($stat);
        $res = mysqli_stmt_get_result($stat);
        if($res){
            $row = mysqli_fetch_assoc($res);
            return $row["comment_count"];
        }
        return 0; 
    }
    public static function UpdateUserProfileImage($user_id , $imagename){
        $query = "UPDATE users SET profileimage = ? WHERE user_id = ?";
        $stat = mysqli_stmt_init(con);
        if(mysqli_stmt_prepare($stat , $query)){
            mysqli_stmt_bind_param($stat , "si" , $imagename , $user_id);
            mysqli_stmt_execute($stat);
            mysqli_stmt_close($stat);
            return true;
        }
        mysqli_stmt_close($stat);
        return false;
    }
    public static function UpdataUserBackgroundImage($user_id, $backgroundname){
        $query = "UPDATE users SET backgroundcover = ? WHERE user_id = ?";
        $stat = mysqli_stmt_init(con);
        if(mysqli_stmt_prepare($stat, $query)){
            mysqli_stmt_bind_param($stat, "si", $backgroundname, $user_id);
            mysqli_stmt_execute($stat);
            mysqli_stmt_close($stat);
            return true;
        }
        mysqli_stmt_close($stat);
        return false;
    }
    public static function getNumberOfLikesByPostId($postId){
        $query = "SELECT COUNT(like_id) AS like_count FROM likes WHERE post_id = ?";
        $stat = mysqli_stmt_init(con);
    
        if(mysqli_stmt_prepare($stat, $query)){
            mysqli_stmt_bind_param($stat, "i", $postId);
            mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
    
            if($result){
                $row = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stat);
                return $row["like_count"];
            }
        }
    
        mysqli_stmt_close($stat);
        return 0;
    }
    public static function toggleLike($post_id, $user_id) {
        if (self::hasLiked($post_id, $user_id)) {
            self::removeLike($post_id, $user_id);
        } else {
            self::addLike($post_id, $user_id);
        }
    }

    private static function hasLiked($post_id, $user_id) {
        $query = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
        $stat = mysqli_stmt_init(con);
        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "ii", $post_id, $user_id);
            mysqli_stmt_execute($stat);
            $result = mysqli_stmt_get_result($stat);
            $row = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stat);
            return ($row !== null); 
        }
        mysqli_stmt_close($stat);
        return false;
    }

    private static function removeLike($post_id, $user_id) {
        $query = "DELETE FROM likes WHERE post_id = ? AND user_id = ?";
        $stat = mysqli_stmt_init(con);

        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "ii", $post_id, $user_id);
            mysqli_stmt_execute($stat);
            mysqli_stmt_close($stat);
        }
    }

    private static function addLike($post_id, $user_id) {
        $query = "INSERT INTO likes (post_id, user_id) VALUES (?, ?)";
        $stat = mysqli_stmt_init(con);

        if (mysqli_stmt_prepare($stat, $query)) {
            mysqli_stmt_bind_param($stat, "ii", $post_id, $user_id);
            mysqli_stmt_execute($stat);
            mysqli_stmt_close($stat);
        }
    }
}
    

?>