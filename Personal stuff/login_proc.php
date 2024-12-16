<?php include("connect.php"); ?>

<?php
if (isset($_POST["username"], $_POST["password"])) { //only run this if the form was submitted via POST
    $password = $_POST["password"];
    $username = $_POST["username"];
    CheckUser($con, $password, $username);
}
function CheckUser($con, $password, $username) {
    $sql = "SELECT * FROM `users` WHERE `Username` = ? AND `Password` = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {
            // Fetch the user record
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if ($password == $user['Password']) {
                header("Location: Notes_Proc.php");
                exit();
            } else {
                $msg = "Invalid password.";
            }
        } else {
            $msg = "User not found.";
        }
    } else {
        $msg = "Database error: " . mysqli_error($con);
    }
    mysqli_stmt_close($stmt);
    header("Location: LoginPage.php?message=" . urlencode($msg));
    exit();
}
?>