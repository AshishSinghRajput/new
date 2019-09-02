<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class AccountMstModel extends CI_Model {
    //put your code here
    private $table_name = 'account';

    public function get_record($account_id = '') {
        $query = "SELECT `account_id`, `account`, `narration`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `account` ";
        $is_where = '';
        if(($account_id != '') && ($account_id != '0') && ($account_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`account_id` = '".$account_id."') ";
        }        
        $query.= "ORDER BY `account_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select() {
        $query = "SELECT `account_id`, `account` FROM `account` ";
        $query.= "WHERE (`display` = '1') ";
        $query.= "ORDER BY `priority` DESC, `account`";
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