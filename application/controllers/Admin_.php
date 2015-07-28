<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Admin_ extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->library('mypagination');
	}
	function index(){
		$this->adminList();
	}

	function adminList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '管理员列表';
		$data['admin'] = $_SESSION['admin'];
		$this->load->model('Admin_model');
		$result = $this->Admin_model->getAll($page,$num);
		$data['adminList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
			,"admin/adminList");
		$this->loadView(ADMIN_PREFIX.'admin_list',$data);
	}

	function modifyPage(){
		$data['pageTitle'] = '修改密码';

		$data['admin'] = $_SESSION['admin'];
		$this->loadView(ADMIN_PREFIX.'admin_modify',$data);
	}

	function modify(){
		$admin = $_SESSION['admin'];
		if(isset($_POST['orignal']) and isset($_POST['password'])){
			$orignal = $_POST['orignal'];
			$password = $_POST['password'];
			if($admin['password'] == $orignal){
				$this->load->model('Admin_model');
				$admin['password'] = $password;
				$this->Admin_model->modify($admin['name'], $admin);
				header("refresh:3;url=adminList");
				print('修改成功...<br> 3秒后自动跳转。');
				exit(0);
			}else{
				header("refresh:3;url=loginPage");
				print('原始密码错误...<br> 3秒后自动跳转。');
				exit(0);
			}
		}
	}

}
