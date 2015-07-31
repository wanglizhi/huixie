<!-- BEGIN PAGE -->
<div class="page-content">

	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">
				<h3 class="page-title">用户管理</h3>
			</div>

		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<?php if(isset($user)&& !empty($user)): ?>
		<div class="tabbable tabble-custom boxless">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#user_info" data-toggle="tab">用户信息</a>
				</li>
				<li>
					<a href="#user_order" data-toggle="tab">用户订单列表</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active form" id="user_info">
					<form action="<?php echo site_url(ADMIN_PREFIX."user/updateUser")?>
						" class="form-horizontal" id="updateUserForm" method="post">
						<div class="row-fluid">
							<div class="row-fluid span4">
								<div class="span8">
									<ul class="unstyled profile-nav" style="align: center;">
										<li>
											<img src="<?=$user['headimgurl']?>" alt=""></li>
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
							<style>
							.control-input{
								margin-bottom: 0px !important;
							}
							.control-input span{
								width: 70px !important;
							}
							</style>
							<div class="span8">
								<h3 class="form-section">微信信息</h3>
								<div class="span12">

									<div class="profile-classic span6">
										<ul class="unstyled">

											<li>
												<span>用户ID:</span>
												<?=$user['openid']?>
												<input type="hidden" id = "openid" name = "openid" value="<?=$user['openid']?>"/>
											</li>
											
											<li>
												<span>关注微信号:</span>
												<?php if($user['subscribe']==0): ?>
												<td>
													<span class="label label-default" style="color:white;">未关注</span>
												</td>
												<?php else: ?>
												<td>
													<span class="label label-success" style="color:white;">已关注</span>
												</td>
												<?php endif;?></li>
											<li>
												<span>关注时间:</span>
												<?=date("Y-m-d H:i:s",$user['subscribe_time'])?></li>
											
										</ul>
									</div>

									<div class="profile-classic span6">
										<ul class="unstyled">
											<li>
												<span>语言:</span>
												<?=$user['language']?></li>

											<li>
												<span>分组:</span>
												<?=$user['groupid']?></li>

											<li>
												<span>创建时间:</span>
												<?=$user['createTime']?></li>
										</ul>
									</div>
								</div>

								<h3 class="form-section">用户资料</h3>
								
								<div class="span12">
									<div class="profile-classic span6">
										<ul class="unstyled">
											<li >
												<div class="control-group control-input">

												<span class="control-label">
													用户名:
													<span class="required">*</span>
												</span>

												<div class="controls" style="margin-left: 0px;">
													<input type="text"  id="nickname" name="nickname" data-required="1" class="span6 m-wrap" value="<?=$user['nickname']?>" readonly></div>
											</li>
											<li >
												<div class="control-group control-input">

												<span class="control-label">
													国家:
													<span class="required">*</span>
												</span>

												<div class="controls" style="margin-left: 0px;">
													<input type="text"  id="country" name="country" data-required="1" class="span6 m-wrap" value="<?=$user['country']?>" readonly></div>
											</li>
											<li >
												<div class="control-group control-input">

												<span class="control-label">
													城市:
													<span class="required">*</span>
												</span>

												<div class="controls" style="margin-left: 0px;">
													<input type="text"  id="city" name="city" data-required="1" class="span6 m-wrap" value="<?=$user['city']?>" readonly></div>
											</li>
											<li >
												<div class="control-group control-input">

												<span class="control-label">
													邮箱:
													<span class="required"> </span>
												</span>

												<div class="controls" style="margin-left: 0px;">
													<input type="text"  id="email" name="email" data-required="1" class="span6 m-wrap" value="<?=$user['email']?>" ></div>
											</li>
										</ul>
									</div>
									<div class="profile-classic span6">
										<ul class="unstyled">

											
											<li class="control-group control-input">

												<span class="control-label" style="width: 70px;">
													性别:
													<span class="required">*</span>
												</span>

												<div class="controls" style="margin-left: 0px;">
													<input type="text"  id="sex" name="sex" data-required="1" class="span6 m-wrap" value="<?php if($user['sex']==0) echo "女";else echo "男";?>" readonly>
												</div>

											</li>
											<li >
												<div class="control-group control-input">

												<span class="control-label">
													省份:
													<span class="required">*</span>
												</span>

												<div class="controls" style="margin-left: 0px;">
													<input type="text"  id="province" name="province" data-required="1" class="span6 m-wrap" value="<?=$user['province']?>" readonly></div>
											</li>
											<li >
												<div class="control-group control-input">

												<span class="control-label">
													大学:
													<span class="required"> </span>
												</span>

												<div class="controls" style="margin-left: 0px;">
													<input type="text"  id="university" name="university" data-required="1" class="span6 m-wrap" value="<?=$user['university']?>" ></div>
											</li>
										</ul>
									</div>
								</div>
								<div class="span12">

									<div class="form-actions" style="background: transparent;align: center;border-top:none;">

										<button type="submit" class="btn blue span2" style="width: 30%;"> <i class="icon-ok"></i>
											修改
										</button>

									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane" id="user_order">
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
										<td> <span class="label label-info">已接单</span></td>
										<?php else: ?>
										<td> <span class="label label-success">已完成</span></td>
										<?php endif; ?>
										<td>
											<?php static $orderRow = 0; ?>
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
											<?php $orderRow++;?>
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

						<p style="text-align: center;">不存在该用户！</p>

					</div>
				</div>
				<?php endif; ?>
				<!-- END PAGE CONTENT-->

			</div>
			<!-- END PAGE CONTAINER-->

		</div>
		<!-- END PAGE -->