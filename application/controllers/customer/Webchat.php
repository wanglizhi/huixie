<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Webchat extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	//默认入口
	function index(){
		$this->log('index start <-----------------------------------------------');
		// $this->load->model('Ctoken_model');
		// echo $this->Ctoken_model->getAccessToken();;

		$this->load->model('Weixin_model');
		// $this->Weixin_model->getAllFollower();
		// $this->Weixin_model->getFollowerInfo('oJWDev7W6DN_6gKuLumLPoOUeky4');

		$this->load->model('Admin_model');
		$admin = $this->Admin_model->searchByName('admin2');

		// $result =  json_decode(json_encode($admin),true);
		$result = array('1'=>1, '2'=>3);
		if($result){
			echo 'true';
		}else{
			echo 'false';
		}
		var_dump($result);
		//$this->Weixin_model->sendTemplateMessage();

		//url encode
		// 授权接口需要转码
		// $url = 'http://huixie.me/index.php/user/orderPage';
		// echo urlencode($url);
		
		$this->log('index end ==================================================>');
	}

	// 要连接数据库，检测更新
	private function getAccessToken(){
		$token = 'Ex2ZupGFEqr6RGucCCB8R2DjnJd4T9ZfT2sdvOrf_cgYZNYCfy7Dhyiglga8-kc8b4H4XlHvO5-o6dZb1Wk5YBnVzTfMC--oXtwa9516-bY';
		return $token;
	}
//  https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fnomoredue.com%2Fhuixie%2Findex.php%2Fuser%2ForderPage&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect

	//添加自定义菜单函数
	private function createMenu(){
		//此处使用CURL发送Https请求
		$token = $this->getAccessToken();
		$this->load->model('HttpModel');
		$menuData = array(
			'button'=>array(
				array(
					'type' => 'view',
					'name' => '我要下单',
					'key' => 'B1_order'
				),
				array(
					'name' => '订单列表',
					'sub_button' => array(
						array(
							'type' => 'click',
							'name' => '待付款',
							'key' => 'B2_unpaid'
						),
						array(
							'type' => 'click',
							'name' => '待接单',
							'key' => 'B2_unselected'
						),
						array(
							'type' => 'click',
							'name' => '已接单',
							'key' => 'B2_unfinished'
						),
						array(
							'type' => 'click',
							'name' => '已完成',
							'key' => 'B2_finished'
						)
				),
				array(
					'name' => '接单列表',
					'sub_button' => array(
						array(
							'type' => 'click',
							'name' => '待选择',
							'key' => 'B3_unselected'
						),
						array(
							'type' => 'click',
							'name' => '进行中',
							'key' => 'B3_unfinished'
						),
						array(
							'type' => 'click',
							'name' => '已完成',
							'key' => 'B3_finished'
						)
					)
				)
			)
		));
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token;
		$ret = $this->HttpModel->doCurlPostRequest($url, json_encode($menuData, JSON_UNESCAPED_UNICODE));
		$retData = json_decode($ret, true);

		var_dump($retData);

	}


	//测试接收和回复用户消息的函数，原样返回消息
	private function autoReply(){
		if(isset($GLOBALS['HTTP_RAW_POST_DATA'])){
			$postData = $GLOBALS['HTTP_RAW_POST_DATA'];
			$this->log('$postData=>'.$postData);
		}else{
			$this->log('$postData=> NULL');
			exit(0);
		}
		$xmlObj = simplexml_load_string($postData, 'SimpleXMLElement',LIBXML_NOCDATA);
		if(!$xmlObj){
			echo 'wrong input';
			$this->log('$xmlObj=> NULL');
			exit(0);
		}
		$fromUserName = $xmlObj->FromUserName;
		$toUserName = $xmlObj->ToUserName;
		$msgType = $xmlObj->MsgType;
		if('text' != $msgType){
			$retMsg = '只关注文本消息';
		}else{
			$content = $xmlObj->Content;
			$retMsg = $content;
		}
		$retTmp = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[text]]></MsgType>
			<Content><![CDATA[%s]]></Content>
			<FuncFlag>0</FuncFlag>
			</xml>";
		$resultStr = sprintf($retTmp, $fromUserName, $toUserName, time(), $retMsg);
		$this->log('$resultStr=>'.$resultStr);
		echo $resultStr;
	}

	//验证签名(只有这一个函数，一般只调用一次)
	private function checkSignature(){
		if(!isset($_GET['signature'])){
			log_message('info','checkSignature error');
			exit(0);
		}
		$signature = $_GET['signature'];
		$timestamp = $_GET['timestamp'];
		$nonce = $_GET['nonce'];

		$token = 'fuxuejiaoyu';
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if($tmpStr == $signature){
			return true;
		}else{
			log_message('info','checkSignature error');
			exit(0);
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

	//获取IP
	private function getIp(){
		if(isset($_SERVER)){
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else if(isset($_SERVER['HTTP_CLIENT_IP'])){
				$realip = $_SERVER['HTTP_CLIENT_IP'];
			}else{
				$realip = $_SERVER['REMOTE_ADDR'];
			}
		}else{
			if(getenv('HTTP_X_FORWARDED_FOR')){
				$realip = getenv('HTTP_X_FORWARDED_FOR');
			}else if(getenv('HTTP_CLIENT_IP')){
				$realip = getenv('HTTP_CLIENT_IP');
			}else{
				$realip = getenv('REMOTE_ADDR');
			}
		}
	}
}