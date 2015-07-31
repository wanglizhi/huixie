<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Order extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('mypagination');
		$this->load->library('my_pagination');
	}

	function test(){
			$this->load->model('Order_model');
			$result = $this->Order_model->getAll(1,ITEMS_PER_PAGE);
			$data['orderList'] = $result['result_rows'];
			$data['page_info'] = $this->my_pagination->create_links(
				$result['result_num_rows'],1,ADMIN_PREFIX."order/orderList");
			$this->load->view('admin/order_tbody',$data);
	}

	// Admin page

	function orderList(){
		$data['pageTitle'] = '所有订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->getAll(1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => 1,
			'page_method' => ADMIN_PREFIX."order/orderListPage",
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	//获取分页数据
	function orderListPage(){
		$page = $_GET['page'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$js_page_method = $_GET['js_page_method'];
		$this->load->model('Order_model');
		$result = $this->Order_model->getAll($page,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => $page,
			'page_method' => ADMIN_PREFIX."order/orderListPage",
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}

	function unpaidOrderList(){
		$data['pageTitle'] = '未付款订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('hasPaid',FALSE,1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => 1,
			'page_method' => ADMIN_PREFIX."order/unpaidOrderListPage",
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	function unpaidOrderListPage(){
		$page = $_GET['page'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$js_page_method = $_GET['js_page_method'];
		$data['pageTitle'] = '未付款订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('hasPaid',FALSE,$page,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => $page,
			'page_method' => ADMIN_PREFIX."order/unpaidOrderListPage",
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}

	function untakenOrderList(){
		$data['pageTitle'] = '未接单订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', TRUE, 'hasTaken', FALSE,1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => 1,
			'page_method' => ADMIN_PREFIX."order/untakenOrderListPage",
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	function untakenOrderListPage(){
		$page = $_GET['page'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$js_page_method = $_GET['js_page_method'];
		$data['pageTitle'] = '未接单订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', TRUE, 'hasTaken', FALSE,$page,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => $page,
			'page_method' => ADMIN_PREFIX."order/untakenOrderListPage",
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}
	function unfinishedOrderList(){
		$data['pageTitle'] = '未完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasTaken', TRUE, 'hasFinished', FALSE,1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => 1,
			'page_method' => ADMIN_PREFIX."order/unfinishedOrderListPage",
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}


	function unfinishedOrderListPage(){
		$page = $_GET['page'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$js_page_method = $_GET['js_page_method'];
		$data['pageTitle'] = '未完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasTaken', TRUE, 'hasFinished', FALSE,$page,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => $page,
			'page_method' => ADMIN_PREFIX."order/unfinishedOrderListPage",
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}


	function finishedOrderList(){
		$data['pageTitle'] = '已完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', TRUE, 'hasFinished', TRUE,1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => 1,
			'page_method' => ADMIN_PREFIX."order/finishedOrderListPage",
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	function finishedOrderListPage(){
		$page = $_GET['page'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$js_page_method = $_GET['js_page_method'];
		$data['pageTitle'] = '已完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', TRUE, 'hasFinished', TRUE,$page,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => $page,
			'page_method' => ADMIN_PREFIX."order/finishedOrderListPage",
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}
}
