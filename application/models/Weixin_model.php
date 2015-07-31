<?php
class Weixin_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function getFollowerInfo($openid){
		$this->load->model('Ctoken_model');
		$token = $this->Ctoken_model->getAccessToken();

		$url = 'https://api.weixin.qq.com/cgi-bin/user/info';
		$para = array(
			'access_token' => $token,
			'openid' => $openid,
			'lang' => 'zh_CN'
		);
		$ret = $this->Http_model->doCurlGetRequest($url, $para);
		$retData = json_decode($ret, true);
		// var_dump($retData);

		return $retData;
	}
	function sendMessageToTa($order, $openid, $first){
		$this->load->model('Ctoken_model');
		$token = $this->Ctoken_model->getAccessToken();
		$this->load->model('Http_model');
		$template = array(
			'touser' => $openid,
			'template_id' => 'eQP5IFYGaECRLMtn4mLq2gmV_Zygcs9pfggzfmT_tO4',
			'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Fhuixie%2Findex.php%2Fta%2FtakeOrderPage&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
			'topcolor' => '#FF0000',
			'data'=>array(
				'first' =>array(
					'value' => $first,
					'color' => '#173177'
				),
				'keyword1' =>array(
					'value' => $order['endTime'],
					'color' => '#173177'
				),
				'keyword2' =>array(
					'value' => $order['courseName'],
					'color' => '#173177'
				),
				'keyword3' =>array(
					'value' => $order['requirement'],
					'color' => '#173177'
				),
				'keyword4' =>array(
					'value' => '订单编号: '.$order['orderNum'].' 页数要求: '.$order['pageNum'].'; 阅读材料: '.$order['refDoc'],
					'color' => '#173177'
				),
				'remark' =>array(
					'value' => '请您及时接单，并且联系客服获得相关材料',
					'color' => '#173177'
				)
			)
		);
		$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;
		$ret = $this->Http_model->doCurlPostRequest($url, json_encode($template, JSON_UNESCAPED_UNICODE));
		$retData = json_decode($ret, true);

		// var_dump($retData);

	}

	//每两个小时更新一次，写中转服务
	// function getAccessToken(){
	// 	$appid = 'wxcd901e4412fc040b';
	// 	$appsecret = '16a24c163a44ee41fa3ef630c1c455ec';
	// 	$url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
		
	// 	$ch = curl_init();
	// 	$timeout = 5;
	// 	curl_setopt ($ch, CURLOPT_URL, $url);
	// 	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	// 	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	// 	$file_contents = curl_exec($ch);
	// 	curl_close($ch);

	// 	return $file_contents;
	// }

	function getAllFollower(){
		$this->load->model('Ctoken_model');
		$token = $this->Ctoken_model->getAccessToken();

		$url = 'https://api.weixin.qq.com/cgi-bin/user/get';
		$para = array(
			'access_token' => $token,
			'next_openid' => ''
		);
		$ret = $this->Http_model->doCurlGetRequest($url, $para);
		$retData = json_decode($ret, true);
		// var_dump($retData);

		return $retData;
	}
	function sendMessage(){
		$openid = 'oJWDev7W6DN_6gKuLumLPoOUeky4';
		//shezhi
	}
	
}
?>