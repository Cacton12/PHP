<?php
/*login_proc/php
1. grab the username/password from the form using $_POST
2. write sql statement to query the users table to see if the record exists
  2.1 if no record found incorrect login info so send back to login give friendly error message
  2.2 if record found, store user_id in session variable and redirect user to index.php

logout.php
3 lines of code to kill the session and redirect the user back to login.php

index.php
1. write an sql statement to get a random list of 3 people to follow from the users table
 1.1 exclude the currently logged in user because they cant follow themselves
 1.2 exclude users they already follow look in files table
 sql statement for 1.1:
  select user_id, first_name, last_name, screen_name, profile_pic from  where user_id != *your user_id* and users order by rand() limit 3

*/

$password = $_POST["txtPassword"];
$password = password_hash($password, PASSWORD_DEFAULT);
echo "Encrypted password: " . $password . "<br>";
echo password_hash("hello", PASSWORD_DEFAULT) . "<br>";
echo password_hash("hello", PASSWORD_DEFAULT) . "<br>";
//use this on login_proc.php
$myGuess = "test";
echo password_verify($myGuess, $password) . "<br>";
?>