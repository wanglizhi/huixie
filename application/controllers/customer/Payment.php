<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Payment extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	//网站的回调没有验证方法，必须继承CI_Controller

	function paypalNotify($useBalance=0){
		$this->log('enter notify function');
		// STEP 1: Read POST data

		// reading posted data from directly from $_POST causes serialization 
		// issues with array data in POST
		// reading raw POST data from input stream instead. 
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
		  $keyval = explode ('=', $keyval);
		  if (count($keyval) == 2)
		     $myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) {
		   $get_magic_quotes_exists = true;
		} 
		foreach ($myPost as $key => $value) {        
		   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
		        $value = urlencode(stripslashes($value)); 
		   } else {
		        $value = urlencode($value);
		   }
		   $req .= "&$key=$value";
		}

		// STEP 2: Post IPN data back to paypal to validate

		$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

		// In wamp like environments that do not come bundled with root authority certificates,
		// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
		// of the certificate as shown below.
		// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
		if( !($res = curl_exec($ch)) ) {
		    // error_log("Got " . curl_error($ch) . " when processing IPN data");
		    $this->log('error curl_error($ch)');
		    curl_close($ch);
		    exit;
		}
		curl_close($ch);


		// STEP 3: Inspect IPN validation result and act accordingly

		if (strcmp ($res, "VERIFIED") == 0) {
		    // check whether the payment_status is Completed
		    // check that txn_id has not been previously processed
		    // check that receiver_email is your Primary PayPal email
		    // check that payment_amount/payment_currency are correct
		    // process payment

		    // assign posted variables to local variables
		    $item_name = $_POST['item_name'];
		    $item_number = $_POST['item_number'];
		    $payment_status = $_POST['payment_status'];
		    $payment_amount = $_POST['mc_gross'];
		    $payment_currency = $_POST['mc_currency'];
		    $txn_id = $_POST['txn_id'];
		    $receiver_email = $_POST['receiver_email'];
		    $payer_email = $_POST['payer_email'];

		    $this->log('VERIFIED');
		    $this->log($item_name);
		    $this->log($item_number);
		    $this->log($payment_status);
		    $this->log($payment_amount);
		    $this->log($_POST['pending_reason']);
		    
		    //判断正确性并且进行下一步操作
		    session_id($item_name);
		    session_start();
		    $user = $_SESSION['user'];
			$order = $_SESSION['order'];
			$this->log($user['openid']);
			$this->log($order['orderNum']);

		    $this->payOrder($item_name, $useBalance);

		    // <---- HERE you can do your INSERT to the database

		} else if (strcmp ($res, "INVALID") == 0) {
		    // log for manual investigation
		    $this->log('INVALID');
		}

	}
	// 付款
	function payOrder($sessionId, $useBalance=0){
		session_id($sessionId);
	    session_start();
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

	function rechargeNotify($money){
		$this->log('enter notify function');
		// STEP 1: Read POST data

		// reading posted data from directly from $_POST causes serialization 
		// issues with array data in POST
		// reading raw POST data from input stream instead. 
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
		  $keyval = explode ('=', $keyval);
		  if (count($keyval) == 2)
		     $myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) {
		   $get_magic_quotes_exists = true;
		} 
		foreach ($myPost as $key => $value) {        
		   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
		        $value = urlencode(stripslashes($value)); 
		   } else {
		        $value = urlencode($value);
		   }
		   $req .= "&$key=$value";
		}

		// STEP 2: Post IPN data back to paypal to validate

		$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

		// In wamp like environments that do not come bundled with root authority certificates,
		// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
		// of the certificate as shown below.
		// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
		if( !($res = curl_exec($ch)) ) {
		    // error_log("Got " . curl_error($ch) . " when processing IPN data");
		    $this->log('error curl_error($ch)');
		    curl_close($ch);
		    exit;
		}
		curl_close($ch);


		// STEP 3: Inspect IPN validation result and act accordingly

		if (strcmp ($res, "VERIFIED") == 0) {
		    // check whether the payment_status is Completed
		    // check that txn_id has not been previously processed
		    // check that receiver_email is your Primary PayPal email
		    // check that payment_amount/payment_currency are correct
		    // process payment

		    // assign posted variables to local variables
		    $item_name = $_POST['item_name'];
		    $item_number = $_POST['item_number'];
		    $payment_status = $_POST['payment_status'];
		    $payment_amount = $_POST['mc_gross'];
		    $payment_currency = $_POST['mc_currency'];
		    $txn_id = $_POST['txn_id'];
		    $receiver_email = $_POST['receiver_email'];
		    $payer_email = $_POST['payer_email'];

		    $this->log('VERIFIED');
		    $this->log($item_name);
		    $this->log($item_number);
		    $this->log($payment_status);
		    $this->log($payment_amount);
		    $this->log($_POST['pending_reason']);
		    
		    //判断正确性并且进行下一步操作
		    session_id($item_name);
		    session_start();
		    $user = $_SESSION['user'];
			$hasPaid = $_SESSION['hasPaid'];
			$this->log($user['openid']);

		    $this->recharge($item_name, $money);

		    // <---- HERE you can do your INSERT to the database

		} else if (strcmp ($res, "INVALID") == 0) {
		    // log for manual investigation
		    $this->log('INVALID');
		}

	}

	function recharge($sessionId, $money){
		$this->log('enter recharge');
		session_id($sessionId);
		session_start();
		$hasPaid = $_SESSION['hasPaid'];
		$this->log($hasPaid);
		$this->log($money);
		$user = $_SESSION['user'];
		if($hasPaid){
			return;
		}

		$this->load->model('User_model');
		$this->load->model('Trade_model');
		$user = $this->User_model->searchById($user['openid']);
		$balance = $user['balance'];
		$user['balance'] = $balance + $money;
		$data['openid'] = $user['openid'];
		$data['money'] = $money;
		$data['balance'] = $user['balance'];
		date_default_timezone_set('PRC');
		$data['createTime'] = date('Y-m-d H:i:s');
		$data['describe'] = '用户充值';
		$this->User_model->modify($user['openid'], $user);
		$this->Trade_model->add($data);

		$_SESSION['hasPaid'] = 1;
		$this->load->model('Message_model');
		$this->Message_model->sendRechargeMessage($data,
			'恭喜您充值成功！',
			site_url('customer/user/tradeList'),
			'感谢您使用会写么！');
		$this->log('end recharge');
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
            @fwrite($fp,date('Y-m-d H:i:sa').' --> '.$str."\n");  
            @fclose($fp);  
            @umask($oldmask);  
            Return true;  
        }  
    }
}
