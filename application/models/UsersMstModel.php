<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class UsersMstModel extends CI_Model {
    //put your code here
    private $table_name = 'users_mst';

    public function check_login($username, $password) {
        $password = md5($password);

        $query = "SELECT `users_mst`.`users_id`, `users_mst`.`department_id`, `department`.`department_name`, `users_mst`.`name`, `users_mst`.`images`, `users_mst`.`thumbnail1`, `users_mst`.`thumbnail2`, `users_mst`.`mobile`, `users_mst`.`email`, `users_mst`.`username`, `users_mst`.`password`, `users_mst`.`forgot_psw`, `users_mst`.`users_type_id`, `users_type`.`users_type`, `users_mst`.`activation`, `users_mst`.`activation_link`, `users_mst`.`created_date`, `users_mst`.`created_time`, `users_mst`.`created_by`, `users_mst`.`created_name`, `users_mst`.`created_user_agent`, `users_mst`.`created_ip`, `users_mst`.`updated_date`, `users_mst`.`updated_time`, `users_mst`.`updated_by`, `users_mst`.`updated_name`, `users_mst`.`updated_user_agent`, `users_mst`.`updated_ip` FROM `users_mst` LEFT JOIN `department` ON `users_mst`.`department_id`=`department`.`department_id` INNER JOIN `users_type` ON `users_mst`.`users_type_id`=`users_type`.`users_type_id` ";
        $query.= "WHERE (`activation` = '1') ";
        $query.= "AND ((`users_mst`.`mobile` = '".$username."') OR (`users_mst`.`email` = '".$username."') OR (`users_mst`.`username` = '".$username."')) ";
        $query.= "AND (`users_mst`.`password` = '".$password."') ";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_record($users_id = '') {
        $query = "SELECT `users_mst`.`users_id`, `users_mst`.`department_id`, `department`.`department_name`, `users_mst`.`name`, `users_mst`.`images`, `users_mst`.`thumbnail1`, `users_mst`.`thumbnail2`, `users_mst`.`mobile`, `users_mst`.`email`, `users_mst`.`username`, `users_mst`.`password`, `users_mst`.`forgot_psw`, `users_mst`.`users_type_id`, `users_type`.`users_type`, `users_mst`.`activation`, `users_mst`.`activation_link`, `users_mst`.`created_date`, `users_mst`.`created_time`, `users_mst`.`created_by`, `users_mst`.`created_name`, `users_mst`.`created_user_agent`, `users_mst`.`created_ip`, `users_mst`.`updated_date`, `users_mst`.`updated_time`, `users_mst`.`updated_by`, `users_mst`.`updated_name`, `users_mst`.`updated_user_agent`, `users_mst`.`updated_ip` FROM `users_mst` LEFT JOIN `department` ON `users_mst`.`department_id`=`department`.`department_id` INNER JOIN `users_type` ON `users_mst`.`users_type_id`=`users_type`.`users_type_id` ";
        $is_where = '';
        if(($users_id != '') && ($users_id != '0') && ($users_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`users_mst`.`users_id` = '".$users_id."') ";
        }        
        $query.= "ORDER BY `users_mst`.`users_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select($department_id = '', $users_type_id = '') {
        $query = "SELECT `users_id`, `name` FROM `users_mst` ";
        $query.= "WHERE (`department_id` = '".$department_id."') ";
        if(($users_type_id != '') && ($users_type_id != '0') && ($users_type_id != 'null')) {
            $query.= "AND (`users_type_id` = '".$users_type_id."') ";
        }
        $query.= "ORDER BY `users_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function add($data) {
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id(); 
    }

	function modify($tab_data, $tab_where) {
        $this->db->where($tab_where);
		$this->db->update($this->table_name, $tab_data);	
	}
    
    function delete($tab_where) {
		$this->db->delete($this->table_name, $tab_where);
	}   
}