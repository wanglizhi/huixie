<?php
class Ta_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function searchById($id){
		$this->db->where('openid',$id);
		$this->db->select('*');
		$query=$this->db->get('ta');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result[0]),true);
		}else{
			return array();
		}
	}
	function getAll(){
		$this->db->select('*');
		$query=$this->db->get('ta');
		if($this->db->affected_rows()){
			$result['result_num_rows'] = $query->num_rows();
			$result['result_rows'] = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			return array();
		}
	}
	function add($data){
		$this->db->query($this->db->insert_string('ta',$data));					
		return $this->db->affected_rows();
	}
	function searchByName($name){
		$this->db->where('name',$name);
		$this->db->select('*');
		$query=$this->db->get('ta');
		if($this->db->affected_rows()){
			$result = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			return array();
		}
	}
	function searchBySkills($skills){
		$sql="select * from ta where skills='$skills' order by star desc limit 10";
		$query=$this->db->query($sql);
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
		
	}
	
	function modify($id,$data){
		$this->db->where('openid',$id);
		$this->db->update('ta',$data);
		return $this->db->affected_rows();
	}
}
?>