<?php defined('BASEPATH') or exit('No direct script access allowed');

class ManageCreditNote extends CI_Controller
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

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_CREDIT_NOTE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'ManageCreditNote';
        $this->session->set_userdata($main_menu);

        $topbar = "Manage Credit Note";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['credit_note_info'] = $this->CreditNoteMstModel->get_record($finyear_info->finyear_id, $login_info->store_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Account/credit_note_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($credit_note_mst_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_CREDIT_NOTE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'ManageCreditNote';
        $this->session->set_userdata($main_menu);

        $topbar = "Manage Credit Note";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $credit_note_mst_id = base64_decode($credit_note_mst_id);
        $data['credit_note_mst_id'] = $credit_note_mst_id;

        $data['credit_note_info'] = $this->CreditNoteMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $credit_note_mst_id)['0'];

        $this->load->view('layout/header', $data);
        $this->load->view('Account/credit_note_view', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add($supplier_id = '')
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_CREDIT_NOTE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $main_menu['active'] = 'ManageCreditNote';
        $this->session->set_userdata($main_menu);

        $topbar = "Manage Credit Note";

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

        $data['supplier_list'] = $this->SupplierMstModel->get_select($login_info->store_id);
        
        if($supplier_id != '') {
            $supplier_account_info = $this->SupplierAccountMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $supplier_id)['0'];
            $data['supplier_account_info'] = $supplier_account_info;
        }

        $data['payment_mode_list'] = $this->PaymentModeMstModel->get_is_store_select();
        $data['bank_list'] = $this->BankMstModel->get_select();

        $this->credit_note_validation(false);
        if ($this->form_validation->run() == false) {
            if (!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Account/credit_note_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Account/credit_note_add', $data);
                $this->load->view('layout/footer', $data);

            }
        } else {

            $account_info = $this->AccountMstModel->get_record(ACCOUNT_CREDIT_NOTE)['0'];
            $supplier_account_info = $this->SupplierAccountMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $this->input->post('supplier_id'))['0'];
            $payment_mode_info = $this->PaymentModeMstModel->get_record($this->input->post('payment_mode_id'))['0'];
            
            $dues_amount = 0;
            $total_amount = 0;
            $net_amount = 0;
            if(!empty($supplier_account_info)) {
                $dues_amount = $supplier_account_info->net_amount;            
            }

            $total_amount = $this->input->post('pay_amount')-$this->input->post('adjustment');
            $net_amount = $dues_amount-$total_amount;            

            $credit_note_no_info = $this->CreditNoteMstModel->get_count($finyear_info->finyear_id, $login_info->store_id)['0'];
            $credit_note_no = $credit_note_no_info->total;

            $this->db->trans_start();
            
            $credit_note_data['credit_note_no'] = $credit_note_no;
            $credit_note_data['date'] = $this->customlib->get_YYYYMMDD($this->input->post('date'));
            $credit_note_data['store_id'] = $login_info->store_id;
            $credit_note_data['supplier_id'] = $this->input->post('supplier_id');
            $credit_note_data['dues_amount'] = $dues_amount;
            $credit_note_data['pay_amount'] = $this->input->post('pay_amount');
            $credit_note_data['adjustment'] = $this->input->post('adjustment');
            $credit_note_data['grand_total'] = $total_amount;
            $credit_note_data['round_off'] = round($total_amount, 0);
            $credit_note_data['amount_word'] = $this->customlib->number_words(round($this->input->post('pay_amount'), 0));
            $credit_note_data['remarks'] = $this->input->post('remarks'); 
            $credit_note_data['payment_mode_id'] = $this->input->post('payment_mode_id');
            $credit_note_data['payment_mode'] = $payment_mode_info->payment_mode;
            $credit_note_data['bank_id'] = $this->input->post('bank_id');
            $credit_note_data['transaction_no'] = $this->input->post('transaction_no');
            $credit_note_data['transaction_date'] = $this->customlib->get_YYYYMMDD($this->input->post('transaction_date'));  
            $credit_note_data['branch'] = $this->input->post('branch');
            $credit_note_data['status_id'] = 'Pending';
            $credit_note_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $credit_note_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $credit_note_data['is_cancel'] = '0';
            $credit_note_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $credit_note_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $credit_note_data['finyear_id'] = $finyear_info->finyear_id; 
            $credit_note_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $credit_note_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $credit_note_data['created_by'] = $login_info->users_id;
            $credit_note_data['created_name'] = $login_info->name;
            $credit_note_data['created_user_agent'] = $this->customlib->load_agent();
            $credit_note_data['created_ip'] = $this->input->ip_address();

            $credit_note_mst_id = $this->CreditNoteMstModel->add($credit_note_data);

            $account_mst_data['credit_note'] = $supplier_account_info->credit_note+$this->input->post('pay_amount');
            $account_mst_data['adjustment'] = $supplier_account_info->adjustment+$this->input->post('adjustment');
            $account_mst_data['net_amount'] = $net_amount;
            $account_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_mst_data['updated_by'] = $login_info->users_id;
            $account_mst_data['updated_name'] = $login_info->name;
            $account_mst_data['updated_user_agent'] = $this->customlib->load_agent();
            $account_mst_data['updated_ip'] = $this->input->ip_address();

            $account_mst_where['finyear_id'] = $finyear_info->finyear_id; 
            $account_mst_where['store_id'] = $login_info->store_id;
            $account_mst_where['supplier_id'] = $this->input->post('supplier_id');
            $account_mst_where['supplier_account_mst_id'] = $supplier_account_info->supplier_account_mst_id;
            
            $this->SupplierAccountMstModel->modify($account_mst_data, $account_mst_where);

            $account_det_data['invoice_no'] = $credit_note_no;
            $account_det_data['date'] = $this->customlib->get_YYYYMMDD($this->input->post('date'));
            $account_det_data['store_id'] = $login_info->store_id;
            $account_det_data['supplier_id'] = $this->input->post('supplier_id');
            $account_det_data['name'] = ''; //$this->input->post('name');
            $account_det_data['mobile'] = ''; //$this->input->post('mobile');
            $account_det_data['supplier_account_mst_id'] = $supplier_account_info->supplier_account_mst_id;
            $account_det_data['master_id'] = $credit_note_mst_id;
            $account_det_data['account_id'] = $account_info->account_id;
            $account_det_data['account'] = $account_info->account;            
            $account_det_data['dues_amount'] = $dues_amount;
            $account_det_data['total_quantity'] = '0'; //$this->input->post('total_quantity');
            $account_det_data['total_mrp'] = '0'; //$this->input->post('total_mrp');
            $account_det_data['total_rate'] = '0'; //$this->input->post('total_rate');
            $account_det_data['total_cgst'] = '0'; //$this->input->post('total_cgst');
            $account_det_data['total_sgst'] = '0'; //$this->input->post('total_sgst');
            $account_det_data['total_igst'] = '0'; //$this->input->post('total_igst');
            $account_det_data['transport_charges'] = '0'; //$transport_charges;
            $account_det_data['other_charges'] = '0'; //$other_charges;
            $account_det_data['net_amount'] = $this->input->post('pay_amount');
            $account_det_data['adjustment'] = $this->input->post('adjustment');
            $account_det_data['grand_total'] = $total_amount;
            $account_det_data['round_off'] = round($total_amount, 0);
            $account_det_data['amount_word'] = $this->customlib->number_words(round($this->input->post('pay_amount'), 0));
            $account_det_data['remarks'] = $this->input->post('remarks'); 
            $account_det_data['payment_mode_id'] = $this->input->post('payment_mode_id');
            $account_det_data['payment_mode'] = $payment_mode_info->payment_mode;
            $account_det_data['bank_id'] = $this->input->post('bank_id');
            $account_det_data['transaction_no'] = $this->input->post('transaction_no');
            $account_det_data['transaction_date'] = $this->customlib->get_YYYYMMDD($this->input->post('transaction_date'));  
            $account_det_data['branch'] = $this->input->post('branch');
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

            if (($credit_note_mst_id > 0) && ($supplier_account_det_id > 0)) {
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Account/ManageCreditNote');
            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Account/ManageCreditNote/add');
            }
        }
    }

    public function cancel($credit_note_mst_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_COUNTER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageCreditNote';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Credit Note";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $credit_note_mst_id = base64_decode($credit_note_mst_id);
        $data['credit_note_mst_id'] = $credit_note_mst_id;
        
        $this->cancel_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {                
                $credit_note_info = $this->CreditNoteMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $credit_note_mst_id)['0'];
                $data['credit_note_info'] = $credit_note_info;
                if ($credit_note_info->is_cancel == '1') {
                    $this->session->set_flashdata('error_msg', $this->lang->line('cancel_error_message'));
                    redirect('Account/ManageCreditNote');
                } else {
                    $this->load->view('layout/header', $data);
                    $this->load->view('Account/credit_note_cancel', $data);
                    $this->load->view('layout/footer', $data);
                }

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Account/credit_note_cancel', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $credit_note_info = $this->CreditNoteMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $credit_note_mst_id)['0'];
                
            $account_info = $this->AccountMstModel->get_record(ACCOUNT_CREDIT_NOTE)['0'];
            $supplier_account_info = $this->SupplierAccountMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $credit_note_info->supplier_id)['0'];
            
            $dues_amount = 0;
            $total_amount = 0;
            $net_amount = 0;
            if(!empty($supplier_account_info)) {
                $dues_amount = $supplier_account_info->net_amount;            
            }

            $total_amount = $credit_note_info->pay_amount+$credit_note_info->adjustment;
            $net_amount = $dues_amount+$total_amount;
            
            $this->db->trans_start();
            
            $credit_note_data['is_cancel'] = '1';
            $credit_note_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
            $credit_note_data['cancel_reason'] = $this->input->post('cancel_reason');
            $credit_note_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $credit_note_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $credit_note_data['updated_by'] = $login_info->users_id;
            $credit_note_data['updated_name'] = $login_info->name;
            $credit_note_data['updated_user_agent'] = $this->customlib->load_agent();
            $credit_note_data['updated_ip'] = $this->input->ip_address();
            
            $credit_note_where['finyear_id'] = $finyear_info->finyear_id; 
            $credit_note_where['store_id'] = $login_info->store_id;
            $credit_note_where['supplier_id'] = $credit_note_info->supplier_id;
            $credit_note_where['credit_note_mst_id'] = $credit_note_mst_id;
            
            $this->CreditNoteMstModel->modify($credit_note_data, $credit_note_where);

            $account_mst_data['credit_note'] = $supplier_account_info->credit_note-$credit_note_info->pay_amount;
            $account_mst_data['adjustment'] = $supplier_account_info->adjustment-$credit_note_info->adjustment;
            $account_mst_data['net_amount'] = $net_amount;
            $account_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_mst_data['updated_by'] = $login_info->users_id;
            $account_mst_data['updated_name'] = $login_info->name;
            $account_mst_data['updated_user_agent'] = $this->customlib->load_agent();
            $account_mst_data['updated_ip'] = $this->input->ip_address();
            
            $account_mst_where['finyear_id'] = $finyear_info->finyear_id; 
            $account_mst_where['store_id'] = $login_info->store_id;
            $account_mst_where['supplier_id'] = $credit_note_info->supplier_id;
            $account_mst_where['supplier_account_mst_id'] = $supplier_account_info->supplier_account_mst_id;
            
            $this->SupplierAccountMstModel->modify($account_mst_data, $account_mst_where);

            $account_det_data['is_cancel'] = '1';
            $account_det_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
            $account_det_data['cancel_reason'] = $this->input->post('cancel_reason');
            $account_det_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_det_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_det_data['updated_by'] = $login_info->users_id;
            $account_det_data['updated_name'] = $login_info->name;
            $account_det_data['updated_user_agent'] = $this->customlib->load_agent();
            $account_det_data['updated_ip'] = $this->input->ip_address();
            
            $account_det_where['finyear_id'] = $finyear_info->finyear_id; 
            $account_det_where['store_id'] = $login_info->store_id;
            $account_det_where['supplier_id'] = $credit_note_info->supplier_id;
            $account_det_where['supplier_account_mst_id'] = $supplier_account_info->supplier_account_mst_id;
            $account_det_where['master_id'] = $credit_note_mst_id;
            $account_det_where['account_id'] = $account_info->account_id;
            
            $this->SupplierAccountDetModel->modify($account_det_data, $account_det_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('cancel_confirmation_message'));
            redirect('Account/ManageCreditNote');
        }
    }

    public function prints($credit_note_mst_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_COUNTER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_prints == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageCreditNote';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Credit Note";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $credit_note_mst_id = base64_decode($credit_note_mst_id);
        $data['credit_note_mst_id'] = $credit_note_mst_id;

        $data['store_info'] = $this->StoreMstModel->get_record($login_info->store_id)['0'];
        
        $credit_note_info = $this->CreditNoteMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $credit_note_mst_id)['0'];
        $data['credit_note_info'] = $credit_note_info;
        
        $this->load->view('Account/credit_note_prints', $data);
    }

    public function credit_note_validation($required = true) {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[20]');

        $this->form_validation->set_rules('supplier_id', 'Supplier Name', 'trim|required');
        
        $this->form_validation->set_rules('dues_amount', 'Last Dues Amount', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('pay_amount', 'Pay Amount', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('adjustment', 'Adjustment', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('balance_amount', 'Balance Amount', 'trim|required|numeric|min_length[1]|max_length[10]');
        
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[255]');     
        
        $this->form_validation->set_rules('payment_mode_id', 'Payment Mode', 'trim|required');
        if($this->input->post('payment_mode_id') != '11') {
            $this->form_validation->set_rules('bank_id', 'Bank', 'trim|required');
            $this->form_validation->set_rules('transaction_no', 'Transaction No.', 'trim|max_length[20]');
            $this->form_validation->set_rules('transaction_date', 'Transaction Date', 'trim|max_length[20]');
            $this->form_validation->set_rules('branch', 'Branch', 'trim|required|max_length[255]');
        }
    }

    public function cancel_validation($required = true) {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('cancel_date', 'Date', 'trim|max_length[20]');
        $this->form_validation->set_rules('cancel_reason', 'Reason', 'trim|required');
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
