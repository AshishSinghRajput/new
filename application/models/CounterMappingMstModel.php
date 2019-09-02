<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CounterMappingMstModel extends CI_Model
{
    //put your code here
    private $table_name = 'counter_mapping';

    public function get_record($store_id = '', $counter_mapping_id = '', $counter_id = '', $users_id = '')
    {
        $query = "SELECT `counter_mapping_id`, `store_id`, `counter_id`, `counter_type`, `users_id`, `date`, `start_time`, `end_time`, `display`, `priority`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `counter_mapping` ";
        $is_where = '';
        if (($store_id != '') && ($store_id != '0') && ($store_id != 'null')) {
            if ($is_where == '') {
                $query .= "WHERE ";
                $is_where++;
            } else {
                $query .= "AND ";
            }
            $query .= "(`store_id` = '" . $store_id . "') ";
        }
        if (($counter_mapping_id != '') && ($counter_mapping_id != '0') && ($counter_mapping_id != 'null')) {
            if ($is_where == '') {
                $query .= "WHERE ";
                $is_where++;
            } else {
                $query .= "AND ";
            }
            $query .= "(`counter_mapping_id` = '" . $counter_mapping_id . "') ";
        }
        if (($counter_id != '') && ($counter_id != '0') && ($counter_id != 'null')) {
            if ($is_where == '') {
                $query .= "WHERE ";
                $is_where++;
            } else {
                $query .= "AND ";
            }
            $query .= "(`counter_id` = '" . $counter_id . "') ";
        }
        if (($users_id != '') && ($users_id != '0') && ($users_id != 'null')) {
            if ($is_where == '') {
                $query .= "WHERE ";
                $is_where++;
            } else {
                $query .= "AND ";
            }
            $query .= "(`users_id` = '" . $users_id . "') ";
        }
        $query .= "ORDER BY `counter_mapping_id`";
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
