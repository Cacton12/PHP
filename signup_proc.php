<?php include("../connect.php"); ?>

<?php
//add code here to process the form and insert a new product record
if (isset($_POST[""])) { //only run this if the form was submitted via POST
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $province = $_POST["province"];
    $postalCode = $_POST["postalCode"];
    $url = $_POST["url"];
    $desc = $_POST["desc"];
    $location = $_POST["location"];
    echo $firstname . "  " . $lastname . "  " . $email . "  " . $username . "<BR>";
    $password . "  " . $confirm . "  " . $phone . "  " . $address . "<BR>";
    $province . "  " . $postalCode . "  " . $url . "  " . $desc . "  " . $location . "<BR>"; //for debugging
    //AddRecord($con, $productId, $category, $description, $price);
    UpdateRecord($con, $, $);
}
else {
    echo "CAN'T ACCESS THIS PAGE DIRECTLY";
}

// Type-hinting will throw an exception if them type doesnt match
function AddRecord($con, int $, $, $, $) {
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

function UpdateRecord($con, $firstname, $lastname, $email, $username, $password, $confirm, $phone, $address, $province, $postalCode, $url, $desc, $location) {
    //update statement
    $sql = "UPDATE `users` SET `first_name`='[$firstname]',`last_name`='[$lastname]',`screen_name`='[$username]',`password`='[ $password]',`address`='[$address]',`province`='[value-7]',`postal_code`='[value-8]',`contact_number`='[value-9]',`email`='[value-10]',`url`='[value-11]',`description`='[value-12]',`location`='[value-13]'"
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
?>