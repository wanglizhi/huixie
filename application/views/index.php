<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

	<meta charset="utf-8" />
	<base href="<?php echo base_url();?>"/>

	<title>会写么 | Coming Soon</title>

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

	<link href="media/css/coming-soon.css" rel="stylesheet" type="text/css"/>

	<!-- END PAGE LEVEL STYLES -->

	<link rel="shortcut icon" href="images/icon.ico" /> 

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body>

	<div class="container">

		<div class="row-fluid">

			<div class="span12 coming-soon-header">

				<a class="brand" href="#">

				<img src="images/hxmlogo.jpg" alt="logo" height="100" width="100"/>

				</a>

			</div>

		</div>

		<div class="row-fluid">

			<div class="span6 coming-soon-content">

				<h1>Welcome!</h1>

				<p>
					欢迎使用会写么，扫描下面的二维码关注~
				</p>

				<br>

				<form class="form-search" action="#">

					<div class="input-append">

						<input type="text" class="m-wrap" placeholder="Your Email">

						<button type="button" class="btn blue btn-subscribe"><span>Subscribe</span> <i class="m-icon-swapright m-icon-white"></i></button>

					</div>

				</form>

				<ul class="social-icons">

					<li><a href="#" data-original-title="Feed" class="rss"></a></li>

					<li><a href="#" data-original-title="Facebook" class="facebook"></a></li>

					<li><a href="#" data-original-title="Twitter" class="twitter"></a></li>

					<li><a href="#" data-original-title="Goole Plus" class="googleplus"></a></li>

					<li><a href="#" data-original-title="Pinterest" class="pintrest"></a></li>

					<li><a href="#" data-original-title="Linkedin" class="linkedin"></a></li>

					<li><a href="#" data-original-title="Vimeo" class="vimeo"></a></li>

				</ul>

			</div>

			<div class="span6 coming-soon-countdown">

				<div id="defaultCountdown"></div>
				<br>
				<br>
				<br>
				<br>
				<div class="span6">
				<img src="images/qrcode.jpg" alt="logo" />
				</div>

			</div>

		</div>

		<!--/end row-fluid-->

		<div class="row-fluid">

			<div class="span12 coming-soon-footer">

			</div>

		</div>

	</div>

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<!-- BEGIN CORE PLUGINS -->

	<script src="media/js/jquery-1.10.1.min.js" type="text/javascript"></script>

	<script src="media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

	<script src="media/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      

	<script src="media/js/bootstrap.min.js" type="text/javascript"></script>

	<!--[if lt IE 9]>

	<script src="media/js/excanvas.min.js"></script>

	<script src="media/js/respond.min.js"></script>  

	<![endif]-->   

	<script src="media/js/jquery.slimscroll.min.js" type="text/javascript"></script>

	<script src="media/js/jquery.blockui.min.js" type="text/javascript"></script>  

	<script src="media/js/jquery.cookie.min.js" type="text/javascript"></script>

	<script src="media/js/jquery.uniform.min.js" type="text/javascript" ></script>

	<!-- END CORE PLUGINS -->

	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<script src="media/js/jquery.countdown.js" type="text/javascript"></script>

	<script src="media/js/jquery.backstretch.min.js" type="text/javascript"></script>

	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->

	<script src="media/js/app.js" type="text/javascript"></script>

	<script src="media/js/coming-soon.js" type="text/javascript"></script>      

	<!-- END PAGE LEVEL SCRIPTS --> 

	<script>

		jQuery(document).ready(function() {     

		  App.init();

		  CoomingSoon.init();

		});

		 

	</script>

	<!-- END JAVASCRIPTS -->

</body><!-- END BODY -->

</html>