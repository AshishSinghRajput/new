<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class ProductAccountDetModel extends CI_Model {
    //put your code here
    private $table_name = 'product_account_det';

    public function get_record($finyear_id, $store_id = '', $product_account_det_id = '', $product_account_mst_id = '', $product_id = '') {
        $query = "SELECT `product_account_det_id`, `product_account_mst_id`, `account_id`, `account`, `store_id`, `invoice_no`, `date`, `supplier_id`, `name`, `mobile`, `brand_id`, `brand_heading`, `category1_id`, `category2_id`, `category3_id`, `category4_id`, `product_id`, `product_code`, `product_heading`, `standard_barcode`, `generate_barcode`, `quantity`, `packing_id`, `packing_title`, `unit_id`, `unit_title`, `mfg_date`, `expiry_date`, `batch_no`, `mrp_price`, `rate`, `total_mrp`, `total_rate`, `cgst_id`, `cgst_title`, `cgst_value`, `total_cgst_amount`, `sgst_id`, `sgst_title`, `sgst_value`, `total_sgst_amount`, `igst_id`, `igst_title`, `igst_value`, `total_igst_amount`, `total_amount`, `is_cancel`, `cancel_date`, `cancel_reason`, `finyear_id`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `product_account_det` ";
        $query .= "WHERE (`finyear_id` = '" . $finyear_id . "') ";
        $query .= "AND (`store_id` = '" . $store_id . "') ";

        if(($product_account_det_id != '') && ($product_account_det_id != 'null')) {
            $query.= "AND (`product_account_det_id` = '".$product_account_det_id."') ";
        }        
        /*if(($product_account_mst_id != '') && ($product_account_mst_id != 'null')) {
            $query.= "AND (`product_account_mst_id` = '".$product_account_mst_id."') ";
        }        
        if(($product_id != '') && ($product_id != 'null')) {
            $query.= "AND (`store_id` = '".$store_id."') ";
        }*/
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