<?php
session_start();
unset($_SERVER["PHP_AUTH_USER"]); //logs the user out

//these 3 lines will be basically your logout.php in Sprint 2
session_unset(); //free all session variables
session_destroy(); //kills the session completely
header("location:chap17-sessions.php");
