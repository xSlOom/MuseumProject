<?php
$url = "https://maps.googleapis.com/maps/api/geocode/json?address=9+bis+rue+des+violettes+Gray&key=AIzaSyBSPF5q5m2uk0mcsHl48SFcCukZ7ksQY_E";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);

$response = json_decode($response);

print_r($response);
?>