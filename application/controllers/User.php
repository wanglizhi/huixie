<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Http_model');
		$this->load->library('mypagination');
	}
	function userList($page = 1,$num = ITEMS_PER_PAGE)
	{
		$data['pageTitle'] = '所有用户';
		$this->load->model('User_model');
		$result = $this->User_model->getAll($page,$num);
		$data['userList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"user/userList");
		$this->load->view('admin_header',$data);
		$this->load->view('user_list');
		$this->load->view('admin_footer');
	}
	function registerPage(){
		$data['pageTitle']='添加用户';
		$this->load->view('admin_header',$data);
		$this->load->view('add_user');
		$this->load->view('admin_footer');
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
			redirect('user/userList');
		}
	}
	function logout(){
		if (!session_id()) session_start();
		unset($_SESSION['user']);
		redirect('user/loginPage');
	}
	function loginPage(){
		$this->load->view('userHeader');
		$this->load->view('userLogin');
		$this->load->view('userFooter');
	}
	function login(){
		$this->load->model('User_model');
		$name = $_POST['name'];
		$user = $this->User_model->searchByName($name);
		if($user){
			session_start();
			$_SESSION['user'] = $user;	
			redirect('user/orderPage');
		}else{
			$time = 3;
			header("refresh:$time;url=loginPage");
			print('用户名错误，登陆失败...<br>'.$time.'秒后自动跳转。');
		}
	}
	function orderPage(){
			$this->checkLogin();

		  	$data['pageTitle'] = 'All Orders';
			$this->load->view('userHeader',$data);
			$this->load->view('addOrder');
			$this->load->view('userFooter');
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
	function addOrder(){
		$this->checkLogin();
		$this->load->model('Order_model');
		$user = $_SESSION['user'];

		// 2015-07-14T08:55Z
		// echo $_POST['endTime'];
		$data['major'] = $_POST['major'];
		$data['courseName'] = $_POST['courseName'];
		$data['email'] = $_POST['email'];
		$data['pageNum'] = $_POST['pageNum'];
		$data['refDoc'] = $_POST['refDoc'];
		$data['requirement'] = $_POST['requirement'];
		$data['endTime'] = $_POST['endTime'];
		$data['userId'] = $user['openid'];
		date_default_timezone_set('PRC');
		$data['createTime'] = date('Y-m-d h:i:s');
		$data['orderNum'] = time();
		if(!(isset($data['major']) and isset($data['courseName']) and isset($data['userId']) and isset($data['email'])) ){
			$time = 3;
			header("refresh:$time;url=orderPage");
			print('信息错误，订单添加失败...<br>'.$time.'秒后自动跳转。');
			return ;
		}
		$order = $this->Order_model->add($data);
		if (!isset($order)) {
			$time = 3;
			header("refresh:$time;url=orderPage");
			print('信息错误，订单添加失败...<br>'.$time.'秒后自动跳转。');
		}else{
			$data['id'] = $order['id'];
			$_SESSION['order'] = $data;
			redirect('user/taSelectPage');
		}
	}
	function taSelectPage(){
		$this->checkLogin();
		$this->load->model('Ta_model');
		$this->load->model('User_model');
		$order = $_SESSION['order'];
		$taList = $this->Ta_model->searchBySkills($order['major']);
		$length = count($taList);
		for ($i=0; $i < $length; $i++) { 
			$taList[$i]['userInfo'] = $this->User_model->searchById($taList[$i]['openid']);
		}

		$data['pageTitle'] = '推荐 TA';
		$data['taList'] = $taList;
		$this->load->view('userHeader', $data);
		$this->load->view('userSelectTa');
		$this->load->view('userFooter');
	}
	function taRegisterPage(){
			$this->checkLogin();

		  	$data['pageTitle'] = '成为助教';
			$this->load->view('userHeader',$data);
			$this->load->view('user_become_ta');
			$this->load->view('userFooter');
	}
	function taRegister(){
		$this->checkLogin();
		$user = $_SESSION['user'];
		$this->load->model('Ta_model');
		$result = $this->Ta_model->searchById($user['openid']);
		if(isset($result)){
			$time = 3;
			header("refresh:$time;url=taInfoPage");
			//以后应该改成自动填充，修改TA信息
			print('您已经是TA...<br>'.$time.'秒后自动跳转。');
			return;
		}

		$data['openid']= $user['openid'];

		$data['email']=$_POST['email'];
		$data['skills']=$_POST['skills'];
		$data['star'] = $_POST['star'];
		$data['unitPrice'] = $_POST['unitPrice'];
		$data['name'] = $user['nickname'];
		date_default_timezone_set('PRC');
		$data['createTime'] = date('Y-m-d h:i:s');
		if(!isset($data['name'])){
			$time = 3;
			header("refresh:$time;url=taRegisterPage");
			print('填写的信息错误...<br>'.$time.'秒后自动跳转。');
		}
		if (!$this->Ta_model->add($data)) {
			$time = 3;
			header("refresh:$time;url=taRegisterPage");
			print('添加失败...<br>'.$time.'秒后自动跳转。');
		}else{
			redirect('user/taInfoPage');
		}
	}
	function taInfoPage(){
		$this->checkLogin();
		$user = $_SESSION['user'];
		$this->load->model('Ta_model');
		$result = $this->Ta_model->searchById($user['openid']);
		if($result){
			$data['ta'] = $result;
			$data['pageTitle'] = '助教信息';
			$this->load->view('userHeader',$data);
			$this->load->view('user_ta_info');
			$this->load->view('userFooter');
		}else{
			echo '您不是TA';
		}
	}
	function selectTa(){
		$this->checkLogin();
		$taIdList = $_POST['taIdList'];
		$taList = array();
		$this->load->model('Ta_model');
		$max = 0;
		$min = 100000;
		foreach ($taIdList as $taId) {
			$ta = $this->Ta_model->searchById($taId);
			$taList[$taId] = $ta;
			if($ta['unitPrice'] > $max){
				$max = $ta['unitPrice'];
			}
			if($ta['unitPrice'] < $min){
				$min = $ta['unitPrice'];
			}
		}
		if (!session_id()) session_start();
		$data['pageTitle'] = '订单详情';
		$data['order'] = $_SESSION['order'];
		$data['taList'] = $taList;
		$data['max'] = $max * $_SESSION['order']['pageNum'];
		$data['min'] = $min * $_SESSION['order']['pageNum'];
		//添加到session
		$_SESSION['price'] = $data['max'];
		$_SESSION['taList'] = $taList;
		// print_r($data);
		$this->load->view('userHeader', $data);
		$this->load->view('userOrderDetail');
		$this->load->view('userFooter');
	}
	function payOrder(){
		if (!session_id()) session_start();
		$order = $_SESSION['order'];
		$order['price'] = $_SESSION['price'];
		$order['hasPaid'] = 1;
		date_default_timezone_set('PRC');
		$order['paidTime'] = date('Y-m-d h:i:s');
		$this->load->model('Order_model');
		$this->Order_model->update($order);
		//推送给TA
		$this->load->model('Weixin_model');

		$selectedTa = $_SESSION['taList'];
		// if(is_array($selectedTa)){
			foreach ($selectedTa as $ta) {
				echo '推送的人的名字：'.$ta['name']."\n";
			$this->Weixin_model->sendMessageToTa($order, $ta['openid'], '有新的订单提醒');

			$data['taId'] = $ta['openid'];
			$data['orderNum'] = $order['orderNum'];
			$data['createTime'] = date('Y-m-d h:i:s');
			$this->Order_model->selectTa($data);
			}
		// }else{
		// 	$data['taId'] = $selectedTa['id'];
		// 	$data['orderNum'] = $order['orderNum'];
		// 	$data['createTime'] = date('Y-m-d h:i:s');
		// 	$this->Order_model->selectTa($data);
		// }
		
		//跳转到未接单界面
		redirect('user/untakenOrderList');

	}

	function unpaidOrderList(){
		if (!session_id()) session_start();
		$user = $_SESSION['user'];
		if(!$user){
			echo 'please login';
		}else{
			$data['pageTitle'] = 'Unpaid Orders';
			$this->load->model('Order_model');
			$data['orderList'] = $this->Order_model->searchBy2('userId', $user['openid'], 'hasPaid', 0);
			$this->load->view('userHeader', $data);
			$this->load->view('orderList');
			$this->load->view('userFooter');
		}
	}
	function untakenOrderList(){
		if (!session_id()) session_start();
		$user = $_SESSION['user'];
		if(!$user){
			echo 'please login';
		}else{
			$data['pageTitle'] = 'Untakenhed Orders';
			$this->load->model('Order_model');
			$data['orderList'] = $this->Order_model->searchBy3('userId', $user['openid'], 'hasPaid', 1, 'hasTaken', 0);
			$this->load->view('userHeader', $data);
			$this->load->view('orderList');
			$this->load->view('userFooter');
		}
	}
	function unfinishedOrderList(){
		if (!session_id()) session_start();
		$user = $_SESSION['user'];
		if(!$user){
			echo 'please login';
		}else{
			$data['pageTitle'] = 'Unfinished Orders';
			$this->load->model('Order_model');
			$data['orderList'] = $this->Order_model->searchBy3('userId', $user['openid'], 'hasTaken', 1, 'hasFinished', 0);
			$this->load->view('userHeader', $data);
			$this->load->view('orderList');
			$this->load->view('userFooter');
		}
	}
	function finishedOrderList(){
		if (!session_id()) session_start();
		$user = $_SESSION['user'];
		if(!$user){
			echo 'please login';
		}else{
			$data['pageTitle'] = 'Finished Orders';
			$this->load->model('Order_model');
			$data['orderList'] = $this->Order_model->searchBy3('userId', $user['openid'], 'hasPaid', 1, 'hasFinished', 1);
			$this->load->view('userHeader', $data);
			$this->load->view('orderList');
			$this->load->view('userFooter');
		}
	}
}
