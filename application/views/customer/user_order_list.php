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
					订单列表
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
							<i class="icon-reorder"></i> <?php echo $pageTitle;?>
						</div>
						<div class="tools hidden-phone">
							<a href="javascript:;" class="collapse"></a>

						</div>

					</div>

					<div class="portlet-body">
					<?php if(!empty($orderList))foreach ($orderList as $order):?>
						<?php 
							static $orderRow = 0; 
						?>
						<div class="well">
							<h4 class="alert-heading">订单编号：<?php echo $order['orderNum'];?></h4>
							<label>专业：<?php echo $order['major'];?></label>
							<label>课程名：<?php echo $order['courseName'];?></label>
							<label>价格：<?php echo $order['price'];?></label>
							<label>订单状态：
							<?php if($order['hasPaid']==0): ?>
								<span class="label label-default">未付款</span>
								<a class="btn green mini" href="<?php echo site_url('customer/order/taSelectPage/'.$order['orderNum']);?>"><i class="icon-shopping-cart"></i>&nbsp去结算</a>
								<a class="btn red mini" data-toggle="modal" data-target="#delete<?=$orderRow?>"><i class="icon-trash"></i>&nbsp删除订单</a>
								
								<!-- Modal -->
								<div class="modal fade" id="delete<?=$orderRow?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h4 class="modal-title" id="myModalLabel">警告</h4>
								      </div>
								      <div class="modal-body">
								        <label>订单编号：<?php echo $order['orderNum'];?></label>
										<label>课程名：<?php echo $order['courseName'];?></label>
										<label>未付款订单最多只能有十单，请及时清理~</label>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
								        <a class="btn red" href="<?php echo site_url('customer/user/deleteOrder/'.$order['orderNum']);?>"><i class="icon-trash"></i>&nbsp删除订单</a>
								      </div>
								    </div>
								  </div>
								</div>
							<?php elseif($order['hasTaken']==0): ?>
								<span class="label label-warning">已付款</span>
							<?php elseif($order['hasFinished']==0): ?>
								<span class="label label-info">已接单</span>
							<?php else: ?>
								<span class="label label-success">已完成</span>
							<?php endif; ?>
							
							<a class="btn btn-primary mini" role="button" data-toggle="collapse" href="#orderRow<?=$orderRow?>" aria-expanded="false" aria-controls="collapseExample">
				  			<i class="icon-chevron-down"></i></a>
							</label>
							
							<div class="collapse" id="orderRow<?=$orderRow?>">
						 		 <div class="">
						 		 	<h4>详细描述</h4>
						 		 	<label>页数：<?php echo $order['pageNum'];?></label>
									<label>阅读材料页数：<?php echo $order['refDoc'];?></label>
									<label>截止日期：<?php 
									date_default_timezone_set("PRC");
									$timestamp = strtotime($order['endTime']);
									date_default_timezone_set($order['timezone']);
									echo date("Y-m-d H:i:s",$timestamp);
									?></label>
									<label>时区：<?php echo $order['timezone'];?></label>
									<label>补充要求：<?php echo $order['requirement'];?></label>
									<label>邮箱：<?php echo $order['email'];?></label>
									<label>创建时间：<?php 
									date_default_timezone_set("PRC");
									$timestamp = strtotime($order['createTime']);
									date_default_timezone_set($order['timezone']);
									echo date("Y-m-d H:i:s",$timestamp);
									?></label>

									<?php if($order['hasPaid']==1): ?>
										<label>付款时间：<?php 
										date_default_timezone_set("PRC");
										$timestamp = strtotime($order['paidTime']);
										date_default_timezone_set($order['timezone']);
										echo date("Y-m-d H:i:s",$timestamp);
										?></label>
									<?php elseif($order['hasTaken']==1): ?>
										<label>接单时间：<?php 
										date_default_timezone_set("PRC");
										$timestamp = strtotime($order['takenTime']);
										date_default_timezone_set($order['timezone']);
										echo date("Y-m-d H:i:s",$timestamp);
										?></label>
									<?php elseif($order['hasFinished']==1): ?>
										<label>完成时间：<?php 
										date_default_timezone_set("PRC");
										$timestamp = strtotime($order['finishedTime']);
										date_default_timezone_set($order['timezone']);
										echo date("Y-m-d H:i:s",$timestamp);
										?></label>
									<?php endif; ?>

						  		</div>
							</div>
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
