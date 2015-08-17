<?php
class Trade_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function searchTradeByUserCondition($openid){
		$this->db->where('openid',$openid);
		$this->db->order_by('createTime', 'desc');
	}

	function searchTradeByUser($openid,$page,$num){
		$this->searchTradeByUserCondition($openid);
		$query=$this->db->get('tradeRecord',$num,($page-1)*$num);
		if($this->db->affected_rows()){
			$result['result_rows'] = $query->result();
			$this->searchTradeByUserCondition($openid);
			$query=$this->db->get('tradeRecord');
			$result['result_num_rows'] = $query->num_rows();
			return json_decode(json_encode($result),true);
		}else{
			$result['result_rows'] = array();
			$result['result_num_rows'] = 0;
			return $result;
		}
	}
	function add($data){
		$this->db->query($this->db->insert_string('tradeRecord',$data));					
		return $this->db->affected_rows();
	}
}
?>