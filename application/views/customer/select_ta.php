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
							选择助教
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
									<i class="icon-reorder"></i> 请查看助教信息
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>

								</div>

							</div>

							<div class="portlet-body center">
							
			
<form action="<?php echo site_url('customer/order/payOrderPage');?>" method="post">

<?php if(!empty($taList))foreach ($taList as $ta):?>
	<div class="checkbox span6 alert alert-info">
	<label>
    	<input type="checkbox" name="taIdList[]" value="<?php echo $ta['openid'];?>">
  		</label>
		<img src="<?php echo $ta['userInfo']['headimgurl'];?>" alt="..." class="img-circle" style="width:120px;height:120px">
  		
  		<br>
  		<label>姓名：<?php echo $ta['userInfo']['nickname'];?></label>
  		<label>评级：<?php echo $ta['star'];?></label>
  		<label>单价：<?php echo $ta['unitPrice'];?></label>
  		<label>简介：<?php echo $ta['introduction'];?></label>
  		
	</div>



<?php endforeach;?>
<div>
<br>
	<font style="font-weight:bold;">（可多选，如果不选择，系统默认分配助教）</font>
</div>
<button type="submit" class="btn blue"><i class="icon-ok"></i> 提交</button>

<!-- <a href="#" class="btn btn-default" role="button">返回修改</a> -->
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