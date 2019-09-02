<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class BrandMstModel extends CI_Model {
    //put your code here
    private $table_name = 'brand';

    public function get_record($brand_id = '') {
        $query = "SELECT `brand_id`, `meta_title`, `author`, `meta_keywords`, `meta_description`, `slug`, `heading`, `sub_heading`, `is_show`, `images`, `thumbnail1`, `thumbnail2`, `video`, `short_description1`, `short_description2`, `description`, `tags`, `is_store`, `store_priority`, `is_app`, `app_priority`, `is_web`, `web_priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `brand` ";
        $is_where = '';
        if(($brand_id != '') && ($brand_id != '0') && ($brand_id != 'null')) {
            if($is_where === '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`brand_id` = '".$brand_id."') ";
        }        
        $query.= "ORDER BY `heading`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_is_store_select() {
        $query = "SELECT `brand_id`, `heading` FROM `brand` ";
        $query.= "WHERE (`is_store` = '1') ";
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