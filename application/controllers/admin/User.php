<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class User extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Http_model');
		$this->load->library('mypagination');
	}
	function searchUser($key = ""){
		$data['pageTitle'] = '查找用户';
		$this->load->model('User_model');
		if($key==NULL)	$key = $_GET['key'];
		$result = $this->User_model->searchUser($key,1,ITEMS_PER_PAGE);
		$data['userTable'] = array(
			'userList' => $result['result_rows'],
			'tableId'   => "userTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => 1,
			'page_method' => ADMIN_PREFIX."user/searchUserPage",
		);
		$this->loadView(ADMIN_PREFIX.'user_list',$data);
	}

	function searchUserPage(){
		$page = $_GET['page'];
		$js_page_method = $_GET['js_page_method'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$this->load->model('User_model');
		$result = $this->User_model->searchUser($key,$page,ITEMS_PER_PAGE);
		$data['userTable'] = array(
			'userList' => $result['result_rows'],
			'tableId'   => "userTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => $page,
			'page_method' => ADMIN_PREFIX."user/searchUserPage",
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'user_table',$data);
	}

	function userProfile($user_id = NULL){
		if(!isset($user_id) && !isset($_GET['user_id'])){
			echo "error!";
			exit();
		}
		if(!isset($user_id)) $user_id = $_GET['user_id'];
		$this->load->model('User_model');
		$result = $this->User_model->searchById($user_id);
		if(isset($result)) $data['user'] = $result;
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('userId', $user_id,1,ITEMS_PER_PAGE);
		$data['userOrderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "userOrderTable",
			'sort_key'  => "createTime",
			'sort_method' => 'desc', 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => 1,
				'page_method' => ADMIN_PREFIX."user/userOrderListPage",
			),
		);
		$this->load->model('Trade_model');
		$result = $this->Trade_model->searchTradeByUser($user_id,1,ITEMS_PER_PAGE);
		$data['userTradeTable'] = array(
			'tradeList' => $result['result_rows'],
			'tableId'   => "userTradeTable",
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => 1,
				'page_method' => ADMIN_PREFIX."user/userTradeListPage",
			),
		);
		$this->load->model('Cash_model');
		$result = $this->Cash_model->searchCashByUser($user_id,1,ITEMS_PER_PAGE);
		$data['userCashTable'] = array(
			'cashList' => $result['result_rows'],
			'tableId'   => "userCashTable",
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => 1,
				'page_method' => ADMIN_PREFIX."user/userCashListPage",
			),
		);
		$this->loadView(ADMIN_PREFIX.'user_profile',$data);
	}
	function userOrderListPage($user_id = NULL){
		if(!isset($user_id) && !isset($_GET['user_id'])){
			echo "error!";
			exit();
		}
		if(!isset($user_id)) $user_id = $_GET['user_id'];
		$page = $_GET['page'];
		$sort_key = "createTime";
		$sort_method = "desc";
		if(isset($_GET['sort_key'])) $sort_key = $_GET['sort_key'];
		if(isset($_GET['sort_method'])) $sort_method = $_GET['sort_method'];
		$js_page_method = $_GET['js_page_method'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('userId', $user_id,$page,ITEMS_PER_PAGE,$sort_key,$sort_method);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "userOrderTable",
			'sort_key'  => $sort_key,
			'sort_method' => $sort_method, 
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => $page,
				'page_method' => ADMIN_PREFIX."user/userOrderListPage",
			),
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}
	function userTradeListPage($user_id = NULL){
		if(!isset($user_id) && !isset($_GET['user_id'])){
			echo "error!";
			exit();
		}
		if(!isset($user_id)) $user_id = $_GET['user_id'];
		$page = $_GET['page'];
		$js_page_method = $_GET['js_page_method'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$this->load->model('Trade_model');
		$result = $this->Trade_model->searchTradeByUser($user_id,$page,ITEMS_PER_PAGE);
		$data['tradeTable'] = array(
			'tradeList' => $result['result_rows'],
			'tableId'   => "userTradeTable",
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => $page,
				'page_method' => ADMIN_PREFIX."user/userTradeListPage",
			),
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'trade_table',$data);
	}

	function userCashListPage($user_id = NULL){
		if(!isset($user_id) && !isset($_GET['user_id'])){
			echo "error!";
			exit();
		}
		if(!isset($user_id)) $user_id = $_GET['user_id'];
		$page = $_GET['page'];
		$js_page_method = $_GET['js_page_method'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$this->load->model('Cash_model');
		$result = $this->Cash_model->searchCashByUser($user_id,$page,ITEMS_PER_PAGE);
		$data['cashTable'] = array(
			'cashList' => $result['result_rows'],
			'tableId'   => "userCashTable",
			'page_info' => array(
				'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
				'current_page'  => $page,
				'page_method' => ADMIN_PREFIX."user/userCashListPage",
			),
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'cash_table',$data);
	}

	function updateUser(){
		$this->load->model('User_model');
		if(!isset($_POST['openid'])){
			$time = 3;
			header("refresh:$time;url=registerPage");
			print('openid不存在...<br>'.$time.'秒后自动跳转。');
			exit();
		}
		$user['openid'] = $_POST['openid'];
		$user['university'] = $_POST['university'];
		$user['email'] = $_POST['email'];
		$user['cashType'] = $_POST['cashType'];
		$user['cashAccount'] = $_POST['cashAccount'];
		$user['balance'] = $_POST['balance'];
		$result = $this->User_model->updateUser($user);
		$this->userProfile($_POST['openid']);
	}
	function userList()
	{
		$data['pageTitle'] = '所有用户';
		$this->load->model('User_model');
		$result = $this->User_model->getAll(1,ITEMS_PER_PAGE);
		$data['userTable'] = array(
			'userList' => $result['result_rows'],
			'tableId'   => "userTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => 1,
			'page_method' => ADMIN_PREFIX."user/userListPage",
		);
		$this->loadView(ADMIN_PREFIX.'user_list',$data);
	}
	function userListPage()
	{
		$page = $_GET['page'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$js_page_method = $_GET['js_page_method'];
		$data['pageTitle'] = '所有用户';
		$this->load->model('User_model');
		$result = $this->User_model->getAll($page,ITEMS_PER_PAGE);
		$data['userTable'] = array(
			'userList' => $result['result_rows'],
			'tableId'   => "userTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => $page,
			'page_method' => ADMIN_PREFIX."user/userListPage",
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'user_table',$data);
	}

	function registerPage(){
		$data['pageTitle']='添加用户';
		$this->loadView(ADMIN_PREFIX.'add_user',$data);
	}
	function register(){
		$this->load->model('User_model');
		$data['name']=$_POST['name'];
		$data['university']=$_POST['university'];
		$data['email'] = $_POST['email'];
		date_default_timezone_set('PRC');
		$data['createTime'] = date('Y-m-d h:i:s');

		if(empty($name)){
			$time = 3;
			header("refresh:$time;url=registerPage");
			print('信息错误，添加失败...<br>'.$time.'秒后自动跳转。');
		}
		if (!$this->User_model->add($data)) {
			$time = 3;
			header("refresh:$time;url=registerPage");
			print('信息错误，添加失败...<br>'.$time.'秒后自动跳转。');
		}else{
			redirect(ADMIN_PREFIX.'user/userList');
		}
	}
}
