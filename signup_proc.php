<?php include("connect.php"); ?>

<?php
//add code here to process the form and insert a new product record
if (isset($_POST["username"])) { //only run this if the form was submitted via POST
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
    AddRecord($con, $firstname, $lastname, $email, $username, $password, $confirm, $phone, $address, $province, $postalCode, $url, $desc, $location);
}
else {
    echo "CAN'T ACCESS THIS PAGE DIRECTLY";
}

// Type-hinting will throw an exception if them type doesnt match
function AddRecord($con, $firstname, $lastname, $email, $username, $password, $confirm, $phone, $address, $province, $postalCode, $url, $desc, $location) {
    //insert statement
    $sql = "INSERT INTO users(first_name, last_name, screen_name, password, address, province, postal_code, contact_number, email, url, description, location, date_created, profile_pic) 
            VALUES ('$firstname','$lastname','$username','$password','$address','$province','$postalCode','$phone','$email','$url','$desc','$location',NOW(), NULL)";
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
    header("location:Login.php?message=$msg");
}
?>
