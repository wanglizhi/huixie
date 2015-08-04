<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Oauth extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	function testModel(){
		$this->load->model('Ta_model');
		$result = $this->Ta_model->searchBySkills('工程-计算机工程');
		var_dump($result);
	}
	function index(){
		// $this->load->view('customer/test');
		$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');

	}
	function check(){
		echo $_POST['prov'].'--'.$_POST['city'];
	}
	function loginPage(){
		$this->load->view('customer/header');
		$this->load->view('customer/login_page');
		$this->load->view('customer/footer');
	}
	//网站的回调没有验证方法，必须继承CI_Controller

	function notify(){
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
		    session_start($item_name);

		    redirect('customer/order/payOrder');

		    // <---- HERE you can do your INSERT to the database

		} else if (strcmp ($res, "INVALID") == 0) {
		    // log for manual investigation
		    $this->log('INVALID');
		}

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
