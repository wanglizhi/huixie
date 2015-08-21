<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //防止用户直接访问

class Statistic extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Http_model');
		$this->load->library('mypagination');
	}
	function stat(){
		$this->load->model('Order_model');
		$data['orderNum'] = $this->Order_model->getTotalOrderNum();
		$this->load->model('User_model');
		$data['userNum'] = $this->User_model->getTotalUserNum();
		$this->load->model('Ta_model');
		$data['checkedTaNum'] = $this->Ta_model->getCheckedTaNum();
		$data['uncheckedTaNum'] = $this->Ta_model->getUnCheckedTaNum();
		$this->loadView(ADMIN_PREFIX.'statistic',$data);
	}
}