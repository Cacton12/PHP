<?php
$url = "api.openweathermap.org/data/2.5/weather?q=Fredericton&units=metric&APPID=45bfb762ed60106a45fd68fdcc0848fa";
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($client);
curl_close($client);
$myArray = json_decode($data);
print_r($myArray);
echo "<br><br>";
echo "latitude: " . $myArray->coord->lat . "<br>";
echo "longitude: " . $myArray->coord->lon . "<br>";
echo "Current temp: " . $myArray->main->temp . "<br>";
echo "current weather: " . $myArray->weather[0]->description . "<br>";

foreach($myArray as $x){
    print_r($x);
    echo "<br>";
}

?>