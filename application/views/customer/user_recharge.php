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
          充值信息
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
                            <i class="icon-reorder"></i> 充值详情
                        </div>
                        <div class="tools hidden-phone">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="well">
                            <label>充值金额（$）：
                                <?php echo $recharge;?>
                            </label>
                        </div>

                        <div class="alert alert-info" id="payOption">
                            请选择付款方式：<br>
                            <a class="btn blue btn-block" href="javascript:void(0)" onclick="postPaypal()">Paypal</a><br>
                            <a class="btn green btn-block" href="javascript:void(0)" onclick="callpay()" id="wxpayBtn">微信支付</a>
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
        cancel_return: "<?php echo site_url('customer/user/tradeList');?>",
        return: "<?php echo site_url('customer/user/recharge');?>"+"/"+payPrice,
        notify_url: "<?php echo site_url('customer/payment/paypalNotify');?>"+"/"+payPrice,
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
                    window.location.href = "<?php echo site_url('customer/user/tradeList');?>";
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