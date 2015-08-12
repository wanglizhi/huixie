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
					余额信息
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

			<div class="responsive span6" data-tablet="span6" data-desktop="span3">

				<div class="dashboard-stat green">
					<div class="visual">
						<i class="icon-credit-card"></i>
					</div>
					<div class="details">
						<div class="number">$<?php echo $user['balance'];?></div>
						<div class="desc">账户余额</div>
					</div>
					<a class="more">
					充值<i class="m-icon-swapright m-icon-white"></i>
					</a>                 
				</div>
			</div>

			<div class="span12">
				<div class="portlet box blue" id="form_wizard_1">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-reorder"></i> 余额变动记录
						</div>
						<div class="tools hidden-phone">
							<a href="javascript:;" class="collapse"></a>

						</div>

					</div>

					<div class="portlet-body">
					<?php if(!empty($tradeList))foreach ($tradeList as $trade):?>
						<?php 
							static $orderRow = 0; 
						?>
						<div class="well">
							<label>交易金额：<?php echo $trade['money'];?></label>
							<label>余额：<?php echo $trade['balance'];?></label>
							<label>订单编号：<?php echo $trade['orderNum'];?></label>
							<label>描述：<?php echo $trade['describe'];?></label>
							<label>创建时间：<?php echo $trade['createTime'];?></label>
							<?php
							$orderRow++; 
							?>
						</div>
					<?php endforeach;?>

	<?=$page_info?>
</div>

</div>

</div>

</div>
<!-- END PAGE CONTENT-->         

</div>
<!-- END PAGE CONTAINER-->

</div>
<!-- END PAGE -->  
