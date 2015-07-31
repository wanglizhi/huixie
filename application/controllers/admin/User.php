<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class User extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Http_model');
		$this->load->library('mypagination');
	}
	function searchUser($key = "",$page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '查找用户';
		$this->load->model('User_model');
		if($key==NULL)	$key = $_GET['key'];
		$result = $this->User_model->searchUser($key,$page,$num);
		$data['userList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."user/searchUser/".$key);
		$this->loadView(ADMIN_PREFIX.'user_list',$data);
	}
	function userProfile($user_id = NULL,$page = 1,$num = ITEMS_PER_PAGE){
		if(!isset($user_id) && !isset($_GET['user_id'])) return;
		if(!isset($user_id)) $user_id = $_GET['user_id'];
		$this->load->model('User_model');
		$result = $this->User_model->searchById($user_id);
		if(isset($result)) $data['user'] = $result;
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('userId', $user_id,$page,$num);
		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."user/userProfile/".$user_id);
		$this->loadView(ADMIN_PREFIX.'user_profile',$data);
	}
	function updateUser(){
		$this->load->model('User_model');
		if(!isset($_POST['openid'])){
			$time = 3;
			header("refresh:$time;url=registerPage");
			print('openid不存在...<br>'.$time.'秒后自动跳转。');
			exit();
		}
		$result = $this->User_model->updateUser($_POST['openid'],$_POST['university'],
			$_POST['email']);
		$this->userProfile($_POST['openid']);
	}
	function userList($page = 1,$num = ITEMS_PER_PAGE)
	{
		$data['pageTitle'] = '所有用户';
		$this->load->model('User_model');
		$result = $this->User_model->getAll($page,$num);
		$data['userList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."user/userList");
		$this->loadView(ADMIN_PREFIX.'user_list',$data);
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
