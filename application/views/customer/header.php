<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title>会写么</title>
  <base href="<?php echo base_url();?>"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="media/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="media/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
  <link href="media/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <link href="media/css/style-metro.css" rel="stylesheet" type="text/css"/>
  <link href="media/css/style.css" rel="stylesheet" type="text/css"/>
  <link href="media/css/style-responsive.css" rel="stylesheet" type="text/css"/>
  <link href="media/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>
  <link href="media/css/uniform.default.css" rel="stylesheet" type="text/css"/>
  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- BEGIN PAGE LEVEL STYLES -->
  <link rel="stylesheet" href="media/css/DT_bootstrap.css">
  <link rel="stylesheet" type="text/css" href="media/css/select2_metro.css" />
  <link rel="stylesheet" type="text/css" href="media/css/chosen.css" />
  <link href="media/css/bootstrap-fileupload.css" rel="stylesheet" type="text/css">
  <link href="media/css/chosen.css" rel="stylesheet" type="text/css">
  <link href="media/css/profile.css" rel="stylesheet" type="text/css">
  <!-- END PAGE LEVEL STYLES -->

  <link rel="shortcut icon" href="images/icon.ico" /> 
  <!-- <link rel="shortcut icon" href="media/image/favicon.ico" /> -->

  <script src="media/js/jquery-1.10.1.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/jquery.cityselect.js"></script>
  <script type="text/javascript" src="js/majorData.js"></script> 
</head>
<!-- END HEAD -->

<style>
.navbar-brand{
font-weight: 300;
  font-size: 22px;
  font-family: "Roboto Condensed", sans-serif;
  color: white;
  padding: 0;
  padding-left: 5px;
  height: 45px;
  line-height: 45px;
}
</style>

<!-- BEGIN BODY -->
<body class="page-header-fixed">

  <!-- BEGIN HEADER -->
  <div class="header navbar navbar-inverse navbar-fixed-top">

    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
      <div class="container-fluid">

        <!-- BEGIN LOGO -->
        <!--  <a class="brand" href="#">
        <img src="../resources/media/image/logo.png" alt="logo"/>
        </a>-->
        <span class="navbar-brand" href="#">
                <strong>会</strong> <font color="red"><strong>写么</strong></font>
              </span>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
        <img src="media/image/menu-toggler.png" alt="" />
        </a>          
        <!-- END RESPONSIVE MENU TOGGLER -->            

        <!-- BEGIN TOP NAVIGATION MENU -->              

        <ul class="nav pull-right">

          

        </ul>
        <!-- END TOP NAVIGATION MENU --> 

      </div>
    </div>
    <!-- END TOP NAVIGATION BAR -->
  </div>
  <!-- END HEADER -->

  <!-- BEGIN CONTAINER -->
  <div class="page-container row-fluid">

    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar nav-collapse collapse">

      <!-- BEGIN SIDEBAR MENU -->        
      <ul class="page-sidebar-menu">
        <li>
          <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
          <div class="sidebar-toggler hidden-phone"></div>
          <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        </li>

        <li class="start ">
          <a href="<?php echo site_url("customer/user/logout");?>">
          <i class="icon-signout"></i> 
          <span class="title">注销</span>
          </a>
        </li>

        <li class="start ">
          <a href="<?php echo site_url("customer/order/addOrderPage");?>">
          <i class="icon-edit"></i> 
          <span class="title">下订单</span>
          </a>
        </li>

        <li class="">
          <a href="javascript:;">
          <i class="icon-shopping-cart"></i> 
          <span class="title">我的订单</span>
          <span class="arrow "></span>
          </a>
          <ul class="sub-menu">
            <li><a href="<?php echo site_url("customer/user/infoPage");?>">个人信息</a></li>
            <li><a href="<?php echo site_url("customer/user/orderList");?>">订单列表</a></li>
            <li><a href="<?php echo site_url("customer/user/unpaidOrderList");?>">未付款订单</a></li>
          </ul>
        </li>

        <li class="">
          <a href="javascript:;">
          <i class="icon-inbox"></i> 
          <span class="title">我的接单</span>
          <span class="arrow "></span>
          </a>
          <ul class="sub-menu">
            <li >
              <a href="<?php echo site_url("customer/ta/registerPage");?>">成为助教</a>
            </li>
            <li >
              <a href="<?php echo site_url("customer/ta/orderList");?>">已接订单</a>
            </li>
            <li >
              <a href="<?php echo site_url("customer/ta/untakenOrderList");?>">待选择订单</a>
            </li>
          </ul>
        </li>

      </ul>
      <!-- END SIDEBAR MENU -->

    </div>
  </div>
    <!-- END SIDEBAR -->
