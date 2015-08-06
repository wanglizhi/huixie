<!-- BEGIN PAGE -->  
<div class="page-content">

	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">
				<h3 class="form-section">
					登陆
				</h3>
			</div>

		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid"></div>
					<div class="portlet-body">
						<form action="<?php echo site_url(ADMIN_PREFIX.'login/adminLogin');?>" method="post">
								<div  style="margin-top:150px;margin-left:auto;margin-right:auto;width:247px;">
								<div class="control-group">
									<div class="controls"  style="width:300px;" >
										<div class="input-icon left">
											<i class="icon-user"></i>
											<input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" id="name" name="name">
										</div>
									</div>

								</div>
								<div class="control-group">


									<div class="controls" style="width:247px;">

										<div class="input-icon left">

											<i class="icon-lock"></i>

											<input class="m-wrap placeholder-no-fix"  type="password" placeholder="Password" id="password" name="password">

										</div>

									</div>

								</div>

								<button style="width:247px;" type="submit" class="btn green">登录</button>
								</div>
						</form>
					</div>
			</div>

		</div>

		</div>
		<!-- END PAGE CONTENT-->         

	</div>
	<!-- END PAGE CONTAINER-->

</div>
<!-- END PAGE -->  