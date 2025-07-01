<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your PHP Page</title>

    <!-- Include Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css"> -->

    <!-- Your custom styles if any -->
    <!-- <link rel="stylesheet" href="path/to/your/style.css"> -->
</head>
<body>
<?php
include('database/connection.php');
if(isset($_POST['input']))
{
    
    $input = $_POST['input'];
    $query = "SELECT * FROM users where username LIKE '{$input}%'";
    $result = mysqli_query($con,$query);
    if(isset($_POST['input']))
    {
        
        $input = $_POST['input'];
        $query = "SELECT * FROM users WHERE username LIKE '{$input}%'";
        $result = mysqli_query($con, $query);
    
        if(mysqli_num_rows($result) > 0){
            while($user = mysqli_fetch_assoc($result))
            {
                ?>
                <div class='card'>
                    <div class='first'>
                        <a href='profile.php?user_id=<?php echo $user['user_id']; ?>'><img src='userImagesVedios/<?php echo $user['profileimage']; ?>' alt='' /></a>
                    </div>
                    <div class='second'>
                        <p><a href='profile.php?user_id=<?php echo $user['user_id']; ?>'><?php echo $user['username']; ?></a></p>
                        <p>@<?php echo $user['handlename']; ?></p>
                    </div>
                    <div class='third'>
                        <form action='handle/processFollow.php' method ='POST'>
                            <input name='to_follow_user_id' type='hidden' value='<?php echo $user['user_id']; ?>'>
                            <input name='follow_submit' id='submit' type='submit' hidden>
                        </form>
                        <button class='follow_btn'>follow</button>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<h6 class='text-danger text-center mt-3'>No Result</h6>";
        }
    }
}
    ?>
    

<!-- Include Bootstrap JS and any other JS files if needed -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- Your custom scripts if any -->
</body>
</html>
