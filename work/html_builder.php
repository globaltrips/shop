<?php

// die('Access Denied');
include_once '/var/www/globaltrips_cdn_pages/definitions.php';
include_once '/var/www/globaltrips_cdn_pages/work/simple_html_dom.php';

error_reporting(E_ALL);
ini_set('display_errors', 'On');


$response = []; 
$response['success'] = false; 
$response['data'] = [];
// $response['data']['master_index_path'] = $masterIndexPath;
$response['message'] = []; 
$categoryArr = ['deals','offers'];

if(empty($_GET['category']) || !in_array($_GET['category'], $categoryArr)){
  $response['success'] = false;
  $response['message'] = 'Category not defined';
  die(json_encode($response));
}

if(!isset($_GET['build'])) {
  $response['success'] = false;
  $response['message'] = 'Build is required';
  die(json_encode($response));
}

$env = $_GET['build'];
$response['env'] = $env;


if($env == 'dev') {
  $siteUrl = _DEV_SITE_URL;
  $siteShopUrl = _DEV_SITE_SHOP_URL;
  $siteName = _DEV_SITE_NAME;
} else if($env == 'prod') {
  $siteUrl = _SITE_URL;
  $siteShopUrl = _SITE_SHOP_URL;
  $siteName = _SITE_NAME;
} else {
  $response['success'] = false;
  $response['message'] = 'Build env is not valid';
  die(json_encode($response));
}

$folderToUpdate = $_GET['category'];
$baseDealsPath = '/var/www/globaltrips_cdn_pages/'.$folderToUpdate.'/';
// $masterLocation = 'orlando'; // Using Orlando index as master
$baseHtmlFile = '/var/www/globaltrips_cdn_pages/work/base.html';

if(isset($_GET['minified'])) {
  $baseHtmlFile = '/var/www/globaltrips_cdn_pages/work/base.min.html';
}

// $baseHtmlFileContent = '';
$configJsonFile = '/var/www/globaltrips_cdn_pages/config.json';
$configJsonFileContent = '';

try{
  
  // Check if base html exists
  if(!file_exists($baseHtmlFile)) { throw new \Exception('Base html not found'); } 
  

  // Get base file content
  $html = file_get_html($baseHtmlFile, $use_include_path = false, $context = null, $offset = -1, $maxLen = -1, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);
//   $baseHtmlFileContent = file_get_contents($baseHtmlFile);
  if($html === false) { throw new \Exception('Failed to read base html file'); }  
  
  // Check if config exists
  if(!file_exists($configJsonFile)) { throw new \Exception('Config not found'); }
  
  // Get config content
  $configJsonFileContent = file_get_contents($configJsonFile);
  if($configJsonFileContent === false) { throw new \Exception('Failed to read config file'); }
  $configJsonFileContent = json_decode($configJsonFileContent, true);
  
  // Get locations to update
  $dealsLocations = scandir($baseDealsPath);
  $dealsLocationsToUpdate = [];
  foreach(($dealsLocations ?? []) as $k => $v) {
    if($v != '.' && $v != '..' && is_dir($baseDealsPath.$v)) {
      $dealsLocationsToUpdate[$v] = [
        'path' => $baseDealsPath.$v.'/index.html',
        'updated' => 0
      ];
    }
  }
  
  if(count($dealsLocationsToUpdate) <= 0){
    die('Failed to read folder, empty');
  }
  $response['data']['locations_to_update'] = $dealsLocationsToUpdate;
  

  
  
  // Update locations
  $dealsLocationsToUpdateCount = count($dealsLocationsToUpdate);
  $updated = 0;
  foreach($dealsLocationsToUpdate as $k => $v) {
    
    if(!isset($configJsonFileContent[$folderToUpdate][$k])){
      // missconfiguration notify someway
      continue;
    }
//     if($k == 'cancun'){
//       continue;
//     }
    // update redirect and json data specific to each file
    $configData = $configJsonFileContent;
    $dataObj = $configData[$folderToUpdate][$k];
    
    $hotelsCount = $configData['counts']['hotels'][$k] ?? 0;
    $condosCount = $configData['counts']['condos'][$k] ?? 0;
//     if(isset($configData['counts']['hotels'][$k])){
//       if(!isset($dataObj['counts'])){$dataObj['counts'] = [];}
//       $dataObj['counts']['hotels'] = $configData['counts']['hotels'][$k];
//     }
//     if(isset($configData['counts']['condos'][$k])){
//       if(!isset($dataObj['counts'])){$dataObj['counts'] = [];}
//       $dataObj['counts']['condos'] = $configData['counts']['condos'][$k];
//     }
    
    // clean others folders
    foreach($categoryArr as $k2=>$v2){
      unset($configData[$v2]);
    }
    $configData[$folderToUpdate] = [];
    $configData['counts'] = [];
    
    $configData[$folderToUpdate][$k] = $dataObj;
    $configData['counts'][$k] = [
      'hotels' => $hotelsCount,
      'condos' => $condosCount,
    ];
    
    // og 
    $ogUrl = $html->find('[property="og:url"]');
    $ogUrl[0]->content = $siteShopUrl.'/'.$folderToUpdate.'/'.$k.'/';
    $ogType = $html->find('[property="og:type"]');
    $ogType[0]->content = 'video';
    $ogTitle = $html->find('[property="og:title"]');
    $ogTitle[0]->content = $dataObj['definitions']['location'];
    $ogLocale = $html->find('[property="og:locale"]');
    $ogLocale[0]->content = 'en_US';
    $ogImage = $html->find('[property="og:image"]');
    $ogImage[0]->content = $siteShopUrl.$dataObj['hero']['og_img'];
//     $ogVideo = $html->find('[property="og:video"]');
//     $ogVideo[0]->content = 'https:\/\/player.vimeo.com\/external\/547671806.hd.mp4?s=0746a5de6e35aec7dfacad8b8006b49d769b3a95&profile_id=174';
    $ogDescription = $html->find('[property="og:description"]');
    $ogDescription[0]->content = 'Exclusive Offers - '.$configData['counts'][$k]['hotels'].' participating hotels';
    $ogSite_name = $html->find('[property="og:site_name"]');
    $ogSite_name[0]->content = $siteName;
//     var_dump($test);die;
    
    $html->getElementById('siteurl')->innertext = "const siteUrl = '".$siteUrl."';";
    
    $html->getElementById('pLocationData')->innertext = "const configLocationData = ".json_encode($configData);
//     $html->getElementById('pWidgetsData')->innertext = "const configWidgetsData = ".json_encode($configData);
    
    // Including redirect(number) as a get parameter will redirect user to respective url
    $html->getElementById('pRedirectScript')->innertext = "
      const redirectObj = {
        'redirect1':'".$siteUrl."',
      }

      let getSearchVars = {};
      window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(m,key,value){
        getSearchVars[key] = value;
      });
      if(typeof getSearchVars.redirect != 'undefined' && typeof redirectObj[getSearchVars.redirect] !== 'undefined'){
        window.location.replace(redirectObj[getSearchVars.redirect]);
      }
    ";
    
    // update the base html with fresh config
    // update the base html with fresh config
    // update the base html with fresh config
    if($k == 'orlando'){
      if(isset($_GET['updateBaseConfigHtml'])){
        file_put_contents($baseHtmlFile, $html);
      }
      if(isset($_GET['updateBaseConfigPRO'])){
        file_put_contents('/var/www/globaltrips_cdn_pages/work/basePro.html', $html);
      }
    }
    // update the base html with fresh config
    // update the base html with fresh config
    // update the base html with fresh config
    
    file_put_contents($v['path'], $html);
    $dealsLocationsToUpdate[$k]['updated'] = 1;
    $updated++;
  }
  $response['data']['locations_to_update'] = $dealsLocationsToUpdate;
  
  if($updated != $dealsLocationsToUpdateCount) {
    throw new \Exception('Failed to update '.($dealsLocationsToUpdateCount - $updated).' locations');
  }
  $response['success'] = true;
  
}catch(\Exception $ex) {
  $response['success'] = false;
  $response['message'] = $ex->getMessage();
}

die(json_encode($response));


