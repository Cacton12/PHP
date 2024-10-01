<?php
//internet is stateless - every page has no knowledge of other pages
session_start();// use this on every page that requires session variables
echo session_id() . "<BR>";
//this is similar to what you will use in login_proc.php
$_SESSION["name"] = "Nick"; //set the session variable
echo $_SESSION["name"] . "  name stored in session<BR>"; //get the session variable

echo session_encode() . " ALL MY SESSION VARIABLES<BR>"; //good for debugging
echo session_decode(session_encode()) . " number of variables in session<BR>";
//session variables are used A LOT in shopping carts, online banking, Brightspace,
//  etc to keep track of user preferences etc
//Don't put too much in session variables maybe just user_id, First Name etc.
//  call the database to get anything else you need
?>
<a href="logout.php">Click here to logout</a>