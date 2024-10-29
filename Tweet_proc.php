<?php include("connect.php"); ?>
<?php
session_start(); // Make sure to start the session

if (isset($_SESSION['user_id'])) {
    if (isset($_POST["myTweet"])) {
        $myTweet = mysqli_real_escape_string($con, $_POST["myTweet"]); // Sanitize input
        $userid = $_SESSION['user_id'];


        $sql = "INSERT INTO `tweets`(`tweet_text`, `user_id`) VALUES ('$myTweet','$userid')";
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die("SQL error: " . mysqli_error($con)); // Display any SQL errors
        }

        if ($result) {
            $msg = "tweet successful";
            header("location:Index.php?message=$msg");
            exit();
        }
    } else {
        echo "<script>
            alert('No tweet to process');
            window.location.href = 'Index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('User not logged in');
        window.location.href = 'Index.php';
    </script>";
}
?>