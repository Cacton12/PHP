<?php
//update a record into the customers table and then redirect the user back to index.php with an appropriate message
//make sure you have logic in Yoga_proc.php to move the PDF file to he consentforms folder and delete the original temp file
 
$sql = "UPDATE `customers` SET `id`='?',`name`='?',`email`='?',`consentfile`='?' WHERE `email` = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('issss', $category);
$stmt->execute();