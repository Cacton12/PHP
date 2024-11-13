<?php
//Amazon Web Services and Google and others are using Web Services alot 
//curl api is a versatile set of libraries for php to send/receive data
$format = "xml";
$celsius = 30;
$url = "http://localhost/Code_Alongs/Chap%2018/MyWebService.php?celsius=" . $celsius . "&format=" . $format;

$cobj = curl_init($url);
//set the option to return the data to the request instead of to the screen
curl_setopt($cobj, CURLOPT_RETURNTRANSFER, 1);

$data = curl_exec($cobj); //execute curl object
if($format == 'json'){
    $object = json_decode($data);
    echo "value in fahrenheit is " . $object->{"value"};
}
else if($format == "xml"){
    $xmlObject = simplexml_load_string($data);
    echo "fahrenheit: " . $xmlObject->value;
}
?>