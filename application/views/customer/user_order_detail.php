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
									<i class="icon-reorder"></i><?php echo $order['createTime'];?>&nbsp 编号：<?php echo $order['orderNum'];?>
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>

								</div>

							</div>

							<div class="portlet-body center">
							
	<div class="alert alert-success">
		<h4 class="alert-heading">详情</h4>
		<label>专业：<?php echo $order['major'];?></label>
		<label>课程名：<?php echo $order['courseName'];?></label>
		<label>页数：<?php echo $order['pageNum'];?></label>
		<label>阅读材料页数：<?php echo $order['refDoc'];?></label>
		<label>截止日期：<?php echo $order['endTime'];?></label>
		<label>补充要求：<?php echo $order['requirement'];?></label>
		<label>价格：<?php echo $order['price'];?></label>
		<label>订单状态：
		<?php if($order['hasPaid']==0): ?>
			<span class="label label-default">未付款</span>
			<a class="btn green mini" href="<?php echo site_url('customer/order/taSelectPage/'.$order['orderNum']);?>"><i class="icon-shopping-cart"></i>&nbsp去结算</a>
		<?php elseif($order['hasTaken']==0): ?>
			<span class="label label-warning">已付款&nbsp<?php echo $order['paidTime'];?></span>
		<?php elseif($order['hasFinished']==0): ?>
			<span class="label label-info">已接单&nbsp<?php echo $order['takenTime'];?></span>
		<?php else: ?>
			<span class="label label-success">已完成&nbsp<?php echo $order['finishedTime'];?></span>
		<?php endif; ?>
		</label>
</div>

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