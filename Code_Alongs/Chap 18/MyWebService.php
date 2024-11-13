<?php
$celsius = $_GET['celsius'];
$format = isset($_GET['format']) ? $_GET['format'] : 'json';
$result = $celsius * 1.8 + 32;

if($format == 'json'){
    header("content-type: application/json");
    echo json_encode(array('value'=>$result));
}
else if($format == 'xml'){
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\"?>";
    echo "<root>";
    echo "<value>" . $result . "</value>";
    echo "</root>";
}
else{
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\"?>";
    echo "<root>";
    echo "<value> invalid format: json or xml </value>";
    echo "</root>"; 
}
?>