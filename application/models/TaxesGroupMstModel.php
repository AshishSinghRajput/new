<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class TaxesGroupMstModel extends CI_Model {
    //put your code here
    private $table_name = 'taxes_group';

    public function get_record($taxes_group_id = '') {
        $query = "SELECT `taxes_group_id`, `taxes_group`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `taxes_group` ";
        $is_where = '';
        if(($taxes_group_id != '') && ($taxes_group_id != '0') && ($taxes_group_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`taxes_group_id` = '".$taxes_group_id."') ";
        }        
        $query.= "ORDER BY `taxes_group_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select() {
        $query = "SELECT `taxes_group_id`, `taxes_group` FROM `taxes_group` ";
        $query.= "WHERE (`display` = '1') ";
        $query.= "ORDER BY `priority` DESC, `taxes_group`";
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