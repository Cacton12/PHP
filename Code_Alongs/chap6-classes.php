<?php
include ("Student.php");
$s = new Student(123, "Nick", "Oct 29, 1990", 180, 75);//create an instance of the object
$s->name = "Jimmy"; //call the setter
echo $s->name . "<BR>"; //call the getter
echo $s->toString(); //call a method in the class
PrintDetails($s); //call the local function

echo Student::SCHOOL . "<BR>";
Student::SomeMethod(); //scope resolution operator to access static methods

echo "MAX COURSES " . Student::$maxCourses . "<BR>";
function PrintDetails(Student $myStudent) {//type-hinting
    echo $myStudent->toString(); 
}

