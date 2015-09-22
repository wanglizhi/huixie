<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Oauth extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('datetime');
	}
	function testModel(){
		$this->load->model('Ta_model');
		$result = $this->Ta_model->searchBySkills('历史');
		var_dump($result);
	}
	function index(){
		// $this->load->view('customer/test');
		// $ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
		//sleep(5);
		// $this->load->model('Ta_model');
		// echo getNow();
		// $str = "oJWDev3kr51nqxTSFNQDaf4y7xHA";
		// $str4 = substr($str,-4,4);
		// echo $str4.time();
		// if($this->check()){
		// 	echo 'haha';
		// }
		$this->load->view('customer/sui_index');

		// header("refresh:3;url=oauth/check");
		// print('信息错误，添加失败...<br>3秒后自动跳转。');
		//$this->check();
	}
	function ratchet(){
		$data['pageTitle'] = "测试界面";
		$this->load->view('customer/m_header', $data);
		$this->load->view('customer/ratchet');
		$this->load->view('customer/m_footer');
	}
	function check(){
		$this->load->model('Star_model');
		echo $this->Star_model->getTaStar('oJWDev7W6DN_6gKuLumLPoOUeky4');
		$ss = explode('--', 'fadfafa');
		var_dump($ss);
	}
	function infoPage(){
		// 用来测试Sui mobile的函数
		// $user = $_SESSION['user'];

		//数据测试
		$user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
				'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com',
				'cashType'=>1, 'cashAccount'=>'account@paypal.com','balance'=>100);

		$data['user'] = $user;
		$this->load->view('customer/sui_user_info', $data);
	}
	function loginPage(){
		$data['pageTitle'] = '登入界面';
		$this->load->view('m_customer/m_header', $data);
		$this->load->view('m_customer/m_login_page');
		$this->load->view('m_customer/m_footer');
	}
	function rateTest(){
		$this->load->helper('simple_html_dom_helper');
		$this->load->helper('rate_helper');
		$selling_rate = floatval(getRate()['selling_rate']);
		echo intval(($selling_rate/100)*34);
	}

}
