<?php


function p ($myString){
    echo $myString . "<br>";
}
//PREG -pearl-compatiable regualr expressions 
//grep -global regular expression print
$students = array("nick", "Jimmy", "john", "jill");
$foundStudents = preg_grep("/j/i", $students); // i is case insensativiy 
$myString = "Jimmy Johnson";
p(preg_match("/j/", $myString));
p(preg_match_all("/j/", $myString));
$myString = "$******.95";
p(preg_quote($myString));
$myString = "Hello";
$newString = preg_replace("/Hello/", "Goodbye", $myString);
p($newString);
//split
$myString = "May~!~The~!~Force~!~Be~!~With~!~You"; //squiggly bang squiggly
$myArray = preg_split("/~!~/", $myString);
print_r($myArray);
p("");
//comparison
$string1 = "HEllo";
$string2 = "hello";
p(strcmp($string1, $string2));
//tolower
p(strtolower($string2));
//first letter upper case
p(ucfirst($string2));
//htmlentities
// $myString ="<script>alert('Hello')</script>";
p(($myString));
p(htmlentities($myString));

//strip off the html tags 
p(strip_tags($myString));

mysqli_real_escape_string($con, $mySqlStatement);

?>