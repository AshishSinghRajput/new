<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class FinyearMstModel extends CI_Model {

    private $table_name = "finyear";

    public function get_record($finyear_id = '', $activation = '') {
        $query = "SELECT `finyear_id`, `finyear`, `from_date`, `to_date`, `activation`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `finyear` ";
        $where = '';
        if($finyear_id != '') {
            if($where === '') {
                $where = "WHERE "; 
            } else {
                $where = "AND ";
            }
            $query.= $where."(`finyear_id` = '".$finyear_id."') ";
        }
        if($activation != '') {
            if($where === '') {
                $where = "WHERE "; 
            } else {
                $where = "AND ";
            }
            $query.= $where."(`activation` = '".$activation."') ";
        }        
        //$query.= "ORDER BY `utilize_certificate`.`create_on` ASC";
        $results = $this->db->query($query);
		return $results->result();
    }
    
    public function get_select() {
        $query = "SELECT `finyear_id`, `finyear` FROM `finyear` ";        
        $query.= "WHERE (`display` = '1') ";
        $query.= "ORDER BY `priority` DESC, `finyear`";
        $results = $this->db->query($query);
		return $results->result();
    }

    public function add($data) {
        return $this->db->insert($this->table_name, $data);
    } 

	function modify($tab_sel, $tab_where) {
		$this->db->where($tab_where);
		$this->db->update($this->table_name, $tab_sel);
	}
    
    function delete($tab_where) {
		$this->db->delete($this->table_name, $tab_where);
	}
}
