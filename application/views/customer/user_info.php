<!-- BEGIN PAGE -->  
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN PAGE CONTAINER-->

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->   

				<div class="row-fluid">

					<div class="span12">
						<h3 class="page-title">
							个人信息
						</h3>
					</div>

				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue" id="form_wizard_1">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-reorder"></i>
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>

								</div>

							</div>

							<div class="portlet-body center">
			
			<div class="alert alert-success">
			<h4>昵称：<?php echo $user['nickname'];?></h4>
			<div class="span6">
			<img src="<?php echo $user['headimgurl'];?>" alt="..." class="img-circle" style="width:120px;height:120px">
			</div>
				<div class="span6">性别：<?php if($user['sex']):?>
				<?php echo '男';?>
				<?php else:?>
				<?php echo '女';?>
				<?php endif?>

				</div>
				<div class="span6">地址：<?php echo $user['country'].'-'.$user['city'];?></div>
				<div class="span6">大学：<?php echo $user['university'];?></div>
				<div class="span6">邮箱：<?php echo $user['email'];?></div>
			</div>
			<div class="alert span6">您可以提交下面的表单修改你的学校和邮箱！</div>
		<form action="<?php echo site_url('customer/user/modify');?>" method="post">
			<div class="form-group">
    			<label for="university">大学</label>
    			<input type="text" class="form-control m-wrap span6" id="university" name="university" placeholder="" required="required">
  			</div>
  			<div class="form-group">
    			<label for="email">邮箱</label>
    			<input type="email" class="form-control m-wrap span6" id="email" name="email" placeholder="" required="required">
  			</div>
  			<div class="form-actions">
  			<button type="submit" class="btn green"><i class="icon-ok"></i> 提交申请</button>
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