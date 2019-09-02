<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class UnitMstModel extends CI_Model {
    //put your code here
    private $table_name = 'unit';

    public function get_record($unit_id = '', $unit_group_id = '') {
        $query = "SELECT `unit`.`unit_id`, `unit`.`unit_group_id`, `unit_group`.`unit_group`, `unit`.`unit_title`, `unit`.`unit_short`, `unit`.`unit_value`, `unit`.`is_default`, `unit`.`display`, `unit`.`priority`, `unit`.`created_date`, `unit`.`created_time`, `unit`.`created_by`, `unit`.`created_name`, `unit`.`created_user_agent`, `unit`.`created_ip`, `unit`.`updated_date`, `unit`.`updated_time`, `unit`.`updated_by`, `unit`.`updated_name`, `unit`.`updated_user_agent`, `unit`.`updated_ip` FROM `unit` INNER JOIN `unit_group` ON `unit`.`unit_group_id`=`unit_group`.`unit_group_id` ";
        $is_where = '';
        if(($unit_id != '') && ($unit_id != '0') && ($unit_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`unit`.`unit_id` = '".$unit_id."') ";
        }        
        if(($unit_group_id != '') && ($unit_group_id != '0') && ($unit_group_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`unit`.`unit_group_id` = '".$unit_group_id."') ";
        }        
        $query.= "ORDER BY `unit`.`unit_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select($unit_group_id = '') {
        $query = "SELECT `unit`.`unit_id`, `unit`.`unit_title` FROM `unit` ";
        $query.= "WHERE (`unit`.`display` = '1') ";                
        if(($unit_group_id != '') && ($unit_group_id != 'null')) {
            $query.= "AND (`unit`.`unit_group_id` = '".$unit_group_id."') ";
        }
        $query.= "ORDER BY `unit`.`priority` DESC, `unit`.`unit_title`";
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