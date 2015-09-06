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
    function getTaStar($taId){
        //根据Star表得到TA对应的分数
        $sql = 'SELECT count(*) FROM starRecord WHERE taId = ?';
        $query = $this->db->query($sql, array($taId));
        $result = $query->result();
        $count = json_decode(json_encode($result[0]),true)['count(*)'];
        if($count == 0){
            // 魔法数字。。。最高评分
            return 5;
        }

        $sql = 'SELECT sum(`star`) FROM starRecord WHERE taId = ?';
        $query = $this->db->query($sql, array($taId));
        $result = $query->result();
        $sum = json_decode(json_encode($result[0]),true)['sum(`star`)'];
        return round(($sum + 5 ) /($count + 1), 1);
    }
    function updateTaStar($taId){
        $this->load->model('Ta_model');
        $ta = $this->Ta_model->searchById($taId);
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