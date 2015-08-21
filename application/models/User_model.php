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

	function getTotalUserNum(){
		$this->db->select('*');
		$this->db->from('user');
		return $this->db->count_all_results();
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
	function updateUser($user){
		$this->db->where('openid',$user['openid']);
		$this->db->update('user',$user);
		return $this->db->affected_rows();
	}

	function update($data){
		
	}
	//改变余额，money可以为负值
	function addBalance($id, $money, $describe="", $orderNum=0){
		$user = $this->searchById($id);
		$balance = $user['balance'];
		if(($balance+$money)<0){
			return false;
		}else{
			$user['balance'] = $balance+$money;
			$this->modify($id, $user);
			// 交易记录
			$data['openid'] = $user['openid'];
			$data['money'] = $money;
			$data['balance'] = $balance+$money;
			$data['orderNum'] = $orderNum;
			date_default_timezone_set('PRC');
			$data['createTime'] = date('Y-m-d h:i:s');
			$data['describe'] = $describe;
			$this->load->model('Trade_model');
			return $this->Trade_model->add($data);
		}
	}
	
	function modify($id,$data){
		$this->db->where('openid',$id);
		$this->db->update('user',$data);
		return $this->db->affected_rows();
	}
}
?>