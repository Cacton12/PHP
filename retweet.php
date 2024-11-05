<?php include("connect.php"); ?>
<?php
session_start(); // Make sure to start the session

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}
if (isset($_GET['tweet_id'])) {
    $original_tweet_id = $_GET['tweet_id']; // here we set the original_tweet_id
    $user_id = $_SESSION['user_id'];
    $tweet_text;
    $sql = "INSERT INTO tweets (tweet_text, user_id, original_tweet_id, date_created) VALUES ('$tweet_text', '$user_id', '$original_tweet_id', NOW())";
    
    if (mysqli_query($con, $sql)) {
        $msg = "successful";
        header("Location: Index.php?message=$msg");
    } else {
        echo "<script>
                alert('retweet failed try again');
                window.location.href = 'Index.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid retweet request.');
            window.location.href = 'Index.php';
          </script>";
}
?>