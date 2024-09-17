<?php
echo rand(min: 1, max: 6) . "<br>";
echo getrandmax() . "<br>";

function MultiplyNumbers($x, $y)
{
    return $x * $y;
}

// & makes it by ref which passes memory location rather than the variable 
function DisplayMessage(string &$message)
{
    $message = "AHHHHHHHHHHH";
    echo $message . "<br>";
}

function Factorial(int $n)
{
    return ($n == 1) ? 1: $n * Factorial($n - 1);
    // if ($n == 1) {
    //     return 1;
    // } else {
    //     return $n * Factorial($n - 1);
    // }
}

echo MultiplyNumbers(5, 10) . " Product<br>";
$message = "Hello World";
DisplayMessage($message);
echo $message . " back in the main<br>";
echo Factorial(7);

