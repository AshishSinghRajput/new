<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class ContractorBankMstModel extends CI_Model {
    //put your code here
    private $table_name = 'contractor_bank';

    public function get_record($department_id, $contractor_id = '', $users_id = '', $contractor_bank_id = '') {
        $query = "SELECT `contractor_bank_id`, `department_id`, `users_id`, `contractor_id`, `bank_id`, `account_no`, `ifsc_code`, `branch`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `contractor_bank` ";
        $query.= "WHERE (`department_id` = '".$department_id."') ";
        if(($contractor_id != '') && ($contractor_id != '0') && ($contractor_id != 'null')) {
            $query.= "AND (`contractor_id` = '".$contractor_id."') ";
        }        
        if(($users_id != '') && ($users_id != '0') && ($users_id != 'null')) {
            $query.= "AND (`users_id` = '".$users_id."') ";
        }        
        if(($contractor_bank_id != '') && ($contractor_bank_id != '0') && ($contractor_bank_id != 'null')) {
            $query.= "AND (`contractor_bank_id` = '".$contractor_bank_id."') ";
        }        
        $query.= "ORDER BY `contractor_bank_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select($department_id, $users_id = '', $contractor_bank_id = '') {
        $query = "SELECT `contractor_bank`.`contractor_bank_id`, `contractor_bank`.`bank_id`, `bank`.`bank`, `contractor_bank`.`account_no`, `contractor_bank`.`ifsc_code`, `contractor_bank`.`branch` FROM `contractor_bank` INNER JOIN `bank` ON `contractor_bank`.`bank_id`=`bank`.`bank_id` ";
        $query.= "WHERE (`department_id` = '".$department_id."') ";
        if(($users_id != '') && ($users_id != '0') && ($users_id != 'null')) {
            $query.= "AND (`users_id` = '".$users_id."') ";
        }        
        if(($contractor_bank_id != '') && ($contractor_bank_id != '0') && ($contractor_bank_id != 'null')) {
            $query.= "AND (`contractor_bank_id` = '".$contractor_bank_id."') ";
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