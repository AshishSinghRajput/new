<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class UsersTypeMstModel extends CI_Model {
    //put your code here
    private $table_name = 'users_type';

    public function get_record($users_type_id = '') {
        $query = "SELECT `users_type_id`, `users_type`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `users_type` ";
        $is_where = '';
        if(($users_type_id != '') && ($users_type_id != '0') && ($users_type_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`users_type_id` = '".$users_type_id."') ";
        }        
        $query.= "ORDER BY `users_type_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select() {
        $query = "SELECT `users_type_id`, `users_type` FROM `users_type` ";
        $query.= "WHERE (`display` = '1') ";
        $query.= "ORDER BY `priority` DESC, `users_type_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function add($data) {
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id(); 
    }

	function modify($tab_sel, $tab_where) {
		$this->db->where($tab_where);
		$this->db->update($this->table_name, $tab_sel);	
	}
    
    function delete($tab_where) {
		$this->db->delete($this->table_name, $tab_where);
	}   
}