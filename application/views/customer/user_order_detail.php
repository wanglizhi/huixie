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
							订单信息
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
									<i class="icon-reorder"></i> 订单编号：<?php echo $order['orderNum'];?>
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>

								</div>

							</div>

							<div class="portlet-body center">
							
	<div class="alert alert-success">
		<h4>详情</h4>
		<label>专业：<?php echo $order['major'];?></label>
		<label>课程名：<?php echo $order['courseName'];?></label>
		<label>页数：<?php echo $order['pageNum'];?></label>
		<label>阅读材料页数：<?php echo $order['refDoc'];?></label>
		<label>截止日期：<?php echo $order['endTime'];?></label>
		<label>补充要求：<?php echo $order['requirement'];?></label>
		<label>价格：<?php echo $order['price'];?></label>
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