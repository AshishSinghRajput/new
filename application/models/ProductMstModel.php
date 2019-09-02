<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class ProductMstModel extends CI_Model {
    //put your code here
    private $table_name = 'product';

    public function get_record($product_id = '', $hsn_code) {
        $query = "SELECT `product_id`, `meta_title`, `author`, `meta_keywords`, `meta_description`, `slug`, `master_id`, `ean_upc_gtin`, `hsn_code`, `mpn_code`, `sku_code`, `product_code`, `heading`, `sub_heading`, `brand_id`, `category1_id`, `category2_id`, `category3_id`, `category4_id`, `is_download`, `is_show`, `images`, `thumbnail1`, `thumbnail2`, `video`, `pdf`, `zip`, `model`, `is_product_type`, `packing_id`, `unit_id`, `weight`, `weight_unit_id`, `length`, `width`, `height`, `lwh_unit_id`, `cgst_taxes_id`, `sgst_taxes_id`, `igst_taxes_id`, `additional`, `short_description1`, `short_description2`, `description`, `tags`, `is_store`, `store_priority`, `is_app`, `app_priority`, `is_web`, `web_priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `product` ";
        $is_where = '';
        if(($product_id != '') && ($product_id != '0') && ($product_id != 'null')) {
            if($is_where === '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`product_id` = '".$product_id."') ";
        }        
        if(($hsn_code != '') && ($hsn_code != '0') && ($hsn_code != 'null')) {
            if($is_where === '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`hsn_code` = '".$hsn_code."') ";
        }        
        $query.= "ORDER BY `heading`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_full_record($product_id = '') {
        $query = "SELECT `product`.`product_id`, `product`.`meta_title`, `product`.`author`, `product`.`meta_keywords`, `product`.`meta_description`, `product`.`slug`, `product`.`master_id`, `product`.`ean_upc_gtin`, `product`.`hsn_code`, `product`.`mpn_code`, `product`.`sku_code`, `product`.`product_code`, `product`.`heading`, `product`.`sub_heading`, `product`.`brand_id`, `brand`.`heading` AS `brand_heading`, `brand`.`sub_heading` AS `brand_sub_heading`, `product`.`category1_id`, `category1`.`heading` AS `category1_heading`, `category1`.`sub_heading` AS `category1_sub_heading`, `product`.`category2_id`, `category2`.`heading` AS `category2_heading`, `category2`.`sub_heading` AS `category2_sub_heading`, `product`.`category3_id`, `category3`.`heading` AS `category3_heading`, `category3`.`sub_heading` AS `category3_sub_heading`, `product`.`category4_id`, `category4`.`heading` AS `category4_heading`, `category4`.`sub_heading` AS `category4_sub_heading`, `product`.`is_download`, `product`.`is_show`, `product`.`images`, `product`.`thumbnail1`, `product`.`thumbnail2`, `product`.`video`, `product`.`pdf`, `product`.`zip`, `product`.`model`, `product`.`is_product_type`, `product`.`packing_id`, `packing`.`packing_title`, `product`.`unit_id`, `unit`.`unit_title`, `product`.`weight`, `product`.`weight_unit_id`, `weight_unit`.`unit_title` AS `weight_unit`, `product`.`length`, `product`.`width`, `product`.`height`, `product`.`lwh_unit_id`, `lwh_unit`.`unit_title` AS `lwh_unit`, `product`.`cgst_taxes_id`, `cgst`.`taxes_title` AS `cgst_taxes_title`, `cgst`.`taxes_value` AS `cgst_taxes_value`, `cgst`.`is_percent` AS `cgst_is_percent`, `product`.`sgst_taxes_id`, `sgst`.`taxes_title` AS `sgst_taxes_title`, `sgst`.`taxes_value` AS `sgst_taxes_value`, `sgst`.`is_percent` AS `sgst_is_percent`, `product`.`igst_taxes_id`, `igst`.`taxes_title` AS `igst_taxes_title`, `igst`.`taxes_value` AS `igst_taxes_value`, `igst`.`is_percent` AS `igst_is_percent`, `product`.`additional`, `product`.`short_description1`, `product`.`short_description2`, `product`.`description`, `product`.`tags`, `product`.`is_store`, `product`.`store_priority`, `product`.`is_app`, `product`.`app_priority`, `product`.`is_web`, `product`.`web_priority`, `product`.`created_date`, `product`.`created_time`, `product`.`created_by`, `product`.`created_name`, `product`.`created_user_agent`, `product`.`created_ip`, `product`.`updated_date`, `product`.`updated_time`, `product`.`updated_by`, `product`.`updated_name`, `product`.`updated_user_agent`, `product`.`updated_ip` FROM `product` LEFT JOIN `brand` ON `product`.`brand_id`=`brand`.`brand_id` LEFT JOIN `category` AS `category1` ON `product`.`category1_id`=`category1`.`category_id` LEFT JOIN `category` AS `category2` ON `product`.`category2_id`=`category2`.`category_id` LEFT JOIN `category` AS `category3` ON `product`.`category3_id`=`category3`.`category_id` LEFT JOIN `category` AS `category4` ON `product`.`category4_id`=`category4`.`category_id` LEFT JOIN `packing` ON `product`.`packing_id`=`packing`.`packing_id` LEFT JOIN `unit` ON `product`.`unit_id`=`unit`.`unit_id` LEFT JOIN `unit` AS `weight_unit` ON `product`.`weight_unit_id`=`weight_unit`.`unit_id` LEFT JOIN `unit` AS `lwh_unit` ON `product`.`lwh_unit_id`=`lwh_unit`.`unit_id` LEFT JOIN `taxes` AS `cgst` ON `product`.`cgst_taxes_id`=`cgst`.`taxes_id` LEFT JOIN `taxes` AS `sgst` ON `product`.`sgst_taxes_id`=`sgst`.`taxes_id` LEFT JOIN `taxes` AS `igst` ON `product`.`igst_taxes_id`=`igst`.`taxes_id` ";
        $is_where = '';
        if(($product_id != '') && ($product_id != '0') && ($product_id != 'null')) {
            if($is_where === '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`product`.`product_id` = '".$product_id."') ";
        }        
        $query.= "ORDER BY `product`.`heading`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select($brand_id = '', $category1_id = '', $category2_id = '', $category3_id = '', $category4_id = '') {
        $query = "SELECT `product_id`, `heading` FROM `product` ";
        $query.= "WHERE (`is_store` = '1') ";
        if(($brand_id != '') && ($brand_id != 'null')) {
            $query.= "AND (`brand_id` = '".$brand_id."') ";
        }        
        if(($category1_id != '') && ($category1_id != 'null')) {
            $query.= "AND (`category1_id` = '".$category1_id."') ";
        }        
        if(($category2_id != '') && ($category2_id != 'null')) {
            $query.= "AND (`category2_id` = '".$category2_id."') ";
        }        
        if(($category3_id != '') && ($category3_id != 'null')) {
            $query.= "AND (`category3_id` = '".$category3_id."') ";
        }        
        if(($category4_id != '') && ($category4_id != 'null')) {
            $query.= "AND (`category4_id` = '".$category4_id."') ";
        }
        $query.= "ORDER BY `store_priority` DESC, `heading`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_hsn_code() {
        $query = "SELECT DISTINCT `hsn_code` FROM `product` ";
        $query.= "WHERE (`is_store` = '1') ";
        $query.= "ORDER BY `hsn_code`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_autocomplete($finyear_id = '', $store_id = '', $term = '', $product_id = '') {
        $query = "SELECT `product`.`product_id`, `product`.`product_code`, `product`.`heading`, `product`.`packing_id`, `packing`.`packing_title`, `product`.`unit_id`, `unit`.`unit_title`, `product`.`cgst_taxes_id`, `cgst`.`taxes_title` AS `cgst_taxes_title`, `cgst`.`taxes_value` AS `cgst_taxes_value`, `cgst`.`is_percent` AS `cgst_is_percent`, `product`.`sgst_taxes_id`, `sgst`.`taxes_title` AS `sgst_taxes_title`, `sgst`.`taxes_value` AS `sgst_taxes_value`, `sgst`.`is_percent` AS `sgst_is_percent`, `product`.`igst_taxes_id`, `igst`.`taxes_title` AS `igst_taxes_title`, `igst`.`taxes_value` AS `igst_taxes_value`, `igst`.`is_percent` AS `igst_is_percent`, `product_account_mst`.`net_amount` FROM `product` INNER JOIN `product_account_mst` ON `product`.`product_id`= `product_account_mst`.`product_id` LEFT JOIN `generate_barcode` ON `product`.`product_id`=`generate_barcode`.`product_id` LEFT JOIN `packing` ON `product`.`packing_id`=`packing`.`packing_id` LEFT JOIN `unit` ON `product`.`unit_id`=`unit`.`unit_id` LEFT JOIN `taxes` AS `cgst` ON `product`.`cgst_taxes_id`=`cgst`.`taxes_id` LEFT JOIN `taxes` AS `sgst` ON `product`.`sgst_taxes_id`=`sgst`.`taxes_id` LEFT JOIN `taxes` AS `igst` ON `product`.`igst_taxes_id`=`igst`.`taxes_id` ";
        $query.= "WHERE (`product_account_mst`.`finyear_id` = '" . $finyear_id . "') ";
        $query.= "AND (`product_account_mst`.`store_id` = '" . $store_id . "') ";

        if(($term != '') && ($term != 'null')) {
            $query.= "AND ((`generate_barcode`.`standard_barcode` LIKE '%" . $term . "%') ";
            $query.= "OR (`generate_barcode`.`generate_barcode` LIKE '%" . $term . "%') ";
            $query.= "OR (`product`.`product_code`  LIKE '%" . $term . "%') ";
            $query.= "OR (`product`.`heading`  LIKE '%" . $term . "%'))";
        }

        if(($product_id != '') && ($product_id != '0') && ($product_id != 'null')) {
            $query.= "AND (`product`.`product_id` = '".$product_id."') ";
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