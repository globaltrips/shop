<?php

// die('Access Denied');
/**
* Update each location:
* - Add minified styles
* - Add config json data
* - Add minified scripts
*/

if($_REQUEST['secret'] != 'uJqZ6pICLLDJ70pJMnJ8WxJePv0pilNM') {
//   die('Access Denied'); 
}

error_reporting(E_ALL);
ini_set('display_errors', 'On');


$baseDealsPath = '/var/www/globaltrips_cdn_pages/deals/';
$masterLocation = 'orlando'; // Using Orlando index as master
$masterIndexPath = $baseDealsPath.$masterLocation.'/index.html';
$masterIndexContent = '';


$response = []; 
$response['success'] = false; 
$response['data'] = [];
$response['data']['master_index_path'] = $masterIndexPath;
$response['msg'] = []; 

try{
  
  // Check if master index exists
  if(!file_exists($masterIndexPath)) { throw new Exception('Master Index not found'); }
  
  // Get master index content
  $masterIndexContent = file_get_contents($masterIndexPath);
  if($masterIndexContent === false) { throw new Exception('Failed to read master index file'); }
  
  
  // Get locations to update
  $dealsLocations = scandir($baseDealsPath);
  $dealsLocationsToUpdate = [];
  foreach(($dealsLocations ?? []) as $k => $v) {
    if($v != '.' && $v != '..' && $v != $masterLocation && is_dir($baseDealsPath.$v)) {
      $dealsLocationsToUpdate[$v] = [
        'path' => $baseDealsPath.$v.'/index.html',
        'updated' => 0
      ];
    }
  }
  
  $response['data']['deals_locations_to_update'] = $dealsLocationsToUpdate;
  
  // Update locations
  $dealsLocationsToUpdateCount = count($dealsLocationsToUpdate);
  $updated = 0;
  foreach($dealsLocationsToUpdate as $k => $v) {
    file_put_contents($v['path'], $masterIndexContent);
    $dealsLocationsToUpdate[$k]['updated'] = 1;
    $updated++;
  }
  $response['data']['deals_locations_to_update'] = $dealsLocationsToUpdate;
  
  if($updated != $dealsLocationsToUpdateCount) {
    throw new Exception('Failed to update '.($dealsLocationsToUpdateCount - $updated).' locations');
  }
  $response['success'] = true;
  
}catch(\Exception $ex) {
  $response['success'] = false;
  $response['message'] = $ex->getMessage();
}

die(json_encode($response));


