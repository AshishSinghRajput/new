<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class SupplierMstModel extends CI_Model {
    //put your code here
    private $table_name = 'supplier';

    public function get_record($supplier_id = '') {
        $query = "SELECT `supplier_id`, `store_id`, `is_supplier_type`, `firm_name`, `owner_name`, `address`, `country_name`, `state_name`, `city_name`, `zip_code`, `mobile1`, `mobile2`, `email`, `website`, `gsin_no`, `pan_no`, `aadhar_no`, `bank_id`, `account_no`, `ifsc_code`, `branch`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `supplier` ";
        $is_where = '';
        if(($supplier_id != '') && ($supplier_id != '0') && ($supplier_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`supplier_id` = '".$supplier_id."') ";
        }        
        $query.= "ORDER BY `firm_name`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select($store_id = '', $is_supplier_type = '') {
        $query = "SELECT `supplier_id`, `firm_name` FROM `supplier` ";        
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