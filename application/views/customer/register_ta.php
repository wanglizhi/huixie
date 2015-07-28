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
							助教信息
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
		<?php if($ta and $ta['hasCheck']): ?>
			<div class="alert alert-success">
			<h4>您已经通过审核成为助教</h4>
				<div>技能：<?php echo $ta['skills'];?></div>
				<div>单价：<?php echo $ta['unitPrice'];?></div>
				<div>评级：<?php echo $ta['star'];?></div>
			</div>
			<div class="alert alert-info">如果需要修改助教的相关信息，请联系客服，并且将相关材料发送到邮箱admin@huixie.me</div>
		<?php else: ?>
			<?php if($ta): ?>
				<div class="alert alert-info">
				您已经提交过助教申请，您的邮箱是<span><?php echo $ta['email'];?></span>
				请联系客服发送材料等待审核，重新点击提交申请可以更改邮箱。
				</div>
			<?php endif ?>

		<form action="<?php echo site_url('customer/ta/register');?>" method="post">
  			<div class="form-group">
    			<label for="email">邮箱</label>
    			<input type="email" class="form-control m-wrap span6" id="email" name="email" placeholder="" required="required">
  			</div>
  			<button type="submit" class="btn green">提交申请</button>
		</form>
		<?php endif ?>


							</div>

						</div>

					</div>

				</div>
				<!-- END PAGE CONTENT-->         

			</div>
			<!-- END PAGE CONTAINER-->

		</div>
		<!-- END PAGE -->  