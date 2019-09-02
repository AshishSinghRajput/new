<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class CheckedReceivedMstModel extends CI_Model {
    //put your code here
    private $table_name = 'checked_received';

    public function get_record($store_id = '', $checked_received_id = '') {
        $query = "SELECT `checked_received_id`, `store_id`, `checked_received`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `checked_received` ";
        $is_where = '';
        if(($store_id != '') && ($store_id != '0') && ($store_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`store_id` = '".$store_id."') ";
        }        
        if(($checked_received_id != '') && ($checked_received_id != '0') && ($checked_received_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`checked_received_id` = '".$checked_received_id."') ";
        }        
        $query.= "ORDER BY `checked_received_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select($store_id = '') {
        $query = "SELECT `checked_received_id`, `checked_received` FROM `checked_received` ";
        $query.= "WHERE (`display` = '1') ";
        //if(($store_id != '') && ($store_id != 'null')) {
            $query.= "AND (`store_id` = '".$store_id."') ";
        //}
        $query.= "ORDER BY `priority` DESC, `checked_received`";
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