<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class DepartmentMstModel extends CI_Model {
    //put your code here
    private $table_name = 'department';

    public function get_record($department_id = '') {
        $query = "SELECT `department_id`, `department_name`, `images`, `thumbnail1`, `thumbnail2`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `department` ";
        $is_where = '';
        if(($department_id != '') && ($department_id != '0') && ($department_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`department_id` = '".$department_id."') ";
        }        
        $query.= "ORDER BY `department_name`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select() {
        $query = "SELECT `department_id`, `department_name` FROM `department` ";        
        $query.= "WHERE (`display` = '1') ";
        $query.= "ORDER BY `priority` DESC, `department_name`";
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