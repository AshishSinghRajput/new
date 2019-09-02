<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PODetModel extends CI_Model
{
    //put your code here
    private $table_name = 'po_det';

    public function get_record($finyear_id, $store_id = '', $po_det_id = '', $po_mst_id = '')
    {
        $query = "SELECT `po_det_id`, `store_id`, `po_mst_id`, `product_id`, `product_code`, `product_heading`, `available_quantity`, `packing_id`, `packing_title`, `unit_id`, `unit_title`, `order_quantity`, `is_cancel`, `cancel_date`, `cancel_reason`, `finyear_id`, `created_date`, `created_time`, `created_by`, `created_name`, `created_user_agent`, `created_ip`, `updated_date`, `updated_time`, `updated_by`, `updated_name`, `updated_user_agent`, `updated_ip` FROM `po_det` ";
        $query .= "WHERE (`finyear_id` = '" . $finyear_id . "') ";
        $query .= "AND (`store_id` = '" . $store_id . "') ";

        if (($po_det_id != '') && ($po_det_id != 'null')) {
            $query.= "AND (`po_det_id` = '" . $po_det_id . "') ";
        }

        if (($po_mst_id != '') && ($po_mst_id != 'null')) {
            $query.= "AND (`po_mst_id` = '" . $po_mst_id . "') ";
        }
        $query.= "ORDER BY `po_det_id`";
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
