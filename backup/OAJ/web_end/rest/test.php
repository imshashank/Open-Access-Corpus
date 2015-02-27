<?php



$ch = curl_init();
$curlConfig = array(
    CURLOPT_URL            => "http://localhost/corpus/front2/rest/api/get_articles",
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
   
);
curl_setopt_array($ch, $curlConfig);
$result = curl_exec($ch);
curl_close($ch);

$json = json_decode($result, true);

var_dump($json);
?>