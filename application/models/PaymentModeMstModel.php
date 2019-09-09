<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class PaymentModeMstModel extends CI_Model {
    //put your code here
    private $table_name = 'payment_mode';

    public function get_record($payment_mode_id = '') {
        $query = "SELECT `payment_mode_id`, `payment_mode`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `payment_mode` ";
        $is_where = '';
        if(($payment_mode_id != '') && ($payment_mode_id != '0') && ($payment_mode_id != 'null')) {
            if($is_where == '') {
                $query.= "WHERE ";
                $is_where++;
            } else {
                $query.= "AND ";
            }
            $query.= "(`payment_mode_id` = '".$payment_mode_id."') ";
        }        
        $query.= "ORDER BY `payment_mode_id`";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_is_store_select() {
        $query = "SELECT `payment_mode_id`, `payment_mode` FROM `payment_mode` ";
        $query.= "WHERE (`display` = '1') ";
        $query.= "ORDER BY `priority` DESC, `payment_mode`";
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