<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class DesignationMstModel extends CI_Model {
    //put your code here
    private $table_name = 'designation';

    public function get_record($designation_id = '') {
        $query = "SELECT `designation`, `designation_id`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `designation` ";
        $is_where = '';
        if(($designation_id != '') && ($designation_id != '0') && ($designation_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`designation_id` = '".$designation_id."') ";
        }        
        $query.= "ORDER BY `designation_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select() {
        $query = "SELECT `designation_id`, `designation` FROM `designation` ";
        $query.= "WHERE (`display` = '1') ";
        $query.= "ORDER BY `priority` DESC, `designation`";
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