<?php
//internet is stateless - every page has no knowledge of other pages 
session_start(); // use this on every page that requires session variables
echo session_id() . "<br>";
//this is similar to what you will use in login_proc.php
$_SESSION["name"] = "Colby";
echo $_SESSION["name"] . " name stored in session" . "<BR>";

echo session_encode() . "<br>"; // all session variables
echo session_decode(session_encode()); //number of variables in session 

?>
<br>
<a href="logout.php"> Logout</a>