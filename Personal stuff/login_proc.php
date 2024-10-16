<?php include("connect.php"); ?>

<?php
if (isset($_POST["username"], $_POST["password"])) { //only run this if the form was submitted via POST
    $password = $_POST["password"];
    $username = $_POST["username"];
    AddRecord($con, $password, $username);
}

// Type-hinting will throw an exception if them type doesnt match
function AddRecord($con, $password, $username) {
    //insert statement
    $sql = "INSERT INTO `users`(`Password`, `Username`) VALUES ('$password', '$username')";

    //run the sql
    mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
        $msg = "Insert successful";
        header("location:index.php?message=$msg");
        exit();
    }
    else { //some kind of problem
        $msg = "insert failed";
    }
    echo $msg;
    //redirect the user back to the form
    header("location:Practice_login.php?message=$msg");
}
?>