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
	<?php $this->load->helper('time');?>
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
										<?php
										$differ = cal_time_differ($order['createTime'],date("Y-m-d H:i:s",time()));
										echo "（已过去".$differ['day']."天".$differ['hour']."小时".$differ['minute']."分）";
										?>
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
										<?php
										$differ = cal_time_differ(date("Y-m-d H:i:s",time()),$order['endTime']);
										if(($differ['day'])<0 or ($differ['hour'])<0 or $differ['minute']<0)
											echo "（已过截止日期）";
										else
											echo "（还剩".$differ['day']."天".$differ['hour']."小时".$differ['minute']."分）";
										?>
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
					<h3 class="form-section">选择TA列表</h3>
					<?php $this->load->view(ADMIN_PREFIX."selected_ta_table");?>
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
										<option style="color:red;" value="<?=0?>" <?php if(!$order['hasPaid']) echo "selected";?> >未付款</option>

										<option value="<?=1?>" <?php if($order['hasPaid']) echo "selected";?>>已付款</option>

									</select>
								</li>
								<?php if(!$order['hasTaken']):?>
								<li id="taken-row" class="bad">
								<?php else:?>
								<li id="taken-row" class="good">
								<?php endif;?>
								<span class="pay-label">接单状态:</span>
								<select id="hasTaken" name="hasTaken" class="small m-wrap" tabindex="1" onchange="taken(this)">
									<option value="<?=0?>" <?php if(!$order['hasTaken']) echo "selected";?> >未接单</option>

									<option value="<?=1?>" <?php if($order['hasTaken']) echo "selected";?> >已接单</option>

								</select>
							</li>
							<?php if(!$order['hasFinished']):?>
							<li id="finish-row" class="bad">
							<?php else:?>
							<li id="finish-row" class="good">
							<?php endif;?>
							<span class="pay-label">完成状态:</span>
							<select id="hasFinished" name="hasFinished" class="small m-wrap" tabindex="1" onchange="finish(this)">
								<option value="<?=0?>" <?php if(!$order['hasFinished']) echo "selected";?> >未完成</option>

								<option value="<?=1?>" <?php if($order['hasFinished']) echo "selected";?>>已完成</option>

							</select>
						</li>
						<li>
							<div class="control-group control-input" style="margin-bottom:0px;">

								<span class="pay-label" style="color: #666;">
									TA ID:
								</span>

								<div class="controls" style="margin-left: 0px;">
									<input type="text"  id="taId" name="taId" data-required="1" class="span7 m-wrap" value="<?=$order['taId']?>">
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
							$('#taId').val("");
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

				<div class="modal hide fade modal-overflow" id="confirmChange" tabindex="-1" role="dialog">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title" >确认修改</h4>
					</div>
					<style type="text/css">
					.confirm-state li span{
						font-size: 14px !important;
					}
					.confirm-state li{
						font-size: 14px !important;
					}
					.confirm-state .label{
						font-size: 14px !important;
					}
					.strong-text{
						color: red;
						font-size: 16px;
					}
					</style>
					<div class="modal-body form-horizontal">
						<div class="alert" id="confirm-info">没有任何修改！无法提交！</div>
						<div class="profile-classic row-fluid">
							<ul class="confirm-state">
								<li style="width:100%;"><span>付款状态:</span> <div style="display:inline-block" id="confirm-pay-state"></div></li>
								<li style="width:100%;"><span>付款时间:</span> <div style="display:inline-block" id="confirm-pay-time"></div></li>
								<li style="width:100%;"><span>接单状态:</span> <div style="display:inline-block" id="confirm-taken-state"></div></li>
								<li style="width:100%;"><span>接单时间:</span> <div style="display:inline-block" id="confirm-taken-time"></div></li>
								<li style="width:100%;"><span>完成状态:</span> <div style="display:inline-block" id="confirm-finished-state"></div></li>
								<li style="width:100%;"><span>完成时间:</span> <div style="display:inline-block" id="confirm-finished-time"></div></li>
								<li style="width:100%;"><span>TaId:</span> <div style="display:inline-block" id="confirm-taId"></div></li>

							</ul>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
						<button id="confirmButton" type="submit" class="btn blue">确认修改</button>
					</div>
					<script type="text/javascript">
					function confirm(){
						var hasChanged = false;

						var pre_hasPaid = "<?=$order['hasPaid']?>";
						var now_hasPaid = $('#hasPaid').val();
						var pay_state = $('#hasPaid option:selected').text();
						$('#confirm-pay-state').text(pay_state);	
						if(pre_hasPaid==now_hasPaid){
							$('#confirm-pay-state').removeClass();
						}else{
							if(now_hasPaid) $('#confirm-pay-state').addClass("label label-success");
							else $('#confirm-pay-state').addClass("label label-important");
							hasChanged = true;
						}

						var pre_PaidTime = "<?=$order['paidTime']?>";
						var now_PaidTime = $('#paidTime').val();
						$('#confirm-pay-time').text(now_PaidTime);
						if(pre_PaidTime==now_PaidTime){
							$('#confirm-pay-time').removeClass();
						}else{
							$('#confirm-pay-time').addClass("strong-text");
							hasChanged = true;
						}

						var pre_hasTaken = "<?=$order['hasTaken']?>";
						var now_hasTaken = $('#hasTaken').val();
						var taken_state = $('#hasTaken option:selected').text();
						$('#confirm-taken-state').text(taken_state);	
						if(pre_hasTaken==now_hasTaken){
							$('#confirm-taken-state').removeClass();
						}else{
							if(now_hasTaken) $('#confirm-taken-state').addClass("label label-success");
							else $('#confirm-taken-state').addClass("label label-important");
							hasChanged = true;
						}

						var pre_TakenTime = "<?=$order['takenTime']?>";
						var now_TakenTime = $('#takenTime').val();
						$('#confirm-taken-time').text(now_TakenTime);
						if(pre_TakenTime==now_TakenTime){
							$('#confirm-taken-time').removeClass();
						}else{
							$('#confirm-taken-time').addClass("strong-text");
							hasChanged = true;
						}

						var pre_hasFinished = "<?=$order['hasFinished']?>";
						var now_hasFinished = $('#hasFinished').val();
						var finished_state = $('#hasFinished option:selected').text();
						$('#confirm-finished-state').text(finished_state);	
						if(pre_hasFinished==now_hasFinished){
							$('#confirm-finished-state').removeClass();
						}else{
							if(now_hasFinished) $('#confirm-finished-state').addClass("label label-success");
							else $('#confirm-finished-state').addClass("label label-important");
							hasChanged = true;
						}

						var pre_finishedTime = "<?=$order['finishedTime']?>";
						var now_finishedTime = $('#finishedTime').val();
						$('#confirm-finished-time').text(now_finishedTime);
						if(pre_finishedTime==now_finishedTime){
							$('#confirm-finished-time').removeClass();
						}else{
							$('#confirm-finished-time').addClass("strong-text");
							hasChanged = true;
						}

						var pre_Taid = "<?=$order['taId']?>";
						var now_Taid = $('#taId').val();
						$('#confirm-taId').text(now_Taid);
						if(pre_Taid==now_Taid){
							$('#confirm-taId').removeClass();
						}else{
							$('#confirm-taId').addClass("strong-text");
							hasChanged = true;
						}

						if(!hasChanged){
							$('#confirmButton').attr("disabled",true);
							$('#confirm-info').text("没有任何修改！无法提交！");
						}
						else{
							$('#confirmButton').attr("disabled",false);
							$('#confirm-info').text("请确认以下修改");
						}
						$('#confirmChange').modal('show');
					}
					</script>
				</div>
				<div class="span12">
					<div class="span12">

						<div class="form-actions" style="background: transparent;align: center;border-top:none;">

							<button type="button" onclick="return confirm()" class="btn blue span2" style="width: 30%;"> <i class="icon-ok"></i>
								修改
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- END PAGE CONTAINER-->
	</div>
</div>


		<!-- END PAGE -->