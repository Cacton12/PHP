<?php 
include("connect.php"); 
include("Users.php");
?>
<?php
//verify the user's login credentials. if they are valid redirect them to index.php/
//if they are invalid send them back to login.php
session_start();
if (isset($_POST["username"], $_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
}

$sql = "SELECT `user_id`, `first_name`, `last_name`, `screen_name`, `password`, `address`, `province`, `postal_code`, `contact_number`, 
`email`, `url`, `description`, `location`, `date_created`, `profile_pic` FROM `users` WHERE `screen_name` = '$username'";

$result = mysqli_query($con, $sql);
if (mysqli_affected_rows($con) == 1) {
    $row = mysqli_fetch_assoc($result);
    $user = new users(
        $row['user_id'], $row['password'], $row['first_name'], $row['last_name'], $row['screen_name'], $row['email'], $row['contact_number'], $row['address'],
        $row['postal_code'], $row['province'], $row['location'], $row['profile_pic'], $row['description'], $row['url']
    );
        $_SESSION["user_id"] = $user->userId; 
    if ($user->UserName == $username && password_verify($password, $user->Password)) {
        $msg = "Login successful";
        header("location:Index.php?message=$msg");
        exit();
    } else {
        echo "<script>
            alert('Incorrect username or password please try again || password: $password username: $username dbUsername: $user->screen_name dbpassword: $user->Password');
            
            window.location.href = 'Login.php';
          </script>";
    }
} else {
    echo "<script>
            alert('Incorrect username or password please try again');
            window.location.href = 'Login.php';
          </script>";
}
?>