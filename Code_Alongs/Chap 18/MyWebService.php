<?php 
$celsius = $_GET["celsius"];
$format = isset($_GET["format"]) ? $_GET["format"] : "json";//  xml or json
$result = $celsius * 1.8 + 32; //formula

//echo $result;
//echo $format;
if ($format == "json") {
    header("content-type: application/json");
    echo json_encode(array("value"=>$result));
}
else if ($format == "xml") {
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\"?>";
    echo "<root>";
    echo "<value>" . $result . "</value>";
    echo "</root>";
}
else { //in case they pass an invalid format
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\"?>";
    echo "<root>";
    echo "<value>Invalid format-please enter XML or JSON</value>";
    echo "</root>";
}