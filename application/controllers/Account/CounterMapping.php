<?php defined('BASEPATH') or exit('No direct script access allowed');

class CounterMapping extends CI_Controller
{
    var $CI;
    private $login_Detail;

    public function __construct()
    {
        parent::__construct();
        $this->customlib->expirePage();
    }

    public function index()
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'CounterMapping';
        $this->session->set_userdata($main_menu);

        $topbar = "Counter Mapping";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['counter_mapping_info'] = $this->CounterMappingMstModel->get_record($login_info->store_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Account/counter_mapping_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($counter_mapping_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'CounterMapping';
        $this->session->set_userdata($main_menu);

        $topbar = "Counter Mapping";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $counter_mapping_id = base64_decode($counter_mapping_id);
        $data['counter_mapping_id'] = $counter_mapping_id;

        $data['counter_mapping_info'] = $this->CounterMappingMstModel->get_record($login_info->store_id, $counter_mapping_id)['0'];

        $this->load->view('layout/header', $data);
        $this->load->view('Account/counter_mapping_view', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add()
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $main_menu['active'] = 'CounterMapping';
        $this->session->set_userdata($main_menu);

        $topbar = "Counter Mapping";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['counter_list'] = $this->CounterMstModel->get_select($login_info->store_id);
        $data['users_list'] = $this->UsersMstModel->get_cashier_returns_select($login_info->store_id);

        $this->counter_mapping_validation(false);
        if ($this->form_validation->run() == false) {
            if (!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Account/counter_mapping_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Account/counter_mapping_add', $data);
                $this->load->view('layout/footer', $data);

            }
        } else {
            $this->db->trans_start();

            $counter_mapping_data['store_id'] = $login_info->store_id;
            $counter_mapping_data['counter_id'] = $this->input->post('counter_id');
            $counter_mapping_data['counter_type'] = $this->input->post('counter_type');
            $counter_mapping_data['users_id'] = $this->input->post('users_id');
            $counter_mapping_data['display'] = $this->input->post('display');
            $counter_mapping_data['priority'] = $this->input->post('priority');
            $counter_mapping_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $counter_mapping_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $counter_mapping_data['created_by'] = $login_info->users_id;
            $counter_mapping_data['created_name'] = $login_info->name;
            $counter_mapping_data['created_user_agent'] = $this->customlib->load_agent();
            $counter_mapping_data['created_ip'] = $this->input->ip_address();

            $counter_mapping_id = $this->CounterMappingMstModel->add($counter_mapping_data);

            $this->db->trans_complete();

            if ($counter_mapping_id > 0) {
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Account/CounterMapping');
            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Account/CounterMapping/add');
            }
        }
    }

    public function edit($counter_mapping_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $main_menu['active'] = 'CounterMapping';
        $this->session->set_userdata($main_menu);

        $topbar = "Counter Mapping";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $counter_mapping_id = base64_decode($counter_mapping_id);
        $data['counter_mapping_id'] = $counter_mapping_id;

        $data['counter_list'] = $this->CounterMstModel->get_select($login_info->store_id);
        $data['users_list'] = $this->UsersMstModel->get_cashier_returns_select($login_info->store_id);

        $this->counter_mapping_validation(false);
        if ($this->form_validation->run() == false) {
            if (!$this->input->post('submit')) {
                $data['counter_mapping_info'] = $this->CounterMappingMstModel->get_record($login_info->store_id, $counter_mapping_id)['0'];

                $this->load->view('layout/header', $data);
                $this->load->view('Account/counter_mapping_edit', $data);
                $this->load->view('layout/footer', $data);
            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Account/counter_mapping_edit', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $this->db->trans_start();

            $counter_mapping_data['store_id'] = $login_info->store_id;
            $counter_mapping_data['counter_id'] = $this->input->post('counter_id');
            $counter_mapping_data['counter_type'] = $this->input->post('counter_type');
            $counter_mapping_data['users_id'] = $this->input->post('users_id');
            $counter_mapping_data['display'] = $this->input->post('display');
            $counter_mapping_data['priority'] = $this->input->post('priority');
            $counter_mapping_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $counter_mapping_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $counter_mapping_data['updated_by'] = $login_info->users_id;
            $counter_mapping_data['updated_name'] = $login_info->name;
            $counter_mapping_data['updated_user_agent'] = $this->customlib->load_agent();
            $counter_mapping_data['updated_ip'] = $this->input->ip_address();

            $counter_mapping_where['store_id'] = $login_info->store_id;
            $counter_mapping_where['counter_mapping_id'] = $counter_mapping_id;

            $this->CounterMappingMstModel->modify($counter_mapping_data, $counter_mapping_where);

            $this->db->trans_complete();

            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Account/CounterMapping');
        }
    }

    public function is_display($counter_mapping_id, $display)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $main_menu['active'] = 'CounterMapping';
        $this->session->set_userdata($main_menu);

        $topbar = "Counter Mapping";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $counter_mapping_id = base64_decode($counter_mapping_id);
        $data['counter_mapping_id'] = $counter_mapping_id;

        $counter_mapping_where['counter_mapping_id'] = $counter_mapping_id;

        $this->db->trans_start();

        $counter_mapping_data['display'] = base64_decode($display);
        $counter_mapping_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $counter_mapping_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $counter_mapping_data['updated_by'] = $login_info->users_id;
        $counter_mapping_data['updated_name'] = $login_info->name;
        $counter_mapping_data['updated_user_agent'] = $this->customlib->load_agent();
        $counter_mapping_data['updated_ip'] = $this->input->ip_address();

        $counter_mapping_where['counter_mapping_id'] = $counter_mapping_id;

        $this->CounterMappingMstModel->modify($counter_mapping_data, $counter_mapping_where);

        $this->db->trans_complete();

        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
        //redirect('Account/CounterMapping');
    }

    public function del($counter_mapping_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $main_menu['active'] = 'CounterMapping';
        $this->session->set_userdata($main_menu);

        $topbar = "Counter Mapping";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $counter_mapping_id = base64_decode($counter_mapping_id);
        $data['counter_mapping_id'] = $counter_mapping_id;

        $counter_mapping_where['counter_mapping_id'] = $counter_mapping_id;

        $this->CounterMappingMstModel->delete($counter_mapping_where);

        $this->db->trans_complete();

        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Account/CounterMapping');
    }

    public function counter_mapping_validation($required = true)
    {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('counter_id', 'Counter No.', 'trim|required');
        $this->form_validation->set_rules('counter_type', 'Counter Type', 'trim|required');
        $this->form_validation->set_rules('users_id', 'User Name', 'trim|required');
        $this->form_validation->set_rules('display', 'Display', 'trim|required|is_natural|exact_length[1]');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|is_natural|min_length[1]|max_length[10]');
    }

    public function valid_url($str)
    {
        if ($str != "") {
            if (filter_var($str, FILTER_VALIDATE_URL)) {
                $this->form_validation->set_message('valid_url', "Invalid website url");
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    public function create_thumb($full_path, $new_img, $img_width, $img_height)
    {
        $config_create_thumb['image_library'] = 'gd2';
        $config_create_thumb['source_image'] = $new_img;
        $config_create_thumb['new_image'] = $full_path;
        //$config_create_thumb['create_thumb'] = TRUE;
        $config_create_thumb['maintain_ratio'] = TRUE;
        $config_create_thumb['width'] = $img_width;
        $config_create_thumb['height'] = $img_height;
        $this->load->library('image_lib');
        $this->image_lib->initialize($config_create_thumb);
        if (!$this->image_lib->resize()) {
            die($this->image_lib->display_errors());
        }
        $this->image_lib->clear();

        //unlink($upload_data['full_path']);
        return true;
    }
}
