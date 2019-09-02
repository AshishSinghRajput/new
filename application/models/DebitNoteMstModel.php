<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class DebitNoteMstModel extends CI_Model {
    //put your code here
    private $table_name = 'debit_note_mst';

    public function get_record($finyear_id, $store_id = '', $debit_note_mst_id = '', $supplier_id = '') {
        $query = "SELECT `debit_note_mst_id`, `debit_note_no`, `date`, `store_id`, `supplier_id`, `dues_amount`, `pay_amount`, `adjustment`, `grand_total`, `round_off`, `amount_word`, `payment_mode_id`, `payment_mode`, `bank_id`, `transaction_no`, `transaction_date`, `branch`, `remarks`, `status_id`, `status_date`, `status_remarks`, `is_cancel`, `cancel_date`, `cancel_reason`, `finyear_id`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `debit_note_mst` ";
        $query .= "WHERE (`finyear_id` = '" . $finyear_id . "') ";
        $query .= "AND (`store_id` = '" . $store_id . "') ";
         
        if(($debit_note_mst_id != '') && ($debit_note_mst_id != 'null')) {
            $query.= "AND (`debit_note_mst_id` = '".$debit_note_mst_id."') ";
        }
        
        if(($supplier_id != '') && ($supplier_id != 'null')) {
            $query.= "AND (`supplier_id` = '".$supplier_id."') ";
        }
        
        //$query.= "ORDER BY `heading`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_count($finyear_id, $store_id) {
        $query = "SELECT count(`debit_note_mst_id`)+1 AS `total` FROM `debit_note_mst` ";
        $query.= "WHERE (`finyear_id` = '".$finyear_id."') ";
        $query.= "AND (`store_id` = '".$store_id."') ";
        //$query.= "ORDER BY `heading`";
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