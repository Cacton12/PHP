<?php include("connect.php"); ?>
<?php
//add code that will retrieve an email address that will be passed in via the URL querystring. 
//Then use the given email address to query the customers table to see if the email address exists.
// If the email address does exist, echo out “Email exists in our system”. 
//If the email does NOT exist, echo out “Account does not exist”. 
//This page will only be called via AJAX and will never be seen directly by the user.
$email = $_GET["email"];

$sql = "SELECT * FROM `customers` WHERE email = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $email); // Bind $email as a string parameter
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if ($result > 0) {
    echo "Email exists in our system";
} else {
    echo "Account does not exist";
}
