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
		//删除所有该用户的Session文件
		session_destroy();
		redirect('customer/oauth/loginPage');
	}
	function infoPage(){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com',
		// 		'cashType'=>1, 'cashAccount'=>'account@paypal.com','balance'=>100);

		$data['user'] = $user;
		$this->loadView('user_info', $data);
	}
	function tradeList($page = 1,$num = ITEMS_PER_PAGE){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com',
		// 		'cashType'=>1, 'cashAccount'=>'account@paypal.com','balance'=>100, 'openid'=>4, 'createTime'=>'2015-08-09', 'balance'=>1000);


		$this->load->model('Trade_model');
		$result = $this->Trade_model->searchTradeByUser($user['openid'], $page, $num);
		$data['tradeList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/user/tradeList");
		$data['user'] = $user;

		$this->loadView('user_trade_list', $data);

	}
	function modify(){
		$user = $_SESSION['user'];
		$university = $_POST['university'];
		$email = $_POST['email'];
		$cashType = $_POST['cashType'];
		$cashAccount = $_POST['cashAccount'];
		$user['cashType'] = $cashType;
		$user['cashAccount'] = $cashAccount;
		$user['university'] = $university;
		$user['email'] = $email;
		$this->load->model('User_model');
		$this->User_model->modify($user['openid'], $user);
		//更新Session
		$_SESSION['user'] = $this->User_model->searchById($user['openid']);

		redirect('customer/user/infoPage');
	}
	function orderDetail($orderNum){
		$user = $_SESSION['user'];
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($orderNum);

		//测试数据
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com', 'openid'=>12);
		// $order = array('taId'=>2, 'price'=>100, 'hasPaid'=>0, 'hasTaken'=>0, 'orderNum'=>1437727418,'courseName'=>'设计与实现','major'=>'软件工程', 'pageNum'=>10, 'refDoc'=>6, 'createTime'=>'2015-4-30 18：00','endTime'=>'2015-6-10', 'requirement'=>'没有什么要求，好好写就行');

		$data['order'] = $order;
		$data['user'] = $user;

		$this->loadView('user_order_detail', $data);
	}

	function unpaidOrderList($page = 1,$num = ITEMS_PER_PAGE){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('openid'=>'4');
		// $_SESSION['user'] = $user;


		$data['pageTitle'] = '未付款订单列表';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('userId', $user['openid'], 'hasPaid', 0, $page,$num);

		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/user/unpaidOrderList");

		$this->loadView('user_order_list', $data);
	}
	function deleteOrder($orderNum){
		$user = $_SESSION['user'];
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($orderNum);
		if($order['userId'] == $user['openid']){
			$this->Order_model->delete($orderNum);
		}
		redirect('customer/user/unpaidOrderList');
		$this->unpaidOrderList();
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

		$this->loadView('user_order_list', $data);
	}
}
