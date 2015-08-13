<?php
class Selected_ta_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function takeOrder($orderNum){
		$this->db->query('update selectedTa set hasTaken = 1 where orderNum = '.$orderNum);
		return $this->db->affected_rows();
	}

	function add($data){
		$this->db->query($this->db->insert_string('selectedTa',$data));
		return $this->db->affected_rows();
	}
	function searchByTa($taId, $page, $num){
		$this->db->where('taId', $taId);
		$this->db->where('hasTaken', 0);
		$this->db->order_by('createTime', 'desc');
		$this->db->select('*');
		$query=$this->db->get('selectedTa',$num,($page-1)*$num);
		if($this->db->affected_rows()){
			$result['result_rows'] = $query->result();
			$result['result_num_rows'] = $this->db->count_all_results();
			return json_decode(json_encode($result),true);
		}else{
			$result['result_rows']=array();
			$result['result_num_rows'] = 0;
			return $result;
		}
	}
	function searchBy2($taId, $orderNum){
		$this->db->where('taId', $taId);
		$this->db->where('orderNum', $orderNum);
		$this->db->select('*');
		$query=$this->db->get('selectedTa');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result[0]),true);
		}else{
			return array();
		}
	}
	function delete($orderNum){
		$this->db->where('orderNum',$orderNum);
		$this->db->delete('selectedTa');
		return $this->db->affected_rows();
	}
}
?>