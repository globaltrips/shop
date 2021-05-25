<?php

$env = $_GET['env'];
$response = [];
$response['success'] = false;
$response['message'] = '';
$response['data'] = [];

$configBuilderUrl = 'https://shop.globaltrips.nettravel.io/work/html_builder.php?category=offers&updateBaseConfigHtml&build=dev&minified';
$response['data']['config_builder'] = file_get_contents($configBuilderUrl);
  
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 120);
$raw = curl_exec($ch);
// var_dump($raw); die;
$info = curl_getinfo($ch);
curl_close($ch);


die(json_encode($response));