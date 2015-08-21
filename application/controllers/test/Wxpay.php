<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Wxpay extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        require_once(APPPATH."third_party/wxpay/lib/WxPay.JsApiPay.php");
        require_once(APPPATH."third_party/wxpay/lib/log.php");
        require_once(APPPATH."third_party/wxpay/lib/notify.php");
    }
    function index(){
        date_default_timezone_set("Asia/Shanghai");
        //初始化日志
        $logHandler= new CLogFileHandler(APPPATH."third_party/wxpay/logs/".date('Y-m-d').'.log');
        $log = Log::Init($logHandler, 15);

        //①、获取用户openid
        $tools = new JsApiPay();
        // $openId = $tools->GetOpenid();
        $openId = 'oJWDev7W6DN_6gKuLumLPoOUeky4';

        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody("商品描述 白色iPadmini");
        $input->SetAttach("附加数据");
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("商品标签");
        $input->SetNotify_url("http://huixie.me/index.php/test/wxpay/notify");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        $this->printf_info($order);
        $jsApiParameters = $tools->GetJsApiParameters($order);

        //获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();

        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */
        $data['jsApiParameters'] = $jsApiParameters;
        $data['editAddress'] = $editAddress;
        $this->load->view('customer/jsapi_page',$data);
    }
    function notify(){
        Log::DEBUG("call back before");
        $notify = new PayNotifyCallBack();
        $notify->Handle(false);
        Log::DEBUG("call back after");
    }
    //打印输出数组信息
    function printf_info($data)
    {
        foreach($data as $key=>$value){
            echo "<font color='#00ff55;'>$key</font> : $value <br/>";
        }
    }

}
