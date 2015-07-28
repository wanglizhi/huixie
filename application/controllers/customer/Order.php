<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Order extends CustomerController {
	function __construct(){
		parent::__construct();
	}
	function index(){
	}
	//添加订单
	function addOrderPage(){

		$this->load->view('customer/header');
		$this->load->view('customer/add_order');
		$this->load->view('customer/footer');
	}
	function addOrder(){
		$this->checkLogin();
		$this->load->model('Order_model');
		$user = $_SESSION['user'];

		// 2015-07-14T08:55Z
		// echo $_POST['endTime'];
		$data['major'] = $_POST['major'];
		$data['courseName'] = $_POST['courseName'];
		$data['email'] = $_POST['email'];
		$data['pageNum'] = $_POST['pageNum'];
		$data['refDoc'] = $_POST['refDoc'];
		$data['requirement'] = $_POST['requirement'];
		$data['endTime'] = $_POST['endTime'];
		$data['userId'] = $user['openid'];
		date_default_timezone_set('PRC');
		$data['createTime'] = date('Y-m-d h:i:s');
		$data['orderNum'] = time();
		if(!(isset($data['major']) and isset($data['courseName']) and isset($data['userId']) and isset($data['email'])) ){
			$time = 3;
			header("refresh:$time;url=orderPage");
			print('信息错误，订单添加失败...<br>'.$time.'秒后自动跳转。');
			return ;
		}
		$order = $this->Order_model->add($data);
		if (!isset($order)) {
			$time = 3;
			header("refresh:$time;url=orderPage");
			print('信息错误，订单添加失败...<br>'.$time.'秒后自动跳转。');
		}else{
			$data['id'] = $order['id'];
			$_SESSION['order'] = $data;
			redirect('user/taSelectPage');
		}
	}


















	// Admin page
	function orderList($page = 1,$num = ITEMS_PER_PAGE)
	{
		if($page>0 && $num>0){
			$data['pageTitle'] = '所有订单';
			$this->load->model('Order_model');
			$result = $this->Order_model->getAll($page,$num);
			$data['orderList'] = $result['result_rows'];
			$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"order/orderList");
		}else{
			$data['orderList'] = array();
		}
		$this->load->view('admin_header', $data);
		$this->load->view('order_list');
		$this->load->view('admin_footer');
	}
	function unpaidOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '未付款订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('hasPaid', 0,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"order/unpaidOrderList");
		$this->load->view('admin_header', $data);
		$this->load->view('order_list');
		$this->load->view('admin_footer');
	}
	function untakenOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '未接单订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', 1, 'hasTaken', 0,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"order/untakenOrderList");
		$this->load->view('admin_header', $data);
		$this->load->view('order_list');
		$this->load->view('admin_footer');
	}
	function unfinishedOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '未完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasTaken', 1, 'hasFinished', 0,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"order/unfinishedOrderList");
		$this->load->view('admin_header', $data);
		$this->load->view('order_list');
		$this->load->view('admin_footer');
	}
	function finishedOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '已完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', 1, 'hasFinished', 1,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"order/finishedOrderList");
		$this->load->view('admin_header', $data);
		$this->load->view('order_list');
		$this->load->view('admin_footer');
	}

}
