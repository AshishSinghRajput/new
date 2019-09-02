<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ManageSupplier extends CI_Controller {
    
	var $CI;
    private $login_Detail;

    public function __construct() {
            parent::__construct();
            $this->customlib->expirePage();
    }
    
    public function index() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_SUPPLIER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageSupplier';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Supplier";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $data['supplier_info'] = $this->SupplierMstModel->get_record();

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/supplier_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function view($supplier_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_SUPPLIER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageSupplier';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Supplier";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $supplier_id = base64_decode($supplier_id);
        $data['supplier_id'] = $supplier_id;
        
        $data['supplier_info'] = $this->SupplierMstModel->get_record($supplier_id)['0'];
       
        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/supplier_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_SUPPLIER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageSupplier';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Supplier";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['state_list'] = $this->LocationMstModel->get_state();
        $data['bank_list'] = $this->BankMstModel->get_select();

        $this->supplier_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/supplier_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                if($this->input->post('state_name') != '') {
                    $data['city_list'] = $this->LocationMstModel->get_city($this->input->post('state_name'));
                }

                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/supplier_add', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {                        
            $location_val = $this->LocationMstModel->get_record('', $this->input->post('state_name'), $this->input->post('city'))['0'];
            
            $account_info = $this->AccountMstModel->get_record(ACCOUNT_OPENING_BALANCE)['0'];
            
            $this->db->trans_start();
            
            $supplier_data['store_id'] = $login_info->store_id;
            $supplier_data['is_supplier_type'] = $this->input->post('is_supplier_type');
            $supplier_data['firm_name'] = $this->input->post('firm_name');
            $supplier_data['owner_name'] = $this->input->post('owner_name');
            $supplier_data['address'] = $this->input->post('address');
            $supplier_data['country_name'] = $location_val->country_name;
            $supplier_data['state_name'] = $this->input->post('state_name');
            $supplier_data['city_name'] = $this->input->post('city_name');
            $supplier_data['zip_code'] = $this->input->post('zip_code');
            $supplier_data['mobile1'] = $this->input->post('mobile1');
            $supplier_data['mobile2'] = $this->input->post('mobile2');
            $supplier_data['email'] = $this->input->post('email');
            $supplier_data['website'] = $this->input->post('website');
            $supplier_data['gsin_no'] = $this->input->post('gsin_no');
            $supplier_data['pan_no'] = $this->input->post('pan_no');
            $supplier_data['aadhar_no'] = $this->input->post('aadhar_no');
            $supplier_data['bank_id'] = $this->input->post('bank_id');
            $supplier_data['account_no'] = $this->input->post('account_no');
            $supplier_data['ifsc_code'] = $this->input->post('ifsc_code');
            $supplier_data['branch'] = $this->input->post('branch');
            $supplier_data['display'] = $this->input->post('display');
            $supplier_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $supplier_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $supplier_data['created_by'] = $login_info->users_id;
            $supplier_data['created_name'] = $login_info->name;
            $supplier_data['created_user_agent'] = $this->customlib->load_agent();
            $supplier_data['created_ip'] = $this->input->ip_address();            
            
            $supplier_id = $this->SupplierMstModel->add($supplier_data);

            $supplier_account_data['store_id'] = $login_info->store_id;
            $supplier_account_data['is_supplier_type'] = $this->input->post('is_supplier_type');
            $supplier_account_data['supplier_id'] = $supplier_id;
            $supplier_account_data['opening'] = $this->input->post('opening');
            $supplier_account_data['inward'] = ''; //$this->input->post('inward');
            $supplier_account_data['purchase'] = ''; //$this->input->post('purchase');
            $supplier_account_data['payment'] = ''; //$this->input->post('payment');
            $supplier_account_data['purchase_return'] = ''; //$this->input->post('purchase_return');
            $supplier_account_data['outward'] = ''; //$this->input->post('outward');
            $supplier_account_data['sales'] = ''; //$this->input->post('sales');
            $supplier_account_data['receipt'] = ''; //$this->input->post('receipt');
            $supplier_account_data['sales_return'] = ''; //$this->input->post('sales_return');
            $supplier_account_data['credit_note'] = ''; //$this->input->post('credit_note');
            $supplier_account_data['debit_note'] = ''; //$this->input->post('debit_note');
            $supplier_account_data['net_amount'] = $this->input->post('opening');
            $supplier_account_data['finyear_id'] = $finyear_info->finyear_id;
            $supplier_account_data['display'] = $this->input->post('display');
            $supplier_account_data['priority'] = '0'; //$this->input->post('priority');
            $supplier_account_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $supplier_account_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $supplier_account_data['created_by'] = $login_info->users_id;
            $supplier_account_data['created_name'] = $login_info->name;
            $supplier_account_data['created_user_agent'] = $this->customlib->load_agent();
            $supplier_account_data['created_ip'] = $this->input->ip_address();            
            
            $supplier_account_mst_id = $this->SupplierAccountMstModel->add($supplier_account_data);

            $account_det_data['invoice_no'] = '0';
            $account_det_data['date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_det_data['store_id'] = $login_info->store_id;
            $account_det_data['supplier_id'] = $supplier_id;
            $account_det_data['supplier_account_mst_id'] = $supplier_account_mst_id;
            $account_det_data['master_id'] = '0';
            $account_det_data['account_id'] = $account_info->account_id;
            $account_det_data['account'] = $account_info->account;            
            $account_det_data['total_quantity'] = '0';
            $account_det_data['total_mrp'] = '0';
            $account_det_data['total_rate'] = $this->input->post('opening');
            $account_det_data['total_cgst'] = '0';
            $account_det_data['total_sgst'] = '0';
            $account_det_data['total_igst'] = '0';
            $account_det_data['transport_charges'] = '0';
            $account_det_data['other_charges'] = '0';
            $account_det_data['net_amount'] = $this->input->post('opening');
            $account_det_data['adjustment'] = '0';
            $account_det_data['grand_total'] = $this->input->post('opening');
            $account_det_data['round_off'] = $this->input->post('opening');
            $account_det_data['amount_word'] = $this->customlib->number_words($this->input->post('opening'));
            $account_det_data['remarks'] = ''; //$this->input->post('remarks'); 
            $account_det_data['payment_mode_id'] = '0'; //$this->input->post('payment_mode_id');
            $account_det_data['payment_mode'] = ''; //$payment_mode_info->payment_mode;
            $account_det_data['bank_id'] = '0'; //$this->input->post('bank_id');
            $account_det_data['transaction_no'] = ''; //$this->input->post('transaction_no');
            $account_det_data['transaction_date'] = '1900-01-01'; //$this->customlib->get_YYYYMMDD($this->input->post('transaction_date'));  
            $account_det_data['branch'] = ''; //$this->input->post('branch');
            $account_det_data['status_id'] = 'Pending';
            $account_det_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_det_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $account_det_data['is_cancel'] = '0';
            $account_det_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_det_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $account_det_data['finyear_id'] = $finyear_info->finyear_id; 
            $account_det_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_det_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_det_data['created_by'] = $login_info->users_id;
            $account_det_data['created_name'] = $login_info->name;
            $account_det_data['created_user_agent'] = $this->customlib->load_agent();
            $account_det_data['created_ip'] = $this->input->ip_address();

            $supplier_account_det_id = $this->SupplierAccountDetModel->add($account_det_data);
        
            $this->db->trans_complete();

            if(($supplier_id > 0) && ($supplier_account_mst_id > 0)) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Supervisor/ManageSupplier');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Supervisor/ManageSupplier/add');

            }
        }
    }
    
    public function edit($supplier_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_SUPPLIER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageSupplier';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Supplier";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $supplier_id = base64_decode($supplier_id);
        $data['supplier_id'] = $supplier_id;
        
        $data['state_list'] = $this->LocationMstModel->get_state();
        $data['bank_list'] = $this->BankMstModel->get_select();

        $this->supplier_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $data['supplier_info'] = $this->SupplierMstModel->get_record($supplier_id)['0'];
                $data['city_list'] = $this->LocationMstModel->get_city($data['supplier_info']->state_name);

                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/supplier_edit', $data);
                $this->load->view('layout/footer', $data);

            } else {
                if($this->input->post('state_name') != '') {
                    $data['city_list'] = $this->LocationMstModel->get_city($this->input->post('state_name'));
                }

                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/supplier_edit', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $location_val = $this->LocationMstModel->get_record('', $this->input->post('state_name'), $this->input->post('city'))['0'];
            
            $this->db->trans_start();
            
            $supplier_data['store_id'] = $login_info->store_id;
            $supplier_data['is_supplier_type'] = $this->input->post('is_supplier_type');
            $supplier_data['firm_name'] = $this->input->post('firm_name');
            $supplier_data['owner_name'] = $this->input->post('owner_name');
            $supplier_data['address'] = $this->input->post('address');
            $supplier_data['country_name'] = $location_val->country_name;
            $supplier_data['state_name'] = $this->input->post('state_name');
            $supplier_data['city_name'] = $this->input->post('city_name');
            $supplier_data['zip_code'] = $this->input->post('zip_code');
            $supplier_data['mobile1'] = $this->input->post('mobile1');
            $supplier_data['mobile2'] = $this->input->post('mobile2');
            $supplier_data['email'] = $this->input->post('email');
            $supplier_data['website'] = $this->input->post('website');
            $supplier_data['gsin_no'] = $this->input->post('gsin_no');
            $supplier_data['pan_no'] = $this->input->post('pan_no');
            $supplier_data['aadhar_no'] = $this->input->post('aadhar_no');
            $supplier_data['bank_id'] = $this->input->post('bank_id');
            $supplier_data['account_no'] = $this->input->post('account_no');
            $supplier_data['ifsc_code'] = $this->input->post('ifsc_code');
            $supplier_data['branch'] = $this->input->post('branch');
            $supplier_data['display'] = $this->input->post('display');
            $supplier_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $supplier_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $supplier_data['updated_by'] = $login_info->users_id;
            $supplier_data['updated_name'] = $login_info->name;
            $supplier_data['updated_user_agent'] = $this->customlib->load_agent();
            $supplier_data['updated_ip'] = $this->input->ip_address();

            $supplier_where['store_id'] = $login_info->store_id;
            $supplier_where['supplier_id'] = $supplier_id;
            
            $this->SupplierMstModel->modify($supplier_data, $supplier_where);

            $supplier_account_data['store_id'] = $login_info->store_id;
            $supplier_account_data['supplier_id'] = $supplier_id;
            $supplier_account_data['is_supplier_type'] = $this->input->post('is_supplier_type');
            $supplier_account_data['display'] = $this->input->post('display');
            $supplier_account_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $supplier_account_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $supplier_account_data['updated_by'] = $login_info->users_id;
            $supplier_account_data['updated_name'] = $login_info->name;
            $supplier_account_data['updated_user_agent'] = $this->customlib->load_agent();
            $supplier_account_data['updated_ip'] = $this->input->ip_address();

            $supplier_account_where['store_id'] = $login_info->store_id;
            $supplier_account_where['finyear_id'] = $finyear_info->finyear_id;
            $supplier_account_where['supplier_id'] = $supplier_id;
            
            $this->SupplierAccountMstModel->modify($supplier_account_data, $supplier_account_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Supervisor/ManageSupplier');
        }
    }
    
    public function is_supplier_type($supplier_id, $is_supplier_type) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_SUPPLIER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'Manage Supplier';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Store";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $supplier_id = base64_decode($supplier_id);
        $data['supplier_id'] = $supplier_id;
        
        $supplier_where['supplier_id'] = $supplier_id;

        $this->db->trans_start();
            
        $supplier_data['is_supplier_type'] = base64_decode($is_supplier_type);
        $supplier_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $supplier_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $supplier_data['updated_by'] = $login_info->users_id;
        $supplier_data['updated_name'] = $login_info->name;
        $supplier_data['updated_user_agent'] = $this->customlib->load_agent();
        $supplier_data['updated_ip'] = $this->input->ip_address();

        $supplier_where['store_id'] = $login_info->store_id;
        $supplier_where['supplier_id'] = $supplier_id;
        
        $this->SupplierMstModel->modify($supplier_data, $supplier_where);

        $supplier_data['is_supplier_type'] = base64_decode($is_supplier_type);
        $supplier_account_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $supplier_account_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $supplier_account_data['updated_by'] = $login_info->users_id;
        $supplier_account_data['updated_name'] = $login_info->name;
        $supplier_account_data['updated_user_agent'] = $this->customlib->load_agent();
        $supplier_account_data['updated_ip'] = $this->input->ip_address();

        $supplier_account_where['store_id'] = $login_info->store_id;
        $supplier_account_where['supplier_id'] = $supplier_id;
        
        $this->SupplierAccountMstModel->modify($supplier_account_data, $supplier_account_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
        //redirect('Supervisor/ManageSupplier');
    }
    
    public function is_display($supplier_id, $display) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_SUPPLIER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'Manage Supplier';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Store";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $supplier_id = base64_decode($supplier_id);
        $data['supplier_id'] = $supplier_id;
        
        $supplier_where['supplier_id'] = $supplier_id;

        $this->db->trans_start();
            
        $supplier_data['display'] = base64_decode($display);
        $supplier_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $supplier_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $supplier_data['updated_by'] = $login_info->users_id;
        $supplier_data['updated_name'] = $login_info->name;
        $supplier_data['updated_user_agent'] = $this->customlib->load_agent();
        $supplier_data['updated_ip'] = $this->input->ip_address();

        $supplier_where['store_id'] = $login_info->store_id;
        $supplier_where['supplier_id'] = $supplier_id;
        
        $this->SupplierMstModel->modify($supplier_data, $supplier_where);

        $supplier_data['display'] = base64_decode($display);
        $supplier_account_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $supplier_account_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $supplier_account_data['updated_by'] = $login_info->users_id;
        $supplier_account_data['updated_name'] = $login_info->name;
        $supplier_account_data['updated_user_agent'] = $this->customlib->load_agent();
        $supplier_account_data['updated_ip'] = $this->input->ip_address();

        $supplier_account_where['store_id'] = $login_info->store_id;
        $supplier_account_where['supplier_id'] = $supplier_id;
        
        $this->SupplierAccountMstModel->modify($supplier_account_data, $supplier_account_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
        //redirect('Supervisor/ManageSupplier');
    }
    
    public function del($supplier_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_SUPPLIER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'Manage Supplier';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Store";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $supplier_id = base64_decode($supplier_id);
        $data['supplier_id'] = $supplier_id;
        
        $supplier_where['supplier_id'] = $supplier_id;
        
        $supplier_info = $this->SupplierMstModel->get_record($supplier_id)['0'];

        $this->SupplierMstModel->delete($supplier_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Supervisor/ManageSupplier');
    }
	
	public function supplier_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
		
		$this->form_validation->set_rules('is_supplier_type', 'Supplier Type', 'trim|required|is_natural|exact_length[1]');
        
        $this->form_validation->set_rules('firm_name', 'Firm Name', 'trim|required|max_length[255]');		
		$this->form_validation->set_rules('owner_name', 'Owner Name', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]');		
        $this->form_validation->set_rules('state_name', 'State', 'trim|required');		
        $this->form_validation->set_rules('city_name', 'City', 'trim|required');
        $this->form_validation->set_rules('zip_code', 'Zip code', 'trim|required|numeric|exact_length[6]');
		$this->form_validation->set_rules('mobile1', 'Mobile No. 1', 'trim|required|numeric|exact_length[10]');
		$this->form_validation->set_rules('mobile2', 'Mobile No. 2', 'trim|numeric|exact_length[10]');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[255]');		
		$this->form_validation->set_rules('website', 'Website', 'callback_valid_url');
        
		$this->form_validation->set_rules('gsin_no', 'GSIN No.', 'trim|max_length[20]');
		$this->form_validation->set_rules('pan_no', 'PAN No.', 'trim|exact_length[10]');
        $this->form_validation->set_rules('aadhar_no', 'Aadhar No.', 'trim|numeric|exact_length[12]');
		
        $this->form_validation->set_rules('bank_id', 'Bank Name', 'trim|required');
        $this->form_validation->set_rules('account_no', 'Account No.', 'trim|required');
        $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required');
        $this->form_validation->set_rules('branch', 'Branch', 'trim|required|max_length[255]');

		$this->form_validation->set_rules('display', 'Display', 'trim|required|is_natural|exact_length[1]');
	}
	
	public function valid_url($str) {
		if($str!="") {			
			if(filter_var($str, FILTER_VALIDATE_URL)) {
				$this->form_validation->set_message('valid_url',"Invalid website url");
				return TRUE;
			} else {
				return FALSE;
			}
		} else {		
			return TRUE;	
		}
	}
	
	public function create_thumb($full_path, $new_img, $img_width, $img_height) {		
		$config_create_thumb['image_library'] = 'gd2';
		$config_create_thumb['source_image'] = $new_img;
		$config_create_thumb['new_image'] = $full_path;
		//$config_create_thumb['create_thumb'] = TRUE;
		$config_create_thumb['maintain_ratio'] = TRUE;
		$config_create_thumb['width'] = $img_width;
		$config_create_thumb['height'] =$img_height;
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