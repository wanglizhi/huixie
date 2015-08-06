<?php
class Order_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function searchById($orderNum){
		$this->db->where('orderNum', $orderNum);
		$this->db->select('*');
		$query=$this->db->get('order');

		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result[0]),true);
		}else{
			return array();
		}
	}

	function searchBy1Condition($key,$value,$sort_key,$sort_method,$searchKey){
		$this->db->where($key, $value);
		$this->db->select('*');
		$this->db->order_by($sort_key,$sort_method);
		$this->db->where('(orderNum like "%'.$searchKey.'%" or email like "%'.$searchKey.'%" or userId like "%'.$searchKey.'%")');
		$this->db->from('order');
	}

	function searchBy1($key, $value,$page,$num,$sort_key = "createTime",$sort_method = "desc",$searchKey=""){
		$this->searchBy1Condition($key,$value,$sort_key,$sort_method,$searchKey);
		$result['result_num_rows'] = $this->db->count_all_results();
		$this->searchBy1Condition($key,$value,$sort_key,$sort_method,$searchKey);
		$this->db->limit($num,($page-1)*$num);
		$query = $this->db->get();
		if($this->db->affected_rows()){
			$result['result_rows'] = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			$result['result_rows']=array();
			return $result;
		}
	}
	function searchBy2Condition($key1, $value1, $key2, $value2,$sort_key,$sort_method,$searchKey){
		$this->db->where($key1, $value1);
		$this->db->where($key2, $value2);
		$this->db->select('*');
		$this->db->where('(orderNum like "%'.$searchKey.'%" or email like "%'.$searchKey.'%" or userId like "%'.$searchKey.'%")');
		$this->db->order_by($sort_key,$sort_method);
		$this->db->from('order');
	}

	function searchBy2($key1, $value1, $key2, $value2,$page,$num,$sort_key = "createTime",$sort_method = "desc",$searchKey = ""){
		$this->searchBy2Condition($key1, $value1, $key2, $value2,$sort_key,$sort_method,$searchKey);
		$result['result_num_rows'] = $this->db->count_all_results();
		$this->searchBy2Condition($key1, $value1, $key2, $value2,$sort_key,$sort_method,$searchKey);
		$this->db->limit($num,($page-1)*$num);
		$query = $this->db->get();
		if($this->db->affected_rows()){
			$result['result_rows'] = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			$result['result_rows']=array();
			$result['result_num_rows'] = 0;
			return $result;
		}
	}
	function searchBy3Condition($key1, $value1, $key2, $value2,$key3, $value3,$sort_key,$sort_method,$searchKey){
		$this->db->where($key1, $value1);
		$this->db->where($key2, $value2);
		$this->db->where($key3, $value3);
		$this->db->select('*');
		$this->db->where('(orderNum like "%'.$searchKey.'%" or email like "%'.$searchKey.'%" or userId like "%'.$searchKey.'%")');
		$this->db->order_by($sort_key,$sort_method);
		$this->db->from('order');
	}

	function searchBy3($key1, $value1, $key2, $value2, $key3, $value3,$page,$num,$searchKey=""){
		$this->searchBy3Condition($key1, $value1, $key2, $value2,$key3, $value3,$sort_key,$sort_method,$searchKey);
		$result['result_num_rows'] = $this->db->count_all_results();
		$this->searchBy3Condition($key1, $value1, $key2, $value2,$key3, $value3,$sort_key,$sort_method,$searchKey);
		$this->db->limit($num,($page-1)*$num);
		$query = $this->db->get();
		if($this->db->affected_rows()){
			$result['result_rows'] = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			$result['result_rows']=array();
			$result['result_num_rows'] = 0;
			return $result;
		}
	}

	function getAllCondition($sort_key,$sort_method,$searchKey){
		$this->db->select('*');
		$this->db->from('order');
		$this->db->order_by($sort_key,$sort_method);
		$this->db->where('(orderNum like "%'.$searchKey.'%" or email like "%'.$searchKey.'%" or userId like "%'.$searchKey.'%")');
	}

	function getAll($page,$num,$sort_key = "createTime",$sort_method = "desc",$searchKey=""){
		$this->getAllCondition($sort_key,$sort_method,$searchKey);
		$result['result_num_rows'] = $this->db->count_all_results();
		$this->getAllCondition($sort_key,$sort_method,$searchKey);
		$this->db->limit($num,($page-1)*$num);
		$query = $this->db->get();
		if($this->db->affected_rows()){
			$result['result_rows'] = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			$result['result_rows'] = array();
			return $result;
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
	function delete($orderNum){
		$this->db->where('orderNum',$orderNum);
		$this->db->delete('order');
		return $this->db->affected_rows();
	}
	function update($data){
		$this->db->where('orderNum',$data['orderNum']);
		$this->db->update('order',$data);
		return $this->db->affected_rows();
	}
	function takeOrder($orderNum, $taId){
		$data = $this->searchById($orderNum);
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