<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class User extends CustomerController {
	function __construct(){
		parent::__construct();
		$this->load->model('Http_model');
		$this->load->library('mypagination');
	}
	function logout(){
		if (!session_id()) session_start();
		unset($_SESSION['user']);
		redirect('customer/oauth/loginPage');
	}

	function unpaidOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('openid'=>'4');


		$data['pageTitle'] = '未付款订单列表';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('userId', $user['openid'], 'hasPaid', 0, $page,$num);

		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/user/unpaidOrderList");

		$this->load->view('customer/header', $data);
		$this->load->view('customer/user_order_list');
		$this->load->view('customer/footer');
	}

	function orderList($page = 1,$num = ITEMS_PER_PAGE){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('openid'=>'4');


		$data['pageTitle'] = '我的订单列表';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('userId', $user['openid'], 'hasPaid', 1, $page,$num);

		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/user/orderList");

		$this->load->view('customer/header', $data);
		$this->load->view('customer/user_order_list');
		$this->load->view('customer/footer');
	}
}
