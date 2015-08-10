<?php
class Message_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->model('Http_model');
	}
	// 待接单 已接单 已完成 对TA的推送
	function sendMessageToTa($order, $openid, $first, $url, $remark){
		$this->load->model('Ctoken_model');
		$token = $this->Ctoken_model->getAccessToken();
		$template = array(
			'touser' => $openid,
			'template_id' => '6FqI2wjXUmfRunkD4zVxVAv_nWZPbb7qnVS80VN08OU',
			'url' => $url,
			'topcolor' => '#FF0000',
			'data'=>array(
				'first' =>array(
					'value' => $first,
					'color' => '#173177'
				),
				'keyword1' =>array(
					'value' => $order['orderNum'],
					'color' => '#173177'
				),
				'keyword2' =>array(
					'value' => $order['courseName'],
					'color' => '#173177'
				),
				'keyword3' =>array(
					'value' => $order['endTime'],
					'color' => '#173177'
				),
				'keyword4' =>array(
					'value' => '页数要求: '.$order['pageNum'].'; 阅读材料: '.$order['refDoc'].'; 额外需求: '.$order['requirement'],
					'color' => '#173177'
				),
				'remark' =>array(
					'value' => $remark,
					'color' => '#173177'
				)
			)
		);
		$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;
		$ret = $this->Http_model->doCurlPostRequest($url, json_encode($template, JSON_UNESCAPED_UNICODE));
		$retData = json_decode($ret, true);
	}

	// 付款后 完成后 对用户的推送
	function sendMessageToUser($order, $openid, $first, $url, $remark){
		$this->load->model('Ctoken_model');
		$token = $this->Ctoken_model->getAccessToken();
		date_default_timezone_set("PRC");
		$timestamp = strtotime($order['endTime']);
		date_default_timezone_set($order['timezone']);
		$endTime = date("Y-m-d H:i:s",$timestamp);
		$template = array(
			'touser' => $openid,
			'template_id' => 'PbGUA1ZGH6hh4H1zVpyVcR0jgF3QzTfr6vLPTAoM6yc',
			'url' => $url,
			'topcolor' => '#FF0000',
			'data'=>array(
				'first' =>array(
					'value' => $first,
					'color' => '#173177'
				),
				'keyword1' =>array(
					'value' => $order['orderNum'],
					'color' => '#173177'
				),
				'keyword2' =>array(
					'value' => $order['courseName'],
					'color' => '#173177'
				),
				'keyword3' =>array(
					'value' => $order['price'],
					'color' => '#173177'
				),
				'keyword4' =>array(
					'value' => $endTime,
					'color' => '#173177'
				),
				'keyword5' =>array(
					'value' => '页数要求: '.$order['pageNum'].'; 阅读材料: '.$order['refDoc'].'; 额外需求: '.$order['requirement'],
					'color' => '#173177'
				),
				'remark' =>array(
					'value' => $remark,
					'color' => '#173177'
				)
			)
		);
		$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;
		$ret = $this->Http_model->doCurlPostRequest($url, json_encode($template, JSON_UNESCAPED_UNICODE));
		$retData = json_decode($ret, true);
	}


	
}
?>