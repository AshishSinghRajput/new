<?php defined('BASEPATH') or exit('No direct script access allowed');

class ReportsSupplierLedger extends CI_Controller
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

        $topbar = "Supplier Ledger";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;


        $current_supplier_id = $supplier_id;
        $data['current_supplier_id'] = $current_supplier_id;

        
        if($supplier_id != '') {

            $data['supplierdatails'] = $this->db->query("select * from supplier where store_id='".$login_info->store_id."' AND supplier_id='".$supplier_id['0']."'")->row();

           
            $data['supplier_account_info'] = $this->db->query("select * from supplier_account_det where store_id='".$login_info->store_id."' AND supplier_id='".$supplier_id['0']."' AND account in('Purchase','Purchase Return','Payment') AND finyear_id='".$finyear_info->finyear_id."'")->result();
        }

        $data['supplier_list'] = $this->SupplierAccountMstModel->get_record($login_info->store_id, $finyear_info->finyear_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/reports_supplier_ledger_list', $data);
        $this->load->view('layout/footer', $data);
    }











    public function viewledger($supplier_id = '')
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

        $topbar = "Supplier Ledger";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;


        $current_supplier_id = $supplier_id;
        $data['current_supplier_id'] = $current_supplier_id;

        
        if($supplier_id != '') {

            $data['supplierdatails'] = $this->db->query("select * from supplier where store_id='".$login_info->store_id."' AND supplier_id='".$supplier_id['0']."'")->row();

           
            $data['supplier_account_info'] = $this->db->query("select * from supplier_account_det where store_id='".$login_info->store_id."' AND supplier_id='".$supplier_id['0']."' AND account in('Purchase','Purchase Return','Payment') AND finyear_id='".$finyear_info->finyear_id."'")->result();
        }

        
        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/view_supplier_ledger', $data);
        $this->load->view('layout/footer', $data);
    }



    
}
