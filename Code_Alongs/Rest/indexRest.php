<?php
$url = 'http://localhost/Code_Alongs/Rest/MyRestAPI.php?users/1'; // API endpoint
// Initialize cURL object
$cobj = curl_init($url);

//call the functions
doGet($cobj);
doPost($cobj);
doPut($cobj);
doDelete($cobj);

function doGet($cobj) {
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    $response = curl_exec($cobj);
    echo "Get Response" . $response . "<br>";
}//end get
function doPost($cobj) { 
    $myData = [
        "name" => "John",
        "email" => "john@gmail.com"
    ];
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    curl_setopt($cobj, CURLOPT_POST, true);
    curl_setopt($cobj, CURLOPT_POSTFIELDS, json_encode($myData));
    curl_setopt($cobj, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    $response = curl_exec($cobj);
    echo "Get Response" . $response . "<br>";
} //end post function
function doPut($cobj) { //to UPDATE a user record
    $myData = [
        "name" => "John UPDATED",
        "email" => "john@updated.com"
    ];
    curl_setopt($cobj, CURLOPT_CUSTOMREQUEST, 'PUT'); //return the response as a string
    curl_setopt($cobj, CURLOPT_POST, true);
    curl_setopt($cobj, CURLOPT_POSTFIELDS, json_encode($myData));
    curl_setopt($cobj, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    $response = curl_exec($cobj);
    echo "Get Response" . $response . "<br>";
} //end put
function doDelete($cobj) {
    curl_setopt($cobj, CURLOPT_CUSTOMREQUEST, "DELETE"); //return the response as a string
    curl_setopt($cobj, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    $response = curl_exec($cobj);
    echo "Get Response" . $response . "<br>";
}
// Close cURL
curl_close($cobj);
?>