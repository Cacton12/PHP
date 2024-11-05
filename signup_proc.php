<?php 
include("connect.php");
include("Users.php");
?>

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

    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
    $newUser = new users(null, $encryptedPassword, $firstname, $lastname, $username, $email, $phone, $address, $postalCode, $province, $location, null, $desc, $url);
    AddRecord($con, $newUser);
}
else {
    echo "CAN'T ACCESS THIS PAGE DIRECTLY";
}
function AddRecord($con, $newUser) {
        $password = mysqli_real_escape_string($con, $newUser->Password);
        $firstName = mysqli_real_escape_string($con, $newUser->FirstName);
        $lastName = mysqli_real_escape_string($con, $newUser->LastName);
        $userName = mysqli_real_escape_string($con, $newUser->UserName);
        $email = mysqli_real_escape_string($con, $newUser->email);
        $phone = mysqli_real_escape_string($con, $newUser->ContactNo);
        $address = mysqli_real_escape_string($con, $newUser->Address);
        $postalCode = mysqli_real_escape_string($con, $newUser->postalCode);
        $province = mysqli_real_escape_string($con, $newUser->Province);
        $location = mysqli_real_escape_string($con, $newUser->Location);
        $profImage = mysqli_real_escape_string($con, $newUser->profImage);
        $description = mysqli_real_escape_string($con, $newUser->description);
        $url = mysqli_real_escape_string($con, $newUser->url);
    $sql = "INSERT INTO users(first_name, last_name, screen_name, password, address, province, postal_code, contact_number, email, url, description, location, date_created, profile_pic) 
            VALUES ('$firstName','$lastName','$userName','$password','$address','$province','$postalCode','$phone','$email','$url','$description','$location',NOW(), NULL)";
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
