<?php 
include("connect.php");
if (isset($_POST["username"], $_POST["password"], $_POST["email"], $_POST["confirm_password"])) { //only run this if the form was submitted via POST
    $password = $_POST["password"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $conPassword = $_POST["confirm_password"];
    AddRecord($con, $password, $username, $email);
}

// Type-hinting will throw an exception if them type doesnt match
function AddRecord($con, $password, $username, $email) {
    //insert statement
    $sql = "INSERT INTO `users` (`Username`, `Password`, `Email`) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $msg = "Insert successful";
            mysqli_stmt_close($stmt);
            header("Location: LoginPage.php?message=" . urlencode($msg));
            exit();
        } else {
            $msg = "Insert failed: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    } else {
        $msg = "Statement preparation failed: " . mysqli_error($con);
    }
    echo $msg;
    // Redirect the user back to the form
    header("Location: CreateAccount.php?message=" . urlencode($msg));
    exit();
}
?>