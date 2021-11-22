<?php

//Detect devices
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");

$fileName = "counter.json";
$fileContents = file_get_contents($fileName);
$decodedData = json_decode($fileContents, true);
$url = "https://www.robostodelivery.com";

// Detect Device
if ($Android) {
    $url = "https://play.google.com/store/apps/details?id=com.robosto";
    $decodedData['android'] += 1;
} else if ($iPod || $iPhone || $iPad) {
    $url = "https://apps.apple.com/app/robosto/id1547420897";
    $decodedData['iphone'] += 1;
} else {
    $decodedData['desktop'] += 1;
}

// Increment Visitors
file_put_contents($fileName, json_encode($decodedData));

// REdirect to target URL
header('Location: ' . $url);

?>