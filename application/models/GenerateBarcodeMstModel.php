<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GenerateBarcodeMstModel extends CI_Model
{
    //put your code here
    private $table_name = 'generate_barcode';

    public function get_record($finyear_id, $store_id = '', $generate_barcode_id = '', $supplier_id = '', $brand_id = '', $product_id = '')
    {
        $query = "SELECT `generate_barcode_id`, `date`, `store_id`, `supplier_id`, `brand_id`, `brand_heading`, `category1_id`, `category2_id`, `category3_id`, `category4_id`, `product_id`, `product_code`, `product_heading`, `standard_barcode`, `generate_barcode`, `quantity`, `packing_id`, `packing_title`, `unit_id`, `unit_title`, `mfg_date`, `expiry_date`, `batch_no`, `mrp_price`, `total_mrp`, `purchase_rate`, `total_purchase_rate`, `sales_rate`, `total_sales_rate`, `status_id`, `status_date`, `status_remarks`, `is_cancel`, `cancel_date`, `cancel_reason`, `finyear_id`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `generate_barcode` ";
        $query .= "WHERE (`finyear_id` = '" . $finyear_id . "') ";
        $query .= "AND (`store_id` = '" . $store_id . "') ";
        if (($generate_barcode_id != '') && ($generate_barcode_id != '0') && ($generate_barcode_id != 'null')) {
            $query .= "AND (`generate_barcode_id` = '" . $generate_barcode_id . "') ";
        }
        if (($supplier_id != '') && ($supplier_id != '0') && ($supplier_id != 'null')) {
            $query .= "AND (`supplier_id` = '" . $supplier_id . "') ";
        }
        if (($product_id != '') && ($product_id != '0') && ($product_id != 'null')) {
            $query .= "AND (`product_id` = '" . $product_id . "') ";
        }
        if (($generate_barcode_id != '') && ($generate_barcode_id != '0') && ($generate_barcode_id != 'null')) {
            $query .= "AND (`generate_barcode_id` = '" . $generate_barcode_id . "') ";
        }
        $query .= "ORDER BY `generate_barcode_id`";
        $results = $this->db->query($query);
        return $results->result();
    }
    
    public function get_stock($finyear_id, $store_id = '', $generate_barcode_id = '', $supplier_id = '', $brand_id = '', $product_id = '') {
        $query = "SELECT `generate_barcode_id`, `date`, `store_id`, `supplier_id`, `brand_id`, `brand_heading`, `category1_id`, `category2_id`, `category3_id`, `category4_id`, `product_id`, `product_code`, `product_heading`, `standard_barcode`, `generate_barcode`, `quantity`, `packing_id`, `packing_title`, `unit_id`, `unit_title`, `mfg_date`, `expiry_date`, `batch_no`, `mrp_price`, `total_mrp`, `purchase_rate`, `total_purchase_rate`, `sales_rate`, `total_sales_rate`, `status_id`, `status_date`, `status_remarks`, `is_cancel`, `cancel_date`, `cancel_reason`, `finyear_id`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `generate_barcode` ";
        $query .= "WHERE (`finyear_id` = '" . $finyear_id . "') ";
        $query .= "AND (`store_id` = '" . $store_id . "') ";
        if (($generate_barcode_id != '') && ($generate_barcode_id != '0') && ($generate_barcode_id != 'null')) {
            $query .= "AND (`generate_barcode_id` = '" . $generate_barcode_id . "') ";
        }
        if (($supplier_id != '') && ($supplier_id != '0') && ($supplier_id != 'null')) {
            $query .= "AND (`supplier_id` = '" . $supplier_id . "') ";
        }
        if (($product_id != '') && ($product_id != '0') && ($product_id != 'null')) {
            $query .= "AND (`product_id` = '" . $product_id . "') ";
        }
        if (($generate_barcode_id != '') && ($generate_barcode_id != '0') && ($generate_barcode_id != 'null')) {
            $query .= "AND (`generate_barcode_id` = '" . $generate_barcode_id . "') ";
        }
        $query .= "ORDER BY `quantity` DESC";
        $query .= "`generate_barcode_id`";
        $results = $this->db->query($query);
        return $results->result();
    }

    public function add($data)
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    function modify($tab_sel, $tab_where)
    {
        $this->db->where($tab_where);
        $this->db->update($this->table_name, $tab_sel);
    }

    function delete($tab_where)
    {
        $this->db->delete($this->table_name, $tab_where);
    }
}
