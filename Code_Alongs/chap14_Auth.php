<?php
session_start(); //don't forget this!!!!
//this is really good way to authenticate someone if you don't have a DB
//associative array to hold username/password info
//unset($_SERVER["PHP_AUTH_USER"]); //log the user out
$valid_passwords = array("jimmy" => "opensesame");
$valid_users = array_keys($valid_passwords); //get the usernames (keys)

echo $_SESSION["name"] . "  name stored in session<BR>"; //get the session variable

$user = $_SERVER['PHP_AUTH_USER']; //the username they entered
$pass = $_SERVER['PHP_AUTH_PW'];    //the password they entered

$validated = in_array($user, $valid_users) && $pass == $valid_passwords[$user];
//echo $validated . "<BR>";
if (!$validated) {
    header("WWW-Authenticate: Basic realm=myRealm");
    header("HTTP/1.0 401 Unauthorized");
    die("NOT AUTHORIZED");
} //end if
echo "<p>Welcome $user, Congrats you are into the system<p>";
//on Y, your login_proc.php page will select from the users table where the screen_name
//  equals whatever they entered and the password equals whatever they entered.
//  if any records come back they are successfully authenticated so use a header 
//  location to redirect them to index.php
//  if NO records found, display an error and ask them to try again.

?>
<a href="logout.php">Click here to logout</a>