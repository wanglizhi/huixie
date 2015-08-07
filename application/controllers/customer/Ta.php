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
			date_default_timezone_set('PRC');
			$data['createTime'] = date('Y-m-d h:i:s');
			$this->Ta_model->add($data);
		}
		redirect('customer/ta/registerPage');
	}




	// 接单界面
	function takeOrderPage($orderNum){
		$user = $_SESSION['user'];
		$this->load->model('Order_model');
		$this->load->model('Selected_ta_model');
		// $select = $this->Selected_ta_model->searchBy2($user['openid'], $orderNum);
		$order = $this->Order_model->searchById($orderNum);

		//测试数据
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com', 'openid'=>12);
		// $order = array('taId'=>2, 'hasTaken'=>0, 'orderNum'=>1234567,'courseName'=>'设计与实现','major'=>'软件工程', 'pageNum'=>10, 'refDoc'=>6, 'endTime'=>'2015-6-10', 'requirement'=>'没有什么要求，好好写就行');

		$data['order'] = $order;
		$data['user'] = $user;

		$this->load->view('customer/header',$data);
		$this->load->view('customer/ta_take_order');
		$this->load->view('customer/footer');
	}
	function takeOrder(){
		$this->load->model('Order_model');
		$user = $_SESSION['user'];
		$orderNum = $_POST['orderNum'];
		$order = $this->Order_model->searchById($orderNum);
		if($this->Order_model->takeOrder($orderNum, $user['openid'])){
			// 更新SelectedTa
			$this->load->model('Selected_ta_model');
			$this->Selected_ta_model->takeOrder($orderNum);

			$this->load->model('Message_model');
			$this->Message_model->sendMessageToTa(
				$order,
				$user['openid'],
				'订单接单成功！',
				'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Fhuixie%2Findex.php%2Fcustomer%2Fta%2FtakeOrderPage%2F'.$orderNum.'&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
				'恭喜你接单成功，请联系客服获得相关材料，完成后将文件发送到admin@huixie.me');
		}
		redirect('customer/ta/takeOrderPage/'.$orderNum);

	}
	//待选择订单
	function untakenOrderList($page = 1,$num = ITEMS_PER_PAGE){
		//此处需要修改，排序问题，联合查询问题，分页问题，选择接单
		$user = $_SESSION['user'];
		$this->load->model('Selected_ta_model');
		$selectList = $this->Selected_ta_model->searchByTa($user['openid'],$page,$num);
		$orderList = array();
		foreach ($selectList as $select) {
			$this->load->model('Order_model');
			$order = $this->Order_model->searchById($select['orderNum']);
			array_push($orderList, $order);
		}

		$data['pageTitle'] = '未接单列表';
		$data['orderList'] = $orderList;
		$result['result_num_rows'] = count($orderList);
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/ta/untakenOrderList");

		$this->load->view('customer/header', $data);
		$this->load->view('customer/ta_order_list');
		$this->load->view('customer/footer');
	}

	// 订单列表
	function orderList($page = 1,$num = ITEMS_PER_PAGE){
		$user = $_SESSION['user'];

		//数据测试
		// $user = array('openid'=>'4');


		$data['pageTitle'] = '接单列表';
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy2('taId', $user['openid'], 'hasTaken', 1, $page,$num);

		$data['orderList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,"customer/ta/orderList");

		$this->load->view('customer/header', $data);
		$this->load->view('customer/ta_order_list');
		$this->load->view('customer/footer');
	}
	
}
