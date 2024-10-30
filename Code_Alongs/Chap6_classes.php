<?php
include("Student.php");
$s = new Student(123, "Joshua", "July-13-04");
$s->name = "Jimmy";

echo $s->name;

?>