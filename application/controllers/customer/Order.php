<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Order extends CustomerController {
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->addOrderPage();
	}
	//添加订单
	function addOrderPage(){
		$this->load->view('customer/header');
		$this->load->view('customer/add_order');
		$this->load->view('customer/footer');
	}
	function addOrder(){

		// echo $_POST['endDate'].'--'.$_POST['endTime'].'--'.$_POST['prov'].'--'.$_POST['city'];
		// exit(0);

		$this->load->model('Order_model');
		$user = $_SESSION['user'];

		// 2015-07-14T08:55Z
		// echo $_POST['endTime'];
		$data['major'] = $_POST['prov'].'-'.$_POST['city'];
		$data['courseName'] = $_POST['courseName'];
		$data['email'] = $_POST['email'];
		$data['pageNum'] = $_POST['pageNum'];
		$data['refDoc'] = $_POST['refDoc'];
		$data['requirement'] = $_POST['requirement'];
		$data['endTime'] = $_POST['endDate'].' '.$_POST['endTime'];
		$data['userId'] = $user['openid'];
		date_default_timezone_set('PRC');
		$data['createTime'] = date('Y-m-d h:i:s');
		$data['orderNum'] = time();
		if(!(isset($data['major']) and isset($data['courseName']) and isset($data['userId']) and isset($data['email'])) ){
			redirect('customer/order/addOrderPage');
		}
		$order = $this->Order_model->add($data);
		if (!isset($order)) {
			redirect('customer/order/addOrderPage');
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
		$_SESSION['order'] = $order;
		$taList = $this->Ta_model->searchBySkills($order['major']);
		$length = count($taList);
		for ($i=0; $i < $length; $i++) {
			$taList[$i]['userInfo'] = $this->User_model->searchById($taList[$i]['openid']);
		}

		// $ta1 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $ta2 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $taList = array('1'=>$ta1, '2'=>$ta2);

		$data['taList'] = $taList;
		$this->load->view('customer/header', $data);
		$this->load->view('customer/select_ta');
		$this->load->view('customer/footer');
	}

	function payOrderPage(){
		// 如果没有TA选择，如何处理。。。。

		if(isset($_POST['taIdList'])){
			$taIdList = $_POST['taIdList'];
		}else{
			$taIdList = array();
		}
		$taIdList = $_POST['taIdList'];
		$taList = array();
		$this->load->model('Ta_model');
		$max = 0;
		$min = 100000;
		foreach ($taIdList as $taId) {
			//ta 对象里要加userInfo项目
			$ta = $this->Ta_model->searchById($taId);
			$taList[$taId] = $ta;
			if($ta['unitPrice'] > $max){
				$max = $ta['unitPrice'];
			}
			if($ta['unitPrice'] < $min){
				$min = $ta['unitPrice'];
			}
		}
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($_SESSION['order']['orderNum']);

		$data['order'] = $order;
		$data['taList'] = $taList;
		$data['max'] = $max * $order['pageNum'];
		$data['min'] = $min * $order['pageNum'];
		$sessionId = session_id();
		$data['sessionId'] = $sessionId;
		//添加到session
		$_SESSION['price'] = $data['max'];
		$_SESSION['taList'] = $taList;
		
		//数据测试
		// $data['max'] = 100;
		// $data['min'] = 10;
		// $data['order'] = array('orderNum'=>1234567,'courseName'=>'设计与实现','major'=>'软件工程', 'pageNum'=>10, 'refDoc'=>6, 'endTime'=>'2015-6-10', 'requirement'=>'没有什么要求，好好写就行');
		// $ta1 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $ta2 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $taList = array('1'=>$ta1, '2'=>$ta2);
		// $data['taList'] = $taList;

		$this->load->view('customer/header', $data);
		$this->load->view('customer/pay_order_detail');
		$this->load->view('customer/footer');
	}
	// 付款
	function payOrder(){
		$this->log('enter payOrder');
		$user = $_SESSION['user'];
		$order = $_SESSION['order'];
		var_dump($order);
		$order['price'] = $_SESSION['price'];
		$this->load->model('Weixin_model');
		$this->load->model('Message_model');
		$order['hasPaid'] = 1;
		date_default_timezone_set('PRC');
		$order['paidTime'] = date('Y-m-d h:i:s');
		$this->load->model('Order_model');
		$this->Order_model->update($order);
		//推送给用户
		$this->Message_model->sendMessageToUser(
				$order,
				$user['openid'],
				'付款成功，订单详情如下：！',
				'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Fhuixie%2Findex.php%2Fcustomer%2Fuser%2ForderDetail%2F'.$order['orderNum'].'&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
				'恭喜你下单成功，请联系客服获得帮助，将参考资料发送到admin@huixie.me');

		//推送给TA
		$selectedTa = $_SESSION['taList'];

		foreach ($selectedTa as $ta) {
			$this->Weixin_model->sendMessageToTa($order, $ta['openid'], '有新的订单提醒');
			$this->Message_model->sendMessageToTa(
				$order,
				$ta['openid'],
				'有新的订单提醒',
				'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Fhuixie%2Findex.php%2Fcustomer%2Fta%2FtakeOrderPage%2F'.$order['orderNum'].'&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
				'请您及时接单，并且联系客服获得相关材料');

			//数据库添加选择的TA列表
			$data['taId'] = $ta['openid'];
			$data['orderNum'] = $order['orderNum'];
			$data['createTime'] = date('Y-m-d h:i:s');
			$this->load->model('Selected_ta_model');
			$this->Selected_ta_model->add($data);
		}
		
		//跳转到接单界面
		redirect('customer/user/orderList');
	}
	function notifyUrl(){
		$this->log('notifyUrl start <-----------------------------------------------');

		// read the post from PayPal system and add 'cmd'  
		$req = 'cmd=_notify-validate';  
		   
		foreach ($_POST as $key => $value) {  
		$value = urlencode(stripslashes($value));  
		$req .= "&$key=$value";
		}  
		   
		// post back to PayPal system to validate  
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";  
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";  
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";  
		   
		$fp = fsockopen ('http://www.sandbox.paypal.com', 80, $errno, $errstr, 60); // 沙盒用  
		//$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30); // 正式用  
		   
		// assign posted variables to local variables  
		$item_name = $_POST['item_name'];  
		$item_number = $_POST['item_number'];  
		$payment_status = $_POST['payment_status'];  
		$payment_amount = $_POST['mc_gross'];  
		$payment_currency = $_POST['mc_currency'];  
		$txn_id = $_POST['txn_id'];  
		$receiver_email = $_POST['receiver_email'];  
		$payer_email = $_POST['payer_email'];  
		$mc_gross = $_POST['mc_gross ']; // 付款金额  
		$custom = $_POST['custom ']; // 得到订单号  

		$this->log($item_number);
		   
		if (!$fp) {  
		// HTTP ERROR  
			$this->log('http error');
		} else {  
			fputs ($fp, $header . $req);  
		while (!feof($fp)) {  
			$res = fgets ($fp, 1024);  
		if (strcmp ($res, "VERIFIED") == 0) {
		// check the payment_status is Completed  
		// check that txn_id has not been previously processed  
		// check that receiver_email is your Primary PayPal email  
		// check that payment_amount/payment_currency are correct  
		// process payment  
		// 验证通过。付款成功了，在这里进行逻辑处理（修改订单状态，邮件提醒，自动发货等）  
			$this->log('VERIFIED');
			$this->log('payment_status->'.$_POST['payment_status']);
		}  
		else if (strcmp ($res, "INVALID") == 0) {  
		// log for manual investigation  
		// 验证失败，可以不处理。  
			$this->log('INVALID');
		}  
		}  
		fclose ($fp);  
		}
		// var_dump($_POST);
		$this->log('notifyUrl end <-----------------------------------------------');
	}

		//写内容到文件，log日志功能
	private function log($str){  
        $mode='a';//追加方式写  
        $file = "log.txt";  
        $oldmask = @umask(0);  
        $fp = @fopen($file,$mode); 
        @flock($fp, 3);  
        if(!$fp)  
        {  
            Return false;  
        }  
        else  
        {  
            @fwrite($fp,date('Y-m-d h:i:sa').' --> '.$str."\n");  
            @fclose($fp);  
            @umask($oldmask);  
            Return true;  
        }  
    }


}
