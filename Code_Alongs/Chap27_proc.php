<?php include("../connect.php"); ?>

<?php
//add code here to process the form and insert a new product record
if (isset($_POST["txtProdId"])) { //only run this if the form was submitted via POST
    $productId = $_POST["txtProdId"];
    $category = $_POST["txtCategory"];
    $description = $_POST["txtDesc"];
    $price = $_POST["txtPrice"];
    echo $productId . "  " . $category . "  " . $description . "  " . $price . "<BR>"; //for debugging
    //AddRecord($con, $productId, $category, $description, $price);
    UpdateRecord($con, $productId, $category);
}
else {
    echo "CAN'T ACCESS THIS PAGE DIRECTLY";
}

// Type-hinting will throw an exception if them type doesnt match
function AddRecord($con, int $id, $category, $description, $price) {
    //insert statement
    $sql = "INSERT INTO `products`(`ID`,`Category`,`Description`,`Image`,`Price`)VALUES
        ($id, '$category', '$description', '', $price)";
    echo $sql . "  SQL<BR>";  //for debugging

    //run the sql
    mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
        $msg = "Insert successful";
    }
    else { //some kind of problem
        $msg = "insert failed";
    }
    echo $msg;
    //redirect the user back to the form
    header("location:Chap27.php?message=$msg");
}

function UpdateRecord($con, $id, $category) {
    //update statement
    $sql = "update products set Category = '$category' where ID = $id";
    echo $sql . "  SQL<BR>";  //for debugging

    //run the sql
    mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
        $msg = "Update successful";
    }
    else { //some kind of problem
        $msg = "Update failed";
    }
    echo $msg;
    //redirect the user back to the form
    header("location:Chap27.php?message=$msg");
}