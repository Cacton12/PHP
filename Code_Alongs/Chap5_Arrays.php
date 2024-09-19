<?php
$numbers[0] = 1;
$numbers[1] = 2;
$numbers[2] = 3;

$numbers = [1,2,3];

$numbers = [9=>5, 88 => 8, 34 => 3];
$cities = ["fredericton" => 60000, "saint john" => 70000, "moncton" => 80000];

$student = array(
    "jimmy" => array(99,88,77),
    "john" => array(0,0,0),
    "sarah"=> array(0,0,0)
);

echo count($student) . "Number of elements in our array";
print_r($student); //print out the array(good for debugging)

foreach ($student as $s) {
    echo $s[0] ."". $s[1] ."". $s[2] ."<br>";
}
print_r(array_reverse($numbers));
echo "<br>";
print_r(array_flip($numbers)) . "<br>";
array_push($numbers, 50) . "<br>"; //add to the end of the array
array_pop($numbers) . "<br>"; //remove the last element 
array_unshift($numbers, 123);
array_shift($numbers);
print_r($numbers)."<br>";