<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Order extends CustomerController {
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->addOrderPage();
	}
	//添加订单
	function addOrderPage($notice=""){
		$data['notice'] = $notice;
		$this->loadView('add_order',$data);
	}
	//保密政策
	function privacy(){
		$this->loadView('privacy');
	}
	function addOrder(){
		// echo $_POST['endDate'].'--'.$_POST['endTime'].'--'.$_POST['prov'].'--'.$_POST['city'];

		$this->load->model('Order_model');
		$user = $_SESSION['user'];

		$count = $this->Order_model->unpaidCount($user['openid']);
		if($count >= MAX_UNPAID){
			$notice = '未付款订单数量大于'.MAX_UNPAID.'，无法继续添加，请适量删除未付款订单！';
			redirect('customer/order/addOrderPage/'.$notice);
		}

		$endTime = $_POST['endDate'].' '.$_POST['endTime'];
		$timezone = $_POST['timezone'];
		date_default_timezone_set($timezone);
		$timestamp = strtotime($endTime);
		date_default_timezone_set("PRC");
		$data['endTime'] = date("Y-m-d H:i:s",$timestamp);
		$data['timezone'] = $timezone;

		$data['major'] = $_POST['prov'].'-'.$_POST['city'];
		$data['courseName'] = $_POST['courseName'];
		$data['email'] = $_POST['email'];
		$data['pageNum'] = $_POST['pageNum'];
		$data['refDoc'] = $_POST['refDoc'];
		$data['requirement'] = $_POST['requirement'];
		$data['userId'] = $user['openid'];
		//设置orderNum 暂时采用用户openid的后四位+timestamp
		// $str = "oJWDev3kr51nqxTSFNQDaf4y7xHA";
		// $str4 = substr($str,-4,4);
		date_default_timezone_set('PRC');
		$data['createTime'] = date('Y-m-d h:i:s');
		$data['orderNum'] = time();
		if(!(isset($data['major']) and isset($data['courseName']) and isset($data['userId']) and isset($data['email'])) ){
			$notice = '信息填写错误';
			redirect('customer/order/addOrderPage/'.$notice);
		}
		$order = $this->Order_model->add($data);
		if (!isset($order)) {
			$notice = '添加失败';
			redirect('customer/order/addOrderPage/'.$notice);
		}else{
			$data['id'] = $order['id'];
			$_SESSION['order'] = $data;
			redirect('customer/order/taSelectPage/'.$data['orderNum']);
		}
	}

	function taSelectPage($orderNum){

		$this->load->model('Ta_model');
		$this->load->model('User_model');
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($orderNum);
		$_SESSION['order'] = $order;
		$taList = $this->Ta_model->searchBySkills($order['major']);
		$length = count($taList);
		for ($i=0; $i < $length; $i++) {
			$taList[$i]['userInfo'] = $this->User_model->searchById($taList[$i]['openid']);
		}

		// $ta1 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $ta2 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $taList = array('1'=>$ta1, '2'=>$ta2);

		$data['taList'] = $taList;
		$this->loadView('select_ta',$data);
	}

	function payOrderPage(){
		// 如果没有TA选择，如何处理。。。。

		$user = $_SESSION['user'];
		if(isset($_POST['taIdList'])){
			$taIdList = $_POST['taIdList'];
			$taList = array();
			$this->load->model('Ta_model');
			$max = 0;
			$min = 100000;
			foreach ($taIdList as $taId) {
				//ta 对象里要加userInfo项目
				$ta = $this->Ta_model->searchById($taId);
				$taList[$taId] = $ta;
				if($ta['unitPrice'] > $max){
					$max = $ta['unitPrice'];
				}
				if($ta['unitPrice'] < $min){
					$min = $ta['unitPrice'];
				}
			}

		}else{
			$max = $min = UNIT_PRICE;
			$taList = array();
		}
		
		$this->load->model('Order_model');
		$order = $this->Order_model->searchById($_SESSION['order']['orderNum']);

		$data['order'] = $order;
		$data['taList'] = $taList;
		$data['max'] = $max * $order['pageNum'];
		$data['min'] = $min * $order['pageNum'];
		$sessionId = session_id();
		$data['sessionId'] = $sessionId;
		$data['user'] = $user;
		//添加到session
		$_SESSION['price'] = $data['max'];
		$_SESSION['taList'] = $taList;


		
		//数据测试
		// $data['max'] = 100;
		// $data['min'] = 10;
		// $data['order'] = array('orderNum'=>1234567,'courseName'=>'设计与实现','major'=>'软件工程', 'pageNum'=>10, 'refDoc'=>6, 'endTime'=>'2015-6-10','timezone'=>'EST5EDT', 'requirement'=>'没有什么要求，好好写就行');
		// $ta1 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $ta2 = array('openid'=> '123456677', 'unitPrice' => 100, 'star'=> 4.0, 'introduction'=>'我来自哈佛，学习成绩非常好！',
		// 	'userInfo'=>array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname'));
		// $taList = array('1'=>$ta1, '2'=>$ta2);
		// $data['sessionId'] = 0;
		// $data['taList'] = $taList;
		// $user = array('headimgurl'=>'http://wx.qlogo.cn/mmopen/ib3RVnJ436WdEFP1zdH4hibpeJcnUmo6nGPHmM4FicOKd7MtROuQqws0WdntwQozgZuuJQlFG42yl6fWic0NYmwtvnWotBRyxt9O/0',
		// 		'nickname'=>'nickname', 'country'=>'中国', 'city'=>'南京', 'sex'=>1, 'university'=>'南京大学', 'email'=>'user@qq.com', 'openid'=>12, 'balance'=>1000);
		// $data['user'] = $user;


		$this->loadView('pay_order_detail',$data);
	}
	// 付款
	function payOrder($useBalance=0){
		$this->log('enter payOrder');
		$user = $_SESSION['user'];
		$order = $_SESSION['order'];
		$this->load->model('Message_model');
		$this->load->model('Order_model');
		$this->load->model('User_model');
		$this->load->model('Selected_ta_model');

		//判断是否已经付款，避免重复~
		$order = $this->Order_model->searchById($order['orderNum']);
		if($order['hasPaid']){
			redirect('customer/user/orderDetail/'.$order['orderNum']);
		}

		if($useBalance>0){
			//如果使用了余额, 用户balance改变
			$this->User_model->addBalance($user['openid'], 0-$useBalance, "余额支付订单", $order['orderNum']);
			$user = $this->User_model->searchById($user['openid']);
			$_SESSION['user'] = $user;
		}

		// var_dump($order);
		$order['price'] = $_SESSION['price'];
		$order['hasPaid'] = 1;
		date_default_timezone_set('PRC');
		$order['paidTime'] = date('Y-m-d h:i:s');
		$this->Order_model->update($order);
		//推送给用户
		$this->Message_model->sendMessageToUser(
				$order,
				$user['openid'],
				'付款成功，订单详情如下：！',
				site_url('customer/user/orderDetail/'.$order['orderNum']),
				//'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Findex.php%2Fcustomer%2Fuser%2ForderDetail%2F'.$order['orderNum'].'&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
				'恭喜你下单成功，请联系客服获得帮助，将参考资料发送到admin@huixie.me');

		//推送给TA
		$selectedTa = $_SESSION['taList'];

		foreach ($selectedTa as $ta) {
			$this->Message_model->sendMessageToTa(
				$order,
				$ta['openid'],
				'有新的订单提醒',
				site_url('customer/ta/takeOrderPage/'.$order['orderNum']),
				// 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcd901e4412fc040b&redirect_uri=http%3A%2F%2Fhuixie.me%2Findex.php%2Fcustomer%2Fta%2FtakeOrderPage%2F'.$order['orderNum'].'&response_type=code&scope=snsapi_base&state=fuxue#wechat_redirect',
				'请您及时接单，并且联系客服获得相关材料');

			//数据库添加选择的TA列表
			$data['taId'] = $ta['openid'];
			$data['orderNum'] = $order['orderNum'];
			date_default_timezone_set('PRC');
			$data['createTime'] = date('Y-m-d h:i:s');
			$this->Selected_ta_model->add($data);
		}
		//跳转到接单界面
		redirect('customer/user/orderDetail/'.$order['orderNum']);
	}

		//写内容到文件，log日志功能
	private function log($str){  
        $mode='a';//追加方式写  
        $file = "log.txt";  
        $oldmask = @umask(0);  
        $fp = @fopen($file,$mode); 
        @flock($fp, 3);  
        if(!$fp)  
        {  
            Return false;  
        }  
        else  
        {  
            @fwrite($fp,date('Y-m-d h:i:sa').' --> '.$str."\n");  
            @fclose($fp);  
            @umask($oldmask);  
            Return true;  
        }  
    }


}
