<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Order extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('mypagination');
		$this->load->helper('price');
	}

	// Admin page

	function orderInfo(){
		$orderNum = $_GET['orderNum'];
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($orderNum);
		if(empty($order)){
			echo "不存在订单";
			return;
		}
		$data['order'] = $order;
		$this->load->model('Selected_ta_model');
		$selected_ta = $this->Selected_ta_model->searchByOrderNum($orderNum);
		$data['selectedTaTable'] = array(
			'selectedTaList' => $selected_ta,
			'tableId' => 'selectedTaTable',
		);
		$this->loadView(ADMIN_PREFIX."order_info",$data);
	}

	function orderList(){
		$data['pageTitle'] = '所有订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->getAll(1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => "createTime",
			'sort_method' => 'desc', 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => 1,
				'page_method' => ADMIN_PREFIX."order/orderListPage",
			),
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	//获取分页数据
	function orderListPage(){
		$page = $_GET['page'];
		if(!isset($page)) $page = 1;
		$sort_key = "createTime";
		$sort_method = "desc";
		if(isset($_GET['sort_key'])) $sort_key = $_GET['sort_key'];
		if(isset($_GET['sort_method'])) $sort_method = $_GET['sort_method'];
		$js_page_method = $_GET['js_page_method'];
		$this->load->model('Order_model');
		$search_key = $_GET['search_key'];
		$result = $this->Order_model->getAll($page,ITEMS_PER_PAGE,$sort_key,$sort_method,$search_key);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => $sort_key,
			'sort_method' => $sort_method, 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => $page,
				'page_method' => ADMIN_PREFIX."order/orderListPage",
			),
			'js_page_method' => $js_page_method,
		);
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}

	function unpaidOrderList(){
		$data['pageTitle'] = '未付款订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('hasPaid',FALSE,1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => "createTime",
			'sort_method' => 'desc', 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => 1,
				'page_method' => ADMIN_PREFIX."order/unpaidOrderListPage",
			),
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	function unpaidOrderListPage(){
		$page = $_GET['page'];
		if(!isset($page)) $page = 1;
		$sort_key = "createTime";
		$sort_method = "desc";
		if(isset($_GET['sort_key'])) $sort_key = $_GET['sort_key'];
		if(isset($_GET['sort_method'])) $sort_method = $_GET['sort_method'];
		$search_key = $_GET['search_key'];
		$js_page_method = $_GET['js_page_method'];
		$data['pageTitle'] = '未付款订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('hasPaid',FALSE,$page,ITEMS_PER_PAGE,$sort_key,$sort_method,$search_key);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => $sort_key,
			'sort_method' => $sort_method, 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => $page,
				'page_method' => ADMIN_PREFIX."order/unpaidOrderListPage",
			),
			'js_page_method' => $js_page_method,
		);
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}

	function untakenOrderList(){
		$data['pageTitle'] = '未接单订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', TRUE, 'hasTaken', FALSE,1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => "createTime",
			'sort_method' => 'desc', 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => 1,
				'page_method' => ADMIN_PREFIX."order/untakenOrderListPage",
			),
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	function untakenOrderListPage(){
		$page = $_GET['page'];
		if(!isset($page)) $page = 1;
		$sort_key = "createTime";
		$sort_method = "desc";
		if(isset($_GET['sort_key'])) $sort_key = $_GET['sort_key'];
		if(isset($_GET['sort_method'])) $sort_method = $_GET['sort_method'];
		$search_key = $_GET['search_key'];
		$js_page_method = $_GET['js_page_method'];
		$data['pageTitle'] = '未接单订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', TRUE, 'hasTaken', FALSE,$page,ITEMS_PER_PAGE,$sort_key,$sort_method,$search_key);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => $sort_key,
			'sort_method' => $sort_method, 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => $page,
				'page_method' => ADMIN_PREFIX."order/untakenOrderListPage",
			),
			'js_page_method' => $js_page_method,
		);
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}
	function unfinishedOrderList(){
		$data['pageTitle'] = '未完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasTaken', TRUE, 'hasFinished', FALSE,1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => "createTime",
			'sort_method' => 'desc', 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => 1,
				'page_method' => ADMIN_PREFIX."order/unfinishedOrderListPage",
			),
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}


	function unfinishedOrderListPage(){
		$page = $_GET['page'];
		if(!isset($page)) $page = 1;
		$sort_key = "createTime";
		$sort_method = "desc";
		if(isset($_GET['sort_key'])) $sort_key = $_GET['sort_key'];
		if(isset($_GET['sort_method'])) $sort_method = $_GET['sort_method'];
		$search_key = $_GET['search_key'];
		$js_page_method = $_GET['js_page_method'];
		$data['pageTitle'] = '未完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasTaken', TRUE, 'hasFinished', FALSE,$page,ITEMS_PER_PAGE,$sort_key,$sort_method,$search_key);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => $sort_key,
			'sort_method' => $sort_method, 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => $page,
				'page_method' => ADMIN_PREFIX."order/unfinishedOrderListPage",
			),
			'js_page_method' => $js_page_method,
		);
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}


	function finishedOrderList(){
		$data['pageTitle'] = '已完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', TRUE, 'hasFinished', TRUE,1,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => "createTime",
			'sort_method' => 'desc', 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => 1,
				'page_method' => ADMIN_PREFIX."order/finishedOrderListPage",
			),
		);
		$this->loadView(ADMIN_PREFIX.'order_list',$data);
	}

	function finishedOrderListPage(){
		$page = $_GET['page'];
		if(!isset($page)) $page = 1;
		$sort_key = "createTime";
		$sort_method = "desc";
		if(isset($_GET['sort_key'])) $sort_key = $_GET['sort_key'];
		if(isset($_GET['sort_method'])) $sort_method = $_GET['sort_method'];
		$search_key = $_GET['search_key'];
		$js_page_method = $_GET['js_page_method'];
		$data['pageTitle'] = '已完成订单';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('hasPaid', TRUE, 'hasFinished', TRUE,$page,ITEMS_PER_PAGE,$sort_key,$sort_method,$search_key);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "orderTable",
			'sort_key'  => $sort_key,
			'sort_method' => $sort_method, 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => $page,
				'page_method' => ADMIN_PREFIX."order/finishedOrderListPage",
			),
			'js_page_method' => $js_page_method,
		);
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}

	function updateOrder(){
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($_POST['orderNum']);
		try{
			$data['hasPaid'] = $_POST['hasPaid'];
			if($_POST['paidTime']!="")
				$data['paidTime'] = $_POST['paidTime'];
			$data['hasTaken'] = $_POST['hasTaken'];
			if($data['hasTaken'] and !$order['hasTaken']){
				// 将order里的takenPrice改为系统价格
				$data['takenPrice'] = getPrice(UNIT_PRICE, $order);
			}
			if($_POST['takenTime']!="")
				$data['takenTime'] = $_POST['takenTime'];
			$data['hasFinished'] = $_POST['hasFinished'];
			if($_POST['finishedTime']!="")
				$data['finishedTime'] = $_POST['finishedTime'];
			if($_POST['taId']!="")
				$data['taId'] = $_POST['taId'];
			$data['orderNum'] = $_POST['orderNum'];
 		}catch(Exception $e){
			$time = 3;
			header("refresh:$time;url=orderInfo?orderNum=".$_POST['orderNum']);
			print('出错了...<br>'.$time.'秒后自动跳转。');
 		}
 		$this->notify($data, $order);
		$this->Order_model->update($data);
		redirect(ADMIN_PREFIX.'order/orderInfo?orderNum='.$_POST['orderNum']);
	}
	function notify($data, $order){
		$this->load->model('Message_model');
		$this->load->model('Selected_ta_model');
		$this->load->model('Ta_model');
		$this->load->model('User_model');
		if($data['hasPaid'] and (!$order['hasPaid'])){
			//修改为已付款
			//推送给用户
			$this->Message_model->sendMessageToUser(
					$order,
					$order['userId'],
					'付款成功，订单详情如下：！',
					site_url('customer/user/orderDetail/'.$order['orderNum']),
					'恭喜你下单成功，请联系客服获得帮助，将参考资料发送到admin@huixie.me');
			// 推送给TA
			$selectList = $this->Selected_ta_model->searchByOrderNum($order['orderNum']);
			foreach ($selectList as $select) {
				$this->Message_model->sendMessageToTa(
					$order,
					$select['taId'],
					'有新的订单提醒',
					site_url('customer/ta/takeOrderPage/'.$order['orderNum']),
					'请您及时接单，并且联系客服获得相关材料');
			}

		}

		if($data['hasTaken'] and (!$order['hasTaken'])){
			//修改为已接单
			$this->Selected_ta_model->takeOrder($order['orderNum']);
			// 修改TA为有课、以及推送消息
			$ta = $this->Ta_model->searchById($data['taId']);
			if($ta){
				if($ta['state']==0){
					$ta['state'] = 1;
					$this->Ta_model->modify($ta['openid'],$ta);
				}
				$this->Message_model->sendMessageToTa(
					$order,
					$order['taId'],
					'订单接单成功！',
					site_url('customer/ta/takeOrderPage/'.$order['orderNum']),
					'恭喜你接单成功，请联系客服获得相关材料，完成后将文件发送到admin@huixie.me');
			}
		}

		if($data['hasFinished'] and (!$order['hasFinished'])){
			//修改为已完成
			//推送给用户
			$this->Message_model->sendMessageToUser(
				$order,
				$order['userId'],
				'订单完成！',
				site_url('customer/user/orderDetail/'.$order['orderNum']),
				'恭喜！您的订单已经完成，如有问题请咨询客服，欢迎继续使用！');
			//推送给TA
			$this->Message_model->sendMessageToTa(
				$order,
				$order['taId'],
				'您的接单已经完成！',
				site_url('customer/ta/takeOrderPage/'.$order['orderNum']),
				'恭喜你完成订单，欢迎继续使用！结账请联系客服~');
			// 修改用户balance，添加交易记录
			$this->load->model('Trade_model');
			$user = $this->User_model->searchById($order['userId']);
			if($order['price'] > $order['takenPrice']){
				$user['balance'] = $user['balance'] + $order['price'] - $order['takenPrice'];
				$this->User_model->modify($user['openid'], $user);
				$trade['openid'] = $user['openid'];
				$trade['money'] = $order['price'] - $order['takenPrice'];
				$trade['balance'] = $user['balance'];
				$trade['orderNum'] = $order['orderNum'];
				date_default_timezone_set('PRC');
				$trade['createTime'] = date('Y-m-d h:i:s');
				$trade['describe'] = '订单支付余额返还';
				$this->Trade_model->add($trade);
			}
			// 修改的TA的balance
			$ta = $this->Ta_model->searchById($order['taId']);
			$taInfo = $this->User_model->searchById($order['taId']);
			if($taInfo){
				$taInfo['balance'] = $taInfo['balance'] + getPrice($ta['actualPrice'], $order);
				$this->User_model->modify($taInfo['openid'], $taInfo);
				$trade['openid'] = $ta['openid'];
				$trade['money'] = getPrice($ta['actualPrice'], $order);
				$trade['balance'] = $taInfo['balance'];
				$trade['orderNum'] = $order['orderNum'];
				date_default_timezone_set('PRC');
				$trade['createTime'] = date('Y-m-d h:i:s');
				$trade['describe'] = 'TA接单收入';
				$this->Trade_model->add($trade);
			}
		}
	}

	function deleteOrder(){
		$this->load->model('Order_model');
		$orderNum = $_POST['orderNum'];
		$this->Order_model->delete($orderNum);
	}
}
