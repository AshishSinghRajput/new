<?php defined('BASEPATH') or exit('No direct script access allowed');

class ChangePrice extends CI_Controller {

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

        $main_menu['active'] = 'ChangePrice';
        $this->session->set_userdata($main_menu);

        $topbar = 'Change Price';

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['price_mst_info'] = $this->PriceMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, IS_NOT_DEFINE_SALES);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/change_price_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($price_mst_id)
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

        $main_menu['active'] = 'ChangePrice';
        $this->session->set_userdata($main_menu);

        $topbar = 'Change Price';

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $price_mst_id = base64_decode($price_mst_id);
        $data['price_mst_id'] = $price_mst_id;

        $data['price_mst_info'] = $this->PriceMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, IS_NOT_DEFINE_SALES, $price_mst_id)['0'];

        $data['price_det_info'] = $this->PriceDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $price_mst_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/change_price_view', $data);
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

        $main_menu['active'] = 'ChangePrice';
        $this->session->set_userdata($main_menu);

        $topbar = 'Change Price';

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['supplier_list'] = $this->SupplierMstModel->get_select($login_info->store_id);
        
        $this->price_validation(false);
        if ($this->form_validation->run() == false) {
            if (!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/change_price_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/change_price_add', $data);
                $this->load->view('layout/footer', $data);

            }
        } else {

            $invoice_no_info = $this->PriceMstModel->get_count($finyear_info->finyear_id, $login_info->store_id)['0'];
            $invoice_no = $invoice_no_info->total;

            $change_price_details = $this->session->userdata('change_price_details');

            $total_quantity = 0;
            $total_mrp = 0;
            $total_rate = 0;
            $total_new_rate = 0;

            $total_cgst = 0;
            $total_sgst = 0;
            $total_igst = 0;
            $transport_charges = 0;
            $other_charges = 0;
            $net_amount = 0;
            $adjustment = 0;
            $grand_total = 0;
            $grand_total = 0;

            for ($counter = 0; $counter < count($change_price_details); $counter++) {
                $product_info = $this->ProductMstModel->get_autocomplete($finyear_info->finyear_id, $login_info->store_id, '', $change_price_details[$counter]['product_id'])['0'];
                
                $total_quantity = $total_quantity + $change_price_details[$counter]['quantity'];
                $total_mrp = $total_mrp + ($change_price_details[$counter]['quantity']*$change_price_details[$counter]['mrp']);
                
                $rate = $change_price_details[$counter]['quantity']*$change_price_details[$counter]['rate'];
                $total_rate = $total_rate + $rate;
                
                $new_rate = $change_price_details[$counter]['quantity']*$change_price_details[$counter]['new_rate'];
                $total_new_rate = $total_new_rate + $new_rate;
                
                $gst_amount = $this->customlib->calculate_gst($new_rate, $product_info->igst_taxes_value);
                
                $cgst_amount = round($gst_amount/2, 2);
                $total_cgst = $total_cgst+$cgst_amount;

                $sgst_amount = round($gst_amount/2, 2);
                $total_sgst = $total_sgst+$sgst_amount;

                $igst_amount = round($gst_amount, 2);
                $total_igst = $total_igst+$igst_amount;

                //$rate = round($change_price_details[$counter]['rate']-$gst_amount, 2);
                //$total_rate = $total_rate + ($change_price_details[$counter]['quantity']*$change_price_details[$counter]['rate']);
            }
            
            $transport_charges = $this->input->post('price_transport_charges');
            $other_charges = $this->input->post('price_other_charges');

            $net_amount = $total_new_rate+$total_igst;
            $net_amount = $net_amount+$transport_charges;
            $net_amount = $net_amount+$other_charges; //$this->input->post('price_net_amount');

            $adjustment = $this->input->post('price_adjustment');
            $grand_total = $net_amount+$adjustment; //$this->input->post('price_grand_total');
            
            $round_off = round($grand_total, 0);

            $this->db->trans_start();

            $price_mst_data['is_credit'] = IS_NOT_DEFINE_SALES;
            $price_mst_data['invoice_no'] = $invoice_no;
            $price_mst_data['date'] = $this->customlib->get_YYYYMMDD($this->input->post('date'));
            $price_mst_data['store_id'] = $login_info->store_id;
            $price_mst_data['total_quantity'] = $total_quantity;
            $price_mst_data['total_mrp'] = $total_mrp;
            $price_mst_data['total_rate'] = $total_rate;
            $price_mst_data['total_new_rate'] = $total_new_rate;
            $price_mst_data['total_cgst'] = $total_cgst;
            $price_mst_data['total_sgst'] = $total_sgst;
            $price_mst_data['total_igst'] = $total_igst;
            $price_mst_data['transport_charges'] = $transport_charges;
            $price_mst_data['other_charges'] = $other_charges;
            $price_mst_data['net_amount'] = $net_amount;
            $price_mst_data['adjustment'] = $adjustment;
            $price_mst_data['grand_total'] = $grand_total;
            $price_mst_data['round_off'] = $round_off;
            $price_mst_data['amount_word'] = $this->customlib->number_words($round_off);
            $price_mst_data['remarks'] = $this->input->post('remarks');
            $price_mst_data['status_id'] = 'Pending';
            $price_mst_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $price_mst_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $price_mst_data['is_cancel'] = '0';
            $price_mst_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $price_mst_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $price_mst_data['finyear_id'] = $finyear_info->finyear_id; 
            $price_mst_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $price_mst_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $price_mst_data['created_by'] = $login_info->users_id;
            $price_mst_data['created_name'] = $login_info->name;
            $price_mst_data['created_user_agent'] = $this->customlib->load_agent();
            $price_mst_data['created_ip'] = $this->input->ip_address();

            $price_mst_id = $this->PriceMstModel->add($price_mst_data);            

            for ($counter = 0; $counter < count($change_price_details); $counter++) {

                $product_info = $this->ProductMstModel->get_autocomplete($finyear_info->finyear_id, $login_info->store_id, '', $change_price_details[$counter]['product_id'])['0'];
                
                $product_full_info = $this->ProductMstModel->get_full_record($change_price_details[$counter]['product_id'])['0'];

                $total_mrp = $change_price_details[$counter]['quantity']*$change_price_details[$counter]['mrp'];
                $total_rate = $change_price_details[$counter]['quantity']*$change_price_details[$counter]['rate'];                
                $total_new_rate = $change_price_details[$counter]['quantity']*$change_price_details[$counter]['new_rate'];
                
                $gst_amount = $this->customlib->calculate_gst($total_new_rate, $product_info->igst_taxes_value);
                
                $cgst_amount = round($gst_amount/2, 2);
                
                $sgst_amount = round($gst_amount/2, 2);
                
                $igst_amount = round($gst_amount, 2);

                $total_amount = $total_rate+$igst_amount;

                $price_det_data['store_id'] = $login_info->store_id;
                $price_det_data['price_mst_id'] = $price_mst_id;
                $price_det_data['product_id'] = $change_price_details[$counter]['product_id'];
                $price_det_data['product_code'] = $product_info->product_code;
                $price_det_data['product_heading'] = $product_info->heading;
                $price_det_data['quantity'] = $change_price_details[$counter]['quantity'];
                $price_det_data['packing_id'] = $product_info->packing_id;   
                $price_det_data['packing_title'] = $product_info->packing_title; 
                $price_det_data['unit_id'] = $product_info->unit_id;   
                $price_det_data['unit_title'] = $product_info->unit_title; 
                $price_det_data['mfg_date'] = $this->customlib->get_YYYYMMDD($change_price_details[$counter]['mfg_date']);
                $price_det_data['expiry_date'] = $this->customlib->get_YYYYMMDD($change_price_details[$counter]['expiry_date']);
                $price_det_data['batch_no'] = $change_price_details[$counter]['batch_no'];
                $price_det_data['mrp_price'] = $change_price_details[$counter]['mrp'];
                $price_det_data['rate'] = $change_price_details[$counter]['rate'];
                $price_det_data['new_rate'] = $change_price_details[$counter]['new_rate'];
                $price_det_data['total_mrp'] = $total_mrp; //$change_price_details[$counter]['total_mrp'];
                $price_det_data['total_rate'] = $total_rate; //$change_price_details[$counter]['total_rate'];
                $price_det_data['total_new_rate'] = $total_new_rate; //$change_price_details[$counter]['total_rate'];
                $price_det_data['cgst'] = $cgst_amount; //$change_price_details[$counter]['total_rate'];
                $price_det_data['sgst'] = $sgst_amount; //$change_price_details[$counter]['total_rate'];
                $price_det_data['igst'] = $igst_amount; //$change_price_details[$counter]['total_rate'];
                $price_det_data['total_amount'] = $total_amount;
                $price_det_data['is_cancel'] = '0';
                $price_det_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $price_det_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
                $price_det_data['finyear_id'] = $finyear_info->finyear_id; 
                $price_det_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $price_det_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $price_det_data['created_by'] = $login_info->users_id;
                $price_det_data['created_name'] = $login_info->name;
                $price_det_data['created_user_agent'] = $this->customlib->load_agent();
                $price_det_data['created_ip'] = $this->input->ip_address();
    
                $price_det_id = $this->PriceDetModel->add($price_det_data);                
            }

            $this->db->trans_complete();

            if (($price_mst_id > 0) && ($price_det_id > 0)) {                
                $this->session->unset_userdata('change_price_details');

                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Supervisor/ChangePrice');
            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Supervisor/ChangePrice/add');
            }            
        }
    }

    public function cancel($price_mst_id) {
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
        
        $main_menu['active'] = 'ChangePrice';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Change Price';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $price_mst_id = base64_decode($price_mst_id);
        $data['price_mst_id'] = $price_mst_id;
        
        $this->cancel_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {        
                $price_mst_info = $this->PriceMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, IS_NOT_DEFINE_SALES, $price_mst_id)['0'];
                $data['price_mst_info'] = $price_mst_info;        
                $data['price_det_info'] = $this->PriceDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $price_mst_id);
                if ($price_mst_info->is_cancel == '1') {
                    $this->session->set_flashdata('error_msg', $this->lang->line('cancel_error_message'));
                    redirect('Supervisor/ChangePrice');

                } else {
                    $this->load->view('layout/header', $data);
                    $this->load->view('Supervisor/change_price_cancel', $data);
                    $this->load->view('layout/footer', $data);

                }

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/change_price_cancel', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {

            $price_mst_info = $this->PriceMstModel->get_record($finyear_info->finyear_id,$login_info->store_id, IS_NOT_DEFINE_SALES, $price_mst_id)['0'];

            $price_det_info = $this->PriceDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $price_mst_id);

            $this->db->trans_start();

            $price_mst_data['is_cancel'] = '1';
            $price_mst_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
            $price_mst_data['cancel_reason'] = $this->input->post('cancel_reason');
            $price_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $price_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $price_mst_data['updated_by'] = $login_info->users_id;
            $price_mst_data['updated_name'] = $login_info->name;
            $price_mst_data['updated_user_agent'] = $this->customlib->load_agent();
            $price_mst_data['updated_ip'] = $this->input->ip_address();
            
            $price_mst_where['finyear_id'] = $finyear_info->finyear_id; 
            $price_mst_where['store_id'] = $login_info->store_id;
            $price_mst_where['supplier_id'] = $price_mst_info->supplier_id;
            $price_mst_where['price_mst_id'] = $price_mst_id;
            
            $this->PriceMstModel->modify($price_mst_data, $price_mst_where);

            foreach ($price_det_info as $value) {
                
                $price_det_data['is_cancel'] = '1';
                $price_det_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
                $price_det_data['cancel_reason'] = $this->input->post('cancel_reason');
                $price_det_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $price_det_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $price_det_data['updated_by'] = $login_info->users_id;
                $price_det_data['updated_name'] = $login_info->name;
                $price_det_data['updated_user_agent'] = $this->customlib->load_agent();
                $price_det_data['updated_ip'] = $this->input->ip_address();
                
                $price_det_where['finyear_id'] = $finyear_info->finyear_id; 
                $price_det_where['store_id'] = $login_info->store_id;
                /*$price_det_where['supplier_id'] = $price_det_info->supplier_id;*/
                $price_det_where['price_mst_id'] = $price_mst_id;
                $price_det_where['price_det_id'] = $value->price_det_id;
                
                $this->PriceDetModel->modify($price_det_data, $price_det_where);                
            }

            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('cancel_confirmation_message'));
            redirect('Supervisor/ChangePrice');
        }
    }

    public function prints($price_mst_id) {
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
        
        $main_menu['active'] = 'ChangePrice';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Change Price';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $price_mst_id = base64_decode($price_mst_id);
        $data['price_mst_id'] = $price_mst_id;

        $data['store_info'] = $this->StoreMstModel->get_record($login_info->store_id)['0'];
        
        $data['price_mst_info'] = $this->PriceMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, IS_NOT_DEFINE_SALES, $price_mst_id)['0'];

        $data['price_det_info'] = $this->PriceDetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $price_mst_id);

        $this->load->view('Supervisor/change_price_prints', $data);
    }

    public function price_validation($required = true) {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('invoice_no', 'Invoice No.', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[20]');
        
        $this->form_validation->set_rules('price_net_quantity', 'Net Quantity', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_net_mrp', 'Net MRP Price', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_net_rate', 'Net Old Rate', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_net_new_rate', 'Net New Rate', 'trim|required|numeric|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('price_total_cgst', 'Total CGST', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_total_sgst', 'Total SGST', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_total_igst', 'Total IGST', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_transport_charges', 'Transport Charges', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_other_charges', 'Other Charges', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_net_amount', 'Net Amount', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_adjustment', 'Adjustment', 'trim|required|numeric|min_length[1]|max_length[10]'); 
        $this->form_validation->set_rules('price_grand_total', 'Grand Total', 'trim|required|numeric|min_length[1]|max_length[10]'); 
                
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
        $session['change_price_details'] = $this->session->userdata('change_price_details');

        $change_price_details = $this->session->userdata('change_price_details');
        $found = false;
        for ($counter = 0; $counter < count($change_price_details); $counter++) {
            /*if (($this->input->post('price_product_id') == $change_price_details[$counter]['product_id'])
            && ($this->input->post('batch_no') == $change_price_details[$counter]['batch_no'])
            && ($this->input->post('mrp') == $change_price_details[$counter]['mrp'])
            && ($this->input->post('rate') == $change_price_details[$counter]['rate'])
            ) {*/
            if ($this->input->post('product_id') == $change_price_details[$counter]['product_id']) {
                $found = true;
                $ss = $counter;
                break;
            }
        }
        if ($found) {
            $session['change_price_details'][$ss]['quantity'] += $this->input->post('quantity');

        } else {
            $session['change_price_details'][] = array(
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
                'new_rate' => $this->input->post('new_rate'),
                'total_mrp' => $this->input->post('total_mrp'),
                'total_rate' => $this->input->post('total_rate'),
                'total_new_rate' => $this->input->post('total_new_rate')
            );
        }

        $this->session->set_userdata($session);
        $change_price_details = $this->session->userdata('change_price_details');
        for ($counter = 0; $counter < count($change_price_details); $counter++) {
            $d = $counter;
        }
        if ($found)
            echo "ddd";
        else
            echo $d;
    }
    
    public function remove_item($item_id)
    {
        //$session['change_price_details'][] = array();

        $change_price_details = $this->session->userdata('change_price_details');
        for ($counter = 0; $counter < count($change_price_details); $counter++) {
            if ($counter != $item_id) {
                $session['change_price_details'][] = array(
                    'product_code' => $change_price_details[$counter]['product_code'],
                    'product_name' => $change_price_details[$counter]['product_name'],
                    'product_id' => $change_price_details[$counter]['product_id'],
                    'mfg_date' => $change_price_details[$counter]['mfg_date'],
                    'expiry_date' => $change_price_details[$counter]['expiry_date'],
                    'batch_no' => $change_price_details[$counter]['batch_no'],
                    'quantity' => $change_price_details[$counter]['quantity'],
                    'packing_title' => $change_price_details[$counter]['packing_title'],
                    'mrp' => $change_price_details[$counter]['mrp'],
                    'rate' => $change_price_details[$counter]['rate'],
                    'new_rate' => $change_price_details[$counter]['new_rate'],
                    'total_mrp' => $change_price_details[$counter]['total_mrp'],
                    'total_rate' => $change_price_details[$counter]['total_rate'],
                    'total_new_rate' => $change_price_details[$counter]['total_new_rate']
                );
            }
        }
        $this->session->unset_userdata('change_price_details');
        $this->session->set_userdata($session);

        redirect(base_url('Supervisor/ChangePrice/add'));
    }
    
    
    public function ajaxRequestRemove()
    {
        $item_id = $this->input->post('price_product_code');
        $change_price_details = $this->session->userdata('change_price_details');
        for ($counter = 0; $counter < count($change_price_details); $counter++) {
            if ($counter != $item_id) {
                $session['change_price_details'][] = array(
                    'product_code' => $change_price_details[$counter]['product_code'],
                    'product_name' => $change_price_details[$counter]['product_name'],
                    'product_id' => $change_price_details[$counter]['product_id'],
                    'mfg_date' => $change_price_details[$counter]['mfg_date'],
                    'expiry_date' => $change_price_details[$counter]['expiry_date'],
                    'batch_no' => $change_price_details[$counter]['batch_no'],
                    'quantity' => $change_price_details[$counter]['quantity'],
                    'packing_title' => $change_price_details[$counter]['packing_title'],
                    'mrp' => $change_price_details[$counter]['mrp'],
                    'rate' => $change_price_details[$counter]['rate'],
                    'new_rate' => $change_price_details[$counter]['new_rate'],
                    'total_mrp' => $change_price_details[$counter]['total_mrp'],
                    'total_rate' => $change_price_details[$counter]['total_rate'],
                    'total_new_rate' => $change_price_details[$counter]['total_new_rate']
                );
            }
        }
        $this->session->unset_userdata('change_price_details');
        $this->session->set_userdata($session);
    }
}
