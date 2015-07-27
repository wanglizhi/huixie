<?php
class Order_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function searchBy1($key, $value){
		$this->db->where($key, $value);
		$this->db->select('*');
		$query=$this->db->get('order');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			return array();
		}
	}
	function searchBy2($key1, $value1, $key2, $value2){
		$this->db->where($key1, $value1);
		$this->db->where($key2, $value2);
		$this->db->select('*');
		$query=$this->db->get('order');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			return array();
		}
	}
	function searchBy3($key1, $value1, $key2, $value2, $key3, $value3){
		$this->db->where($key1, $value1);
		$this->db->where($key2, $value2);
		$this->db->where($key3, $value3);
		$this->db->select('*');
		$query=$this->db->get('order');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			return array();
		}
	}
	function getAll(){
		$this->db->select('*');
		$query=$this->db->get('order');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			return array();
		}
	}
	function add($data){
		$this->db->query($this->db->insert_string('order',$data));
		$query=$this->db->query("select @@identity as id");
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			return array();
		}
	}
	function delete(){
		
	}
	function update($data){
		$this->db->where('id',$data['id']);
		$this->db->update('order',$data);
		return $this->db->affected_rows();
	}
	function takeOrder($orderNum, $taId){
		$result = $this->searchBy1('orderNum', $orderNum);
		$data = $result[0];
		$data['taId'] = $taId;
		date_default_timezone_set('PRC');
		$data['takenTime'] = date('Y-m-d h:i:s');
		$data['hasTaken'] = 1;
		$this->db->where('orderNum',$orderNum);
		$this->db->update('order',$data);
		//接单时间
		return $this->db->affected_rows();
	}
	function selectTa($data){
		$this->db->query($this->db->insert_string('selectedTa',$data));
		return $this->db->affected_rows();
	}
	function searchSelectTa($taId){
		$this->db->where('taId', $taId);
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