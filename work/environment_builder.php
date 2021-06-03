<?php

include_once('/var/www/globaltrips_cdn_pages/definitions.php');

$env = $_GET['env'] ?? 'dev';
$baseUrl = _DEV_SITE_SHOP_URL;

$response = [];
$response['success'] = false;
$response['message'] = '';
$response['data'] = [];
$response['debug'] = [];
$response['debug']['env'] = $env;
$response['debug']['base_url'] = $baseUrl;

$offersHtmlBuilderUrl = $baseUrl.'/work/html_builder.php?category=offers&updateBaseConfigHtml&build='.$env.'&minified';
$dealsHtmlBuilderUrl = $baseUrl.'/work/html_builder.php?category=deals&updateBaseConfigHtml&build='.$env.'&minified';
$searchHtmlBuilderUrl = $baseUrl.'/work/html_builder.php?category=search&build='.$env;
$configBuilderUrl = $baseUrl.'/work/config_builder.php?build='.$env;

// update config builder first
$response['data']['config_builder'] = $configBuilder = json_decode(file_get_contents($configBuilderUrl), true);

if (!$configBuilder['success']) {
  $response['message'] = 'Something went wrong';
  $response['debug']['error'] = $configBuilder['message'] ?? '';
  die(json_encode($response));
}

// then update html files
$response['data']['offers_html_builder'] = $offersHtml = json_decode(file_get_contents($offersHtmlBuilderUrl), true);
  
if (!$offersHtml['success']) {
  $response['message'] = 'Something went wrong';
  $response['debug']['error'] = $offersHtml['message'] ?? '';
  die(json_encode($response));
}

$response['data']['deals_html_builder'] = $dealsHtml = json_decode(file_get_contents($dealsHtmlBuilderUrl), true);

if (!$dealsHtml['success']) {
  $response['message'] = 'Something went wrong';
  $response['debug']['error'] = $dealsHtml['message'] ?? '';
  die(json_encode($response));
}

$response['data']['search_html_builder'] = $searchHtml = json_decode(file_get_contents($searchHtmlBuilderUrl), true);

// we're good at this point
$response['success'] = true;
$response['message'] = 'Config and HTML files built correctly';

die(json_encode($response));