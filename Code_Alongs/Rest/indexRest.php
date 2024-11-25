<?php
$url = 'http://localhost/codealongs/ch18-WS/MyRestAPI.php?users/1'; // API endpoint
// Initialize cURL object
$cobj = curl_init($url);

//call the functions
doGet($cobj);
doPost($cobj);
doPut($cobj);
doDelete($cobj);

function doGet($cobj) {
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    //execute the request
    $response = curl_exec($cobj);
    echo "GET RESPONSE " . $response . "<BR>";

}//end get
function doPost($cobj) { 
    $myData = [
        'name' => 'John',
        'email' => 'john@gmail.com'
    ];
    curl_setopt($cobj, CURLOPT_POST, true); //use the post method
    curl_setopt($cobj, CURLOPT_POSTFIELDS, json_encode($myData));
    //set content type to JSON
    curl_setopt($cobj, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    
    $response = curl_exec($cobj);
    
    echo "GET RESPONSE " . $response . "<BR>";
} //end post function

function doPut($cobj) { //to UPDATE a user record
    $myData = [
        'name' => 'NICK UPDATED',
        'email' => 'nick@updated.com'
    ];
    curl_setopt($cobj, CURLOPT_CUSTOMREQUEST, "PUT"); //use the post method
    curl_setopt($cobj, CURLOPT_POSTFIELDS, json_encode($myData));
    //set content type to JSON
    curl_setopt($cobj, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    
    $response = curl_exec($cobj);
    
    echo "GET RESPONSE " . $response . "<BR>";
} //end put
function doDelete($cobj) {
    curl_setopt($cobj, CURLOPT_CUSTOMREQUEST, "DELETE"); //use the post method
    curl_setopt($cobj, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    
    $response = curl_exec($cobj);
    
    echo "GET RESPONSE " . $response . "<BR>";
} //end delete

// Close cURL
curl_close($cobj);
?>