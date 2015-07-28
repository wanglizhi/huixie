<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Oauth extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	function index(){
	}
	function loginPage(){
		$this->load->view('customer/header');
		$this->load->view('customer/loginPage');
		$this->load->view('customer/footer');
	}
}
