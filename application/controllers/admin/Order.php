<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Order extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('mypagination');
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
				,ADMIN_PREFIX."order/orderList");
		}else{
			$data['orderList'] = array();
		}
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	function userOrderList($user_id,$page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '用户订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('userId', $user_id,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."order/userOrderList/".$user_id);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	function unpaidOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '未付款订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('hasPaid', 0,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."order/unpaidOrderList");
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}
	function untakenOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '未接单订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', 1, 'hasTaken', 0,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."order/untakenOrderList");
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}
	function unfinishedOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '未完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasTaken', 1, 'hasFinished', 0,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."order/unfinishedOrderList");
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}
	function finishedOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '已完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', 1, 'hasFinished', 1,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."order/finishedOrderList");
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

}
