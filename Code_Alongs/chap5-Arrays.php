<?php
$numbers[0] = 5; //this is an array
$numbers[1] = 8;
$numbers[2] = 3;
//easier way
//$numbers = [5,8,3]; //all on one line
//associative array
$numbers = [9 => 5, 88 => 8, 34 => 3];
$cities = ["Fredericton" =>60000, "Saint John" => 70000, "Moncton" => 80000];
//2-d array
$student = array("Jimmy"=>array(99,88,77),
                "John" => array(55,60,70),
                "Sarah" => array(70,80,90));
//how many elements in our array?
echo count($student) . " number of elements in our array<BR>";
print_r($student); //print out the array (good for debugging)

foreach($student as $s) {
    echo $s[0] . "  " . $s[1]. "  " . $s[2] . "<BR>";
} //end foreach
print_r(array_reverse($numbers));
echo "<BR>";
print_r(array_flip($numbers));
echo "<br>";
array_push($numbers, 50);//add to the end of the array
array_pop($numbers);//remove the last element of the array
array_unshift($numbers, 123); //add to the beginning of the array
array_shift($numbers);// remove from the beginning
print_r($numbers);
echo "<BR>";

//open the file
$students = file("students.txt");
foreach ($students as $s) {
    echo $s . "<BR>";
    list($name, $grade1, $grade2, $grade3) = explode("|", $s);
    echo $name . " " . $grade1 . " " . $grade2 . " ".$grade3."<BR>";
} //end foreach

//search
if (in_array(5, $numbers)) {
    echo "FOUND<BR>";
}
else {echo "NOT FOUND<BR>"; }
//sort
sort($numbers);
print_r($numbers);

$words=array("test1", "test2", "Test10", "test22");
natcasesort($words); //case-insensitive natural sort
print_r($words);
echo "<BR>";

//merge array
$mergedArray = array_merge($numbers, $words);
print_r($mergedArray);