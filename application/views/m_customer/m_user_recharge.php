<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">
    
<div class="content-block-title">充值详情</div>
<div class="list-block">
    <ul>
      <li class="item-content">
        <div class="item-media"><i class="icon icon-emoji"></i></div>
        <div class="item-inner">
          <div class="item-title">充值金额</div>
          <div class="item-after"><?php echo $recharge;?></div>
        </div>
      </li>
    </ul>
</div>
<div class="content-block-title">请选择付款方式</div>
<a class="btn btn-primary btn-block" href="javascript:void(0)" onclick="postPaypal()">Paypal</a><br>
<a class="btn btn-positive btn-block" href="javascript:void(0)" onclick="callpay()" id="wxpayBtn">微信支付</a>

</div>
<!-- end content-->

<script type="text/javascript">
    var payPrice = <?php echo $recharge;?>;
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
        item_number: "<?php echo $user['openid'];?>",
        cancel_return: "<?php echo site_url('customer/user/rechargePage');?>",
        return: "<?php echo site_url('customer/user/recharge');?>"+"/"+payPrice,
        notify_url: "<?php echo site_url('customer/payment/rechargeNotify');?>"+"/"+payPrice,
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
    function jsApiCall()
      {
          WeixinJSBridge.invoke(
              'getBrandWCPayRequest',
              jsApiParameters,
              function(res){
                  WeixinJSBridge.log(res.err_msg);
                  alert(res.err_msg);
                  if(res.err_msg == 'get_brand_wcpay_request:cancel' || res.err_msg == 'get_brand_wcpay_request:fail'){
                    alert("cancel");
                  }else if(res.err_msg == 'get_brand_wcpay_request:ok'){
                    window.location.href = "<?php echo site_url('customer/user/recharge');?>"+ "/" + payPrice;
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