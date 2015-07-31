<?php
class User_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function searchUserCondition($key){
		$this->db->like('openid',$key);
		$this->db->or_like('email',$key);
		$this->db->or_like('nickname',$key);
	}

	function searchUser($key,$page,$num){
		$this->searchUserCondition($key);
		$query=$this->db->get('user',$num,($page-1)*$num);
		if($this->db->affected_rows()){
			$result['result_rows'] = $query->result();
			$this->searchUserCondition($key);
			$query=$this->db->get('user');
			$result['result_num_rows'] = $query->num_rows();
			return json_decode(json_encode($result),true);
		}else{
			$result['result_rows'] = array();
			$result['result_num_rows'] = 0;
			return $result;
		}
	}

	function searchById($id){
		$this->db->where('openid',$id);
		$this->db->select('*');
		$query=$this->db->get('user');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result[0]),true);
		}else{
			return array();
		}
	}
	function getAll($page,$num){
		$this->db->select('*');
		$query=$this->db->get('user',$num,($page-1)*$num);
		if($this->db->affected_rows()){
			$result['result_rows'] = $query->result();
			$query=$this->db->get('user');
			$result['result_num_rows'] = $query->num_rows();
			return json_decode(json_encode($result),true);
		}else{
			return array();
		}
	}
	function add($data){
		$this->db->query($this->db->insert_string('user',$data));					
		return $this->db->affected_rows();
	}
	function searchByName($name){
		$this->db->where('name',$name);
		$this->db->select('*');
		$query=$this->db->get('user');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result[0]),true);
		}else{
			return array();
		}
	}

	function delete(){
		
	}
	function updateUser($openid,$university,$email){
		$this->db->where('openid',$openid);
		$data = array(
			'university' =>$university,
			'email' => $email,
		);
		$this->db->update('user',$data);
		return $this->db->affected_rows();
	}

	function update($data){
		
	}
	
	function modify($id,$data){
		$this->db->where('openid',$id);
		$this->db->update('user',$data);
		return $this->db->affected_rows();
	}
}
?>