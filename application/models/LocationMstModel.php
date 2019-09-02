<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class LocationMstModel extends CI_Model {
    //put your code here
    private $table_name = 'location';

    public function get_record($location_id = '', $state_name = '', $city_name = '') {
        $query = "SELECT `location_id`, `country_name`, `state_name`, `state_code`, `city_name`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `location` ";
        $is_where = '';
        if(($location_id != '') && ($location_id != '0') && ($location_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`location_id` = '".$location_id."') ";
        }        
        if(($state_name != '') && ($state_name != '0') && ($state_name != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`state_name` = '".$state_name."') ";
        }       
        if(($city_name != '') && ($city_name != '0') && ($city_name != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`city_name` = '".$city_name."') ";
        }        
        //$query.= "ORDER BY `country_name`, `state_name`, `state_code`, `city_name`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_state() {
        $query = "SELECT DISTINCT (`state_name`)  FROM `location` ";
        $query.= "WHERE (`display` = '1') ";
        $query.= "AND (`country_name` = 'India') ";
        $query.= "ORDER BY `state_name`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_city($state_name = '') {
        $query = "SELECT `location_id`, `country_name`, `state_name`, `state_code`, `city_name`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `location` ";
        $query.= "WHERE (`display` = '1') ";
        $query.= "AND (`country_name` = 'India') ";
        if($state_name != '') {
            $query.= "AND (`state_name` = '".$state_name."') ";
        }        
        $query.= "ORDER BY `city_name`";
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