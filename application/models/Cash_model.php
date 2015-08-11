<?php
class Cash_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function searchCashByUserCondition($openid){
		$this->db->where('openid',$openid);
	}

	function searchCashByUser($openid,$page,$num){
		$this->searchCashByUserCondition($openid);
		$query=$this->db->get('cashRecord',$num,($page-1)*$num);
		if($this->db->affected_rows()){
			$result['result_rows'] = $query->result();
			$this->searchCashByUserCondition($openid);
			$query=$this->db->get('cashRecord');
			$result['result_num_rows'] = $query->num_rows();
			return json_decode(json_encode($result),true);
		}else{
			$result['result_rows'] = array();
			$result['result_num_rows'] = 0;
			return $result;
		}
	}
}
?>