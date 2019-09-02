<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class SupplierAccountMstModel extends CI_Model {
    //put your code here
    private $table_name = 'supplier_account_mst';

    public function get_record($finyear_id, $store_id, $supplier_id = '', $supplier_account_mst_id = '') {
        $query = "SELECT `supplier_account_mst_id`, `store_id`, `supplier_id`, `is_supplier_type`, `opening`, `inward`, `purchase`, `payment`, `purchase_return`, `outward`, `sales`, `receipt`, `sales_return`, `credit_note`, `debit_note`, `net_amount`, `adjustment`, `finyear_id`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `supplier_account_mst` ";        
        $query.= "WHERE (`finyear_id` = '".$finyear_id."') ";
        $query.= "AND (`store_id` = '".$store_id."') ";
       
        if(($supplier_id != '') && ($supplier_id != '0') && ($supplier_id != 'null')) {
            $query.= "AND (`supplier_id` = '".$supplier_id."') ";
        }
        
        if(($supplier_account_mst_id != '') && ($supplier_account_mst_id != '0') && ($supplier_account_mst_id != 'null')) {
            $query.= "AND (`supplier_account_mst_id` = '".$supplier_account_mst_id."') ";
        }        
        //$query.= "ORDER BY `firm_name`";
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