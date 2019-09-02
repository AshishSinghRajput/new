<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class PaymentMstModel extends CI_Model {
    //put your code here
    private $table_name = 'payment_mst';

    public function get_record($finyear_id, $store_id = '', $payment_mst_id = '', $supplier_id = '') {
        $query = "SELECT `payment_mst_id`, `payment_no`, `date`, `store_id`, `supplier_id`, `purchase_mst_id`, `dues_amount`, `pay_amount`, `adjustment`, `grand_total`, `round_off`, `amount_word`, `remarks`, `payment_mode_id`, `payment_mode`, `bank_id`, `transaction_no`, `transaction_date`, `branch`, `status_id`, `status_date`, `status_remarks`, `is_cancel`, `cancel_date`, `cancel_reason`, `finyear_id`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `payment_mst` ";
        $query .= "WHERE (`finyear_id` = '" . $finyear_id . "') ";
        $query .= "AND (`store_id` = '" . $store_id . "') ";

        if(($payment_mst_id != '') && ($payment_mst_id != 'null')) {
            $query.= "AND (`payment_mst_id` = '".$payment_mst_id."') ";
        }
        
        if(($supplier_id != '') && ($supplier_id != 'null')) {
            $query.= "AND (`supplier_id` = '".$supplier_id."') ";
        }
        
        //$query.= "ORDER BY `heading`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_count($finyear_id, $store_id) {
        $query = "SELECT count(`payment_mst_id`)+1 AS `total` FROM `payment_mst` ";
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