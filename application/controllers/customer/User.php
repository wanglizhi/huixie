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
	function infoPage(){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com');

		$data['user'] = $user;
		$this->load->view('customer/header', $data);
		$this->load->view('customer/user_info');
		$this->load->view('customer/footer');
	}
	function modify(){
		$user = $_SESSION['user'];
		$university = $_POST['university'];
		$email = $_POST['email'];
		$user['university'] = $university;
		$user['email'] = $email;
		$this->load->model('User_model');
		$this->User_model->modify($user['openid'], $user);
		//更新Session
		$_SESSION['user'] = $user;

		redirect('customer/user/infoPage');
	}
	function orderDetail($orderNum, $p){
		$user = $_SESSION['user'];
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($orderNum);

		//测试数据
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com', 'openid'=>12);
		// $order = array('taId'=>2, 'price'=>100, 'hasPaid'=>0, 'hasTaken'=>0, 'orderNum'=>1437727418,'courseName'=>'设计与实现','major'=>'软件工程', 'pageNum'=>10, 'refDoc'=>6, 'createTime'=>'2015-4-30 18：00','endTime'=>'2015-6-10', 'requirement'=>'没有什么要求，好好写就行');

		$data['order'] = $order;
		$data['user'] = $user;

		$this->load->view('customer/header',$data);
		$this->load->view('customer/user_order_detail');
		$this->load->view('customer/footer');
	}
	function returnPage($orderNum){
		print('等待支付结果, 5秒后自动跳转');
		sleep(30);
		$this->orderDetail($orderNum);
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
