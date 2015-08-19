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
		$str = "oJWDev3kr51nqxTSFNQDaf4y7xHA";
		$str4 = substr($str,-4,4);
		echo $str4.time();

		// header("refresh:3;url=oauth/check");
		// print('信息错误，添加失败...<br>3秒后自动跳转。');
		//$this->check();
	}
	function check(){

		echo 'check';
	}
	function loginPage(){
		$this->load->view('customer/header');
		$this->load->view('customer/login_page');
		$this->load->view('customer/footer');
	}

}
