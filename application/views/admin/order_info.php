<!-- BEGIN PAGE -->
<div class="page-content">

	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

	<!-- BEGIN PAGE CONTAINER-->
	<style type="text/css">
	.info-label{
		width: 60px;
		text-align: right;
		margin-right: 10px;
		display: inline-block;
	}
	.pay-label{
		float: left;
		width: 60px;
		text-align: right;
		margin-right: 10px;
		display: inline-block;
		margin-top: 5px;
	}
	.good select{
		color: green;
		border-color: green;
	}
	.bad select{
		color: red;
		border-color:red;
	}
	</style>
	<div class="container-fluid">

		<!-- BEGIN PAGE CONTENT-->
		<div class="tab-pane active form" id="order_info">
			<form action="<?php echo site_url(ADMIN_PREFIX.'order/updateOrder')?>
				" class="form-horizontal" id="updateOrderForm" method="post">
				<div class="row-fluid">
					<div class="row-fluid form-section" >
						<h3 style="display:inline-block;">订单信息</h3>
						<div style="display:inline-block;float:right;">
							<h3 style="display:inline-block;margin-right:50px;">接单价：<font color="#169ef4"><?=$order['takenPrice']?></font>元</h3>
							<h3 style="display:inline-block;">总价：<font color="#169ef4"><?=$order['price']?></font>元</h3>
						</div>
					</div>
					<div class="span12">
						<div class="span12">

							<div class="profile-classic span6">
								<ul class="unstyled">

									<li>
										<span class="info-label">订单编号:</span>
										<?=$order['orderNum']?>
										<input type="hidden" id = "orderNum" name = "orderNum" value="<?=$order['orderNum']?>"/>
									</li>
									<li>
										<span class="info-label">专业:</span>
										<?=$order['major']?>
									</li>
									<li>
										<span class="info-label">页数:</span>
										<?=$order['pageNum']?>
									</li>

									<li>
										<span class="info-label">邮箱:</span>
										<?=$order['email']?>
									</li>
									<li>
										<span class="info-label">创建时间:</span>
										<?=$order['createTime']?>
									</li>
								</ul>
							</div>

							<div class="profile-classic span6">
								<ul class="unstyled">
									<li>
										<span class="info-label">用户ID:</span>
										<?=$order['userId']?>
									</li>
									<li>
										<span class="info-label">课程名称:</span>
										<?=$order['courseName']?>
									</li>
									<li>
										<span class="info-label">阅读材料:</span>
										<?=$order['refDoc']?>
									</li>

									<li>
										<span class="info-label">截止时间:</span>
										<?=$order['endTime']?>
									</li>
									<li>
										<span class="info-label">用户截止时间:</span>
										<?php
											$this->load->helper('time');
											echo decodeTime($order['endTime'],$order['timezone'])." (".$order['timezone'].")";
										?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="profile-classic span12">
						<ul class="unstyled">
							<li style="border-top: solid 1px #f5f5f5;">
								<span class="info-label">额外需求:</span>
								<?=$order['requirement']?>
							</li>
						</ul>
					</div>
					<h3 class="form-section">订单状态</h3>
					<div class="span12">
						<div class="span12">
							<div class="profile-classic span6">
								<ul class="unstyled">
									<?php if(!$order['hasPaid']):?>
									<li id="pay-row" class="bad">
									<?php else:?>
									<li id="pay-row" class="good">
									<?php endif;?>
										<span class="pay-label">付款状态:</span>
										<select id="hasPaid" name="hasPaid" class="small m-wrap" tabindex="1" onchange="pay(this)">
											<option style="color:red;" value="<?=FALSE?>" <?php if(!$order['hasPaid']) echo "selected";?> >未付款</option>

											<option value="<?=TRUE?>" <?php if($order['hasPaid']) echo "selected";?>>已付款</option>

										</select>
									</li>
									<?php if(!$order['hasTaken']):?>
									<li id="taken-row" class="bad">
									<?php else:?>
									<li id="taken-row" class="good">
									<?php endif;?>
										<span class="pay-label">接单状态:</span>
										<select id="hasTaken" name="hasTaken" class="small m-wrap" tabindex="1" onchange="taken(this)">
											<option value="<?=FALSE?>" <?php if(!$order['hasTaken']) echo "selected";?> >未接单</option>

											<option value="<?=TRUE?>" <?php if($order['hasTaken']) echo "selected";?> >已接单</option>
											
										</select>
									</li>
									<?php if(!$order['hasFinished']):?>
									<li id="finish-row" class="bad">
									<?php else:?>
									<li id="finish-row" class="good">
									<?php endif;?>
										<span class="pay-label">完成状态:</span>
										<select id="hasFinished" name="hasFinished" class="small m-wrap" tabindex="1" onchange="finish(this)">
											<option value="<?=FALSE?>" <?php if(!$order['hasFinished']) echo "selected";?> >未完成</option>

											<option value="<?=TRUE?>" <?php if($order['hasFinished']) echo "selected";?>>已完成</option>

										</select>
									</li>
									<li>
										<div class="control-group control-input" style="margin-bottom:0px;">

											<span class="pay-label" style="color: #666;">
												TA ID:
											</span>

											<div class="controls" style="margin-left: 0px;">
												<input type="text"  id="taId" name="taId" data-required="1" class="span6 m-wrap" value="<?=$order['taId']?>">
											</div>
										</div>
									</li>
								</ul>
								<script type="text/javascript">
								function pay(payState){
									if(payState.value==1){
										var paidTime = document.getElementById('paidTime');
										paidTime.value = moment().format("YYYY-MM-DD HH:mm:ss");
										$('#pay-row').removeClass().addClass("good");
									}else{
										$('#pay-row').removeClass().addClass("bad");
									}
								}
								function taken(takenState){
									if(takenState.value==1){
										var takenTime = document.getElementById('takenTime');
										takenTime.value = moment().format("YYYY-MM-DD HH:mm:ss");
										$('#taken-row').removeClass().addClass("good");
									}else{
										$('#taken-row').removeClass().addClass("bad");
									}
								}
								function finish(finishState){
									if(finishState.value==1){
										var finishTime = document.getElementById('finishedTime');
										finishTime.value = moment().format("YYYY-MM-DD HH:mm:ss");
										$('#finish-row').removeClass().addClass("good");
									}else{
										$('#finish-row').removeClass().addClass("bad");
									}
								}
								</script>
							</div>

							<div class="profile-classic span6">
								<ul class="unstyled">
									<li class="control-group control-input" style="margin-bottom:0px;">

										<span class="pay-label">
											付款时间:
										</span>

										<div class="controls" style="margin-left: 0px;">
											<input type="text"  id="paidTime" name="paidTime" data-required="1" class="span6 m-wrap" value="<?=$order['paidTime']?>">
										</div>
									</li>
									<li class="control-group control-input" style="margin-bottom:0px;">

										<span class="pay-label">
											接单时间:
										</span>

										<div class="controls" style="margin-left: 0px;">
											<input type="text"  id="takenTime" name="takenTime" data-required="1" class="span6 m-wrap" value="<?=$order['takenTime']?>">
										</div>
									</li>
									<li class="control-group control-input" style="margin-bottom:0px;">

										<span class="pay-label">
											完成时间:
										</span>

										<div class="controls" style="margin-left: 0px;">
											<input type="text"  id="finishedTime" name="finishedTime" data-required="1" class="span6 m-wrap" value="<?=$order['finishedTime']?>">
										</div>
									</li>
								</ul>

							</div>
						</div>
					</div>
					<div>
						<div class="span12">
							<div class="span12">

								<div class="form-actions" style="background: transparent;align: center;border-top:none;">

									<button type="submit" class="btn blue span2" style="width: 30%;"> <i class="icon-ok"></i>
										修改
									</button>

								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER-->
</div>


		<!-- END PAGE -->