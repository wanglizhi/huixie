<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Ta extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Http_model');
	}
	function taList()
	{
		$data['pageTitle'] = '所有 TA';
		$this->load->model('Ta_model');
		$data['taList'] = $this->Ta_model->getAll();
		$this->load->view('admin_header', $data);
		$this->load->view('ta_list');
		$this->load->view('admin_footer');
	}
	function addTaPage(){
		$data['pageTitle'] = '添加 TA';
		$this->load->view('admin_header',$data);
		$this->load->view('add_tA');
		$this->load->view('admin_footer');
	}
	function addTa(){
		$this->load->model('Ta_model');
		$data['name']=$_POST['name'];
		$data['email']=$_POST['email'];
		$data['skills']=$_POST['skills'];
		$data['star'] = $_POST['star'];
		$data['unitPrice'] = $_POST['unitPrice'];
		date_default_timezone_set('PRC');
		$data['createTime'] = date('Y-m-d h:i:s');
		if(isset($data['name'])){
			$time = 3;
			header("refresh:$time;url=addTaPage");
			print('添加失败...<br>'.$time.'秒后自动跳转。');
		}
		if (!$this->Ta_model->add($data)) {
			$time = 3;
			header("refresh:$time;url=addTaPage");
			print('添加失败...<br>'.$time.'秒后自动跳转。');
		}else{
			redirect('ta/taList');
		}
	}
//==
	function takeOrderPage(){
		$this->checkLogin();
		$user = $_SESSION['user'];
		$this->load->model('Order_model');
		$select = $this->Order_model->searchSelectTa($user['openid']);
		$order = $this->Order_model->searchBy1('orderNum', $select['orderNum']);

		//判断是否被接单
		if($order){
			$order = $order[0];
		}

		$data['pageTitle'] = '接单';
		$data['order'] = $order;
		$this->load->view('userHeader',$data);
		$this->load->view('ta_take_order');
		$this->load->view('userFooter');
	}
	function takeOrder(){
		$this->checkLogin();
		$this->load->model('Order_model');
		$user = $_SESSION['user'];
		$orderNum = $_POST['orderNum'];
		if($this->Order_model->takeOrder($orderNum, $user['openid'])){
			echo "接单成功";
		}else{
			echo "接单失败";
		}

	}
	function checkLogin(){
		if (!session_id()) session_start();
		if(isset($_SESSION['user'])){
			// var_dump($_SESSION['user']);
			return true;
		}

		if(isset($_GET['code'])) {
			$appid = 'wxcd901e4412fc040b';
			$appsecret = '16a24c163a44ee41fa3ef630c1c455ec';
			$code = $_GET['code'];
			$para = array('appid'=>$appid, 'secret'=>$appsecret, 'code'=>$code, 'grant_type'=>'authorization_code');
			
			$ret = $this->Http_model->doCurlGetRequest('https://api.weixin.qq.com/sns/oauth2/access_token',$para);
		  	$retData = json_decode($ret, true);

		  	$openid = $retData['openid'];
		  	$access_token = $retData['access_token'];

		  	$this->load->model('User_model');
		  	$this->load->model('Weixin_model');
		  	$result = $this->User_model->searchById($openid);
		  	if($result){
		  		$user = $result;
		  	}else{
		  		$followerInfo = $this->Weixin_model->getFollowerInfo($openid);
		  		if(isset($followerInfo['errorcode'])){
		  			echo '登陆失败, 请关闭网页重连';
					exit(0);
		  		}
		  		date_default_timezone_set('PRC');
		  		$followerInfo['createTime'] = date('Y-m-d h:i:s'); 
		  		$this->User_model->add($followerInfo);
		  		$user = $this->User_model->searchById($openid);
		  	}
	  		if (!session_id()) session_start();
			$_SESSION['user'] = $user;
			// var_dump($user);
		}else{
			echo '登陆失败, 请关闭网页重连';
			exit(0);
		}
	}
	
}
