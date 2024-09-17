<!DOCTYPE html>
<?php include("../connect.php") ?>
<html>
    <head>
        <title>MY FIRST PHP PAGE</title>
        <script></script>
    </head>
    <body>
        <?php
            //all vars begin with $
            $myName = "Nick"; //this is a string
            $myNum = 10; //int
            //. is string concatenation
            echo $myName . "<BR>";
            print("the number is " . ++$myNum . "<BR>");
            //variable names can't begin with number or special characters
            $Password = "whatever";
            printf("the number is %d<BR>", $myNum);
            echo "She said \"Hello\" to me<BR>";

            //if statement
            //if ($myNum === "11") {//compare type AND data 
            if ($myNum <=> 11) { //spaceship operator
                //spaceship operator returns 0 if the 2 value are equal
                //return 1 if greater than and return -1 if less than
                echo "EQUAL<BR>";
            }
            else {
                echo "NOT EQUAL<BR>";
            }
            $value = (bool)true; //explicit cast
            echo "value = " . $value . "<BR>";
            //implicit cast --- this is using type-juggling
            echo "value of x and y is " . ("10" . "10") . "<BR>";

            $value = 0755; //octal
            $value = 0xabc;// hexidecimal

            //arrays (chapter 5 is all about arrays)
            $names[0] = "Jimmy";
            $names[1] = "Joe";
            for ($i =0; $i<count($names); $i++) {
                echo $names[$i] . "<BR>";
                if ($names[$i] == "Jimmy") {//found it!
                    break;  //exit the loop
                }
            }

            //by ref variables
            $y = &$myName; //points to a memory address, if myName changes, y also changes
            $myName = "Jimmy";
            echo $y . "  BYREF<BR>";

            //while loop
            while ($i <10) {
                $i++; //don't forget this line
                if ($i == 5) {
                    continue; //skip this iteration of the loop and continue
                }
                echo pow($i, 2) . "<BR>";
            }
$i = 0; //re-initialize it back to 0
            //do-while
            do {
                echo pow($i, 3) . "<BR>";
                $i++;
            } while($i<10);


            //select from the products table in the productsdemo schema
            $id = 9;
            $sql = "select * from products where id = $id";
            if ($result = mysqli_query($con, $sql)) {
                while ($row = mysqli_fetch_array($result)) {
                    echo $row["ID"] . "  " . $row["Category"] . "  ". 
                        $row["Description"] . "<BR>";
                }//end while
            }//end if
        ?>
        <p>Your name is <?=$myName?></p>
    </body>
</html>