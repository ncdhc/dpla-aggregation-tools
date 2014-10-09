<?php

require('config.php');

$url = "http://api.dp.la/v2/items?provider.@id=".$provider_id."&facets=dataProvider,sourceResource.collection.title&facet_size=500&page_size=0&api_key=".$dpla_api_key;

// create curl resource
    $ch = curl_init();

// set url
    curl_setopt($ch, CURLOPT_URL, $url);

//return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
    $output = curl_exec($ch);

// close curl resource to free up system resources
    curl_close($ch);
    
$timestamp = date('U');
$filepath = 'snapshots/'.$timestamp.'.txt';
$snapshot = fopen($filepath, "w");
fwrite($snapshot, $output);
fclose($snapshot);

header('Location:index.php');