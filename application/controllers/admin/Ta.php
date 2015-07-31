<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Ta extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Http_model');
		$this->load->library('mypagination');
	}
	function taList($page = 1,$num = ITEMS_PER_PAGE)
	{
		$data['pageTitle'] = '所有 TA';
		$this->load->model('Ta_model');
		$result = $this->Ta_model->getAll($page,$num);
		$data['taList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."ta/taList");
		$this->loadView(ADMIN_PREFIX.'ta_list',$data);
	}
	function checkedtaList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '待审核 TA';
		$this->load->model('Ta_model');
		$result = $this->Ta_model->getChecked($page,$num);
		$data['taList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."ta/unCheckedtaList");
		$this->loadView(ADMIN_PREFIX.'ta_list',$data);
	}
	function unCheckedtaList($page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '待审核 TA';
		$this->load->model('Ta_model');
		$result = $this->Ta_model->getUnchecked($page,$num);
		$data['taList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."ta/unCheckedtaList");
		$this->loadView(ADMIN_PREFIX.'ta_list',$data);
	}
	function searchTa($key = "",$page = 1,$num = ITEMS_PER_PAGE){
		$data['pageTitle'] = '查找TA';
		$this->load->model('Ta_model');
		if($key==NULL)	$key = $_GET['key'];
		$result = $this->Ta_model->searchTa($key,$page,$num);
		$data['taList'] = $result['result_rows'];
		$data['page_info'] = $this->mypagination->create_links(ceil($result['result_num_rows']/$num),$page
				,ADMIN_PREFIX."ta/searchTa/".$key);
		$this->loadView(ADMIN_PREFIX.'ta_list',$data);
	}
	function taInfo($openid = ""){
		$data['pageTitle'] = 'TA 信息';
		$this->load->model('Ta_model');
		if($openid==="") $openid = $_GET['openid'];
		$ta = $this->Ta_model->searchById($openid);
		if(empty($ta)){
			$time = 3;
			header("refresh:$time;url=addTaPage");
			print($openid.'ta不存在...<br>'.$time.'秒后自动跳转。');
			exit();
		} 
		$data['ta'] = $ta;
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('taId', $openid,1,ITEMS_PER_PAGE);
		$data['taOrderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "taOrderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => 1,
			'page_method' => ADMIN_PREFIX."ta/taOrderListPage",
		);
		$this->loadView(ADMIN_PREFIX.'ta_info',$data);
	}
	function taOrderListPage($openid = ""){
		if($openid=="" && !isset($_GET['openid'])){
			echo "error!";
			exit();
		}
		if($openid=="") $openid = $_GET['openid'];
		$page = $_GET['page'];
		$js_page_method = $_GET['js_page_method'];
		if(!isset($page)){
			echo "错误！！没有页数";
			exit(0);
		}
		$this->load->model('Order_model');
		$result = $this->Order_model->searchBy1('taId', $openid,$page,ITEMS_PER_PAGE);
		$data['orderTable'] = array(
			'orderList' => $result['result_rows'],
			'tableId'   => "taOrderTable",
		);
		$data['page_info'] = array(
			'total_pages'  => ceil($result['result_num_rows']/ITEMS_PER_PAGE),
			'current_page'  => $page,
			'page_method' => ADMIN_PREFIX."ta/taOrderListPage",
		);
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX.'order_table',$data);
	}
	function addTaPage(){
		$data['pageTitle'] = '添加 TA';
		$this->loadView(ADMIN_PREFIX.'add_ta',$data);
	}
	function updateTa(){
		$this->load->model('Ta_model');
		try{
			$data['openid']=$_POST['openId'];
			$data['email']=$_POST['email'];
			$data['skills']=$_POST['skill'];
			$data['star'] = $_POST['star'];
			$data['unitPrice'] = $_POST['unitPrice'];
			$data['introduction'] = $_POST['introduction'];
			$data['hasCheck'] = TRUE;
			date_default_timezone_set('PRC');
			$data['createTime'] = date('Y-m-d h:i:s');
		}catch(Exception $e){
			$time = 3;
			header("refresh:$time;url=addTaPage");
			print('出错了...<br>'.$time.'秒后自动跳转。');
		}
		if (!$this->Ta_model->update($data)) {
			$time = 3;
			header("refresh:$time;url=addTaPage");
			print('添加失败...<br>'.$time.'秒后自动跳转。');
		}else{
			redirect(ADMIN_PREFIX.'ta/taList');
		}
	}
	function addTa(){
		$this->load->model('Ta_model');
		try{
			$data['openid']=$_POST['openId'];
			$data['email']=$_POST['email'];
			$data['skills']=$_POST['skill'];
			$data['star'] = $_POST['star'];
			$data['unitPrice'] = $_POST['unitPrice'];
			$data['introduction'] = $_POST['introduction'];
			$data['hasCheck'] = TRUE;
			date_default_timezone_set('PRC');
			$data['createTime'] = date('Y-m-d h:i:s');
		}catch(Exception $e){
			$time = 3;
			header("refresh:$time;url=addTaPage");
			print('出错了...<br>'.$time.'秒后自动跳转。');
		}
		if(!empty($this->Ta_model->searchById($data['openid']))){
			$time = 3;
			header("refresh:$time;url=addTaPage");
			print('该openId已存在！...<br>'.$time.'秒后自动跳转。');
			exit();
		}
		if (!$this->Ta_model->add($data)) {
			$time = 3;
			header("refresh:$time;url=addTaPage");
			print('添加失败...<br>'.$time.'秒后自动跳转。');
		}else{
			redirect(ADMIN_PREFIX.'ta/taList');
		}
	}
}
