<?php
echo rand(1,6) . "<BR>";
echo getrandmax() . "<BR>";

function MultiplyNumbers(int $x, int $y) { //type-hinting
    return $x * $y;
}

//& makes it by ref so it passes the memory location
function DisplayMessage(string &$msg) {
    $msg = "Bonjour monde";//changing the value here will also change it in the 
            //calling function because it is passed by ref
    echo $msg . "<BR>";
}
//iterative method to solve the problem
/*function Factorial (int $n) {
    $result = 1;
    for ($i=$n; $i>0; $i--) {
        $result *= $i;
    }
    return $result;
}*/

//recursive solution 
//recursive function call themselves
//      must work towards a base case
function Factorial (int $n) {    
    return ($n == 1) ? 1 : $n * Factorial($n - 1); //one line!!!
    /*if ($n ==1) return 1; //base case
    else {
        //echo $n . "<BR>";
        return $n * Factorial ($n -1);
    }*/
}

//pass-by-value is the default
echo MultiplyNumbers(5, 10) . "  product<BR>";
$msg = "Hello world";
DisplayMessage($msg);
echo $msg . "  back in the main<br>";
echo Factorial(6) . "<BR>";
echo "Hello";
?>