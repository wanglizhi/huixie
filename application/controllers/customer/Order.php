<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Order extends CustomerController {
	function __construct(){
		parent::__construct();
		$this->load->helper('price');
	}
	function index(){
		$this->addOrderPage();
	}
	//添加订单
	function addOrderPage($notice=""){
		$data['notice'] = $notice;
		$data['pageTitle'] = '下订单';
		$this->load_view('m_add_order',$data);
	}
	//保密政策
	function privacy(){
		$data['pageTitle'] = '保密政策';
		$data['back'] = site_url('customer/order/addOrderPage');
		$this->load_view('m_privacy', $data);
	}
	function addOrder(){
		// echo $_POST['endDate'].'--'.$_POST['endTime'].'--'.$_POST['prov'].'--'.$_POST['city'];

		$this->load->model('Order_model');
		$user = $_SESSION['user'];

		$count = $this->Order_model->unpaidCount($user['openid']);
		if($count >= MAX_UNPAID){
			$notice = '未付款订单数量大于'.MAX_UNPAID.'，无法继续添加，请适量删除未付款订单！';
			redirect('customer/order/addOrderPage/'.$notice);
		}

		$endTime = $_POST['endDate'].' '.$_POST['endTime'];
		$timezone = $_POST['timezone'];
		date_default_timezone_set($timezone);
		$timestamp = strtotime($endTime);
		date_default_timezone_set("PRC");
		$data['endTime'] = date("Y-m-d H:i:s",$timestamp);
		$data['timezone'] = $timezone;
		$data['major'] = $_POST['prov'].'-'.$_POST['city'];
		$data['courseName'] = $_POST['courseName'];
		$data['email'] = $_POST['email'];
		$data['pageNum'] = $_POST['pageNum'];
		$data['refDoc'] = $_POST['refDoc'];
		$data['requirement'] = $_POST['requirement'];
		$data['userId'] = $user['openid'];
		//设置orderNum 暂时采用用户openid的后四位+timestamp
		// $str = "oJWDev3kr51nqxTSFNQDaf4y7xHA";
		// $str4 = substr($str,-4,4);
		date_default_timezone_set('PRC');
		$data['createTime'] = date('Y-m-d H:i:s');
		$data['orderNum'] = substr($user['openid'],-4,4).time();
		$data['price'] = getPrice(UNIT_PRICE, $data);
		if(!(isset($data['major']) and isset($data['courseName']) and isset($data['userId']) and isset($data['email'])) ){
			$notice = '信息填写错误';
			redirect('customer/order/addOrderPage/'.$notice);
		}
		$order = $this->Order_model->add($data);
		if (!isset($order)) {
			$notice = '添加失败';
			redirect('customer/order/addOrderPage/'.$notice);
		}else{
			$data['id'] = $order['id'];
			$_SESSION['order'] = $data;
			redirect('customer/order/taSelectPage/'.$data['orderNum']);
		}
	}

	function taSelectPage($orderNum){

		$this->load->model('Ta_model');
		$this->load->model('User_model');
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($orderNum);
		
		$taList = $this->Ta_model->searchBySkills($order['major']);
		$length = count($taList);
		for ($i=0; $i < $length; $i++) {
			$taList[$i]['userInfo'] = $this->User_model->searchById($taList[$i]['openid']);
		}

		// $ta1 = array('openid'=> '123456677', 'state'=>1,'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $ta2 = array('openid'=> '123456677', 'state'=>2,'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $taList = array('1'=>$ta1, '2'=>$ta2);

		$data['taList'] = $taList;
		$data['orderNum'] = $orderNum;
		$data['pageTitle'] = '选择TA';
		$this->load_view('m_select_ta',$data);
	}
	function selectTa($orderNum){
		$this->load->model('Selected_ta_model');
		$this->load->model('Ta_model');
		$this->load->model('Order_model');
		$selectList = $this->Selected_ta_model->searchByOrderNum($orderNum);
		if($selectList){
			$this->Selected_ta_model->delete($orderNum);
		}
		$max = 0;
		$min = 100000;
		if(isset($_POST['taIdList'])){
			$taIdList = $_POST['taIdList'];
			foreach ($taIdList as $taId) {
				//数据库添加选择的TA列表
				$data['taId'] = $taId;
				$data['orderNum'] = $orderNum;
				date_default_timezone_set('PRC');
				$data['createTime'] = date('Y-m-d H:i:s');
				$this->Selected_ta_model->add($data);
				//求最大和最小price
				$ta = $this->Ta_model->searchById($taId);
				if($ta['unitPrice'] > $max){
					$max = $ta['unitPrice'];
				}
				if($ta['unitPrice'] < $min){
					$min = $ta['unitPrice'];
				}
			}
		}else{
			$max = UNIT_PRICE;
		}
		//选择TA后更新价格信息
		$order = $this->Order_model->searchById($orderNum);
		$order['price'] = getPrice($max, $order);
		$this->Order_model->update($order);
		$this->payOrderPage($orderNum, 1);
		// redirect('customer/order/payOrderPage/'.$orderNum.'/1');
	}

	function payOrderPage($orderNum, $force=0){
		// echo current_url();
		$user = $_SESSION['user'];
		$this->load->model('User_model');
		$user = $this->User_model->searchById($user['openid']);
		$this->load->model('Selected_ta_model');
		$selectList = $this->Selected_ta_model->searchByOrderNum($orderNum);
		if($selectList){
			$taList = array();
			$this->load->model('Ta_model');
			$max = 0;
			$min = 100000;
			foreach ($selectList as $select) {
				$ta = $this->Ta_model->searchById($select['taId']);
				$taList[$ta['openid']] = $ta;
				if($ta['unitPrice'] > $max){
					$max = $ta['unitPrice'];
				}
				if($ta['unitPrice'] < $min){
					$min = $ta['unitPrice'];
				}
			}
		}else{
			//如果为空
			//force = 1表示不选择TA，强制判断
			if($force){
				$max = $min = UNIT_PRICE;
				$taList = array();
			}else{
				//默认自动判断，如果没有选择，就跳转
				redirect('customer/order/taSelectPage/'.$orderNum);
			}
		}
		
		// 如果没有TA选择，如何处理。。。。
		
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($orderNum);

		$data['order'] = $order;
		$data['taList'] = $taList;
		$data['max'] = getPrice($max, $order);
		$data['min'] = getPrice($min, $order);
		$sessionId = session_id();
		$data['sessionId'] = $sessionId;
		$data['user'] = $user;
		$data['pageTitle'] = '付款信息';
		//添加到session
		$_SESSION['price'] = $data['max'];
		$_SESSION['order'] = $order;

		//数据测试
		// $data['max'] = 100;
		// $data['min'] = 10;
		// $data['order'] = array('orderNum'=>1234567,'courseName'=>'设计与实现','major'=>'软件工程', 'pageNum'=>10, 'refDoc'=>6, 'endTime'=>'2015-6-10','timezone'=>'EST5EDT', 'requirement'=>'没有什么要求，好好写就行');
		// $ta1 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $ta2 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $taList = array('1'=>$ta1, '2'=>$ta2);
		// $data['sessionId'] = 0;
		// $data['taList'] = $taList;
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com', 'openid'=>12, 'balance'=>1000);
		// $data['user'] = $user;


		//初始化微信数据
		$jsApiParameters = $this->wxpay($user['openid'], $sessionId, $orderNum, $data['max'], 0);
		$data['jsApiParameters'] = $jsApiParameters;


		$this->load_view('m_pay_order_detail',$data);
	}
	// 付款
	function payOrder($useBalance=0){
		$user = $_SESSION['user'];
		$order = $_SESSION['order'];
		$this->load->model('Message_model');
		$this->load->model('Order_model');
		$this->load->model('User_model');
		$this->load->model('Selected_ta_model');

		//判断是否已经付款，避免重复~
		$order = $this->Order_model->searchById($order['orderNum']);
		if($order['hasPaid']){
			redirect('customer/user/orderDetail/'.$order['orderNum']);
		}

		if($useBalance>0){
			//如果使用了余额, 用户balance改变
			$this->User_model->addBalance($user['openid'], 0-$useBalance, "余额支付订单", $order['orderNum']);
			$user = $this->User_model->searchById($user['openid']);
			$_SESSION['user'] = $user;
		}

		// var_dump($order);
		$order['price'] = $_SESSION['price'];
		$order['hasPaid'] = 1;
		date_default_timezone_set('PRC');
		$order['paidTime'] = date('Y-m-d H:i:s');
		$this->Order_model->update($order);
		//推送给用户
		$this->Message_model->sendMessageToUser(
				$order,
				$user['openid'],
				'付款成功，订单详情如下：！',
				site_url('customer/user/orderDetail/'.$order['orderNum']),
				//'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Findex.php%2Fcustomer%2Fuser%2ForderDetail%2F'.$order['orderNum'].'&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
				'恭喜你下单成功，请联系客服获得帮助，将参考资料发送到admin@huixie.me');

		//推送给TA
		$selectList = $this->Selected_ta_model->searchByOrderNum($order['orderNum']);
		foreach ($selectList as $select) {
			$this->Message_model->sendMessageToTa(
				$order,
				$select['taId'],
				'有新的订单提醒',
				site_url('customer/ta/takeOrderPage/'.$order['orderNum']),
				// 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Findex.php%2Fcustomer%2Fta%2FtakeOrderPage%2F'.$order['orderNum'].'&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
				'请您及时接单，并且联系客服获得相关材料');
		}
		//跳转到接单界面
		redirect('customer/user/orderDetail/'.$order['orderNum']);
	}
	//微信支付初始化
	function wxpay($openId, $sessionId, $orderNum, $total_fee, $usb){
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
        $input->SetBody("商品订单编号:".$orderNum);
        $input->SetAttach($sessionId."--".$usb);
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
	function ajaxCall($total_fee, $usb){
		$user = $_SESSION['user'];
		$order = $_SESSION['order'];
		$sessionId = session_id();
		echo $this->wxpay($user['openid'], $sessionId, $order['orderNum'], $total_fee, $usb);
	}

}
