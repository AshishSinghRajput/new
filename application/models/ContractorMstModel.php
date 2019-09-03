<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class ContractorMstModel extends CI_Model {
    //put your code here
    private $table_name = 'contractor';

    public function get_record($contractor_id = '') {
        $query = "SELECT `contractor_id`, `users_id`, `firm_name`, `firm_type`, `owner_name`, `address`,`mobile`, `email`, `website`, `gsin_no`, `pan_no`, `aadhar_no`, `bank_id`, `account_no`, `ifsc_code`, `branch`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `contractor` ";
        $is_where = '';
        if(($contractor_id != '') && ($contractor_id != '0') && ($contractor_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`contractor_id` = '".$contractor_id."') ";
        }        
        $query.= "ORDER BY `firm_name`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select($store_id = '', $is_supplier_type = '') {
        $query = "SELECT `supplier_id`, `firm_name` FROM `contractor` ";        
        $query.= "WHERE (`display` = '1') ";
        //if(($store_id != '') && ($store_id != 'null')) {
            $query.= "AND (`store_id` = '".$store_id."') ";
        //}
        if(($is_supplier_type != '') && ($is_supplier_type != 'null')) {
            $query.= "AND (`is_supplier_type` = '".$is_supplier_type."') ";
        }
        $query.= "ORDER BY `priority` DESC, `firm_name`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function add($data) {
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id(); 
    }

    public function add_acc($tblname, $data) {
        $this->db->insert($tblname, $data);
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