<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>府学教育</title>
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
	<link rel="stylesheet" type="text/css" href="media/css/select2_metro.css" />
	<link rel="stylesheet" type="text/css" href="media/css/chosen.css" />
	<link href="media/css/bootstrap-fileupload.css" rel="stylesheet" type="text/css">
	<link href="media/css/chosen.css" rel="stylesheet" type="text/css">
	<link href="media/css/profile.css" rel="stylesheet" type="text/css">
	<!-- END PAGE LEVEL STYLES -->

	<link rel="shortcut icon" href="media/image/favicon.ico" />
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

					<!-- BEGIN USER LOGIN DROPDOWN -->
					<?php if(isset($admin)): ?>
     				   <li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img alt="" src="media/image/avatar1_small.jpg" />
						<span class="username"><?php echo $admin['name'];?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url("admin/modifyPage");?>"><i class="icon-lock"></i>修改密码</a></li>
							<li><a href="<?php echo site_url("admin/logout");?>"><i class="icon-key"></i>注销</a></li>
						</ul>
					</li>
      				<?php else: ?>
        				<li class="active"><a href="<?php echo site_url("admin/loginPage");?>">请登陆</a></li>
     				<?php endif ?>
					
					<!-- END USER LOGIN DROPDOWN -->

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
					<a href="#">
					<i class="icon-home"></i> 
					<span class="title">统计面板</span>
					</a>
				</li>

				<li class="">
					<a href="javascript:;">
					<i class="icon-cogs"></i> 
					<span class="title">用户管理</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo site_url("user/registerPage");?>">添加用户</a></li>
            			<li><a href="<?php echo site_url("user/userList");?>">查看用户列表</a></li>
					</ul>
				</li>

				<li class="">
					<a href="javascript:;">
					<i class="icon-cogs"></i> 
					<span class="title">TA管理</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<a href="<?php echo site_url("ta/addTaPage");?>">
							添加TA</a>
						</li>
						<li >
							<a href="<?php echo site_url("ta/taList");?>">
							查看TA列表</a>
						</li>
					</ul>
				</li>

				<li class="">
					<a href="javascript:;">
					<i class="icon-cogs"></i> 
					<span class="title">订单管理</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">

						<li><a href="<?php echo site_url("order/unpaidOrderList");?>">所有未付款订单</a></li>
			            <li><a href="<?php echo site_url("order/untakenOrderList");?>">所有未接单订单</a></li>
			            <li><a href="<?php echo site_url("order/unfinishedOrderList");?>">所有未完成订单</a></li>
			            <li><a href="<?php echo site_url("order/finishedOrderList");?>">所有已完成订单</a></li>
			            <li><a href="<?php echo site_url("order/orderList/1/10");?>">所有订单（未分类）</a></li>
					</ul>
				</li>

				<li class="">
					<a href="javascript:;">
					<i class="icon-cogs"></i> 
					<span class="title">Admin管理</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<a href="<?php echo site_url("admin/adminList");?>">
							查看Admin列表</a>
						</li>
					</ul>
				</li>

			</ul>
			<!-- END SIDEBAR MENU -->

		</div>
	</div>
		<!-- END SIDEBAR -->
