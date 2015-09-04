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
		<label>截止日期：<?php 
			date_default_timezone_set("PRC");
			$timestamp = strtotime($order['endTime']);
			date_default_timezone_set($order['timezone']);
			echo date("Y-m-d H:i:s",$timestamp);
		?></label>
		<label>时区：<?php echo $order['timezone'];?></label>
		<label>补充要求：<?php echo $order['requirement'];?></label>
	</div>
	<div class="alert alert-success">
		<h4>选择的TA信息</h4>
		<?php if(!empty($taList))foreach ($taList as $ta):?>
  		<label>姓名：<?php echo $ta['userInfo']['nickname'];?></label>
  		<img src="<?php echo $ta['userInfo']['headimgurl'];?>" alt="..." class="img-circle" style="width:120px;height:120px">
  		<?php endforeach;?>
  		<label>如果没有选择TA或者TA没有接单，系统将会自动分配TA，请您放心！</label>
	</div>

	<div class="alert">
		价格区间（我们收取TA价格区间的最大值，交易成功后返回实际差额）
		<label>【$ <?php echo $min;?>  ~ $<?php echo $max;?>】</label>
		实际收取金额：$<?php echo $max;?>
		<div>
			用户余额:&nbsp$<?php echo $user['balance'];?>
		</div>
		<div class="checkbox">
    		<label>
      		<input type="checkbox" id="checkBalance" onchange="useBalance()"> 选择使用余额支付
    		</label>
    		<label>付款金额：$<span id="payPrice"><?php echo $max;?></span></label>
  		</div>
	</div>

	<div class="alert alert-info" id="payOption">
		请选择付款方式：<br>
		<a class="btn blue btn-block" href="javascript:void(0)" onclick="postPaypal()">Paypal</a><br>
		<a class="btn green btn-block" href="javascript:void(0)" onclick="callpay()" id="wxpayBtn">微信支付</a>

		<!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="acount@huixie.me">
		<input type="hidden" name="item_name" value="<?php echo $sessionId;?>">
		<input type="hidden" name="item_number" value="<?php echo $order['orderNum'];?>"> 
		<input type="hidden" name="cancel_return" value="<?php echo site_url("customer/user/orderDetail/".$order['orderNum']);?>"> 
		<input type="hidden" name="return" value="<?php echo site_url('customer/order/payOrder');?>"> 
		<input type="hidden" name="notify_url" value="<?php echo site_url('customer/payment/paypalNotify');?>">
		<input type="hidden" name="amount" value="<?php echo $max;?>">
		<input type="hidden" name="no_shipping" value="2"> 
		<input type="hidden" name="no_note" value="1"> 
		<input type="hidden" name="currency_code" value="USD">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"> 
		</form> -->
	</div>

	<div class="form-actions">
  			<a href="<?php echo site_url('customer/order/payOrder/'.$max);?>" class="btn green hide" id="submitOrder" role="button">提交订单</a>
  			<a href="<?php echo site_url('customer/order/taSelectPage/'.$order['orderNum']);?>" class="btn blue" style="display: inline;" id="modifyTa"role="button">返回修改</a>
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
		<script type="text/javascript">
		var payPrice = <?php echo $max;?>;
		var max = <?php echo $max;?>;
		var balance = <?php echo $user['balance'];?>;
		var usb = 0;
		var jsApiParameters = <?php echo $jsApiParameters; ?>;
		function postPaypal(){
			console.log('payPrice'+payPrice);
			// alert('payPrice'+payPrice);
			var url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
			var params =
			{
				cmd: "_xclick",
				business: "acount@huixie.me",
				item_name: "<?php echo $sessionId;?>",
				item_number: "<?php echo $order['orderNum'];?>",
				cancel_return: "<?php echo site_url('customer/user/orderDetail/'.$order['orderNum']);?>",
				return: "<?php echo site_url('customer/order/payOrder');?>"+"/"+usb,
				notify_url: "<?php echo site_url('customer/payment/paypalNotify');?>"+"/"+usb,
				amount: payPrice,
				no_shipping: 2,
				no_note: 1,
				currency_code: "USD"
			};
			var temp = document.createElement("form");
		    temp.action = url;
		    temp.method = "post";
		    temp.style.display = "none";
		    for (var x in params) {
		        var opt = document.createElement("input");
		        opt.name = x;
		        opt.value = params[x];
		        temp.appendChild(opt);
		    }
		    document.body.appendChild(temp);
		    temp.submit();
		    return temp;
		}
		function useBalance(){
			if($('#checkBalance').attr('checked')){
				// console.log('checked');
				// console.log(balance);
				// alert('checked');
				if(balance < max){
					payPrice = max - balance;
					usb = balance;
					$('#payPrice').html(payPrice);
					//ajax调用微信获得参数
					$('#wxpayBtn').hide();
					$.ajax({
						url: "<?php echo site_url('customer/order/ajaxCall');?>"+"/"+payPrice+"/"+usb,
						type: "POST",
						data: {},
						// data: {'openId':'<?php echo $order["userId"];?>','sessionId': "<?php echo $sessionId;?>",'orderNum':'<?php echo $order["orderNum"];?>', 'total_fee':payPrice},
						// dataType: "json",
						success: function(data){
							jsApiParameters = eval('(' + data + ')');
							// alert(data);
							$('#wxpayBtn').show();
						},
					});

				}else{
					payPrice = 0;
					usb = max;
					$('#payPrice').html(payPrice);
					$('#payOption').hide();
					$('#submitOrder').show();
				}
			}else{
				// alert('unchecked');
				// console.log('unchecked');
				payPrice = <?php echo $max;?>;
				jsApiParameters = <?php echo $jsApiParameters; ?>;
				usb = 0;
				$('#payPrice').html(payPrice);
				$('#payOption').show();
				$('#submitOrder').hide();
				$('#modifyTa').show();
			}
		}
		function jsApiCall()
	    {
	        WeixinJSBridge.invoke(
	            'getBrandWCPayRequest',
	            jsApiParameters,
	            function(res){
	                WeixinJSBridge.log(res.err_msg);
	                // alert(res.err_msg);
	                if(res.err_msg == 'get_brand_wcpay_request:cancel' || res.err_msg == 'get_brand_wcpay_request:fail'){
	                	// alert("cancel");
	                }else if(res.err_msg == 'get_brand_wcpay_request:ok'){
	                	window.location.href = "<?php echo site_url('customer/order/payOrder');?>"+"/"+usb;
	                }
	            }
	        );
	    }

	    function callpay()
	    {
	        if (typeof WeixinJSBridge == "undefined"){
	            if( document.addEventListener ){
	                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
	            }else if (document.attachEvent){
	                document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
	                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
	            }
	        }else{
	            jsApiCall();
	        }
	    }

		</script>