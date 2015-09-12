<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <base href="<?php echo base_url();?>"/>
    <title><?php echo $pageTitle;?></title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="ratchet/css/ratchet.css" rel="stylesheet" type="text/css"> 
    <link href="ratchet/css/sm.css" rel="stylesheet" type="text/css"> 
    <link href="ratchet/css/ratchet-theme-ios.css" rel="stylesheet" type="text/css">
    <link href="ratchet/css/my.css" rel="stylesheet" type="text/css">
    <!--star -->
    <link rel="stylesheet" href="media/css/jquery.raty.css" media="screen" type="text/css"/>

    <link rel="shortcut icon" href="images/icon.ico" /> 

    <!-- Include the compiled Ratchet JS 
    <script type="text/javascript" src="ratchet/js/ratchet.js"></script>
    <script type="text/javascript" src="ratchet/js/my.js"></script>
    <script type="text/javascript" src="ratchet/js/push.js"></script>
    <script type="text/javascript" src="ratchet/js/modals.js"></script>
    <script type="text/javascript" src="ratchet/js/popovers.js"></script>
    <script type="text/javascript" src="ratchet/js/segmented-controllers.js"></script>
    <script type="text/javascript" src="ratchet/js/sliders.js"></script>
    <script type="text/javascript" src="ratchet/js/toggles.js"></script> -->
    <script src="media/js/jquery-1.10.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.cityselect.js"></script>
    <script type="text/javascript" src="js/majorData.js"></script>
    <script src="media/js/jquery.raty.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>

  </head>
  <body>
  <!-- Make sure all your bars are the first things in your <body> -->
<header class="bar bar-nav" style="background-color:#18b4ed;">
    <?php if(isset($back) and $back!= ""):?>
        <a class="icon icon-left pull-left" href="<?php echo $back; ?>" style="color:#fff;"></a>
    <?php  endif?>
    <?php if(isset($forward) and $forward!= ""):?>
        <a class="icon icon-right pull-right" href="<?php echo $forward; ?>" style="color:#fff;"></a>
    <?php  endif?>
    <h1 class="title" style="color:#fff;"><?php echo $pageTitle;?></h1>
</header>