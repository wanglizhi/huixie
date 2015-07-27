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
					订单管理
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
							<i class="icon-reorder"></i> 订单列表
						</div>
						<div class="tools hidden-phone">
							<a href="javascript:;" class="collapse"></a>

						</div>

					</div>

					<div class="portlet-body">
						<div>
							<table class="table" id="orderList">
								<thead>
									<tr>
										<th>订单编号</th>
										<th>用户编号</th>
										<th>TA编号</th>
										<th>专业</th>
										<th>课程名称</th>
										<th>截止日期</th>
										<th>价格</th>
										<th>订单状态</th>
										<th>详情</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($orderList))foreach ($orderList as $order):?>
									<tr>
										<td> <?php echo $order['orderNum'];?> </td>
										<td> <?php echo $order['userId'];?> </td>
										<td> <?php echo $order['taId'];?> </td>
										<td> <?php echo $order['major'];?> </td>
										<td> <?php echo $order['courseName'];?> </td>
										<td> <?php echo $order['finishedTime'];?> </td>
										<td> <?php echo $order['price'];?> </td>
										<?php if($order['hasPaid']==0): ?>
										<td> <span class="label label-default">未付款</span></td>
									<?php elseif($order['hasTaken']==0): ?>
									<td> <span class="label label-warning">已付款</span></td>
								<?php elseif($order['hasFinished']==0): ?>
								<td> <span class="label label-primary">已接单</span></td>
							<?php else: ?>
							<td> <span class="label label-success">已完成</span></td>
						<?php endif; ?>
						<td>
							<?php 
							static $orderRow; 
							?>
							<a href="" data-toggle="modal" data-target="#myModal<?=$orderRow?>">查看详情</a>
							<!-- Modal -->
							<div class="modal fade" id="myModal<?=$orderRow?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?=$orderRow?>">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<div style="width:100%;">
												<h4 class="modal-title" id="myModalLabel<?=$orderRow?>">订单详情</h4>
											</div>
										</div>
										<div class="modal-body">
											<div class="profile-classic row-fluid">
												<ul style="width:100%;" class="unstyled span10">
													<li style="width:100%;"><span>订单编号:</span> <?=$order['orderNum']?></li>
													<li style="width:100%;"><span>用户编号:</span> <?=$order['userId']?></li>
													<li style="width:100%;"><span>专业:</span> <?=$order['major']?></li>
													<li style="width:100%;"><span>课程名称:</span> <?=$order['courseName']?></li>
													<li style="width:100%;"><span>邮箱:</span> <?=$order['email']?></li>
													<li style="width:100%;"><span>页数:</span> <?=$order['pageNum']?></li>
													<li style="width:100%;"><span>阅读材料:</span> <?=$order['refDoc']?></li>
													<li style="width:100%;"><span>截止日期:</span> <?=$order['endTime']?></li>
													<li style="width:100%;"><span>价格:</span> <?=$order['price']?></li>
													<li style="width:100%;"><span>额外需求:</span> <?=$order['requirement']?></li>
													<li style="width:100%;"><span>TA编号:</span> <?=$order['taId']?></li>
													<li style="width:100%;"><span>创建时间:</span> <?=$order['createTime']?></li>
													<li style="width:100%;"><span>付款时间:</span> <?=$order['paidTime']?></li>
													<li style="width:100%;"><span>接单时间:</span> <?=$order['takenTime']?></li>
													<li style="width:100%;"><span>结束时间:</span> <?=$order['finishedTime']?></li>
												</ul>
											</div>
										</div>
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
