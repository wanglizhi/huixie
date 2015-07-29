<?php
class Selected_ta_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function takeOrder($orderNum){
		$this->db->where('orderNum',$orderNum);
		$this->db->update('hasTake',1);
		return $this->db->affected_rows();
	}

	function add($data){
		$this->db->query($this->db->insert_string('selectedTa',$data));
		return $this->db->affected_rows();
	}
	function searchByTa($taId){
		$this->db->where('taId', $taId);
		$this->db->where('hasTake', 0);
		$this->db->select('*');
		$query=$this->db->get('selectedTa');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			return array();
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
}
?>