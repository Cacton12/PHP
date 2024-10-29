<?php include("connect.php"); ?>
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
    $user_id = $row['user_id'];
    $passwordInDB = $row['password'];
    $usernameInDB = $row['screen_name'];
    $_SESSION["user_id"] = $user_id;
    if ($usernameInDB == $username && password_verify($password, $passwordInDB)) {
        $msg = "Login successful";
        header("location:Index.php?message=$msg");
        exit();
    } else {
        echo "<script>
            alert('Incorrect username or password please try again');
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