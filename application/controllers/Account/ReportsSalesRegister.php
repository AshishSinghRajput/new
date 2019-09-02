<?php defined('BASEPATH') or exit('No direct script access allowed');

class ReportsSalesRegister extends CI_Controller
{
    var $CI;
    private $login_Detail;

    public function __construct()
    {
        parent::__construct();
        $this->customlib->expirePage();
    }

    public function index() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_RECEIPT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'Report';
        $this->session->set_userdata($main_menu);

        $topbar = "Sales Register";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;       

        $data['supplier_list'] = $this->SupplierMstModel->get_select($login_info->store_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Account/reports_sales_register', $data);
        $this->load->view('layout/footer', $data);
    }



    
}