<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class TaxesMstModel extends CI_Model {
    //put your code here
    private $table_name = 'taxes';

    public function get_record($taxes_id = '', $taxes_group_id = '') {
        $query = "SELECT `taxes`.`taxes_id`, `taxes`.`taxes_group_id`, `taxes_group`.`taxes_group`, `taxes`.`taxes_title`, `taxes`.`taxes_value`, `taxes`.`is_percent`, `taxes`.`display`, `taxes`.`priority`, `taxes`.`created_date`, `taxes`.`created_time`, `taxes`.`created_by`, `taxes`.`created_name`, `taxes`.`created_user_agent`, `taxes`.`created_ip`, `taxes`.`updated_date`, `taxes`.`updated_time`, `taxes`.`updated_by`, `taxes`.`updated_name`, `taxes`.`updated_user_agent`, `taxes`.`updated_ip` FROM `taxes` INNER JOIN `taxes_group` ON `taxes`.`taxes_group_id`=`taxes_group`.`taxes_group_id` ";
        $is_where = '';
        if(($taxes_id != '') && ($taxes_id != '0') && ($taxes_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`taxes`.`taxes_id` = '".$taxes_id."') ";
        }        
        if(($taxes_group_id != '') && ($taxes_group_id != '0') && ($taxes_group_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`taxes`.`taxes_group_id` = '".$taxes_group_id."') ";
        }        
        $query.= "ORDER BY `taxes`.`taxes_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select($taxes_group_id = '') {
        $query = "SELECT `taxes`.`taxes_id`, `taxes`.`taxes_title`, `taxes`.`taxes_value`, `taxes`.`is_percent` FROM `taxes` ";
        $query.= "WHERE (`taxes`.`display` = '1') ";                
        if(($taxes_group_id != '') && ($taxes_group_id != 'null')) {
            $query.= "AND (`taxes`.`taxes_group_id` = '".$taxes_group_id."') ";
        }
        $query.= "ORDER BY `taxes`.`priority` DESC, `taxes`.`taxes_title`";
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