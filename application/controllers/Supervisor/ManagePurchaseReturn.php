<?php defined('BASEPATH') or exit('No direct script access allowed');

class ManagePurchaseReturn extends CI_Controller {

    var $CI;
    private $login_Detail;

    public function __construct() {
        parent::__construct();
        $this->customlib->expirePage();
    }

    public function index()
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_RETURN, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'ManagePurchaseReturn';
        $this->session->set_userdata($main_menu);

        $topbar = 'Manage Purchase Return';

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['purchase_return_mst_info'] = $this->PurchaseReturnMstModel->get_record($finyear_info->finyear_id, $login_info->store_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/purchase_return_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($purchase_return_mst_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_RETURN, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'ManagePurchaseReturn';
        $this->session->set_userdata($main_menu);

        $topbar = 'Manage Purchase Return';

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $purchase_return_mst_id = base64_decode($purchase_return_mst_id);
        $data['purchase_return_mst_id'] = $purchase_return_mst_id;

        $data['purchase_return_mst_info'] = $this->PurchaseReturnMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $purchase_return_mst_id)['0'];

        $data['purchase_return_det_info'] = $this->PurchaseReturnDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $purchase_return_mst_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/purchase_return_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add() {
        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_RETURN, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $store_id = $login_info->store_id;
        $finance_id = $finyear_info->finyear_id;

        $main_menu['active'] = 'ManagePurchaseReturn';
        $this->session->set_userdata($main_menu);

        $topbar = 'Manage Purchase Return';

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['supplier_list'] = $this->SupplierMstModel->get_select($login_info->store_id);        
        
        $this->purchase_return_validation(false);
        if ($this->form_validation->run() == false) {
            if (!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/purchase_return_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/purchase_return_add', $data);
                $this->load->view('layout/footer', $data);

            }
        } else {

            $invoice_no_info = $this->PurchaseReturnMstModel->get_count($finyear_info->finyear_id, $login_info->store_id)['0'];
            $invoice_no = $invoice_no_info->total;

            $account_info = $this->AccountMstModel->get_record(ACCOUNT_PURCHASE_RETURN)['0'];
            $supplier_account_info = $this->SupplierAccountMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $this->input->post('supplier_id'))['0'];

            $dues_amount = 0;
            if(!empty($supplier_account_info)) {
                $dues_amount = $supplier_account_info->net_amount;            
            }

            $purchase_return_details = $this->session->userdata('purchase_return_details');

            $total_quantity = 0;
            $total_mrp = 0;
            $total_rate = 0;

            $total_cgst = 0;
            $total_sgst = 0;
            $total_igst = 0;
            $transport_charges = 0;
            $other_charges = 0;
            $net_amount = 0;
            $adjustment = 0;
            $grand_total = 0;
            $grand_total = 0;

            for ($counter = 0; $counter < count($purchase_return_details); $counter++) {
                $total_quantity = $total_quantity + $purchase_return_details[$counter]['quantity'];
                $total_mrp = $total_mrp + $purchase_return_details[$counter]['total_mrp'];
                $total_rate = $total_rate + $purchase_return_details[$counter]['total_rate'];
            }

            $total_cgst = $this->input->post('purchase_return_total_cgst');
            $total_sgst = $this->input->post('purchase_return_total_sgst');
            $total_igst = $this->input->post('purchase_return_total_igst');
            $transport_charges = $this->input->post('purchase_return_transport_charges');
            $other_charges = $this->input->post('purchase_return_other_charges');

            $net_amount = $total_rate+$total_cgst;
            $net_amount = $net_amount+$total_sgst;
            $net_amount = $net_amount+$total_igst;
            $net_amount = $net_amount+$transport_charges;
            $net_amount = $net_amount+$other_charges; //$this->input->post('purchase_return_net_amount');

            $adjustment = $this->input->post('purchase_return_adjustment');
            $grand_total = $net_amount+$adjustment; //$this->input->post('purchase_return_grand_total');
            
            $round_off = round($grand_total, 0);

            $this->db->trans_start();

            $purchase_return_mst_data['is_credit'] = IS_NOT_DEFINE_SALES;
            $purchase_return_mst_data['invoice_no'] = $invoice_no;
            $purchase_return_mst_data['date'] = $this->customlib->get_YYYYMMDD($this->input->post('date'));
            $purchase_return_mst_data['store_id'] = $login_info->store_id;
            $purchase_return_mst_data['supplier_id'] = $this->input->post('supplier_id');
            $purchase_return_mst_data['delivery_challan_no'] = ''; //$this->input->post('delivery_challan_no');
            $purchase_return_mst_data['po_no'] = ''; //$this->input->post('po_no');
            $purchase_return_mst_data['inward_no'] = ''; //$this->input->post('inward_no');
            $purchase_return_mst_data['dues_amount'] = $dues_amount;
            $purchase_return_mst_data['total_quantity'] = $total_quantity;
            $purchase_return_mst_data['total_mrp'] = $total_mrp;
            $purchase_return_mst_data['total_rate'] = $total_rate;
            $purchase_return_mst_data['total_cgst'] = $total_cgst;
            $purchase_return_mst_data['total_sgst'] = $total_sgst;
            $purchase_return_mst_data['total_igst'] = $total_igst;
            $purchase_return_mst_data['transport_charges'] = $transport_charges;
            $purchase_return_mst_data['other_charges'] = $other_charges;
            $purchase_return_mst_data['net_amount'] = $net_amount;
            $purchase_return_mst_data['adjustment'] = $adjustment;
            $purchase_return_mst_data['grand_total'] = $grand_total;
            $purchase_return_mst_data['round_off'] = $round_off;
            $purchase_return_mst_data['amount_word'] = $this->customlib->number_words($round_off);
            $purchase_return_mst_data['remarks'] = $this->input->post('remarks');  
            $purchase_return_mst_data['status_id'] = 'Pending';
            $purchase_return_mst_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $purchase_return_mst_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $purchase_return_mst_data['is_cancel'] = '0';
            $purchase_return_mst_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $purchase_return_mst_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $purchase_return_mst_data['finyear_id'] = $finyear_info->finyear_id; 
            $purchase_return_mst_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $purchase_return_mst_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $purchase_return_mst_data['created_by'] = $login_info->users_id;
            $purchase_return_mst_data['created_name'] = $login_info->name;
            $purchase_return_mst_data['created_user_agent'] = $this->customlib->load_agent();
            $purchase_return_mst_data['created_ip'] = $this->input->ip_address();

            $purchase_return_mst_id = $this->PurchaseReturnMstModel->add($purchase_return_mst_data);

            $account_mst_data['purchase_return'] = $supplier_account_info->purchase_return+$net_amount;
            $account_mst_data['adjustment'] = $supplier_account_info->adjustment+$adjustment;
            $account_mst_data['net_amount'] = $supplier_account_info->net_amount-$grand_total;
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

            $account_det_data['is_credit'] = IS_NOT_DEFINE_SALES;
            $account_det_data['invoice_no'] = $invoice_no;
            $account_det_data['date'] = $this->customlib->get_YYYYMMDD($this->input->post('date'));
            $account_det_data['store_id'] = $login_info->store_id;
            $account_det_data['supplier_id'] = $this->input->post('supplier_id');
            $account_det_data['name'] = ''; //$this->input->post('name');
            $account_det_data['mobile'] = ''; //$this->input->post('mobile');
            $account_det_data['supplier_account_mst_id'] = $supplier_account_info->supplier_account_mst_id;
            $account_det_data['master_id'] = $purchase_return_mst_id;
            $account_det_data['account_id'] = $account_info->account_id;
            $account_det_data['account'] = $account_info->account;            
            $account_det_data['total_quantity'] = $total_quantity;
            $account_det_data['total_mrp'] = $total_mrp;
            $account_det_data['total_rate'] = $total_rate;
            $account_det_data['total_cgst'] = $total_cgst;
            $account_det_data['total_sgst'] = $total_sgst;
            $account_det_data['total_igst'] = $total_igst;
            $account_det_data['transport_charges'] = $transport_charges;
            $account_det_data['other_charges'] = $other_charges;
            $account_det_data['net_amount'] = $net_amount;
            $account_det_data['adjustment'] = $adjustment;
            $account_det_data['grand_total'] = $grand_total;
            $account_det_data['round_off'] = $round_off;
            $account_det_data['amount_word'] = $this->customlib->number_words($round_off);
            $account_det_data['remarks'] = $this->input->post('remarks'); 
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

            for ($counter = 0; $counter < count($purchase_return_details); $counter++) {

                $product_info = $this->ProductMstModel->get_autocomplete($finyear_info->finyear_id, $login_info->store_id, '', $purchase_return_details[$counter]['product_id'])['0'];
                
                $product_full_info = $this->ProductMstModel->get_full_record($purchase_return_details[$counter]['product_id'])['0'];

                $total_mrp = $purchase_return_details[$counter]['quantity']*$purchase_return_details[$counter]['mrp'];
                $total_rate = $purchase_return_details[$counter]['quantity']*$purchase_return_details[$counter]['rate'];

                $purchase_return_det_data['store_id'] = $login_info->store_id;
                $purchase_return_det_data['purchase_return_mst_id'] = $purchase_return_mst_id;
                $purchase_return_det_data['product_id'] = $purchase_return_details[$counter]['product_id'];
                $purchase_return_det_data['product_code'] = $product_info->product_code;
                $purchase_return_det_data['product_heading'] = $product_info->heading;
                $purchase_return_det_data['quantity'] = $purchase_return_details[$counter]['quantity'];
                $purchase_return_det_data['packing_id'] = $product_info->packing_id;   
                $purchase_return_det_data['packing_title'] = $product_info->packing_title; 
                $purchase_return_det_data['unit_id'] = $product_info->unit_id;   
                $purchase_return_det_data['unit_title'] = $product_info->unit_title; 
                $purchase_return_det_data['mfg_date'] = $this->customlib->get_YYYYMMDD($purchase_return_details[$counter]['mfg_date']);
                $purchase_return_det_data['expiry_date'] = $this->customlib->get_YYYYMMDD($purchase_return_details[$counter]['expiry_date']);
                $purchase_return_det_data['batch_no'] = $purchase_return_details[$counter]['batch_no'];
                $purchase_return_det_data['mrp_price'] = $purchase_return_details[$counter]['mrp'];
                $purchase_return_det_data['rate'] = $purchase_return_details[$counter]['rate'];
                $purchase_return_det_data['total_mrp'] = $total_mrp; //$purchase_return_details[$counter]['total_mrp'];
                $purchase_return_det_data['total_rate'] = $total_rate; //$purchase_return_details[$counter]['total_rate'];
                $purchase_return_det_data['cgst'] = '0'; //$purchase_return_details[$counter]['total_rate'];
                $purchase_return_det_data['sgst'] = '0'; //$purchase_return_details[$counter]['total_rate'];
                $purchase_return_det_data['igst'] = '0'; //$purchase_return_details[$counter]['total_rate'];
                $purchase_return_det_data['total_amount'] = $purchase_return_details[$counter]['total_rate'];
                $purchase_return_det_data['is_cancel'] = '0';
                $purchase_return_det_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $purchase_return_det_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
                $purchase_return_det_data['finyear_id'] = $finyear_info->finyear_id; 
                $purchase_return_det_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $purchase_return_det_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $purchase_return_det_data['created_by'] = $login_info->users_id;
                $purchase_return_det_data['created_name'] = $login_info->name;
                $purchase_return_det_data['created_user_agent'] = $this->customlib->load_agent();
                $purchase_return_det_data['created_ip'] = $this->input->ip_address();
    
                $purchase_return_det_id = $this->PurchaseReturnDetModel->add($purchase_return_det_data);

                $product_account_mst_info = $this->ProductAccountMstModel->get_record(
                    $finyear_info->finyear_id, 
                    $login_info->store_id, 
                    '', //$this->input->post('supplier_id'),
                    '', //$this->input->post('brand_id'),
                    $purchase_return_details[$counter]['product_id'])['0'];

                $product_account_mst_data['purchase_return'] = $product_account_mst_info->purchase_return+$purchase_return_details[$counter]['quantity'];
                $product_account_mst_data['net_amount'] = $product_account_mst_info->net_amount
                -$purchase_return_details[$counter]['quantity'];
                $product_account_mst_data['finyear_id'] = $finyear_info->finyear_id;
                $product_account_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['updated_by'] = $login_info->users_id;
                $product_account_mst_data['updated_name'] = $login_info->name;
                $product_account_mst_data['updated_user_agent'] = $this->customlib->load_agent();
                $product_account_mst_data['updated_ip'] = $this->input->ip_address();
    
                $product_account_mst_where['store_id'] = $login_info->store_id;
                $product_account_mst_where['supplier_id'] = $this->input->post('supplier_id');           
                $product_account_mst_where['brand_id'] = $product_full_info->brand_id;
                /*$product_account_mst_where['category1_id'] = $product_full_info->category1_id;
                $product_account_mst_where['category2_id'] = $product_full_info->category2_id;
                $product_account_mst_where['category3_id'] = $product_full_info->category3_id;
                $product_account_mst_where['category4_id'] = $product_full_info->category4_id;*/
                $product_account_mst_where['product_id'] = $purchase_return_details[$counter]['product_id'];
                $product_account_mst_where['product_account_mst_id'] = $product_account_mst_info->product_account_mst_id;

                $this->ProductAccountMstModel->modify($product_account_mst_data, $product_account_mst_where);

                $product_account_det_data['account_id'] = $account_info->account_id;
                $product_account_det_data['account'] = $account_info->account;            
                $product_account_det_data['product_account_mst_id'] = $product_account_mst_info->product_account_mst_id;
                $product_account_det_data['store_id'] = $login_info->store_id;           
                $product_account_det_data['supplier_id'] = $this->input->post('supplier_id');
                $product_account_det_data['name'] = ''; //$this->input->post('name');
                $product_account_det_data['mobile'] = ''; //$this->input->post('mobile');
                $product_account_det_data['brand_id'] = $product_full_info->brand_id;
                $product_account_det_data['brand_heading'] = $product_full_info->brand_heading;
                $product_account_det_data['category1_id'] = $product_full_info->category1_id;
                $product_account_det_data['category2_id'] = $product_full_info->category2_id;
                $product_account_det_data['category3_id'] = $product_full_info->category3_id;
                $product_account_det_data['category4_id'] = $product_full_info->category4_id;
                $product_account_det_data['product_id'] = $purchase_return_details[$counter]['product_id'];
                $product_account_det_data['product_code'] = $product_full_info->product_code;
                $product_account_det_data['product_heading'] = $product_full_info->heading;
                $product_account_det_data['standard_barcode'] = ''; //$this->input->post('standard_barcode');
                $product_account_det_data['generate_barcode'] = ''; //$this->input->post('generate_barcode');
                $product_account_det_data['quantity'] = $purchase_return_details[$counter]['quantity'];
                $product_account_det_data['packing_id'] = $product_info->packing_id;   
                $product_account_det_data['packing_title'] = $product_info->packing_title; 
                $product_account_det_data['unit_id'] = $product_info->unit_id;   
                $product_account_det_data['unit_title'] = $product_info->unit_title;
                $product_account_det_data['mfg_date'] = $this->customlib->get_YYYYMMDD($purchase_return_details[$counter]['mfg_date']);
                $product_account_det_data['expiry_date'] = $this->customlib->get_YYYYMMDD($purchase_return_details[$counter]['expiry_date']);
                $product_account_det_data['batch_no'] = $purchase_return_details[$counter]['batch_no'];
                $product_account_det_data['mrp_price'] = $purchase_return_details[$counter]['mrp'];
                $product_account_det_data['rate'] = $purchase_return_details[$counter]['rate'];
                $product_account_det_data['total_mrp'] = $total_mrp; //$purchase_return_details[$counter]['total_mrp'];
                $product_account_det_data['total_rate'] = $total_rate; //$purchase_return_details[$counter]['total_rate'];
                $product_account_det_data['cgst_id'] = $product_full_info->cgst_taxes_id;
                $product_account_det_data['cgst_title'] = $product_full_info->cgst_taxes_title;
                $product_account_det_data['cgst_value'] = $product_full_info->cgst_taxes_value;
                $product_account_det_data['total_cgst_amount'] = '0'; //$this->input->post('cgst_amount');
                $product_account_det_data['sgst_id'] = $product_full_info->sgst_taxes_id;
                $product_account_det_data['sgst_title'] = $product_full_info->sgst_taxes_title;
                $product_account_det_data['sgst_value'] = $product_full_info->sgst_taxes_value;
                $product_account_det_data['total_sgst_amount'] = '0'; //$this->input->post('sgst_amount');
                $product_account_det_data['igst_id'] = $product_full_info->igst_taxes_id;
                $product_account_det_data['igst_title'] = $product_full_info->igst_taxes_title;
                $product_account_det_data['igst_value'] = $product_full_info->igst_taxes_value;
                $product_account_det_data['total_igst_amount'] = '0'; //$this->input->post('igst_amount');
                $product_account_det_data['total_amount'] = $purchase_return_details[$counter]['total_rate'];
                $product_account_det_data['is_cancel'] = '0';
                $product_account_det_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_det_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
                $product_account_det_data['finyear_id'] = $finyear_info->finyear_id;            
                $product_account_det_data['display'] = '1'; $this->input->post('display');
                $product_account_det_data['priority'] = '0'; $this->input->post('priority');
                $product_account_det_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_det_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_det_data['created_by'] = $login_info->users_id;
                $product_account_det_data['created_name'] = $login_info->name;
                $product_account_det_data['created_user_agent'] = $this->customlib->load_agent();
                $product_account_det_data['created_ip'] = $this->input->ip_address();
                
                $product_account_det_id = $this->ProductAccountDetModel->add($product_account_det_data);
            }

            $this->db->trans_complete();

            if (($purchase_return_mst_id > 0) && ($purchase_return_det_id > 0)) {                
                $this->session->unset_userdata('purchase_return_details');

                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Supervisor/ManagePurchaseReturn');
            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Supervisor/ManagePurchaseReturn/add');
            }            
        }
    }

    public function cancel($purchase_return_mst_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_RETURN, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManagePurchaseReturn';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Manage Purchase Return';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $purchase_return_mst_id = base64_decode($purchase_return_mst_id);
        $data['purchase_return_mst_id'] = $purchase_return_mst_id;
        
        $this->cancel_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {        
                $purchase_return_mst_info = $this->PurchaseReturnMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $purchase_return_mst_id)['0'];
                $data['purchase_return_mst_info'] = $purchase_return_mst_info;        
                $data['purchase_return_det_info'] = $this->PurchaseReturnDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $purchase_return_mst_id);
                if ($purchase_return_mst_info->is_cancel == '1') {
                    $this->session->set_flashdata('error_msg', $this->lang->line('cancel_error_message'));
                    redirect('Supervisor/ManagePurchaseReturn');

                } else {
                    $this->load->view('layout/header', $data);
                    $this->load->view('Supervisor/purchase_return_cancel', $data);
                    $this->load->view('layout/footer', $data);

                }

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/purchase_return_cancel', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {

            $purchase_return_mst_info = $this->PurchaseReturnMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $purchase_return_mst_id)['0'];

            $purchase_return_det_info = $this->PurchaseReturnDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $purchase_return_mst_id);

            $account_info = $this->AccountMstModel->get_record(ACCOUNT_PURCHASE_RETURN)['0'];
            $supplier_account_info = $this->SupplierAccountMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $purchase_return_mst_info->supplier_id)['0'];

            $this->db->trans_start();

            $purchase_return_mst_data['is_cancel'] = '1';
            $purchase_return_mst_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
            $purchase_return_mst_data['cancel_reason'] = $this->input->post('cancel_reason');
            $purchase_return_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $purchase_return_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $purchase_return_mst_data['updated_by'] = $login_info->users_id;
            $purchase_return_mst_data['updated_name'] = $login_info->name;
            $purchase_return_mst_data['updated_user_agent'] = $this->customlib->load_agent();
            $purchase_return_mst_data['updated_ip'] = $this->input->ip_address();
            
            $purchase_return_mst_where['finyear_id'] = $finyear_info->finyear_id; 
            $purchase_return_mst_where['store_id'] = $login_info->store_id;
            $purchase_return_mst_where['supplier_id'] = $purchase_return_mst_info->supplier_id;
            $purchase_return_mst_where['purchase_return_mst_id'] = $purchase_return_mst_id;
            
            $this->PurchaseReturnMstModel->modify($purchase_return_mst_data, $purchase_return_mst_where);

            $account_mst_data['purchase_return'] = $supplier_account_info->purchase_return-$purchase_return_mst_info->net_amount;
            $account_mst_data['adjustment'] = $supplier_account_info->adjustment-$purchase_return_mst_info->adjustment;
            $account_mst_data['net_amount'] = $supplier_account_info->net_amount+$purchase_return_mst_info->grand_total;
            $account_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $account_mst_data['updated_by'] = $login_info->users_id;
            $account_mst_data['updated_name'] = $login_info->name;
            $account_mst_data['updated_user_agent'] = $this->customlib->load_agent();
            $account_mst_data['updated_ip'] = $this->input->ip_address();

            $account_mst_where['finyear_id'] = $finyear_info->finyear_id; 
            $account_mst_where['store_id'] = $login_info->store_id;
            $account_mst_where['supplier_id'] = $purchase_return_mst_info->supplier_id;
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
            $account_det_where['supplier_id'] = $purchase_return_mst_info->supplier_id;
            $account_det_where['supplier_account_mst_id'] = $supplier_account_info->supplier_account_mst_id;
            $account_det_where['master_id'] = $purchase_return_mst_id;
            $account_det_where['account_id'] = $account_info->account_id;
            
            $this->SupplierAccountDetModel->modify($account_det_data, $account_det_where);

            foreach ($purchase_return_det_info as $value) {
                
                $purchase_return_det_data['is_cancel'] = '1';
                $purchase_return_det_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
                $purchase_return_det_data['cancel_reason'] = $this->input->post('cancel_reason');
                $purchase_return_det_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $purchase_return_det_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $purchase_return_det_data['updated_by'] = $login_info->users_id;
                $purchase_return_det_data['updated_name'] = $login_info->name;
                $purchase_return_det_data['updated_user_agent'] = $this->customlib->load_agent();
                $purchase_return_det_data['updated_ip'] = $this->input->ip_address();
                
                $purchase_return_det_where['finyear_id'] = $finyear_info->finyear_id; 
                $purchase_return_det_where['store_id'] = $login_info->store_id;
                /*$purchase_return_det_where['supplier_id'] = $purchase_return_det_info->supplier_id;*/
                $purchase_return_det_where['purchase_return_mst_id'] = $purchase_return_mst_id;
                $purchase_return_det_where['purchase_return_det_id'] = $value->purchase_return_det_id;
                
                $this->PurchaseReturnDetModel->modify($purchase_return_det_data, $purchase_return_det_where);

                $product_info = $this->ProductMstModel->get_full_record($value->product_id)['0'];

                $product_account_mst_info = $this->ProductAccountMstModel->get_record(
                    $finyear_info->finyear_id,
                    $login_info->store_id, 
                    '', //$purchase_return_mst_info->supplier_id,
                    '', //$this->input->post('brand_id'),
                    $value->product_id)['0'];

                $product_account_mst_data['purchase_return'] = $product_account_mst_info->purchase_return-$value->quantity;
                $product_account_mst_data['net_amount'] = $product_account_mst_info->net_amount
                +$value->quantity;
                $product_account_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['updated_by'] = $login_info->users_id;
                $product_account_mst_data['updated_name'] = $login_info->name;
                $product_account_mst_data['updated_user_agent'] = $this->customlib->load_agent();
                $product_account_mst_data['updated_ip'] = $this->input->ip_address();
    
                $product_account_mst_where['finyear_id'] = $finyear_info->finyear_id;
                $product_account_mst_where['store_id'] = $login_info->store_id;
                $product_account_mst_where['supplier_id'] = $purchase_return_mst_info->supplier_id;           
                /*$product_account_mst_where['brand_id'] = $product_full_info->brand_id;
                $product_account_mst_where['category1_id'] = $product_full_info->category1_id;
                $product_account_mst_where['category2_id'] = $product_full_info->category2_id;
                $product_account_mst_where['category3_id'] = $product_full_info->category3_id;
                $product_account_mst_where['category4_id'] = $product_full_info->category4_id;*/
                $product_account_mst_where['product_id'] = $value->product_id;
                $product_account_mst_where['product_account_mst_id'] = $product_account_mst_info->product_account_mst_id;

                $this->ProductAccountMstModel->modify($product_account_mst_data, $product_account_mst_where);

                $product_account_det_data['is_cancel'] = '1';
                $product_account_det_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
                $product_account_det_data['cancel_reason'] = $this->input->post('cancel_reason');
                $product_account_det_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_det_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_det_data['updated_by'] = $login_info->users_id;
                $product_account_det_data['updated_name'] = $login_info->name;
                $product_account_det_data['updated_user_agent'] = $this->customlib->load_agent();
                $product_account_det_data['updated_ip'] = $this->input->ip_address();
                
                $product_account_det_where['finyear_id'] = $finyear_info->finyear_id;            
                $product_account_det_where['store_id'] = $login_info->store_id;           
                $product_account_det_where['account_id'] = $account_info->account_id;
                $product_account_det_where['product_account_mst_id'] = $product_account_mst_info->product_account_mst_id;
                $product_account_det_where['supplier_id'] = $purchase_return_mst_info->supplier_id;          
                $product_account_det_where['brand_id'] = $product_info->brand_id;
                $product_account_det_where['product_id'] = $product_info->product_id;
                
                $this->ProductAccountDetModel->modify($product_account_det_data, $product_account_det_where);
            }

            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('cancel_confirmation_message'));
            redirect('Supervisor/ManagePurchaseReturn');
        }
    }

    public function prints($purchase_return_mst_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_RETURN, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_prints == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManagePurchaseReturn';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Manage Purchase Return';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $purchase_return_mst_id = base64_decode($purchase_return_mst_id);
        $data['purchase_return_mst_id'] = $purchase_return_mst_id;

        $data['store_info'] = $this->StoreMstModel->get_record($login_info->store_id)['0'];
        
        $data['purchase_return_mst_info'] = $this->PurchaseReturnMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $purchase_return_mst_id)['0'];

        $data['purchase_return_det_info'] = $this->PurchaseReturnDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $purchase_return_mst_id);

        $this->load->view('Supervisor/purchase_return_prints', $data);
    }

    public function purchase_return_validation($required = true) {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('invoice_no', 'Invoice No.', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[20]');
        
        $this->form_validation->set_rules('supplier_id', 'Supplier Name', 'trim|required');
        
        $this->form_validation->set_rules('purchase_return_net_quantity', 'Net Quantity', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_net_mrp', 'Net MRP Price', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_net_rate', 'Net Rate', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_total_cgst', 'Total CGST', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_total_sgst', 'Total SGST', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_total_igst', 'Total IGST', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_transport_charges', 'Transport Charges', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_other_charges', 'Other Charges', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_net_amount', 'Net Amount', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_adjustment', 'Adjustment', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('purchase_return_grand_total', 'Grand Total', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[255]');
    }

    public function cancel_validation($required = true) {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('cancel_date', 'Date', 'trim|max_length[20]');
        $this->form_validation->set_rules('cancel_reason', 'Reason', 'trim|required');
    }

    public function ajaxRequestPost()
    {
        $session['purchase_return_details'] = $this->session->userdata('purchase_return_details');

        $purchase_return_details = $this->session->userdata('purchase_return_details');
        $found = false;
        for ($counter = 0; $counter < count($purchase_return_details); $counter++) {
            /*if (($this->input->post('purchase_return_product_id') == $sales_details[$counter]['product_id'])
            && ($this->input->post('batch_no') == $sales_details[$counter]['batch_no'])
            && ($this->input->post('mrp') == $sales_details[$counter]['mrp'])
            && ($this->input->post('rate') == $sales_details[$counter]['rate'])
            ) {*/
            if ($this->input->post('product_id') == $purchase_return_details[$counter]['product_id']) {
                $found = true;
                $ss = $counter;
                break;
            }
        }
        if ($found) {
            $session['purchase_return_details'][$ss]['quantity'] += $this->input->post('quantity');

        } else {
            $session['purchase_return_details'][] = array(
                'product_code' => $this->input->post('product_code'),
                'product_name' => $this->input->post('product_name'),
                'product_id' => $this->input->post('product_id'),
                'mfg_date' => $this->input->post('mfg_date'),
                'expiry_date' => $this->input->post('expiry_date'),
                'batch_no' => $this->input->post('batch_no'),
                'quantity' => $this->input->post('quantity'),
                'packing_title' => $this->input->post('packing_title'),
                'mrp' => $this->input->post('mrp'),
                'rate' => $this->input->post('rate'),
                'total_mrp' => $this->input->post('total_mrp'),
                'total_rate' => $this->input->post('total_rate')
            );
        }

        $this->session->set_userdata($session);
        $purchase_return_details = $this->session->userdata('purchase_return_details');
        for ($counter = 0; $counter < count($purchase_return_details); $counter++) {
            $d = $counter;
        }
        if ($found)
            echo "ddd";
        else
            echo $d;
    }
    
    public function remove_item($item_id)
    {
        //$session['purchase_return_details'][] = array();

        $purchase_return_details = $this->session->userdata('purchase_return_details');
        for ($counter = 0; $counter < count($purchase_return_details); $counter++) {
            if ($counter != $item_id) {
                $session['purchase_return_details'][] = array(
                    'product_code' => $purchase_return_details[$counter]['product_code'],
                    'product_name' => $purchase_return_details[$counter]['product_name'],
                    'product_id' => $purchase_return_details[$counter]['product_id'],
                    'mfg_date' => $purchase_return_details[$counter]['mfg_date'],
                    'expiry_date' => $purchase_return_details[$counter]['expiry_date'],
                    'batch_no' => $purchase_return_details[$counter]['batch_no'],
                    'quantity' => $purchase_return_details[$counter]['quantity'],
                    'packing_title' => $purchase_return_details[$counter]['packing_title'],
                    'mrp' => $purchase_return_details[$counter]['mrp'],
                    'rate' => $purchase_return_details[$counter]['rate'],
                    'total_mrp' => $purchase_return_details[$counter]['total_mrp'],
                    'total_rate' => $purchase_return_details[$counter]['total_rate']
                );
            }
        }
        $this->session->unset_userdata('purchase_return_details');
        $this->session->set_userdata($session);

        redirect(base_url('Supervisor/ManagePurchaseReturn/add'));
    }
    
    
    public function ajaxRequestRemove()
    {
        $item_id = $this->input->post('purchase_return_product_code');
        $purchase_return_details = $this->session->userdata('purchase_return_details');
        for ($counter = 0; $counter < count($purchase_return_details); $counter++) {
            if ($counter != $item_id) {
                $session['purchase_return_details'][] = array(
                    'product_code' => $purchase_return_details[$counter]['product_code'],
                    'product_name' => $purchase_return_details[$counter]['product_name'],
                    'product_id' => $purchase_return_details[$counter]['product_id'],
                    'mfg_date' => $purchase_return_details[$counter]['mfg_date'],
                    'expiry_date' => $purchase_return_details[$counter]['expiry_date'],
                    'batch_no' => $purchase_return_details[$counter]['batch_no'],
                    'quantity' => $purchase_return_details[$counter]['quantity'],
                    'packing_title' => $purchase_return_details[$counter]['packing_title'],
                    'mrp' => $purchase_return_details[$counter]['mrp'],
                    'rate' => $purchase_return_details[$counter]['rate'],
                    'total_mrp' => $purchase_return_details[$counter]['total_mrp'],
                    'total_rate' => $purchase_return_details[$counter]['total_rate']
                );
            }
        }
        $this->session->unset_userdata('purchase_return_details');
        $this->session->set_userdata($session);
    }
}
