<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class UsersLogsMstModel extends CI_Model {
    //put your code here
    private $table_name = 'users_logs';

    public function get_record($users_id = '') {
        $query = "SELECT `usermst`.`users_id`, `usermst`.`name`, `usermst`.`images`, `usermst`.`thumbnail1`, `usermst`.`thumbnail2`, `usermst`.`mobile`, `usermst`.`email`, `usermst`.`username`, `usermst`.`password`, `usermst`.`forgot_psw`, `usermst`.`users_type_id`, `users_type`.`users_type`, `usermst`.`activation`, `usermst`.`activation_link`, `usermst`.`created_date`, `usermst`.`created_time`, `usermst`.`created_by`, `usermst`.`created_name`, `usermst`.`created_user_agent`, `usermst`.`created_ip`, `usermst`.`updated_date`, `usermst`.`updated_time`, `usermst`.`updated_by`, `usermst`.`updated_name`, `usermst`.`updated_user_agent`, `usermst`.`updated_ip` FROM `usermst` INNER JOIN `users_type` ON `usermst`.`users_type_id`=`users_type`.`users_type_id` ";
        $is_where = '';
        if(($users_id != '') && ($users_id != '0') && ($users_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`usermst`.`users_id` = '".$users_id."') ";
        }        
        $query.= "ORDER BY `usermst`.`users_id`";
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