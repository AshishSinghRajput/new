<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class StockLocationMstModel extends CI_Model {
    //put your code here
    private $table_name = 'stock_location';

    public function get_record($store_id = '', $stock_location_id = '') {
        $query = "SELECT `stock_location_id`, `store_id`, `stock_location`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `stock_location` ";
        $is_where = '';
        if(($store_id != '') && ($store_id != '0') && ($store_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`store_id` = '".$store_id."') ";
        }        
        if(($stock_location_id != '') && ($stock_location_id != '0') && ($stock_location_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`stock_location_id` = '".$stock_location_id."') ";
        }        
        $query.= "ORDER BY `stock_location_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select($store_id = '') {
        $query = "SELECT `stock_location_id`, `stock_location` FROM `stock_location` ";
        $query.= "WHERE (`display` = '1') ";
        //if(($store_id != '') && ($store_id != 'null')) {
            $query.= "AND (`store_id` = '".$store_id."') ";
        //}
        $query.= "ORDER BY `priority` DESC, `stock_location`";
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