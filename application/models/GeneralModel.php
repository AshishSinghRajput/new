<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GeneralModel extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        //parent::__construct();        
    }

    private $table_name = 'usermst';

    function login($username = '', $password = '') {
        if (strpos($username, '@') === false)

        $this
            ->db
            ->where('username', $username);

        else

        $this
            ->db
            ->where('email', $username);

        $this
            ->db
            ->where('password', $password);

        $query = $this
            ->db
            ->from($this->table_name);

        $query = $this
            ->db
            ->get();

        if ($query->num_rows() === 1) {

            $row = array(
                'id' => $query->row()->id,
                'username' => $query->row()->username_en,
                'email' => $query->row()->email,
                'type' => $query->row()->type,
                'district_cod' => $query->row()->district_cod,
                'logged_in' => true
            );

            $this->session->set_userdata('superadmin_info', $row);
            $msg['status'] = true;
            return $msg;

        } else {
            $msg['error_msg'] = 'Invalid Username and password.';
            $msg['status'] = false;
            return $msg;
        }
    }

    function check_unique_property_index($tblname, $colname, $colval, $id, $idval) {
        $this
            ->db
            ->where($colname, $colval);
        $this
            ->db
            ->where_not_in($id, $idval);
        return $this
            ->db
            ->get($tblname)->num_rows();
    }

    private $f_table_name = 'zone_login';

    function zone_login($username = '', $password = '')

    {

        $this
            ->db
            ->where('username', $username);

        $this
            ->db
            ->where('password', $password);

        $query = $this
            ->db
            ->from($this->f_table_name);

        $query = $this
            ->db
            ->get();

        if ($query->num_rows() === 1)
        {

            $row = array(

                'id' => $query->row()->id,

                'username' => $query->row()->username,

                'type' => 'zone',

                'logged_in' => true

            );

            $this
                ->session
                ->set_userdata('finance_info', $row);

            $msg['status'] = true;

            return $msg;

        }
        else
        {

            $msg['error_msg'] = 'Invalid Username and password.';

            $msg['status'] = false;

            return $msg;

        }

    }

    public function add($tableName, $data)

    {

        $this
            ->db
            ->insert($tableName, $data);

        return $this
            ->db
            ->insert_id();

    }

    public function modify($tableName, $colName, $id, $data)

    {

        $this
            ->db
            ->where($colName, $id);

        $result = $this
            ->db
            ->update($tableName, $data);

        return $result;

    }

    public function modifyMulti($tableName, $data1, $data)

    {

        $this
            ->db
            ->where($data1);

        $this
            ->db
            ->update($tableName, $data);

    }

    public function delete($tableName, $colName, $id)

    {

        $this
            ->db
            ->where($colName, $id);

        $this
            ->db
            ->delete($tableName);

        return true;

    }

    public function deleteMulti($tableName, $wh)

    {

        $this
            ->db
            ->where($wh);

        $this
            ->db
            ->delete($tableName);

        return true;

    }

    // To get single row of table by a id
    public function getSingleRowById($tableName, $colName, $id, $returnType = '')

    {

        $this
            ->db
            ->where($colName, $id);

        $result = $this
            ->db
            ->get($tableName);

        if ($result->num_rows() > 0)
        {

            if ($returnType == 'array')

            return $result->row_array();

            else

            return $result->row();

        }
        else

        return false;

    }

    // To get all row of matching criteria
    public function getRowAllById($tableName, $colName, $id, $orderby = '', $orderformat = 'asc')

    {

        if ($colName != '' && $id != '')

        $this
            ->db
            ->where($colName, $id);

        if ($orderby != '')

        $this
            ->db
            ->order_by($orderby, $orderformat);

        $result = $this
            ->db
            ->get($tableName);

        if ($result->num_rows() > 0)

        return $result->result();

        else

        return false;

    }

    // To get data by multiple where
    public function getRowByWhere($tableName, $filters = '', $select = '', $noRowReturn = '', $returnType = '', $orderby = '', $orderformat = 'asc', $or_filters = array())

    {

        if ($select != '')

        $this
            ->db
            ->select($select);

        if (count($filters) > 0)
        {

            foreach ($filters as $field => $value)

            $this
                ->db
                ->where($field, $value);

        }

        if (count($or_filters) > 0)
        {

            $this
                ->db
                ->or_where($or_filters);

        }

        if ($orderby != '')

        $this
            ->db
            ->order_by($orderby, $orderformat);

        $result = $this
            ->db
            ->get($tableName);

        if ($result->num_rows() > 0)
        {

            if ($noRowReturn == 'single')
            {

                if ($returnType == 'array')

                return $result->row_array();

                else

                return $result->row();

            }
            else
            {

                if ($returnType == 'array')

                return $result->result_array();

                else

                return $result->result();

            }

        }
        else

        return false;

    }

    public function get_row($table_name = '', $id_array = '')

    {

        if (!empty($id_array)):

            foreach ($id_array as $key => $value)
            {

                $this
                    ->db
                    ->where($key, $value);

            }

        endif;

        $query = $this
            ->db
            ->get($table_name);

        if ($query->num_rows() > 0)

        return $query->row();

        else

        return false;

    }

    public function getlocation()

    {

        $sql = "SELECT DISTINCT(state_name)  FROM location where country_name='India' ORDER BY state_name ASC";

        $query = $this
            ->db
            ->query($sql);

        return $query->result();

    }

    // Pagination function
    public function getPaginationData($tableName = '', $filters = '', $perPage = '', $start = '', $orderby = '', $orderformat = '', $groupby = '')

    {

        //Set default orde
        if ($orderformat == '')

        $orderformat = 'asc';

        //add where clause
        if ($filters != '' && count($filters) > 0)

        $this
            ->db
            ->where($filters);

        if ($groupby != '')

        $this
            ->db
            ->group_by($groupby);

        $this
            ->db
            ->limit($perPage, $start);

        $this
            ->db
            ->order_by($orderby, $orderformat);

        $result = $this
            ->db
            ->get($tableName);

        if ($result->num_rows() > 0)

        return $result->result();

        else

        return false;

    }

    //Function to return total number of rows
    public function getTotalRows($tableName = '', $filters = NULL)

    {

        if ($filters != NULL)
        {

            $this
                ->db
                ->where($filters);

            $count = $this
                ->db
                ->count_all_results($tableName);

        }
        else

        $count = $this
            ->db
            ->count_all($tableName);

        return $count;

    }

    public function get_result($table_name = '', $id_array = '', $id_array2 = '')

    {

        if (!empty($id_array)):

            foreach ($id_array as $key => $value)
            {

                $this
                    ->db
                    ->where($key, $value);

            }

        endif;

        if (!empty($id_array2)):

            foreach ($id_array2 as $key => $value)
            {

                $this
                    ->db
                    ->or_where($key, $value);

            }

        endif;

        $query = $this
            ->db
            ->get($table_name);

        if ($query->num_rows() > 0)

        return $query->result();

        else

        return false;

    }

    //---------========== Get Data Or operator =================------
    public function getOrResult($table_name = '', $id_array = '')

    {

        if (!empty($id_array)):

            $this
                ->db
                ->or_where($id_array);

        endif;

        $query = $this
            ->db
            ->get($table_name);

        if ($query->num_rows() > 0)

        return $query->result();

        else

        return false;

    }

    //---------========== Get Data Using Clause =================------
    public function getInClauseData($select = '', $table_name = '', $colName = '', $arr = '', $where = '')

    {

        if ($select != '')

        $this
            ->db
            ->select($select);

        if (count($where) > 0)

        $this
            ->db
            ->where($where);

        $this
            ->db
            ->where_in($colName, $arr);

        $query = $this
            ->db
            ->get($table_name);

        if ($query->num_rows() > 0)

        return $query->result();

        else

        return false;

    }

    //---------========== Get Data Using Join=================------
    public function getJoinData($seldata, $table1 = '', $table2 = '', $join_condition = '', $wh = '', $orderby = 'id', $orderformat = 'asc')

    {

        $this
            ->db
            ->select($seldata);

        $this
            ->db
            ->from($table1);

        $this
            ->db
            ->join($table2, $join_condition);

        $this
            ->db
            ->where($wh);

        $this
            ->db
            ->order_by($orderby, $orderformat);

        $query = $this
            ->db
            ->get();

        return $query->result();

    }

    //--========= Search Result Using Keyword======------
    public function get_like($table_name, $column = '', $keyword = '', $wh = '', $limit = '', $start = '', $groupby = '')

    {

        $this
            ->db
            ->select('*');

        $this
            ->db
            ->from($table_name);

        $this
            ->db
            ->like($column, $keyword, 'both'); // 'both','after','after',before
        $this
            ->db
            ->where($wh);

        if ($groupby != '')

        $this
            ->db
            ->group_by($groupby);

        $this
            ->db
            ->limit($limit, $start);

        return $this
            ->db
            ->get()
            ->result();

    }

    //--========= Search Result Using group by======------
    public function get_groupby($table_name = '', $wh = '', $groupby = '', $limit = '', $start = '')

    {

        $this
            ->db
            ->select('*');

        $this
            ->db
            ->from($table_name);

        $this
            ->db
            ->where($wh);

        if ($groupby != '')

        $this
            ->db
            ->group_by($groupby);

        if ($limit != '' && $start != '')

        $this
            ->db
            ->limit($limit, $start);

        return $this
            ->db
            ->get()
            ->result();

    }

    /*--------get-result-by-rendom----------*/
    public function get_resultbyrendom($table = "", $limit = "", $where = "") {

        $query = $this->db->query("SELECT  * FROM $table where $where  ORDER BY RAND() LIMIT $limit");
        return $query->result();
    }

    public function add_batch($tablename, $data) {
        return $this->db->insert_batch($tablename, $data);
    }
    /* End of file generalmodel.php */

}

/* Location: ./application/models/generalmodel.php */