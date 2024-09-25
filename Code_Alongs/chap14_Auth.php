<?php
//this is a really good way to authenticate some if you dont have a DB
//associative array to hold username/password info

session_start();

$valid_passwords = array("jimmy" => "yes");

$valid_users = array_keys($valid_passwords); //get the usernames (key)

echo $_SESSION["name"] . " name stored in session <br>";

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = in_array($user, $valid_users) && $pass == $valid_passwords[$user];

if (!$validated) {
    header('WWW-Authenticate: Basic realm= myRealm');
    header('HTTP/1.0 401 Unauthorized');
    die('Not Authorized');
}

/*on Y, your login_proc page will select from the users table where the screen_name
equals whatever they entered and the password equals whatever they entered
if no records come back they are successfully authenticated so use a header location to redirect    
*/
?>