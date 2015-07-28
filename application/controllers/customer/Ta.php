<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Ta extends CustomerController {
	function __construct(){
		parent::__construct();
		$this->load->model('Http_model');
		$this->load->library('mypagination');
	}
	function registerPage(){
		$user = $_SESSION['user'];
		$this->load->model('Ta_model');
		$result = $this->Ta_model->searchById($user['openid']);
		$data['ta'] = $result;

		//数据测试
		// $data['ta'] = array('skills'=>'软件工程','star'=>3.5, 'unitPrice'=>100, 'hasCheck'=>1, 'email'=>'11@qq.com');
		// $data['ta'] = array();

		$this->load->view('customer/header', $data);
		$this->load->view('customer/register_ta');
		$this->load->view('customer/footer');
	}
	function register(){
		$user = $_SESSION['user'];
		$email = $_POST['email'];
		$this->load->model('Ta_model');
		$result = $this->Ta_model->searchById($user['openid']);
		if($result){
			$result['email'] = $email;
			$this->Ta_model->modify($result['openid'],$result);
		}else{
			$data['openid']= $user['openid'];
			$data['email'] = $_POST['email'];
			$data['name'] = $user['nickname'];
			date_default_timezone_set('PRC');
			$data['createTime'] = date('Y-m-d h:i:s');
			$this->Ta_model->add($data);
		}
		redirect('customer/ta/registerPage');
	}




	// 接单界面
	function takeOrderPage(){
		$user = $_SESSION['user'];
		$this->load->model('Order_model');
		$select = $this->Order_model->searchSelectTa($user['openid']);
		$order = $this->Order_model->searchBy1('orderNum', $select['orderNum']);

		//判断是否被接单
		if($order){
			$order = $order[0];
		}
		if($order['taId'] and $order['taId'] == $user['openid']){
			echo '您已经接单！';
			exit(0);
		}else if($order['hasTaken']){
			echo '该订单已经被人接单';
			exit(0);
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
		$order = $this->Order_model->searchBy1('orderNum', $orderNum);
		if($this->Order_model->takeOrder($orderNum, $user['openid'])){
			$this->load->model('Message_model');
			$this->Message_model->sendMessageToTa(
				$order,
				$user['openid'],
				'订单接单成功！',
				'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Fhuixie%2Findex.php%2Fta%2FtakeOrderPage&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
				'恭喜你接单成功，请联系客服获得相关材料，完成后将文件发送到admin@huixie.me');
			echo "接单成功";
		}else{
			echo "接单失败";
		}

	}
	//待选择订单
	function untakenOrderList(){
		echo '待选择订单';
	}

	// 订单列表
	function orderList($page = 1,$num = ITEMS_PER_PAGE){
		// $user = $_SESSION['user'];

		//数据测试
		$user = array('openid'=>'4');


		$data['pageTitle'] = '接单列表';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('taId', $user['openid'], 'hasTaken', 1, $page,$num);

		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/user/orderList");

		$this->load->view('customer/header', $data);
		$this->load->view('customer/user_order_list');
		$this->load->view('customer/footer');
	}
	
}
