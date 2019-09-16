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
    
    public function get_select($department_id, $project_id = '', $projects_bank_id = '') {
        $query = "SELECT `projects_bank`.`projects_bank_id`, `projects_bank`.`department_id`, `projects_bank`.`project_id`, `projects_bank`.`bank_id`, `bank`.`bank`, `projects_bank`.`account_no`, `projects_bank`.`ifsc_code`, `projects_bank`.`branch`, `projects_bank`.`balance`, `projects_bank`.`finyear_id`, `projects_bank`.`created_date`, `projects_bank`.`created_time`, `projects_bank`.`created_by`, `projects_bank`.`created_name`, `projects_bank`.`created_user_agent`, `projects_bank`.`created_ip`, `projects_bank`.`updated_date`, `projects_bank`.`updated_time`, `projects_bank`.`updated_by`, `projects_bank`.`updated_name`, `projects_bank`.`updated_user_agent`, `projects_bank`.`updated_ip` FROM `projects_bank` INNER JOIN `bank` ON `projects_bank`.`bank_id`=`bank`.`bank_id`";
        $query.= "WHERE (`projects_bank`.`department_id` = '".$department_id."') ";
        if(($project_id != '') && ($project_id != '0') && ($project_id != 'null')) {
            $query.= "AND (`projects_bank`.`project_id` = '".$project_id."') ";
        }
        if(($projects_bank_id != '') && ($projects_bank_id != '0') && ($projects_bank_id != 'null')) {
            $query.= "AND (`projects_bank`.`projects_bank_id` = '".$projects_bank_id."') ";
        }
        $query.= "ORDER BY `bank`.`bank`";
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