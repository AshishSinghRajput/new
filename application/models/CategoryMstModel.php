<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class CategoryMstModel extends CI_Model {
    //put your code here
    private $table_name = 'category';

    public function get_record($category_id = '', $master_id = '') {
        $query = "SELECT `category_id`, `meta_title`, `author`, `meta_keywords`, `meta_description`, `slug`, `is_category`, `is_navigation_store`, `is_navigation_app`, `is_navigation_web`, `is_google`, `heading`, `sub_heading`, `is_show`, `images`, `thumbnail1`, `thumbnail2`, `video`, `short_description1`, `short_description2`, `description`, `tags`, `master_id`, `is_store`, `store_priority`, `is_app`, `app_priority`, `is_web`, `web_priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `category` ";
        $is_where = '';
        if(($category_id != '') && ($category_id != 'null')) {
            if($is_where === '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`category_id` = '".$category_id."') ";
        }        
        if(($master_id != '') && ($master_id != '0') && ($master_id != 'null')) {
            if($is_where === '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`master_id` = '".$master_id."') ";
        }        
        $query.= "ORDER BY `heading`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_is_store_select($master_id = '') {
        $query = "SELECT `category_id`, `heading` FROM `category` ";
        $query.= "WHERE (`is_store` = '1') ";
        if(($master_id != '') && ($master_id != 'null')) {
            $query.= "AND (`master_id` = '".$master_id."') ";
        }
        $query.= "ORDER BY `store_priority` DESC, `heading`";
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