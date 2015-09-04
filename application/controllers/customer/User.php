<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class User extends CustomerController {
	function __construct(){
		parent::__construct();
		$this->load->model('Http_model');
		$this->load->library('mypagination');
	}
	function logout(){
		if (!session_id()) session_start();
		unset($_SESSION['user']);
		//删除所有该用户的Session文件
		session_destroy();
		redirect('customer/oauth/loginPage');
	}
	function infoPage(){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com',
		// 		'cashType'=>1, 'cashAccount'=>'account@paypal.com','balance'=>100);

		$data['user'] = $user;
		$this->loadView('user_info', $data);
	}
	function tradeList($page = 1,$num = ITEMS_PER_PAGE){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com',
		// 		'cashType'=>1, 'cashAccount'=>'account@paypal.com','balance'=>100, 'openid'=>4, 'createTime'=>'2015-08-09', 'balance'=>1000);


		$this->load->model('Trade_model');
		$this->load->model('User_model');
		$result = $this->Trade_model->searchTradeByUser($user['openid'], $page, $num);
		$data['tradeList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/user/tradeList");
		$data['user'] = $this->User_model->searchById($user['openid']);
		// $data['user'] = $user;
		// $_SESSION['user'] = $user;

		$this->loadView('user_trade_list', $data);

	}
	function rechargePage(){
		$user = $_SESSION['user'];
		$recharge = $_POST['recharge'];
		if(!$recharge){
			redirect('customer/user/tradeList');
		}
		$data['recharge'] = $recharge;
		$sessionId = session_id();
		$data['sessionId'] = $sessionId;
		$data['user'] = $user;

		//初始化微信数据
		$jsApiParameters = $this->wxpay($user['openid'], $sessionId, $recharge);
		$data['jsApiParameters'] = $jsApiParameters;

		$this->loadView('user_recharge', $data);
	}
	function recharge($money){

	}
	function modify(){
		$user = $_SESSION['user'];
		$university = $_POST['university'];
		$email = $_POST['email'];
		$cashType = $_POST['cashType'];
		$cashAccount = $_POST['cashAccount'];
		$user['cashType'] = $cashType;
		$user['cashAccount'] = $cashAccount;
		$user['university'] = $university;
		$user['email'] = $email;
		$this->load->model('User_model');
		$this->User_model->modify($user['openid'], $user);
		//更新Session
		$_SESSION['user'] = $this->User_model->searchById($user['openid']);

		redirect('customer/user/infoPage');
	}
	function orderDetail($orderNum){
		$user = $_SESSION['user'];
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($orderNum);

		//测试数据
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com', 'openid'=>12);
		// $order = array('taId'=>2, 'price'=>100, 'hasPaid'=>0, 'hasTaken'=>0, 'orderNum'=>1437727418,'courseName'=>'设计与实现','major'=>'软件工程', 'pageNum'=>10, 'refDoc'=>6, 'createTime'=>'2015-4-30 18：00','endTime'=>'2015-6-10', 'requirement'=>'没有什么要求，好好写就行');

		$data['order'] = $order;
		$data['user'] = $user;

		$this->loadView('user_order_detail', $data);
	}

	function unpaidOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('openid'=>'4');
		// $_SESSION['user'] = $user;


		$data['pageTitle'] = '未付款订单列表';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('userId', $user['openid'], 'hasPaid', 0, $page,$num);

		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/user/unpaidOrderList");

		$this->loadView('user_order_list', $data);
	}
	function deleteOrder($orderNum){
		$user = $_SESSION['user'];
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($orderNum);
		if($order and $order['userId'] == $user['openid']){
			$this->Order_model->delete($orderNum);
		}
		redirect('customer/user/unpaidOrderList');
	}

	function orderList($page = 1,$num = ITEMS_PER_PAGE){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('openid'=>'4');


		$data['pageTitle'] = '我的订单列表';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('userId', $user['openid'], 'hasPaid', 1, $page,$num);

		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/user/orderList");

		$this->loadView('user_order_list', $data);
	}

		//微信支付初始化
	function wxpay($openId, $sessionId, $total_fee){
		require_once(APPPATH."third_party/wxpay/lib/WxPay.JsApiPay.php");
        require_once(APPPATH."third_party/wxpay/lib/log.php");
        require_once(APPPATH."third_party/wxpay/lib/notify.php");
        date_default_timezone_set("Asia/Shanghai");
        //初始化日志
        $logHandler= new CLogFileHandler(APPPATH."third_party/wxpay/logs/".date('Y-m-d').'.log');
        $log = Log::Init($logHandler, 15);

        //①、获取用户openid
        $tools = new JsApiPay();
        // $openId = $tools->GetOpenid();
        // $openId = 'oJWDev7W6DN_6gKuLumLPoOUeky4';

        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody("充值");
        $input->SetAttach($sessionId);
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        // $input->SetTotal_fee($total_fee*100);
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("商品标签");
        $input->SetNotify_url("http://huixie.me/index.php/test/wxpay/notify");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        // echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        // $this->printf_info($order);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        // echo $jsApiParameters;

        //获取共享收货地址js函数参数
        // $editAddress = $tools->GetEditAddressParameters();

        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */
        // $this->load->view('customer/jsapi_page',$data);
        return $jsApiParameters;
	}
}
