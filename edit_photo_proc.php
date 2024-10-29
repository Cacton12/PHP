<?php include("connect.php"); ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: Login.php");
    exit();
}

if (isset($_POST["submit"])) {
    $user_id = $_SESSION['user_id'];

    // Check if the file is uploaded
    if (empty($_FILES["file"]["name"])) {
        $message = "YOU MUST UPLOAD A PHOTO";
        echo "<script>
            alert('$message');
            window.location.href = 'edit_photo.php';
        </script>";
        exit;
    } else {

        $file_name = $_FILES["file"]["name"];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        // Construct the new file name using the user ID
        $new_file_name = $user_id . '.' . $file_extension; // e.g., 12345.jpg

        // Define the full path for the new file
        $destFile = "E:/Xampp/htdocs/Images/profilepics/" . $new_file_name;
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $destFile)) {
            // Update the user's profile picture in the database
            $sql = "UPDATE `users` SET `profile_pic`='$new_file_name' WHERE `user_id`='$user_id'";
            if (mysqli_query($con, $sql)) {
                // Store the new profile pic in the session
                $_SESSION['profile_pic'] = $file_name;
                $msg = "Profile pic updated successfully";
                header("Location: Index.php?message=" . urlencode($msg));
                exit();
            } else {
                // Handle SQL error
                echo "<script>
                    alert('Could not update profile pic in the database');
                    window.location.href = 'edit_photo.php';
                </script>";
            }
        } else {
            // Handle file upload error
            echo "<script>
                alert('Could not upload the file $destFile');
                window.location.href = 'edit_photo.php';
            </script>";
        }
    }
} else {
    // Redirect back to the form if accessed without form submission
    header("Location: edit_photo.php");
    exit();
}
?>