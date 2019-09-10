<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class ProjectsBankMstModel extends CI_Model {
    //put your code here
    private $table_name = 'projects_bank';

    public function get_record($department_id, $project_id = '', $projects_bank_id = '') {
        $query = "SELECT `projects_bank_id`, `department_id`, `project_id`, `bank_id`, `account_no`, `ifsc_code`, `branch`, `balance`, `finyear_id`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `projects_bank` ";
        $query.= "WHERE (`department_id` = '".$department_id."') ";
        if(($project_id != '') && ($project_id != '0') && ($project_id != 'null')) {
            $query.= "AND (`project_id` = '".$project_id."') ";
        }
        if(($projects_bank_id != '') && ($projects_bank_id != '0') && ($projects_bank_id != 'null')) {
            $query.= "AND (`projects_bank_id` = '".$projects_bank_id."') ";
        }
        $query.= "ORDER BY `projects_bank_id`";
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