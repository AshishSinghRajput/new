<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class StoreMstModel extends CI_Model {
    //put your code here
    private $table_name = 'store';

    public function get_record($store_id = '') {
        $query = "SELECT `store_id`, `store_name`, `owner_name`, `images`, `thumbnail1`, `thumbnail2`, `address`, `country_name`, `state_name`, `city_name`, `zip_code`, `mobile1`, `mobile2`, `email`, `website`, `gsin_no`, `pan_no`, `aadhar_no`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `store` ";
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
        $query.= "ORDER BY `store_name`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select() {
        $query = "SELECT `store_id`, `store_name` FROM `store` ";        
        $query.= "WHERE (`display` = '1') ";
        $query.= "ORDER BY `priority` DESC, `store_name`";
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