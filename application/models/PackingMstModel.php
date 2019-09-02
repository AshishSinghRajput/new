<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class PackingMstModel extends CI_Model {
    //put your code here
    private $table_name = 'packing';

    public function get_record($packing_id = '', $unit_id = '') {
        $query = "SELECT `packing`.`packing_id`, `packing`.`packing_title`, `packing`.`packing_value`, `packing`.`unit_id`, `unit`.`unit_title`, `unit`.`unit_short`, `packing`.`display`, `packing`.`priority`, `packing`.`created_date`, `packing`.`created_time`, `packing`.`created_by`, `packing`.`created_name`, `packing`.`created_user_agent`, `packing`.`created_ip`, `packing`.`updated_date`, `packing`.`updated_time`, `packing`.`updated_by`, `packing`.`updated_name`, `packing`.`updated_user_agent`, `packing`.`updated_ip` FROM `packing` INNER JOIN `unit` ON `packing`.`unit_id`=`unit`.`unit_id` ";
        $is_where = '';
        if(($packing_id != '') && ($packing_id != '0') && ($packing_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`packing`.`packing_id` = '".$packing_id."') ";
        }        
        if(($unit_id != '') && ($unit_id != '0') && ($unit_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`packing`.`unit_id` = '".$unit_id."') ";
        }        
        $query.= "ORDER BY `packing`.`packing_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select() {
        $query = "SELECT `packing_id`, `packing_title` FROM `packing` ";
        $query.= "WHERE (`display` = '1') ";
        $query.= "ORDER BY `priority` DESC, `packing_title`";
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