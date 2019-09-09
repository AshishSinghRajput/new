<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class ContractorMstModel extends CI_Model {
    //put your code here
    private $table_name = 'contractor';

    public function get_record($department_id, $contractor_id = '', $users_id = '') {
        $query = "SELECT `contractor_id`, `department_id`, `users_id`, `firm_name`, `owner_name`, `firm_type`, `address`, `mobile`, `email`, `website`, `aadhar_no`, `pan_no`, `gsin_no`, `remarks`, `status_id`, `status_date`, `status_remarks`, `is_cancel`, `cancel_date`, `cancel_reason`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `contractor` ";
        $query.= "WHERE (`department_id` = '".$department_id."') ";
        if(($contractor_id != '') && ($contractor_id != '0') && ($contractor_id != 'null')) {
            $query.= "AND (`contractor_id` = '".$contractor_id."') ";
        }        
        if(($users_id != '') && ($users_id != '0') && ($users_id != 'null')) {
            $query.= "AND (`users_id` = '".$users_id."') ";
        }        
        $query.= "ORDER BY `firm_name`";
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