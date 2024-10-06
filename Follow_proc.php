<?php include("connect.php"); ?>
<?php
session_start();
$LoggedInUser = $_SESSION['user_id'];

if (isset($_GET['user_id'])) {
    $follow_user_id = $_GET['user_id']; 
}
else{
    header("Location: index.php");
    exit();
}

$sql = "INSERT INTO follows (from_id, to_id) VALUES ('$LoggedInUser', '$follow_user_id')";
    $result = mysqli_query($con, $sql) or die();
    if($result == true){
        echo "<script>
        alert('Succesful follow!');
        window.location.href = 'Index.php';
      </script>";
    }
    else{
        echo "<script>
        alert('failed to follow:(');
        window.location.href = 'Index.php';
      </script>";
    }
//this page will be used when the user clicks on the "follow" button for a particular user
//process the transaction and insert a record into the database, then redirect the user back
// to index.php

?>