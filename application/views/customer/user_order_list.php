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

					<div class="portlet-body no-more-tables">
						<div>
							<table class="table table-bordered table-striped table-condensed cf" id="orderList">
								<thead class="cf">
									<tr>
										<th>订单编号</th>
										<th>专业</th>
										<th>课程名称</th>
										<th>页数</th>
										<th>补充材料</th>
										<th>截止日期</th>
										<th>价格</th>
										<th>订单状态</th>
										<th>详情</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($orderList))foreach ($orderList as $order):?>
									<tr>
										<td data-title="订单编号"> <?php echo $order['orderNum'];?> </td>
										<td data-title="专业"> <?php echo $order['major'];?> </td>
										<td data-title="课程名称"> <?php echo $order['courseName'];?> </td>
										<td data-title="页数"> <?php echo $order['pageNum'];?> </td>
										<td data-title="补充材料"> <?php echo $order['refDoc'];?> </td>
										<td data-title="截止日期"> <?php echo $order['endTime'];?> </td>
										<td data-title="价格($)"> <?php echo $order['price'];?> </td>
										<?php if($order['hasPaid']==0): ?>
										<td data-title="状态"> <span class="label label-default">未付款</span></td>
									<?php elseif($order['hasTaken']==0): ?>
									<td data-title="状态"> <span class="label label-warning">已付款</span></td>
								<?php elseif($order['hasFinished']==0): ?>
								<td data-title="状态"> <span class="label label-info">已接单</span></td>
							<?php else: ?>
							<td data-title="状态"> <span class="label label-success">已完成</span></td>
						<?php endif; ?>
						<td data-title="详情">
							<?php 
							static $orderRow = 0; 
							?>
							<a href="#orderRow<?=$orderRow?>" data-toggle="modal">查看详情</a>
							<!-- Modal -->
							<div class="modal hide fade modal-overflow" id="orderRow<?=$orderRow?>" tabindex="-1" role="dialog">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title" id="myModalLabel<?=$orderRow?>">订单详情</h4>
								</div>
								<div class="modal-body">
									<div class="profile-classic row-fluid">
										<ul style="width:100%;" class="unstyled span10">
											<li style="width:100%;"><span>订单编号:</span> <?=$order['orderNum']?></li>
											<li style="width:100%;"><span>专业:</span> <?=$order['major']?></li>
											<li style="width:100%;"><span>课程名称:</span> <?=$order['courseName']?></li>
											<li style="width:100%;"><span>邮箱:</span> <?=$order['email']?></li>
											<li style="width:100%;"><span>页数:</span> <?=$order['pageNum']?></li>
											<li style="width:100%;"><span>阅读材料:</span> <?=$order['refDoc']?></li>
											<li style="width:100%;"><span>截止日期:</span> <?=$order['endTime']?></li>
											<li style="width:100%;"><span>价格:</span> <?=$order['price']?></li>
											<li style="width:100%;"><span>额外需求:</span> <?=$order['requirement']?></li>
											<li style="width:100%;"><span>创建时间:</span> <?=$order['createTime']?></li>
											<li style="width:100%;"><span>付款时间:</span> <?=$order['paidTime']?></li>
											<li style="width:100%;"><span>接单时间:</span> <?=$order['takenTime']?></li>
											<li style="width:100%;"><span>结束时间:</span> <?=$order['finishedTime']?></li>
										</ul>
									</div>
								</div>
							</div>
							<?php
							$orderRow++; 
							?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>

		</table>
	</div>
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
