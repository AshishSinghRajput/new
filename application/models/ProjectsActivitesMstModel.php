<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class ProjectsActivitesMstModel extends CI_Model {
    //put your code here
    private $table_name = 'project_activity';

    public function get_record($department_id, $project_id = '', $project_activity_id = '', $contractor_id = '') {
        $query = "SELECT `project_activity_id`, `department_id`, `project_id`, `activity_name`, `address`, `funds_allocated`, `sanction_amount`, `dnit_amount`, `allotment_below_above`, `allotment_amount`, `contractor_id`, `supervisor_id`, `date_start`, `scheduled_date_completion`, `extension`, `actual_date_completion`, `expenditure_released`, `remarks`, `status_id`, `status_date`, `status_remarks`, `is_cancel`, `cancel_date`, `cancel_reason`, `finyear_id`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `project_activity` ";
        $query.= "WHERE (`department_id` = '".$department_id."') ";
        if(($project_id != '') && ($project_id != '0') && ($project_id != 'null')) {
            $query.= "AND (`project_id` = '".$project_id."') ";
        }
        if(($project_activity_id != '') && ($project_activity_id != '0') && ($project_activity_id != 'null')) {
            $query.= "AND (`project_activity_id` = '".$project_activity_id."') ";
        }
        if(($contractor_id != '') && ($contractor_id != '0') && ($contractor_id != 'null')) {
            $query.= "AND (`contractor_id` = '".$contractor_id."') ";
        }
        $query.= "ORDER BY `project_activity_id`";
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