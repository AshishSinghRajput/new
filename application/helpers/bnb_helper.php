<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('superadmin_login')) {
    function superadmin_login()
    {
        $CI =& get_instance();
        if ($CI->session->userdata('superadmin_info')) {
            $user_info = $CI->session->userdata('superadmin_info');
            if ($user_info['logged_in'] === TRUE):
                return TRUE;
            else:
                return FALSE;
            endif;
        } else
            return FALSE;
    }
}

if (!function_exists('get_my_id')) {
    function get_my_id()
    {
        $CI =& get_instance();
        $user_info = $CI->session->userdata('superadmin_info');
        return $user_info['id'];
    }
}



/*===finance=check=login===*/
if (!function_exists('supervisor_login')) {
    function supervisor_login()
    {
        $CI =& get_instance();
        if ($CI->session->userdata('supervisor_info')) {
            $user_info = $CI->session->userdata('supervisor_info');
            if ($user_info['logged_in'] === TRUE):
                return TRUE;
            else:
                return FALSE;
            endif;
        } else
            return FALSE;
    }
}


if (!function_exists('get_fn_id')) {
    function get_fn_id()
    {
        $CI =& get_instance();
        $user_info = $CI->session->userdata('supervisor_info');
        return $user_info['id'];
    }
}



/*===PS=info===*/
if (!function_exists('accounts_login')) {
    function accounts_login()
    {
        $CI =& get_instance();
        if ($CI->session->userdata('accounts_info')) {
            $user_info = $CI->session->userdata('accounts_info');
            if ($user_info['logged_in'] === TRUE):
                return TRUE;
            else:
                return FALSE;
            endif;
        } else
            return FALSE;
    }
}

if (!function_exists('get_ps_id')) {
    function get_ps_id()
    {
        $CI =& get_instance();
        $user_info = $CI->session->userdata('accounts_info');
        return $user_info['id'];
    }
}

if (!function_exists('pg_login')) {
    function pg_login()
    {
        $CI =& get_instance();
        if ($CI->session->userdata('pg_info')) {
            $user_info = $CI->session->userdata('pg_info');
            if ($user_info['logged_in'] === TRUE):
                return TRUE;
            else:
                return FALSE;
            endif;
        } else
            return FALSE;
    }
}

if (!function_exists('get_pg_id')) {
    function get_pg_id()
    {
        $CI =& get_instance();
        $user_info = $CI->session->userdata('pg_info');
        return $user_info['id'];
    }
}





//==========Any Table data=============
if (!function_exists('get_Details')) {
    function get_Details($table = "", $id_arr = "", $noRowReturn = '', $orderby = '', $orderformat = '')
    {
        $CI =& get_instance();
        $CI->db->where($id_arr);
        if ($orderby != '' && $orderformat != '') {
            $CI->db->order_by($orderby, $orderformat);
        }
        $query = $CI->db->get($table);
        if ($noRowReturn == 'single') {
            return $query->row();
        } else {
            return $query->result();
        }
    }
}

if (!function_exists('get_result')) {
    function get_result($table = '', $perPage = '', $start = '', $orderby = '', $orderformat = '')
    {
        $CI =& get_instance();
        if ($perPage > 0) {
            $CI->db->limit($perPage, $start);
        }
        if ($orderby != '') {
            $CI->db->order_by($orderby, $orderformat);
        }
        $query = $CI->db->get($table);
        return $query->result();
    }
}



if ( ! function_exists('alert')) { 
  function alert($msg='', $type='success_msg') {

    $CI =& get_instance();?>
       <?php if (empty($msg)): ?>

        <?php if ($CI->session->flashdata('success_msg')): ?>

        <?php echo success_alert($CI->session->flashdata('success_msg')); ?>

        <?php endif ?>
        <?php if ($CI->session->flashdata('error_msg')): ?>
        <?php echo error_alert($CI->session->flashdata('error_msg')); ?>

        <?php endif ?>

        <?php if ($CI->session->flashdata('info_msg')): ?>

        <?php echo info_alert($CI->session->flashdata('info_msg')); ?>

        <?php endif ?>

        <?php else: ?>

        <?php if ($type == 'success_msg'): ?>

          <?php echo success_alert($msg); ?>

        <?php endif ?>

        <?php if ($type == 'error_msg'): ?>

          <?php echo error_alert($msg); ?>

        <?php endif ?>

        <?php if ($type == 'info_msg'): ?>

          <?php echo info_alert($msg); ?>

        <?php endif ?>

    <?php endif; ?>

<?php }
}

/*** Success alert*/

if (!function_exists('success_alert')) {
    function success_alert($msg = '')
    {
?>

<div class="alert alert-success">
  <button data-dismiss="alert" class="close" type="button">X</button>
  <strong>Success!</strong> <?php
        echo $msg;
?>
</div>
  <?php
    }
}

/*** Error alert*/
if (!function_exists('error_alert')) {
    function error_alert($msg = '')
    {
?>

<div class="alert alert-danger">
  <button data-dismiss="alert" class="close" type="button">X</button>
 <strong>Error!</strong> <?php
        echo $msg;
?>

</div>

  <?php
    }
}

/*** info alert*/
if (!function_exists('info_alert')) {
    function info_alert($msg = '')
    {
?>

<div class="alert alert-info">
  <button data-dismiss="alert" class="close" type="button">X</button>
  <strong>Info: </strong> <?php
        echo $msg;
?>
</div>

<?php }}


if (!function_exists('send_msg')) {
    function send_msg($message = '', $mobile = '', $sender_id = '')
    {
        $CI =& get_instance();
        $url = "https://admagister.net/api/mt/SendSMS?user=GooniAPI2017&password=GooniAPI2017@123&senderid=GOONIE&channel=trans&DCS=0&flashsms=0&route=10&number=" . urlencode($mobile) . "&text=" . urlencode($message) . "";
        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
        $curl_scraped_page;
    }
}

if (!function_exists('get_theme_pagination')) {
    function get_theme_pagination()
    {
        $config                    = array();
        $config['full_tag_open']   = '<div class="pagination"><ul>';
        $config['full_tag_close']  = '</div></ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '&laquo';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&raquo';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><a>';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        return $config;
    }
}

/*------------------Get Trash News Count ---------------------*/
if (!function_exists('get_count')) {
    function get_count($table = '', $r_id = '')
    {
        $CI =& get_instance();
        $CI->db->where($r_id);
        $query = $CI->db->get($table);
        return $query->num_rows();
    }
}

/*------------------Get Sum data ---------------------*/
if (!function_exists('get_sum_data')) {
    function get_sum_data($table = '', $columname = "", $r_id = '')
    {
        $CI =& get_instance();
        $CI->db->select(' SUM(' . $columname . ') as total_sell');
        $CI->db->where($r_id);
        $query = $CI->db->get($table);
        return $query->row();
    }
}


if (!function_exists('get_sum_data_in')) {
    function get_sum_data_in($table = '', $columname = "", $r_column = '' , $r_id = '')
    {
        $CI =& get_instance();
        $CI->db->select(' SUM(' . $columname . ') as total_sell');
        $CI->db->where_in($r_column,$r_id);
        $query = $CI->db->get($table);
        return $query->row();
    }
}


if (!function_exists('get_data_group')) {
    function get_data_group($table = "", $r_id = "", $collum_name = "")
    {
        $CI =& get_instance();
        $CI->db->where($r_id);
        $CI->db->group_by($collum_name);
        $query = $CI->db->get($table);
        return $query->row();
    }
}



