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
							新建TA
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

		<form action="<?php echo site_url('ta/addTa');?>" method="post">
  			<div class="form-group">
    			<label for="name">姓名</label>
    			<input type="text" class="form-control m-wrap large" id="name" name="name" placeholder="" required="required">
  			</div>
  			<div class="form-group">
    			<label for="email">邮箱</label>
    			<input type="email" class="form-control m-wrap large" id="email" name="email" placeholder="" required="required">
  			</div>
  			<div class="form-group">
    			<label for="skills">技能</label>
    			<select class="form-control m-wrap large" name="skills" id="skills">
  					<option>天文</option>
  					<option>地理</option>
  					<option>历史</option>
  					<option>物理</option>
				</select>
  			</div>
  			<div class="form-group">
    			<label for="star">评级</label>
    			<!-- <input type="text" class="form-control" id="star" name="star" placeholder=""> -->

    			<input id="star" name="star" value="0" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs">

  			<!-- ÷</div> -->
  			<div class="form-group">
    			<label for="unitPrice">每页收价（元）</label>
    			<select class="form-control m-wrap large" name="unitPrice" id="unitPrice">
    			<?php for($i=10;$i<=100;$i+=10){ ?>
  					<option><?php echo $i; ?></option>
				<?php } ?>
				</select>
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