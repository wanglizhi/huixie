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
							付款信息
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
									<i class="icon-reorder"></i> 订单编号：<?php echo $order['orderNum'];?>
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>

								</div>

							</div>

							<div class="portlet-body center">
							
	<div class="alert alert-success">
	<h4>订单详情</h4>
		<label>专业：<?php echo $order['major'];?></label>
		<label>课程名：<?php echo $order['courseName'];?></label>
		<label>页数：<?php echo $order['pageNum'];?></label>
		<label>阅读材料页数：<?php echo $order['refDoc'];?></label>
		<label>截止日期：<?php echo $order['endTime'];?></label>
		<label>补充要求：<?php echo $order['requirement'];?></label>
	</div>
	<div class="alert alert-success">
		<h4>选择的TA信息</h4>
		<?php if(!empty($taList))foreach ($taList as $ta):?>
  		<label>姓名：<?php echo $ta['userInfo']['nickname'];?></label>
  		<img src="<?php echo $ta['userInfo']['headimgurl'];?>" alt="..." class="img-circle" style="width:120px;height:120px">
  		<?php endforeach;?>
	</div>

	<div class="alert">
		价格区间（我们收取TA价格区间的最大值，交易成功后返回实际差额）
		<label>【 <?php echo $min;?> 元 --- <?php echo $max;?> 元 】</label>
		<br>
		实际收取金额：【<?php echo $max;?> 元】
	</div>

	<div class="alert alert-info">
		请选择付款方式：<br>
		<a class="btn blue btn-block" href="<?php echo site_url("customer/order/payOrder");?>">Paypal</a><br>
		<a class="btn green btn-block" link="">微信支付</a><br>
		<a class="btn purple btn-block" link="">支付宝支付</a>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_express-checkout">
<input type="hidden" name="useraction" value="commit">
<input type="hidden" name="token" value="valueFromSetExpressCheckoutResponse">
<input type="hidden" name="hosted_button_id" value="V3WXFF2AKNZDJ">
<input type="hidden" name="return" value="http://huixie.me/huixie/index.php">
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="acount@huixie.me"> 
<input type="hidden" name="item_name" value="item name">
<input type="hidden" name="item_number" value="<?php echo $order['orderNum'];?>"> 
<input type="hidden" name="cancel_return" value="<?php echo site_url("customer/order/payOrderPage");?>"> 
<input type="hidden" name="return" value="<?php echo site_url('customer/user/orderDetail/'.$order['orderNum']);?>"> 
<input type="hidden" name="notify_url" value="<?php echo site_url('customer/order/notify');?>"> 
<input type="hidden" name="amount" value="50.00">
<input type="hidden" name="no_shipping" value="2"> 
<input type="hidden" name="no_note" value="1"> 
<input type="hidden" name="currency_code" value="USD"> 
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but23.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"> 
</form>
		
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