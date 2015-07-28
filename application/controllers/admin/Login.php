<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	function loginPage(){
        if (!session_id()) session_start();
        if(isset($_SESSION['admin'])) redirect('admin_/adminList');
        $this->load->view(ADMIN_PREFIX.'admin_header');
        $this->load->view(ADMIN_PREFIX.'admin_login');
        $this->load->view(ADMIN_PREFIX.'admin_footer');
    }

	function adminLogin(){
		$this->load->model('Admin_model');
		$name = $_POST['name'];
		$password = $_POST['password'];
		$admin = $this->Admin_model->searchByName($name);
		if(isset($admin) and $admin['password'] == $password){
			if (!session_id()) session_start();
			$_SESSION['admin'] = $admin;	
			redirect('admin_/adminList');
		}else{
			redirect(ADMIN_PREFIX."login/loginPage");
		}
	}

	function adminLogout(){
        if (!session_id()) session_start();
		if(!isset($_SESSION['admin'])) redirect(ADMIN_PREFIX.'login/loginPage');
		unset($_SESSION['admin']);
		header("refresh:3;url=loginPage");
		print('注销成功！...<br> 3秒后自动跳转。');
	}
}
