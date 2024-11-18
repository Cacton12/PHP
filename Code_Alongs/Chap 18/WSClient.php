<?php
//Amazon Web Services and Google and others are using Web Services alot
//curl api is a versatile set of libraries for PHP to send/receive data
$format = "json"; //or json
$celsius = -10;
$url = "http://localhost/codealongs/ch18-WS/MyWebService.php?celsius="
    . $celsius . "&format=" . $format;
$cobj = curl_init($url); //initialize the curl object

//set the option to return the data to the request instead of displaying it on screen
curl_setopt($cobj, CURLOPT_RETURNTRANSFER, 1);

$data = curl_exec($cobj); //execute the curl object
//echo $data;
if ($format == "json") {
    $object = json_decode($data);
    //print_r($object); //for debugging
    echo "Value in fahrenheit is " . $object->{"value"};
} else if ($format == "xml") {

    $xmlObject = simplexml_load_string($data);
    echo "Value in fahrenheit is " . $xmlObject->value; //for debugging
} else { //just in case an invalid format is sent to the web service
    $xmlObject = simplexml_load_string($data);
    echo "ERROR " . $xmlObject->value;
}
/***** use this line of code to call the open weather API
$url = "api.openweathermap.org/data/2.5/weather?q=Fredericton&units=metric&APPID=45bfb762ed60106a45fd68fdcc0848fa";
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Chapter 18-Calling a WebService with AJAX</title>
    <script>
        function convertTemp() {

            let tempC = document.querySelector("#txtTemp").value;
            console.log("temp in celsius is " + tempC);  //for debugging
            // *** ADD AJAX CODE HERE ***
            if (tempC !== "") {
                const format = "json"
                cosnt url = "http://localhost/codealongs/ch18-WS/MyWebService.php?celsius="
                . celsius . "&format=" . format;
                const response = await fetch(url);

                if (format == "xml") {
                    const xmlText = await response.text();
                    cont xmlDoc = new DOMParser().parseFromString(xmlText, "application/xml");
                    const tempF = xmlDoc.querySelector("value").textContent;
                    document.querySelector("#spnF").innerText = tempF;
                }
                else {
                    const text = await response.json();
                    document.querySelector("#spnF").innerText = text.value;
                }
            }
            else {
                document.querySelector("#spnF").innerText = ""; //clear the span 
            }
        }
        window.onload = function () { //this onload event will execute when the page loads
            document.querySelector("#txtTemp").onkeyup = convertTemp; //this will "wire" the function to the click event of the button
        };//end onload
    </script>
</head>

<body>
    <form>
        <label>Enter a temperature in Celsius</label>
        <input type="text" id="txtTemp"><br>
        <input type="submit"><br>

        The value in fahrenheit is <span id="spnF"></span>
    </form>
</body>

</html>