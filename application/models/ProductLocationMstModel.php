<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class ProductLocationMstModel extends CI_Model {
    //put your code here
    private $table_name = 'product_location_mst';

    public function get_record($finyear_id, $store_id = '', $supplier_id = '', $brand_id = '', $product_id = '') {
        $query = "SELECT `product_location_mst_id`, `product_account_mst_id`, `store_id`, `stock_location_id`, `supplier_id`, `brand_id`, `category1_id`, `category2_id`, `category3_id`, `category4_id`, `product_id`, `opening`, `inward`, `purchase`, `purchase_return`, `outward`, `sales`, `receipt`, `sales_return`, `credit_note`, `debit_note`, `see`, `net_amount`, `finyear_id`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `product_location_mst` ";
        $query .= "WHERE (`finyear_id` = '" . $finyear_id . "') ";
        $query .= "AND (`store_id` = '" . $store_id . "') ";

        if(($supplier_id != '') && ($supplier_id != 'null')) {
            $query.= "AND (`supplier_id` = '".$supplier_id."') ";
        }         
        if(($brand_id != '') && ($brand_id != 'null')) {
            $query.= "AND (`brand_id` = '".$brand_id."') ";
        }       
        if(($product_id != '') && ($product_id != 'null')) {
            $query.= "AND (`product_id` = '".$product_id."') ";
        }        
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