<?php
class Message_model extends CI_Model{
	function __construct(){
		parent::__construct();
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
	}


	
}
?>