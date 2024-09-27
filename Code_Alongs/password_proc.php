<?php
//login_proc.php
//1. grab the username/password from the form using $_POST
//2. write a sql statement to query the users table to see if the record exists
//  2.1 if no record found, return the user to login.php with a friendly error messages.
//  2.2 if record IS found, store user_id in session variable and redirect user to index.php

//logout.php
//3 lines of code to kill the session and redirect the user back to login.php

//index.php
//1. write an sql statement to get random list of 3 users from the users table.
//  1.1 exclude the currently logged in user because they can't follow themself
//  1.2 exclude users they already follow
//select user_id, first_name, last_name, screen_name, profile_pic from users where user_id != 22 and user_id not in
//(select to_id from follows where from_id = 22)
//order by rand() limit 3
//2. Loop through the list to display them in the "Who to Troll" on the index.php
//      with their first name, last name, screen name
//3. You have to build a URL querystring to go to follow_proc.php?user_id=1234 when the 
//  clicks the button
//
//Follow_proc.php
//1. grab the user_id from the URL querystring with $_GET['user_id']
//2. insert into the follow table
//  2.1 the from_id is the currently logged in user (grab from session)
//  2.2 the to_id is the user_id of the person being followed (grab from URL)
//3. redirect them back to index.php with header("location")

//HINT for SPRINT #3-encrypting password
//imagine this is on signup_proc.php
$password = $_POST["txtPassword"];
$password = password_hash($password, PASSWORD_DEFAULT);
echo "encrypted password $password <BR>";
echo password_hash("hello", PASSWORD_DEFAULT) . "<BR>";
echo password_hash("hello", PASSWORD_DEFAULT) . "<BR>";

//use this on login_proc.php
$myguess = "test";
echo password_verify($myguess, $password) . " does it match<BR>";

//chapter 8 - exceptions and errors
//change the config options in php
ini_set("display_errors", 1);
error_reporting(E_WARNING);

try {
    //trigger_error("ERROR", E_ERROR);
    //echo 2+x; //variable doesn't exist so it should throw an exception
    $students =file("students.txt");
    $fh = fopen("asdfasdf.txt", "r"); //open it for read only
    if (!mysqli_connect("localhost", "username", "badpassword", "noschema")){
        throw new Exception("ERROR CONNECTING TO DATABASE");
    } //end if
}
catch (Exception $ex) { //type-hinting
    echo "ERROR ON LINE " . $ex->getLine() . "<br>";
    echo "ERROR MESSAGE " . $ex->getMessage() . "<BR>";
    error_log("ERROR ON LINE " . $ex->getLine() . "<br>");
    error_log("ERROR MESSAGE " . $ex->getMessage() . "<BR>");
}
finally {//optional
    //gets here either way
    //close files, DB connection, network connections
    fclose($students);
    fclose($fh);
}
?>