<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GT Destinations</title>
  <link rel="icon" href="/img/club/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css?v=1" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
  <style>
    * {
/*       overflow: hidden; */
    }
    
    body {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      min-height: 100vh;
    }
    
    .list-group {
      border-bottom: 1px solid rgba(0,0,0,.125);
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-light bg-light border-bottom mb-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="/img/club/nav-logo-icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        Destinations
      </a>
<!--       <button class="navbar-toggler d-block d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->
    </div>
  </nav>
  <div class="container-fluid">
    <?php
      // deals obj
      $json = file_get_contents('config.json');
      $decoded = json_decode($json, true);
      $linksArr = ['deals', 'offers', 'search'];

      // activation codes
      try {
        if(! @include_once("/var/www/secure/signupCodesConfiguration.php")) { // @ - to suppress warnings
          throw new Exception ('Failed to open signup codes file');
        }
      } catch (\Exception $ex) {
        echo '<h6 class="text-danger text-center my-2">'.$ex->getMessage().'</h6>';
      }
    ?>
    <div class="row">
      <?php 
//         foreach ([0,1,2,3,4,5,6,7,8,9] as $k1 => $v1) {
        foreach ($decoded as $k => $v) {
          // if it's something we should show on screen from the json obj
          if (in_array($k, $linksArr)) { ?>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
              <div class="card h-100">
                <div class="card-header pt-1 pb-2">
                  <p class="fs-5 fw-bold mb-0"><?php echo ucfirst($k); ?></p>
                </div>
                <div class="card-body p-0">
                  <ul class="list-group list-group-flush">
                    <?php foreach($v as $location => $information) : ?>
                      <li class="list-group-item"><a href="https://shop.globaltrips.nettravel.io/<?php echo $k; ?>/<?php echo $location; ?>" target="_BLANK"><?php echo ucfirst($location); ?></a></li>
                    <?php endforeach ?>
                  </ul>        
                </div>
              </div>
            </div>
          <?php }
        } 
//         }  
      ?>

      <!-- Experiences card -->
      <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
          <div class="card-header pt-1 pb-2">
            <p class="fs-5 fw-bold mb-0">Experiences</p>
          </div>
          <div class="card-body p-0">
              <?php if(isset($signupCodeList) && count($signupCodeList ?? 0) > 0): ?>
                <ul class="list-group list-group-flush">
                  <?php foreach($signupCodeList ?? [] as $k => $v): ?>
                    <li class="list-group-item" title="creates a member into the membership ID#<?php echo $v['upgradeMembership'] ?? $v['membership']; ?> - <?php echo $v['membership_name']; ?>" ><?php echo $k; ?> - [<?php echo $v['upgradeMembership'] ?? $v['membership']; ?>] <?php echo $v['describe_experience'] ?? $v['membership_name']; ?></li>
                  <?php endforeach ?>
                </ul> 
              <?php else: ?>
                <p class="fs-5 mb-0 d-flex text-center h-100 justify-content-center align-items-center">No experiences found</p>
              <?php endif ?>    
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>