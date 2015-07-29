<!-- BEGIN PAGE -->  
<div class="page-content">

	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">
				<h3 class="page-title">
					用户管理
				</h3>
			</div>

		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<?php if(isset($user)&& !empty($user)): ?>
		<div class="row-fluid">
			<div class="row-fluid span4">
				<div class="span8">
					<ul class="unstyled profile-nav" style="align: center;">
						<li><img src="<?=$user['headimgurl']?>" alt=""></li>
					</ul>
				</div>
				<div class="span12">
					<div class="portlet sale-summary">

						<div class="portlet-title">

							<div class="caption">用户账户</div>

						</div>

						<ul class="unstyled">

							<li>

								<span class="sale-info" style="font-size: 16px;">余额</span> 

								<span class="sale-num">100元</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="span8">
			<div class="profile-classic span6">
				<ul class="unstyled">

					<li><span>用户名:</span> <?=$user['nickname']?></li>

					<li>
						<span>性别:</span> 
						<?php 
						if($user['sex']==0) echo "女";
						else echo "男";
						?>
					</li>

					<li><span>国家:</span> <?=$user['country']?></li>

					<li><span>省份:</span> <?=$user['province']?></li>

					<li><span>城市:</span> <?=$user['city']?></li>

					<li><span>大学:</span> <?=$user['university']?></li>

					<li><span>邮箱:</span> <?=$user['email']?></li>
				</ul>
			</div>
			<div class="profile-classic span6">
				<ul class="unstyled">

					<li><span>用户ID:</span> <?=$user['openid']?></li>

					<li><span>语言:</span> <?=$user['language']?></li>

					<li><span>分组:</span> <?=$user['groupid']?></li>

					<li>
						<span>关注微信号:</span>
						<?php if($user['subscribe']==0): ?>
						<td> <span class="label label-default" style="color:white;">未关注</span></td>
						<?php else: ?>
						<td> <span class="label label-success" style="color:white;">已关注</span></td>
						<?php endif;?>
					</li>

					<li><span>关注时间:</span> <?=date("Y-m-d H:i:s",$user['subscribe_time'])?></li>

					<li><span>创建时间:</span> <?=$user['createTime']?></li>
				</ul>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="portlet box" id="form_wizard_1">
					<div class="portlet-body">
						<div>
							<table class="table" id="orderList">
								<thead>
									<tr>
										<th>订单编号</th>
										<th>TA编号</th>
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
										<td> <?php echo $order['taId'];?> </td>
										<td> <?php echo $order['finishedTime'];?> </td>
										<td> <?php echo $order['price'];?> </td>
										<?php if($order['hasPaid']==0): ?>
										<td> <span class="label label-default">未付款</span></td>
									<?php elseif($order['hasTaken']==0): ?>
									<td> <span class="label label-warning">已付款</span></td>
								<?php elseif($order['hasFinished']==0): ?>
								<td> <span class="label label-info">已接单</span></td>
							<?php else: ?>
							<td> <span class="label label-success">已完成</span></td>
						<?php endif; ?>
						<td>
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

<?php else: ?>
	<div class="row-fluid" style="width:100%;">
		<div class="alert alert-block alert-error fade in" style="margin-left:auto;margin-right:auto;width: 50%;">

			<button type="button" class="close" data-dismiss="alert"></button>

			<h4 class="alert-heading">错误</h4>

			<p style="text-align: center;">
				不存在该用户！
			</p>

		</div>
	</div>
<?php endif; ?>
<!-- END PAGE CONTENT-->         

</div>
<!-- END PAGE CONTAINER-->

</div>
<!-- END PAGE -->  
