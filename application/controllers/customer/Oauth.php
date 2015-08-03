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
}
