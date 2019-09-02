<?php defined('BASEPATH') or exit('No direct script access allowed');

class ReportsProductLedger extends CI_Controller
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

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_RECEIPT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'Report';
        $this->session->set_userdata($main_menu);

        $topbar = "Product Ledger";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;


        $data['product_list'] = $this->ProductAccountMstModel->get_record($finyear_info->finyear_id, $login_info->store_id);

        // echo $this->db->last_query();
        // die;

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/reports_product_ledger_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function viewledger($product_account_mst_id = '')
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_RECEIPT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'Report';
        $this->session->set_userdata($main_menu);

        $topbar = "Product Ledger";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;
        
        if($product_account_mst_id != '') {
            $data['productdetails'] = $this->db->query("select * from product_account_det where store_id='".$login_info->store_id."' AND product_account_mst_id='".$product_account_mst_id['0']."' AND finyear_id='".$finyear_info->finyear_id."'")->result();
        }
        
        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/reports_product_ledger_view', $data);
        $this->load->view('layout/footer', $data);
    }    
}
