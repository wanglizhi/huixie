<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">
<div class="content-block-title">订单编号：<?php echo $order['orderNum'];?></div>
<div class="list-block">
            <ul>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">专业</div>
                  <div class="item-after"><?php echo $order['major'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">课程名</div>
                  <div class="item-after"><?php echo $order['courseName'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">页数</div>
                  <div class="item-after"><?php echo $order['pageNum'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">阅读材料</div>
                  <div class="item-after"><?php echo $order['refDoc'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">截止日期</div>
                  <div class="item-after"><?php 
                        date_default_timezone_set("PRC");
                        $timestamp = strtotime($order['endTime']);
                        date_default_timezone_set($order['timezone']);
                        echo date("Y-m-d H:i:s",$timestamp);
                    ?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">时区</div>
                  <div class="item-after"><?php echo $order['timezone'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">补充要求</div>
                  <p><?php echo $order['requirement'];?></p>
                </div>
              </li>
            </ul>
          </div>

<div class="content-block-title">选择的TA信息</div>
<div class="list-block media-list">
            <ul>
<?php if(!empty($taList))foreach ($taList as $ta):?>

        <li>
    <label class="item-content">
      <div class="item-media"><i class="icon icon-form-checkbox"></i><img src="<?php echo $ta['userInfo']['headimgurl'];?>" style='width: 4rem;'></div>
      <div class="item-inner">
        <div class="item-title-row">
          <div class="item-title"><?php echo $ta['userInfo']['nickname'];?></div>
          <div class="item-after">评级：<?php echo $ta['star'];?></div>
        </div>
        <div class="item-subtitle">单价：<?php echo $ta['unitPrice'];?></div>
        <div class="item-text">
            当前状态：
            <?php if($ta['state']==0): ?>
                <span class="label label-success">空闲</span>
            <?php elseif($ta['state']==1): ?>
                <span class="label label-warning">有课</span>
            <?php else: ?>
                <span class="label label-important">忙碌</span>
            <?php endif ?>
        </div>
      </div>
    </label>
  </li>
      <?php endforeach;?>
      <li class="item-content">
                            <div class="item-inner">
                                <p>如果没有选择TA或者TA没有接单，系统将会自动分配TA，请您放心！</p>
                            </div>
                        </li>
</ul>
</div>

<div class="content-block-title">付款详情（我们收取TA价格区间的最大值，交易成功后返回实际差额）</div>
<div class="list-block">
    <ul>
      <li class="item-content">
        <div class="item-inner">
          <div class="item-title">选择助教的最大金额</div>
          <div class="item-after"><?php echo $max;?></div>
        </div>
      </li>
      <li class="item-content">
        <div class="item-inner">
          <div class="item-title">选择助教的最小金额</div>
          <div class="item-after"><?php echo $min;?></div>
        </div>
      </li>
      <li class="item-content">
        <div class="item-inner">
          <div class="item-title">实际收取金额</div>
          <div class="item-after"><?php echo $max;?></div>
        </div>
      </li>
      <li class="item-content">
        <div class="item-inner">
          <div class="item-title">用户余额</div>
          <div class="item-after"><?php echo $user['balance'];?></div>
        </div>
      </li>
    </ul>
</div>

<div class="content-block">
        <div class="item-inner">
        <label>
          <input type="checkbox" id="checkBalance" onchange="useBalance()">使用余额
        </label>
        <label>余额支付：$<span id="useBalance">0</span></label>
        <label>现金支付：$<span id="payPrice"><?php echo $max;?></span></label>
      </div>
      </div>

<div class="content-block-title">请选择付款方式</div>
<div class="content-block">
<div id="payOption">
<a class="btn btn-primary btn-block" href="javascript:void(0)" onclick="postPaypal()">Paypal</a><br>
<a class="btn btn-positive btn-block" href="javascript:void(0)" onclick="callpay()" id="wxpayBtn">微信支付</a>
</div>
</div>

<div class="content-block">
    <div class="row">
      <div class="col-100"><a href="<?php echo site_url('customer/order/payOrder/'.$max);?>" class="button button-big button-fill button-success" id="submitOrder">提交</a></div>
    </div>
</div>


</div>
<!-- end content-->
<script type="text/javascript">
    $('#submitOrder').hide();
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
      if($('#checkBalance').is(':checked')){
        // console.log('checked');
        // console.log(balance);
        // alert('checked');
        if(balance < max){
          payPrice = max - balance;
          usb = balance;
          $('#payPrice').html(payPrice);
          $('#useBalance').html(usb);
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
          $('#useBalance').html(usb);
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
        $('#useBalance').html(usb);
        $('#payOption').show();
        $('#submitOrder').hide();
        //$('#modifyTa').show();
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