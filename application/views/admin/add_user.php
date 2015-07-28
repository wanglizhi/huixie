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
							新建用户
						</h3>
						<ul class="breadcrumb">
							<li>
							</li>
						</ul>
					</div>

				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue" id="form_wizard_1">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-reorder"></i> 填写表单
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>

								</div>

							</div>

							<div class="portlet-body">

<div class="tab-pane">

		<form action="<?php echo site_url('user/register');?>" method="post">
  			<div class="form-group">
    			<label for="name">姓名</label>
    			<input type="text" class="form-control m-wrap large" id="name" name="name" placeholder="" required="required">
  			</div>
  			<div class="form-group">
    			<label for="university">学校</label>
    			<input type="text" class="form-control m-wrap large" id="university" name="university" placeholder="">
  			</div>
  			<div class="form-group">
    			<label for="email">Email</label>
    			<input type="email" class="form-control m-wrap large" id="email" name="email" placeholder="">
  			</div>
  			<button type="submit" class="btn green">submit</button>
		</form>
</div>


							</div>

						</div>

					</div>

				</div>
				<!-- END PAGE CONTENT-->         

			</div>
			<!-- END PAGE CONTAINER-->

		</div>
		<!-- END PAGE -->  