<?php
session_start();
unset($_SERVER['PHP_AUTH_USER']);

//these 3 for sprint 2
session_unset(); //free all session variables
session_destroy(); //kills the session completely
header('location: chap17_session.php');