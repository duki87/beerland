<?php
  session_start();
  // output: /myproject/index.php
  $currentPath = $_SERVER['PHP_SELF'];

  // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
  $pathInfo = pathinfo($currentPath);
  $baseurl = $pathInfo['dirname'].'/';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BEERLAND</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="<?=$baseurl.'assets/jquery/jquery-3.3.1.min.js';?>"></script>
    <link rel="stylesheet" href="<?=$baseurl.'assets/bootstrap/css/bootstrap.min.css';?>">
    <link rel="stylesheet" href="<?=$baseurl.'assets/bootstrap/css/bootstrap-grid.min.css';?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  </head>
  </head>
