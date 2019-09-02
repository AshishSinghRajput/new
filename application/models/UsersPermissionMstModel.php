<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class UsersPermissionMstModel extends CI_Model {
    //put your code here
    private $table_name = 'users_permission';    
    
    public function get_record($permission_id = '', $users_type_id = '') {
        $query = "SELECT `users_permission`.`permission_id`, `users_permission`.`users_type_id`, `users_type`.`users_type`, `users_permission`.`heading`, `users_permission`.`master_permission_id`, `users_permission`.`url`, `users_permission`.`is_navigation`, `users_permission`.`is_search`, `users_permission`.`is_list`, `users_permission`.`is_view`, `users_permission`.`is_add`, `users_permission`.`is_edit`, `users_permission`.`is_delete`, `users_permission`.`is_prints`, `users_permission`.`display`, `users_permission`.`priority`, `users_permission`.`created_date`, `users_permission`.`created_time`, `users_permission`.`created_by`, `users_permission`.`created_name`, `users_permission`.`created_user_agent`, `users_permission`.`created_ip`, `users_permission`.`updated_date`, `users_permission`.`updated_time`, `users_permission`.`updated_by`, `users_permission`.`updated_name`, `users_permission`.`updated_user_agent`, `users_permission`.`updated_ip` FROM `users_permission` INNER JOIN `users_type` ON `users_permission`.`users_type_id`=`users_type`.`users_type_id` ";
        $is_where = '';
        if(($permission_id != '') && ($permission_id != '0') && ($permission_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`users_permission`.`permission_id` = '".$permission_id."') ";
        }        
        if(($users_type_id != '') && ($users_type_id != '0') && ($users_type_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`users_permission`.`users_type_id` = '".$users_type_id."') ";
        }        
        $query.= "ORDER BY `users_permission`.`priority` DESC, `users_permission`.`permission_id`";
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