<?php defined('BASEPATH') or exit('No direct script access allowed');

class TransferStock extends CI_Controller {

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

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'TransferStock';
        $this->session->set_userdata($main_menu);

        $topbar = 'Transfer Stock';

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['transfer_stock_mst_info'] = $this->TransferStockMstModel->get_record($finyear_info->finyear_id, $login_info->store_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/transfer_stock_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($transfer_stock_mst_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'TransferStock';
        $this->session->set_userdata($main_menu);

        $topbar = 'Transfer Stock';

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $transfer_stock_mst_id = base64_decode($transfer_stock_mst_id);
        $data['transfer_stock_mst_id'] = $transfer_stock_mst_id;

        $data['transfer_stock_mst_info'] = $this->TransferStockMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $transfer_stock_mst_id)['0'];

        $data['transfer_stock_det_info'] = $this->TransferStockDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $transfer_stock_mst_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/transfer_stock_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add() {
        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $store_id = $login_info->store_id;
        $finance_id = $finyear_info->finyear_id;

        $main_menu['active'] = 'TransferStock';
        $this->session->set_userdata($main_menu);

        $topbar = 'Transfer Stock';

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['stock_location_list'] = $this->StockLocationMstModel->get_record($login_info->store_id);
        
        $this->transfer_stock_validation(false);
        if ($this->form_validation->run() == false) {
            if (!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/transfer_stock_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/transfer_stock_add', $data);
                $this->load->view('layout/footer', $data);

            }
        } else {

            $invoice_no_info = $this->TransferStockMstModel->get_count($finyear_info->finyear_id, $login_info->store_id)['0'];
            $invoice_no = $invoice_no_info->total;

            $transfer_stock_details = $this->session->userdata('transfer_stock_details');

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

            for ($counter = 0; $counter < count($transfer_stock_details); $counter++) {
                $product_info = $this->ProductMstModel->get_autocomplete($finyear_info->finyear_id, $login_info->store_id, '', $transfer_stock_details[$counter]['product_id'])['0'];
                
                $total_quantity = $total_quantity + $transfer_stock_details[$counter]['quantity'];
                $total_mrp = $total_mrp + ($transfer_stock_details[$counter]['quantity']*$transfer_stock_details[$counter]['mrp']);
                
                $rate = $transfer_stock_details[$counter]['quantity']*$transfer_stock_details[$counter]['rate'];
                $total_rate = $total_rate + $rate;
                
                $gst_amount = $this->customlib->calculate_gst($rate, $product_info->igst_taxes_value);
                
                $cgst_amount = round($gst_amount/2, 2);
                $total_cgst = $total_cgst+$cgst_amount;

                $sgst_amount = round($gst_amount/2, 2);
                $total_sgst = $total_sgst+$sgst_amount;

                $igst_amount = round($gst_amount, 2);
                $total_igst = $total_igst+$igst_amount;

                //$rate = round($transfer_stock_details[$counter]['rate']-$gst_amount, 2);
                //$total_rate = $total_rate + ($transfer_stock_details[$counter]['quantity']*$transfer_stock_details[$counter]['rate']);
            }
            
            $transport_charges = $this->input->post('transfer_stock_transport_charges');
            $other_charges = $this->input->post('transfer_stock_other_charges');

            $net_amount = $total_rate+$total_igst;
            $net_amount = $net_amount+$transport_charges;
            $net_amount = $net_amount+$other_charges; //$this->input->post('transfer_stock_net_amount');

            $adjustment = $this->input->post('transfer_stock_adjustment');
            $grand_total = $net_amount+$adjustment; //$this->input->post('transfer_stock_grand_total');
            
            $round_off = round($grand_total, 0);

            $this->db->trans_start();

            $transfer_stock_mst_data['is_credit'] = IS_CREDIT_SALES;
            $transfer_stock_mst_data['invoice_no'] = $invoice_no;
            $transfer_stock_mst_data['date'] = $this->customlib->get_YYYYMMDD($this->input->post('date'));
            $transfer_stock_mst_data['store_id'] = $login_info->store_id;
            $transfer_stock_mst_data['from_location_id'] = $this->input->post('from_location_id');
            $transfer_stock_mst_data['to_location_id'] = $this->input->post('to_location_id');
            $transfer_stock_mst_data['total_quantity'] = $total_quantity;
            $transfer_stock_mst_data['total_mrp'] = $total_mrp;
            $transfer_stock_mst_data['total_rate'] = $total_rate;
            $transfer_stock_mst_data['total_cgst'] = $total_cgst;
            $transfer_stock_mst_data['total_sgst'] = $total_sgst;
            $transfer_stock_mst_data['total_igst'] = $total_igst;
            $transfer_stock_mst_data['transport_charges'] = $transport_charges;
            $transfer_stock_mst_data['other_charges'] = $other_charges;
            $transfer_stock_mst_data['net_amount'] = $net_amount;
            $transfer_stock_mst_data['adjustment'] = $adjustment;
            $transfer_stock_mst_data['grand_total'] = $grand_total;
            $transfer_stock_mst_data['round_off'] = $round_off;
            $transfer_stock_mst_data['amount_word'] = $this->customlib->number_words($round_off);
            $transfer_stock_mst_data['is_receipt'] = '0'; 
            $transfer_stock_mst_data['receipt_mst_id'] = '0';
            $transfer_stock_mst_data['receivedby_id'] = $this->input->post('receivedby_id');
            $transfer_stock_mst_data['remarks'] = $this->input->post('remarks');
            $transfer_stock_mst_data['status_id'] = 'Pending';
            $transfer_stock_mst_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $transfer_stock_mst_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $transfer_stock_mst_data['is_cancel'] = '0';
            $transfer_stock_mst_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $transfer_stock_mst_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $transfer_stock_mst_data['finyear_id'] = $finyear_info->finyear_id; 
            $transfer_stock_mst_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $transfer_stock_mst_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $transfer_stock_mst_data['created_by'] = $login_info->users_id;
            $transfer_stock_mst_data['created_name'] = $login_info->name;
            $transfer_stock_mst_data['created_user_agent'] = $this->customlib->load_agent();
            $transfer_stock_mst_data['created_ip'] = $this->input->ip_address();

            $transfer_stock_mst_id = $this->TransferStockMstModel->add($transfer_stock_mst_data);

            for ($counter = 0; $counter < count($transfer_stock_details); $counter++) {

                $product_info = $this->ProductMstModel->get_autocomplete($finyear_info->finyear_id, $login_info->store_id, '', $transfer_stock_details[$counter]['product_id'])['0'];
                
                $product_full_info = $this->ProductMstModel->get_full_record($transfer_stock_details[$counter]['product_id'])['0'];

                $total_rate = $transfer_stock_details[$counter]['quantity']*$rate;

                $gst_amount = $this->customlib->calculate_gst($total_rate, $product_info->igst_taxes_value);
                
                $cgst_amount = round($gst_amount/2, 2);
                
                $sgst_amount = round($gst_amount/2, 2);
                
                $igst_amount = round($gst_amount, 2);

                $total_amount = $total_rate+$igst_amount;

                $transfer_stock_det_data['store_id'] = $login_info->store_id;
                $transfer_stock_det_data['transfer_stock_mst_id'] = $transfer_stock_mst_id;
                $transfer_stock_det_data['product_id'] = $transfer_stock_details[$counter]['product_id'];
                $transfer_stock_det_data['product_code'] = $product_info->product_code;
                $transfer_stock_det_data['product_heading'] = $product_info->heading;
                $transfer_stock_det_data['quantity'] = $transfer_stock_details[$counter]['quantity'];
                $transfer_stock_det_data['packing_id'] = $product_info->packing_id;   
                $transfer_stock_det_data['packing_title'] = $product_info->packing_title; 
                $transfer_stock_det_data['unit_id'] = $product_info->unit_id;   
                $transfer_stock_det_data['unit_title'] = $product_info->unit_title; 
                $transfer_stock_det_data['mfg_date'] = $this->customlib->get_YYYYMMDD($transfer_stock_details[$counter]['mfg_date']);
                $transfer_stock_det_data['expiry_date'] = $this->customlib->get_YYYYMMDD($transfer_stock_details[$counter]['expiry_date']);
                $transfer_stock_det_data['batch_no'] = $transfer_stock_details[$counter]['batch_no'];
                $transfer_stock_det_data['mrp_price'] = $transfer_stock_details[$counter]['mrp'];
                $transfer_stock_det_data['rate'] = $rate; //$transfer_stock_details[$counter]['rate'];
                $transfer_stock_det_data['total_mrp'] = $transfer_stock_details[$counter]['total_mrp'];
                $transfer_stock_det_data['total_rate'] = $total_rate; //$transfer_stock_details[$counter]['total_rate'];
                $transfer_stock_det_data['cgst'] = $cgst_amount; //$transfer_stock_details[$counter]['total_rate'];
                $transfer_stock_det_data['sgst'] = $sgst_amount; //$transfer_stock_details[$counter]['total_rate'];
                $transfer_stock_det_data['igst'] = $igst_amount; //$transfer_stock_details[$counter]['total_rate'];
                $transfer_stock_det_data['total_amount'] = $total_amount;
                $transfer_stock_det_data['is_cancel'] = '0';
                $transfer_stock_det_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $transfer_stock_det_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
                $transfer_stock_det_data['finyear_id'] = $finyear_info->finyear_id; 
                $transfer_stock_det_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $transfer_stock_det_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $transfer_stock_det_data['created_by'] = $login_info->users_id;
                $transfer_stock_det_data['created_name'] = $login_info->name;
                $transfer_stock_det_data['created_user_agent'] = $this->customlib->load_agent();
                $transfer_stock_det_data['created_ip'] = $this->input->ip_address();
    
                $transfer_stock_det_id = $this->TransferStockDetModel->add($transfer_stock_det_data);
            }

            $this->db->trans_complete();

            if (($transfer_stock_mst_id > 0) && ($transfer_stock_det_id > 0)) {                
                $this->session->unset_userdata('transfer_stock_details');

                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Supervisor/TransferStock');
            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Supervisor/TransferStock/add');
            }            
        }
    }

    public function cancel($transfer_stock_mst_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'TransferStock';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Transfer Stock';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $transfer_stock_mst_id = base64_decode($transfer_stock_mst_id);
        $data['transfer_stock_mst_id'] = $transfer_stock_mst_id;
        
        $this->cancel_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {        
                $transfer_stock_mst_info = $this->TransferStockMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $transfer_stock_mst_id)['0'];
                $data['transfer_stock_mst_info'] = $transfer_stock_mst_info;        
                $data['transfer_stock_det_info'] = $this->TransferStockDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $transfer_stock_mst_id);
                if ($transfer_stock_mst_info->is_cancel == '1') {
                    $this->session->set_flashdata('error_msg', $this->lang->line('cancel_error_message'));
                    redirect('Supervisor/TransferStock');

                } else {
                    $this->load->view('layout/header', $data);
                    $this->load->view('Supervisor/transfer_stock_cancel', $data);
                    $this->load->view('layout/footer', $data);

                }

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/transfer_stock_cancel', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {

            $transfer_stock_mst_info = $this->TransferStockMstModel->get_record($finyear_info->finyear_id,$login_info->store_id, $transfer_stock_mst_id)['0'];

            $transfer_stock_det_info = $this->TransferStockDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $transfer_stock_mst_id);

            $this->db->trans_start();

            $transfer_stock_mst_data['is_cancel'] = '1';
            $transfer_stock_mst_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
            $transfer_stock_mst_data['cancel_reason'] = $this->input->post('cancel_reason');
            $transfer_stock_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $transfer_stock_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $transfer_stock_mst_data['updated_by'] = $login_info->users_id;
            $transfer_stock_mst_data['updated_name'] = $login_info->name;
            $transfer_stock_mst_data['updated_user_agent'] = $this->customlib->load_agent();
            $transfer_stock_mst_data['updated_ip'] = $this->input->ip_address();
            
            $transfer_stock_mst_where['finyear_id'] = $finyear_info->finyear_id; 
            $transfer_stock_mst_where['store_id'] = $login_info->store_id;
            $transfer_stock_mst_where['supplier_id'] = $transfer_stock_mst_info->supplier_id;
            $transfer_stock_mst_where['transfer_stock_mst_id'] = $transfer_stock_mst_id;
            
            $this->TransferStockMstModel->modify($transfer_stock_mst_data, $transfer_stock_mst_where);

            foreach ($transfer_stock_det_info as $value) {
                
                $transfer_stock_det_data['is_cancel'] = '1';
                $transfer_stock_det_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
                $transfer_stock_det_data['cancel_reason'] = $this->input->post('cancel_reason');
                $transfer_stock_det_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $transfer_stock_det_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $transfer_stock_det_data['updated_by'] = $login_info->users_id;
                $transfer_stock_det_data['updated_name'] = $login_info->name;
                $transfer_stock_det_data['updated_user_agent'] = $this->customlib->load_agent();
                $transfer_stock_det_data['updated_ip'] = $this->input->ip_address();
                
                $transfer_stock_det_where['finyear_id'] = $finyear_info->finyear_id; 
                $transfer_stock_det_where['store_id'] = $login_info->store_id;
                /*$transfer_stock_det_where['supplier_id'] = $transfer_stock_det_info->supplier_id;*/
                $transfer_stock_det_where['transfer_stock_mst_id'] = $transfer_stock_mst_id;
                $transfer_stock_det_where['transfer_stock_det_id'] = $value->transfer_stock_det_id;
                
                $this->TransferStockDetModel->modify($transfer_stock_det_data, $transfer_stock_det_where);
            }

            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('cancel_confirmation_message'));
            redirect('Supervisor/TransferStock');
        }
    }

    public function prints($transfer_stock_mst_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_prints == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'TransferStock';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Transfer Stock';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $transfer_stock_mst_id = base64_decode($transfer_stock_mst_id);
        $data['transfer_stock_mst_id'] = $transfer_stock_mst_id;

        $data['store_info'] = $this->StoreMstModel->get_record($login_info->store_id)['0'];
        
        $data['transfer_stock_mst_info'] = $this->TransferStockMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $transfer_stock_mst_id)['0'];

        $data['transfer_stock_det_info'] = $this->TransferStockDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $transfer_stock_mst_id);

        $this->load->view('Supervisor/transfer_stock_prints', $data);
    }

    public function transfer_stock_validation($required = true) {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('invoice_no', 'Invoice No.', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[20]');
        
        $this->form_validation->set_rules('from_location_id', 'From Location', 'trim|required');
        $this->form_validation->set_rules('to_location_id', 'To Location', 'trim|required');
        
        $this->form_validation->set_rules('transfer_stock_net_quantity', 'Net Quantity', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_net_mrp', 'Net MRP Price', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_net_rate', 'Net Rate', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_total_cgst', 'Total CGST', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_total_sgst', 'Total SGST', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_total_igst', 'Total IGST', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_transport_charges', 'Transport Charges', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_other_charges', 'Other Charges', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_net_amount', 'Net Amount', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_adjustment', 'Adjustment', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('transfer_stock_grand_total', 'Grand Total', 'trim|required|numeric|min_length[1]|max_length[10]'); 
                
        $this->form_validation->set_rules('receivedby_id', 'Received By', 'trim|max_length[255]');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[255]');
    }

    public function cancel_validation($required = true) {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('cancel_date', 'Date', 'trim|max_length[20]');
        $this->form_validation->set_rules('cancel_reason', 'Reason', 'trim|required');
    }

    public function ajaxRequestPost()
    {
        $session['transfer_stock_details'] = $this->session->userdata('transfer_stock_details');

        $transfer_stock_details = $this->session->userdata('transfer_stock_details');
        $found = false;
        for ($counter = 0; $counter < count($transfer_stock_details); $counter++) {
            /*if (($this->input->post('transfer_stock_product_id') == $transfer_stock_details[$counter]['product_id'])
            && ($this->input->post('batch_no') == $transfer_stock_details[$counter]['batch_no'])
            && ($this->input->post('mrp') == $transfer_stock_details[$counter]['mrp'])
            && ($this->input->post('rate') == $transfer_stock_details[$counter]['rate'])
            ) {*/
            if ($this->input->post('product_id') == $transfer_stock_details[$counter]['product_id']) {
                $found = true;
                $ss = $counter;
                break;
            }
        }
        if ($found) {
            $session['transfer_stock_details'][$ss]['quantity'] += $this->input->post('quantity');

        } else {
            $session['transfer_stock_details'][] = array(
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
        $transfer_stock_details = $this->session->userdata('transfer_stock_details');
        for ($counter = 0; $counter < count($transfer_stock_details); $counter++) {
            $d = $counter;
        }
        if ($found)
            echo "ddd";
        else
            echo $d;
    }
    
    public function remove_item($item_id)
    {
        //$session['transfer_stock_details'][] = array();

        $transfer_stock_details = $this->session->userdata('transfer_stock_details');
        for ($counter = 0; $counter < count($transfer_stock_details); $counter++) {
            if ($counter != $item_id) {
                $session['transfer_stock_details'][] = array(
                    'product_code' => $transfer_stock_details[$counter]['product_code'],
                    'product_name' => $transfer_stock_details[$counter]['product_name'],
                    'product_id' => $transfer_stock_details[$counter]['product_id'],
                    'mfg_date' => $transfer_stock_details[$counter]['mfg_date'],
                    'expiry_date' => $transfer_stock_details[$counter]['expiry_date'],
                    'batch_no' => $transfer_stock_details[$counter]['batch_no'],
                    'quantity' => $transfer_stock_details[$counter]['quantity'],
                    'packing_title' => $transfer_stock_details[$counter]['packing_title'],
                    'mrp' => $transfer_stock_details[$counter]['mrp'],
                    'rate' => $transfer_stock_details[$counter]['rate'],
                    'total_mrp' => $transfer_stock_details[$counter]['total_mrp'],
                    'total_rate' => $transfer_stock_details[$counter]['total_rate']
                );
            }
        }
        $this->session->unset_userdata('transfer_stock_details');
        $this->session->set_userdata($session);

        redirect(base_url('Supervisor/TransferStock/add'));
    }
    
    
    public function ajaxRequestRemove()
    {
        $item_id = $this->input->post('transfer_stock_product_code');
        $transfer_stock_details = $this->session->userdata('transfer_stock_details');
        for ($counter = 0; $counter < count($transfer_stock_details); $counter++) {
            if ($counter != $item_id) {
                $session['transfer_stock_details'][] = array(
                    'product_code' => $transfer_stock_details[$counter]['product_code'],
                    'product_name' => $transfer_stock_details[$counter]['product_name'],
                    'product_id' => $transfer_stock_details[$counter]['product_id'],
                    'mfg_date' => $transfer_stock_details[$counter]['mfg_date'],
                    'expiry_date' => $transfer_stock_details[$counter]['expiry_date'],
                    'batch_no' => $transfer_stock_details[$counter]['batch_no'],
                    'quantity' => $transfer_stock_details[$counter]['quantity'],
                    'packing_title' => $transfer_stock_details[$counter]['packing_title'],
                    'mrp' => $transfer_stock_details[$counter]['mrp'],
                    'rate' => $transfer_stock_details[$counter]['rate'],
                    'total_mrp' => $transfer_stock_details[$counter]['total_mrp'],
                    'total_rate' => $transfer_stock_details[$counter]['total_rate']
                );
            }
        }
        $this->session->unset_userdata('transfer_stock_details');
        $this->session->set_userdata($session);
    }
}
