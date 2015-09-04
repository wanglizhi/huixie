<?php
class Star_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    function searchByOrderNum($orderNum){
        $this->db->where('orderNum',$orderNum);
        $this->db->select('*');
        $query=$this->db->get('starRecord');
        if($this->db->affected_rows()){
            $result = $query->result();
            return json_decode(json_encode($result[0]),true);
        }else{
            return array();
        }
    }
    function searchByTa($taId){

    }
    function add($data){
        $this->db->query($this->db->insert_string('starRecord',$data));                    
        return $this->db->affected_rows();
    }
    function modify($data){
        $this->db->where('orderNum',$data['orderNum']);
        $this->db->update('starRecord',$data);
        return $this->db->affected_rows();
    }
}
?>