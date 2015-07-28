<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class User extends CustomerController {
	function __construct(){
		parent::__construct();
		$this->load->model('Http_model');
	}
	function index(){
		echo 'haha';
	}
	function loginPage(){
		$this->load->view('customer/header');
		$this->load->view('customer/loginPage');
		$this->load->view('customer/footer');
	}
	function logout(){
		if (!session_id()) session_start();
		unset($_SESSION['user']);
		redirect('customer/user/loginPage');
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
		$user = $_SESSION['user'];
		$order = $_SESSION['order'];
		$order['price'] = $_SESSION['price'];
		$this->load->model('Weixin_model');
		$this->load->model('Message_model');
		$order['hasPaid'] = 1;
		date_default_timezone_set('PRC');
		$order['paidTime'] = date('Y-m-d h:i:s');
		$this->load->model('Order_model');
		$this->Order_model->update($order);
		//推送给用户
		$this->Message_model->sendMessageToUser(
				$order,
				$user['openid'],
				'付款成功，订单详情如下：！',
				'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Fhuixie%2Findex.php%2Fta%2FtakeOrderPage&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
				'恭喜你下单成功，请联系客服获得帮助，将参考资料发送到admin@huixie.me');

		//推送给TA
		$selectedTa = $_SESSION['taList'];

		foreach ($selectedTa as $ta) {
			echo '推送的人的名字：'.$ta['name']."\n";
		$this->Weixin_model->sendMessageToTa($order, $ta['openid'], '有新的订单提醒');

		$data['taId'] = $ta['openid'];
		$data['orderNum'] = $order['orderNum'];
		$data['createTime'] = date('Y-m-d h:i:s');
		$this->Order_model->selectTa($data);
		}
		
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
