<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300;1,700;1,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/admin.css" />
    <style>
        /* Add some basic styles for the table */
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .user-table th, .user-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        /* Style the delete button */
        .delete-button {
            background-color: #ff0000; /* Red color */
            color: #ffffff; /* White text */
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
include('classes/methods.php');

$users = methods::getAllUsers();
echo '<p style="text-align:center;color:red">Admin page';
if (empty($users)) {
    echo "</br></br>No users found.";
} else {
    echo '<div class="user-item">';
    echo '<table class="user-table">';
    echo '<tr>';
    echo '<th>User ID</th>';
    echo '<th>Username</th>';
    echo '<th>Email</th>';
    echo '<th>Handle Name</th>';
    echo '<th>Delete</th>'; // New column header
    echo '</tr>';
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>'.$user['user_id'].'</td>';
        echo '<td>'.$user['username'].'</td>';
        echo '<td>'.$user['email'].'</td>';
        echo '<td>'.$user['handlename'].'</td>';
        echo '<td>';
        echo '<form method="POST" action="admin.php">';
        echo '<input type="hidden" name="user_id" value="' . $user['user_id'] . '">';
        echo '<input type="submit" class="delete-button" value="Delete">';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
}
?>

</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $user_email = $_POST['email'];
        $user_username = $_POST['username'];
        $user_handlename = $_POST['handlename'];
        // Call your method to delete the user
        methods::deleteUser($user_id);
    
        // Redirect back to admin.php or wherever you want after deletion
        header("Location: admin.php");
    }
?>
