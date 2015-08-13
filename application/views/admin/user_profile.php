<!-- BEGIN PAGE -->
<div class="page-content">

	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">
				<h3 class="form-section">
					
					<?php if(isset($ta)) echo "TA管理";
					else echo "用户管理";
					?>

				</h3>
			</div>

		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<?php if(isset($user)&& !empty($user)): ?>
		<div class="tabbable tabble-custom boxless">
			<ul class="nav nav-tabs">
				<?php if(isset($ta)):?>
				<li>
				<?php else:?>
				<li class="active">
				<?php endif;?>
				<a href="#user_info" data-toggle="tab">用户信息</a>
			</li>
			<li>
				<a href="#user_order" data-toggle="tab">用户订单列表</a>
			</li>
			<li>
				<a href="#user_trade" data-toggle="tab">交易记录</a>
			</li>
			<li>
				<a href="#user_cash" data-toggle="tab">支付记录</a>
			</li>
			<?php if(isset($ta)):?>

			<li class="active">
				<a href="#ta_info" data-toggle="tab">TA信息</a>
			</li>
			<li>
				<a href="#ta_order" data-toggle="tab">TA接单列表</a>
			</li>
		<?php endif;?>
	</ul>
	<div class="tab-content">
		<?php if(isset($ta)):?>
		<div class="tab-pane form" id="user_info">
		<?php else:?>
		<div class="tab-pane active form" id="user_info">
		<?php endif;?>
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

									<div class="caption" style="margin-top:auto;margin-bottom:auto;">用户账户</div>
								</div>

								<ul class="unstyled">


									<li>

										<span class="sale-info" style="font-size: 16px;">账户类型</span>

										<span class="sale-num" id="show_type">
											<?php
											$CASH_TYPE = eval(CASH_TYPE);
											echo $CASH_TYPE[$user['cashType']];
											?>
										</span>
									</li>


									<li>

										<span class="sale-info" style="font-size: 16px;">现金账户</span>

										<span class="sale-num" id="show_account"><?=$user['cashAccount']?></span>
									</li>

									<li>

										<span class="sale-info" style="font-size: 16px;">余额</span>

										<a href="#changeBalance" role="button" data-toggle="modal"><span class="sale-num" id="show_balance"><u>$<?=$user['balance']?></u></span></a>
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
												<li class="control-group control-input">

													<span class="control-label">
														用户名:
														<span class="required">*</span>
													</span>

													<div class="controls" style="margin-left: 0px;">
														<input type="text"  id="nickname" name="nickname" data-required="1" class="span6 m-wrap" value="<?=$user['nickname']?>" readonly></div>
													</li>
													<li class="control-group control-input">

														<span class="control-label">
															国家:
															<span class="required">*</span>
														</span>

														<div class="controls" style="margin-left: 0px;">
															<input type="text"  id="country" name="country" data-required="1" class="span6 m-wrap" value="<?=$user['country']?>" readonly></div>
														</li>
														<li class="control-group control-input">

															<span class="control-label">
																城市:
																<span class="required">*</span>
															</span>

															<div class="controls" style="margin-left: 0px;">
																<input type="text"  id="city" name="city" data-required="1" class="span6 m-wrap" value="<?=$user['city']?>" readonly></div>
															</li>
															<li class="control-group control-input">

																<span class="control-label">
																	邮箱:
																	<span class="required"> </span>
																</span>

																<div class="controls" style="margin-left: 0px;">
																	<input type="text"  id="email" name="email" data-required="1" class="span6 m-wrap" value="<?=$user['email']?>" ></div>
																</li>
																<li class="control-group control-input">

																	<span class="control-label">
																		现金账户:
																		<span class="required"> </span>
																	</span>

																	<div class="controls" style="margin-left: 0px;">
																		<input type="text"  id="cashAccount" name="cashAccount" data-required="1" class="span6 m-wrap" value="<?=$user['cashAccount']?>" onKeyUp="updateCashType()"></div>
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
																	<li class="control-group control-input">

																		<span class="control-label">
																			省份:
																			<span class="required">*</span>
																		</span>

																		<div class="controls" style="margin-left: 0px;">
																			<input type="text"  id="province" name="province" data-required="1" class="span6 m-wrap" value="<?=$user['province']?>" readonly></div>
																		</li>
																		<li class="control-group control-input">

																			<span class="control-label">
																				大学:
																				<span class="required"> </span>
																			</span>

																			<div class="controls" style="margin-left: 0px;">
																				<input type="text"  id="university" name="university" data-required="1" class="span6 m-wrap" value="<?=$user['university']?>" ></div>
																			</li>

																			<li class="control-group control-input">

																				<span class="control-label">
																					账户类型:
																					<span class="required"> </span>
																				</span>

																				<div class="controls" style="margin-left: 0px;">
																					<select id="cashType" name="cashType" class="small span6 m-wrap" tabindex="1" onchange="updateCashType()">
																						<option value="1" <?php if($user['cashType']===1) echo "selected";?> >paypal</option>

																						<option value="2" <?php if($user['cashType']===2) echo "selected";?>>alipay</option>

																						<option value="3" <?php if($user['cashType']===3) echo "selected";?>>weixinpay</option>

																					</select>
																				</div>
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
													<!-- Modal -->
													<form action="<?php echo site_url(ADMIN_PREFIX."user/changeBalance")?>
														" class="form-horizontal" id="changeBalanceForm" method="post">

														<input type="hidden" name="user_id" id="user_id" value="<?=$user['openid']?>">

														<div class="modal hide fade modal-overflow" id="changeBalance" tabindex="-1" role="dialog">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
																<h4 class="modal-title" >修改余额</h4>
															</div>
															<div class="modal-body form-horizontal">
																<div class="row-fluid">
																	<div class="control-group">

																		<label class="control-label">
																			原余额:
																			<span class="required">*</span>
																		</label>
																		<div class="controls">

																			<div class="input-prepend span6">

																				<span class="add-on">$</span>
																				<input id="pre" name="pre" class="m-wrap span12" type="text" value="<?=$user['balance']?>" readOnly>
																			</div>

																		</div>

																	</div>
																	<div class="control-group">

																		<label class="control-label">
																			新余额:
																			<span class="required">*</span>
																		</label>
																		<div class="controls">

																			<div class="input-prepend span6">

																				<span class="add-on">$</span>
																				<input id="new_balance" name="new_balance" onKeyUp="updateCash()" class="m-wrap span12" type="text" value="<?=$user['balance']?>">
																			</div>

																		</div>

																	</div>
																	<div class="control-group">

																		<label class="control-label">
																			差值:
																			<span class="required">*</span>
																		</label>
																		<div class="controls">

																			<div class="input-prepend span6">

																				<span class="add-on">$</span>
																				<input id="difference" name="difference" class="m-wrap span12" type="text" value="0" readOnly>
																			</div>

																		</div>

																	</div>
																	<div class="control-group">

																		<label class="control-label">
																			说明:
																		</label>

																		<div class="controls">
																			<textarea class="large span7" rows="3" type="text" id="describe" name="describe" data-required="1" placeHolder="请输入说明"></textarea>
																		</div>

																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
																<button type="submit" class="btn blue">确认修改</button>
															</div>
														</div>
													</form>
												</div>

												<div class="tab-pane" id="user_order">
													<div class="portlet-body">
														<?php
														$userOrderTable['js_page_method'] = "change_user_order_page";
														$dataOrder['orderTable'] = $userOrderTable;
														$dataOrder['page_info'] = $userOrderTable['page_info'];
														$this->load->view(ADMIN_PREFIX."order_table",$dataOrder);
														?>
														<script type="text/javascript">
														function updateCash(){
															var preBalance = eval("<?=$user['balance']?>");
															var nowBalance = parseInt($('#new_balance').val());
															if(isNaN(nowBalance)){
																$('#difference').val("输入的余额有误");
															}else{
																$('#difference').val(nowBalance-preBalance);
															}
														}
														function updateCashType(){
															$('#show_type').text($('#cashType option:selected').text());
															$('#show_account').text($('#cashAccount').val());
														}

														var user_sort_key = "createTime",user_sort_method = "desc",user_current_page = 1;
														function change_user_order_page(page,key,method,callBack){
															if(page===undefined) page = user_current_page;
															if(key===undefined) key = user_sort_key;
															if(method===undefined) method = user_sort_method;
															var tableId = "<?=$userOrderTable['tableId']?>";
															$.ajax({
																url: "<?php echo site_url($userOrderTable['page_info']['page_method'])?>",
																type: "get",
																data: {'page':page,'js_page_method': "change_user_order_page",'sort_key': key,'sort_method':method,'user_id': "<?=$user['openid']?>"},
																dataType: "html",
																success: function(data){
																	$('#'+tableId).html(' ');
																	$('#'+tableId).html(data);
																	user_sort_key = key,user_sort_method = method,user_current_page = page;
																	if(callBack!==undefined) callBack();
																},
															});
														}
														function change_user_trade_page(page,key,method,callBack){
															if(page===undefined) page = current_page;
															var tableId = "<?=$userTradeTable['tableId']?>";
															$.ajax({
																url: "<?php echo site_url($userTradeTable['page_info']['page_method'])?>",
																type: "get",
																data: {'page':page,'js_page_method': "change_user_trade_page",'user_id': "<?=$user['openid']?>"},
																dataType: "html",
																success: function(data){
																	$('#'+tableId).html(' ');
																	$('#'+tableId).html(data);
																	if(callBack!==undefined) callBack();
																},
															});
														}
														function change_user_cash_page(page,key,method,callBack){
															if(page===undefined) page = current_page;
															var tableId = "<?=$userCashTable['tableId']?>";
															$.ajax({
																url: "<?php echo site_url($userCashTable['page_info']['page_method'])?>",
																type: "get",
																data: {'page':page,'js_page_method': "change_user_cash_page",'user_id': "<?=$user['openid']?>"},
																dataType: "html",
																success: function(data){
																	$('#'+tableId).html(' ');
																	$('#'+tableId).html(data);
																	if(callBack!==undefined) callBack();
																},
															});
														}
														</script>
													</div>
												</div>
												<div class="tab-pane" id="user_trade">
													<div class="portlet-body">
														<?php
														$userTradeTable['js_page_method'] = "change_user_trade_page";
														$dataTrade['tradeTable'] = $userTradeTable;
														$dataTrade['page_info'] = $userTradeTable['page_info'];
														$this->load->view(ADMIN_PREFIX."trade_table",$dataTrade);
														?>
														<script type="text/javascript">
														</script>
													</div>
												</div>
												<div class="tab-pane" id="user_cash">
													<div class="portlet-body">
														<?php
														$userCashTable['js_page_method'] = "change_user_cash_page";
														$dataCash['cashTable'] = $userCashTable;
														$dataCash['page_info'] = $userCashTable['page_info'];
														$this->load->view(ADMIN_PREFIX."cash_table",$dataCash);
														?>
														<script type="text/javascript">
														</script>
													</div>
												</div>

												<?php if(isset($ta)): ?>
												<?php
												$dataTa['ta'] = $ta;
												$dataTa['taOrderTable'] = $taOrderTable; 
												$this->load->view(ADMIN_PREFIX.'ta_profile',$dataTa);
												?>
											<?php endif;?>
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