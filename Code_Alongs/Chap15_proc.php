<?php
//add code here to process the file upload.
//step 1 - move the file from the TMP directory to it's permanent home, renaming the file if needed
//step 2 - delete the file from the TMP directory if there is an error.
//step 3 - update the users table in the DB with the new file.
//step 4 - redirect the user back to chap15.php

$message = "Successful";//initialize the variable to send a message back to the main form
//make sure the user can't get here directly by typing it into their browser
if (isset($_POST["submit"])) {
    //attempt to upload the file
    if (empty($_FILES["photo"])) {
        $message = "YOU MUST UPLOAD A PHOTO";
        exit; //like a break. Exit the statement
    }
    echo $_FILES["photo"]["size"] . " size in bytes<BR>";  //for debugging
    echo $_FILES["photo"]["tmp_name"] . " name<BR>";
    //print_r($_FILES);
    $MAX_FILE_SIZE = 5 * 1024 * 1024; //5MB in bytes
    if ($MAX_FILE_SIZE < $_FILES["photo"]["size"]) {
        $message = "File size must be less than 5MB";
        unlink($_FILES["photo"]["tmp_name"]);//delete the temp file
        //exit;
    }
    else {//everything is good
        $destFile = "../images/profilepics/" . $_FILES["photo"]["name"];
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $destFile)) {
            $message = "FILE UPLOADED SUCCESSFULLY";
//use the session variable to get the user id of the currently logged in user
//when you move the file, rename it to $_SESSION["SESSION_USER_ID].jpg
//update the users table with the new file name

        }
        else {
            $message = "ERROR UPLOADING FILE";
            unlink($_FILES["photo"]["tmp_name"]);//delete the temp file
        }
    }
    echo $message;
    header("location:Chap15-Uploads.php?msg=$message");

} //end if
else {
    echo "YOU CAN'T ACCESS THIS PAGE DIRECTLY";
}
