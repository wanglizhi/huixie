<?php
class Admin_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function getAll($page,$num){
		$this->db->select('*');
		$query=$this->db->get('admin');
		if($this->db->affected_rows()){
			$result['result_num_rows'] = $query->num_rows();
			$result['result_rows'] = $query->result();
			return json_decode(json_encode($result),true);
		}else{
			return array();
		}
	}
	function add($data){
		$this->db->query($this->db->insert_string('admin',$data));					
		return $this->db->affected_rows();
	}
	function searchByName($name){
		$this->db->where('name',$name);
		$this->db->select('*');
		$query=$this->db->get('admin');
		if($this->db->affected_rows()){
			$sae =	$query->result();
			return json_decode(json_encode($sae[0]),true);
		}
		return $this->db->affected_rows();
	}

	// admin修改密码
	function modify($name,$data){
		$this->db->where('name',$name);
		$this->db->update('admin',$data);
		return $this->db->affected_rows();
	}
}
?>