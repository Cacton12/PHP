<?php
include("connect.php");
include("Users.php");

require_once('E:\Xampp\htdocs\includes\Fedex\fedex-common.php');
$path_to_wsdl = "includes\Fedex\wsdl\CountryService\CountryService_v5.wsdl";

ini_set("soap.wsdl_cache_enabled", "0");

$client = new SoapClient($path_to_wsdl, array('trace' => 1));
function validatePostalCode($postalCode, $countryCode)
{
    global $client;

    $request['WebAuthenticationDetail'] = array(
        'ParentCredential' => array(
            'Key' => getProperty('parentkey'),
            'Password' => getProperty('parentpassword')
        ),
        'UserCredential' => array(
            'Key' => getProperty('key'),
            'Password' => getProperty('password')
        )
    );

    $request['ClientDetail'] = array(
        'AccountNumber' => getProperty('shipaccount'),
        'MeterNumber' => getProperty('meter')
    );
    $request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Validate Postal Code Request using PHP ***');
    $request['Version'] = array(
        'ServiceId' => 'cnty',
        'Major' => '5',
        'Intermediate' => '0',
        'Minor' => '1'
    );

    $request['Address'] = array(
        'PostalCode' => 'E3B2X9',
        'CountryCode' => 'CA'
    );

    $request['CarrierCode'] = 'FDXE';


    try {
        $response = $client->validatePostal($request);
        if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
            return true;
        } else {
            return false;
        }
    } catch (SoapFault $exception) {
        return false;
    }
}
if (isset($_POST["username"])) {
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

    $isPostalCodeValid = validatePostalCode($postalCode, 'CA');

    if (!$isPostalCodeValid) {
        header("Location: signup.php?message=Invalid postal code");
        exit;
    }

    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
    $newUser = new users(null, $encryptedPassword, $firstname, $lastname, $username, $email, $phone, $address, $postalCode, $province, $location, null, $desc, $url);
    AddRecord($con, $newUser);
} else {
    echo "CAN'T ACCESS THIS PAGE DIRECTLY";
}


function AddRecord($con, $newUser)
{
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
    } else {
        $msg = "Insert failed";
    }
    echo $msg;

    // Redirect the user back to the form with the message
    header("Location: Login.php?message=$msg");
}
