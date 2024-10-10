<?php
//add code here to process the file upload.
//step 1 - move the file from the TMP directory to it's permanent home, renaming the file if needed
//step 2 - delete the file from the TMP directory if there is an error.
//step 3 - update the users table in the DB with the new file.
//step 4 - redirect the user back to chap15.php

$message = ""; //initialize the variable to send a message back to the main form
//make sure the user can't get here directly by typing it into their browser
if(isset($_POST["submit"])) {
    //attempt to upload file
    echo $message;
    if (empty($_FILES["photo"])) { // Instead of empty($_FILES["photo"])
        $message = "YOU MUST UPLOAD A FILE";
        echo $message;
        exit; //like a break statement
    }//end if
    echo $_FILES["photo"]["size"] . "<BR>"; //for debugging
    echo $_FILES["photo"]["tmp_name"] . "name<br>";
    $MAX_FILE_SIZE = 5 * 1024 * 1024;
    if ($MAX_FILE_SIZE < $_FILES["photo"]["size"]) {
        $message = "File Size must be less than 5MB";
        unlink($_FILES["photo"]["tmp_name"]);
        exit;
    }
    else {
        $destFile = "../images/profilepics/" . $_FILES["photo"]["size"];
        
    }
}//end if

echo $message;