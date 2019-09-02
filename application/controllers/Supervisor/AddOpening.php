<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AddOpening extends CI_Controller {
    
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
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_ADD_OPENING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = '';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Add Opening";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;

        $data['supplier_list'] = $this->SupplierMstModel->get_select($login_info->store_id);
        
        $data['brand_list'] = $this->BrandMstModel->get_is_store_select();

        /*$data['category1_list'] = $this->CategoryMstModel->get_is_store_select('0');*/

        $data['unit_list'] = $this->UnitMstModel->get_select();

        $data['cgst_taxes_list'] = $this->TaxesMstModel->get_select('1');
        $data['sgst_taxes_list'] = $this->TaxesMstModel->get_select('2');
        $data['igst_taxes_list'] = $this->TaxesMstModel->get_select('3');
        
        $this->checked_received_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/opening_balance_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                if($this->input->post('category1_id') != '') {
                    $data['category2_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category1_id'));	
                }

                /*if($this->input->post('category1_id') != '') {
                    $data['category2_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category1_id'));	
                }

                if($this->input->post('category2_id') != '') {
                    $data['category3_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category2_id'));	
                }

                if($this->input->post('category3_id') != '') {
                    $data['category4_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category3_id'));	
                }*/

                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/opening_balance_add', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {

            $total_opening = 0;
            $total_stock = 0;
            $account_mst_info = $this->ProductAccountMstModel->get_record(
                $login_info->store_id,
                '', //$this->input->post('supplier_id'),
                $this->input->post('brand_id'),
                $this->input->post('product_id'));

            if(!empty($account_mst_info)) {
                $total_opening = $account_mst_info['0']->opening;
                $total_stock = $account_mst_info['0']->net_amount;
            }
            
            $account_info = $this->AccountMstModel->get_record(ACCOUNT_OPENING_BALANCE)['0'];
            $stock_location_info = $this->StockLocationMstModel->get_record($login_info->store_id)['0'];
            $product_info = $this->ProductMstModel->get_full_record($this->input->post('product_id'))['0'];

            $product_account_mst_id = 0;
            $this->db->trans_start();
            if(!empty($account_mst_info)) {
                $product_account_mst_id = $account_mst_info['0']->product_account_mst_id;

                $total_opening = $account_mst_info['0']->opening;
                $total_stock = $account_mst_info['0']->net_amount;

                $product_account_mst_data['store_id'] = $login_info->store_id;
                $product_account_mst_data['supplier_id'] = $this->input->post('supplier_id');           
                $product_account_mst_data['brand_id'] = $this->input->post('brand_id');
                $product_account_mst_data['category1_id'] = $product_info->category1_id;
                $product_account_mst_data['category2_id'] = $product_info->category2_id;
                $product_account_mst_data['category3_id'] = $product_info->category3_id;
                $product_account_mst_data['category4_id'] = $product_info->category4_id;
                $product_account_mst_data['product_id'] = $this->input->post('product_id');                
                $product_account_mst_data['min_qty'] = $this->input->post('min_qty');
                $product_account_mst_data['opening'] = $total_opening+$this->input->post('quantity');
                $product_account_mst_data['net_amount'] = $total_stock+$this->input->post('quantity');
                $product_account_mst_data['finyear_id'] = $finyear_info->finyear_id;
                $product_account_mst_data['display'] = $this->input->post('display');
                $product_account_mst_data['priority'] = $this->input->post('priority');
                $product_account_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['updated_by'] = $login_info->users_id;
                $product_account_mst_data['updated_name'] = $login_info->name;
                $product_account_mst_data['updated_user_agent'] = $this->customlib->load_agent();
                $product_account_mst_data['updated_ip'] = $this->input->ip_address();
    
                $product_account_mst_where['store_id'] = $login_info->store_id;
                $product_account_mst_where['supplier_id'] = $this->input->post('supplier_id');           
                $product_account_mst_where['brand_id'] = $this->input->post('brand_id');
                /*$product_account_mst_where['category1_id'] = $product_info->category1_id;
                $product_account_mst_where['category2_id'] = $product_info->category2_id;
                $product_account_mst_where['category3_id'] = $product_info->category3_id;
                $product_account_mst_where['category4_id'] = $product_info->category4_id;*/
                $product_account_mst_where['product_id'] = $this->input->post('product_id');
                $product_account_mst_where['product_account_mst_id'] = $product_account_mst_id;
    
                $this->ProductAccountMstModel->modify($product_account_mst_data, $product_account_mst_where);

                /*foreach($stock_location_info as $value) {*/
                $product_location_mst_data['product_account_mst_id'] = $product_account_mst_id;
                $product_location_mst_data['store_id'] = $login_info->store_id;
                $product_location_mst_data['stock_location_id'] = $stock_location_info->stock_location_id;
                $product_location_mst_data['supplier_id'] = $this->input->post('supplier_id');
                $product_location_mst_data['brand_id'] = $this->input->post('brand_id');
                $product_location_mst_data['category1_id'] = $product_info->category1_id;
                $product_location_mst_data['category2_id'] = $product_info->category2_id;
                $product_location_mst_data['category3_id'] = $product_info->category3_id;
                $product_location_mst_data['category4_id'] = $product_info->category4_id;
                $product_location_mst_data['product_id'] = $this->input->post('product_id');
                $product_location_mst_data['opening'] = $total_opening+$this->input->post('quantity');
                $product_location_mst_data['net_amount'] = $total_stock+$this->input->post('quantity');
                $product_location_mst_data['finyear_id'] = $finyear_info->finyear_id;
                $product_location_mst_data['display'] = $this->input->post('display');
                $product_location_mst_data['priority'] = $this->input->post('priority');
                $product_location_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_location_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_location_mst_data['updated_by'] = $login_info->users_id;
                $product_location_mst_data['updated_name'] = $login_info->name;
                $product_location_mst_data['updated_user_agent'] = $this->customlib->load_agent();
                $product_location_mst_data['updated_ip'] = $this->input->ip_address();
                
                $product_location_mst_where['store_id'] = $login_info->store_id;
                $product_location_mst_where['stock_location_id'] = $stock_location_info->stock_location_id;
                $product_location_mst_where['supplier_id'] = $this->input->post('supplier_id');
                $product_location_mst_where['brand_id'] = $this->input->post('brand_id');
                /*$product_location_mst_where['category1_id'] = $product_info->category1_id;
                $product_location_mst_where['category2_id'] = $product_info->category2_id;
                $product_location_mst_where['category3_id'] = $product_info->category3_id;
                $product_location_mst_where['category4_id'] = $product_info->category4_id;*/
                $product_location_mst_where['product_id'] = $this->input->post('product_id');
                $product_location_mst_where['product_account_mst_id'] = $product_account_mst_id;

                $this->ProductLocationMstModel->modify($product_location_mst_data, $product_location_mst_where);
                /*}*/

            } else {

                $product_account_mst_data['store_id'] = $login_info->store_id;
                $product_account_mst_data['supplier_id'] = $this->input->post('supplier_id');           
                $product_account_mst_data['brand_id'] = $this->input->post('brand_id');
                $product_account_mst_data['category1_id'] = $product_info->category1_id;
                $product_account_mst_data['category2_id'] = $product_info->category2_id;
                $product_account_mst_data['category3_id'] = $product_info->category3_id;
                $product_account_mst_data['category4_id'] = $product_info->category4_id;
                $product_account_mst_data['product_id'] = $this->input->post('product_id');                
                $product_account_mst_data['min_qty'] = $this->input->post('min_qty');
                $product_account_mst_data['opening'] = $total_opening+$this->input->post('quantity');
                $product_account_mst_data['net_amount'] = $total_stock+$this->input->post('quantity');
                $product_account_mst_data['finyear_id'] = $finyear_info->finyear_id;
                $product_account_mst_data['display'] = $this->input->post('display');
                $product_account_mst_data['priority'] = $this->input->post('priority');
                $product_account_mst_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['created_by'] = $login_info->users_id;
                $product_account_mst_data['created_name'] = $login_info->name;
                $product_account_mst_data['created_user_agent'] = $this->customlib->load_agent();
                $product_account_mst_data['created_ip'] = $this->input->ip_address();
                
                $product_account_mst_id = $this->ProductAccountMstModel->add($product_account_mst_data);

                /*foreach($stock_location_info as $value) {*/
                $product_location_mst_data['product_account_mst_id'] = $product_account_mst_id;
                $product_location_mst_data['store_id'] = $login_info->store_id;
                $product_location_mst_data['stock_location_id'] = $stock_location_info->stock_location_id;
                $product_location_mst_data['supplier_id'] = $this->input->post('supplier_id');
                $product_location_mst_data['brand_id'] = $this->input->post('brand_id');
                $product_location_mst_data['category1_id'] = $product_info->category1_id;
                $product_location_mst_data['category2_id'] = $product_info->category2_id;
                $product_location_mst_data['category3_id'] = $product_info->category3_id;
                $product_location_mst_data['category4_id'] = $product_info->category4_id;
                $product_location_mst_data['product_id'] = $this->input->post('product_id');
                $product_location_mst_data['opening'] = $total_opening+$this->input->post('quantity');
                $product_location_mst_data['net_amount'] = $total_stock+$this->input->post('quantity');
                $product_location_mst_data['finyear_id'] = $finyear_info->finyear_id;
                $product_location_mst_data['display'] = $this->input->post('display');
                $product_location_mst_data['priority'] = $this->input->post('priority');
                $product_location_mst_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_location_mst_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_location_mst_data['created_by'] = $login_info->users_id;
                $product_location_mst_data['created_name'] = $login_info->name;
                $product_location_mst_data['created_user_agent'] = $this->customlib->load_agent();
                $product_location_mst_data['created_ip'] = $this->input->ip_address();
                
                $product_location_mst_id = $this->ProductLocationMstModel->add($product_location_mst_data);
                /*}*/
            }

            $generate_barcode_data['date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $generate_barcode_data['store_id'] = $login_info->store_id;
            $generate_barcode_data['supplier_id'] = $this->input->post('supplier_id');           
            $generate_barcode_data['brand_id'] = $product_info->brand_id;
            $generate_barcode_data['brand_heading'] = $product_info->brand_heading;
            $generate_barcode_data['category1_id'] = $product_info->category1_id;
            $generate_barcode_data['category2_id'] = $product_info->category2_id;
            $generate_barcode_data['category3_id'] = $product_info->category3_id;
            $generate_barcode_data['category4_id'] = $product_info->category4_id;
            $generate_barcode_data['product_id'] = $this->input->post('product_id');
            $generate_barcode_data['product_code'] = $product_info->product_code;
            $generate_barcode_data['product_heading'] = $product_info->heading;
            $generate_barcode_data['standard_barcode'] = $this->input->post('standard_barcode');
            $generate_barcode_data['generate_barcode'] = $this->input->post('generate_barcode');
            $generate_barcode_data['batch_no'] = $this->input->post('batch_no');
            $generate_barcode_data['quantity'] = $this->input->post('quantity');
            $generate_barcode_data['packing_id'] = $product_info->packing_id;   
            $generate_barcode_data['packing_title'] = $product_info->packing_title; 
            $generate_barcode_data['unit_id'] = $product_info->unit_id;   
            $generate_barcode_data['unit_title'] = $product_info->unit_title;
            $generate_barcode_data['mfg_date'] = $this->customlib->get_YYYYMMDD($this->input->post('mfg_date'));  
            $generate_barcode_data['expiry_date'] = $this->customlib->get_YYYYMMDD($this->input->post('expiry_date'));  
            $generate_barcode_data['batch_no'] = $this->input->post('batch_no');
            $generate_barcode_data['mrp_price'] = $this->input->post('mrp_price');
            $generate_barcode_data['total_mrp'] = $this->input->post('total_mrp');
            $generate_barcode_data['purchase_rate'] = $this->input->post('purchase_rate');
            $generate_barcode_data['total_purchase_rate'] = $this->input->post('total_purchase_rate');
            $generate_barcode_data['sales_rate'] = $this->input->post('sales_rate');
            $generate_barcode_data['total_sales_rate'] = $this->input->post('total_sales_rate');
            $credit_note_data['status_id'] = 'Pending';
            $credit_note_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $credit_note_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $generate_barcode_data['is_cancel'] = '0';
            $generate_barcode_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $generate_barcode_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $generate_barcode_data['finyear_id'] = $finyear_info->finyear_id;  
            
            $generate_barcode_data['display'] = '1'; //$this->input->post('display');
            $generate_barcode_data['priority'] = '0'; //$this->input->post('priority');
            $generate_barcode_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $generate_barcode_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $generate_barcode_data['created_by'] = $login_info->users_id;
            $generate_barcode_data['created_name'] = $login_info->name;
            $generate_barcode_data['created_user_agent'] = $this->customlib->load_agent();
            $generate_barcode_data['created_ip'] = $this->input->ip_address();

            $generate_barcode_id = $this->GenerateBarcodeMstModel->add($generate_barcode_data);

            $product_account_det_data['account_id'] = $account_info->account_id;
            $product_account_det_data['account'] = $account_info->account;            
            $product_account_det_data['product_account_mst_id'] = $product_account_mst_id;
            $product_account_det_data['supplier_id'] = $this->input->post('supplier_id');            $product_account_det_data['store_id'] = $login_info->store_id;           
            $product_account_det_data['brand_id'] = $product_info->brand_id;
            $product_account_det_data['brand_heading'] = $product_info->brand_heading;
            $product_account_det_data['category1_id'] = $product_info->category1_id;
            $product_account_det_data['category2_id'] = $product_info->category2_id;
            $product_account_det_data['category3_id'] = $product_info->category3_id;
            $product_account_det_data['category4_id'] = $product_info->category4_id;
            $product_account_det_data['product_id'] = $this->input->post('product_id');
            $product_account_det_data['product_code'] = $product_info->product_code;
            $product_account_det_data['product_heading'] = $product_info->heading;
            $product_account_det_data['standard_barcode'] = $this->input->post('standard_barcode');
            $product_account_det_data['generate_barcode'] = $this->input->post('generate_barcode');
            $product_account_det_data['batch_no'] = $this->input->post('batch_no');
            $product_account_det_data['quantity'] = $this->input->post('quantity');
            $product_account_det_data['packing_id'] = $product_info->packing_id;   
            $product_account_det_data['packing_title'] = $product_info->packing_title; 
            $product_account_det_data['unit_id'] = $product_info->unit_id;   
            $product_account_det_data['unit_title'] = $product_info->unit_title;
            $product_account_det_data['mfg_date'] = $this->customlib->get_YYYYMMDD($this->input->post('mfg_date'));  
            $product_account_det_data['expiry_date'] = $this->customlib->get_YYYYMMDD($this->input->post('expiry_date'));  
            $product_account_det_data['batch_no'] = $this->input->post('batch_no');                
            $product_account_det_data['mrp_price'] = $this->input->post('mrp_price');
            $product_account_det_data['rate'] = $this->input->post('sales_rate');
            $product_account_det_data['total_mrp'] = $this->input->post('total_mrp');
            $product_account_det_data['total_rate'] = $this->input->post('total_sales_rate');
            $product_account_det_data['cgst_id'] = $product_info->cgst_taxes_id;
            $product_account_det_data['cgst_title'] = $product_info->cgst_taxes_title;
            $product_account_det_data['cgst_value'] = $product_info->cgst_taxes_value;
            $product_account_det_data['total_cgst_amount'] = $this->input->post('cgst_amount');
            $product_account_det_data['sgst_id'] = $product_info->sgst_taxes_id;
            $product_account_det_data['sgst_title'] = $product_info->sgst_taxes_title;
            $product_account_det_data['sgst_value'] = $product_info->sgst_taxes_value;
            $product_account_det_data['total_sgst_amount'] = $this->input->post('sgst_amount');
            $product_account_det_data['igst_id'] = $product_info->igst_taxes_id;
            $product_account_det_data['igst_title'] = $product_info->igst_taxes_title;
            $product_account_det_data['igst_value'] = $product_info->igst_taxes_value;
            $product_account_det_data['total_igst_amount'] = $this->input->post('igst_amount');
            $product_account_det_data['total_amount'] = $this->input->post('total_amount');
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
            
            $this->db->trans_complete();

            if(($product_account_mst_id > 0) && ($product_account_det_id > 0)) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Supervisor/AddOpening');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Supervisor/AddOpening');

            }                
        }
    }
	
	public function checked_received_validation($required=true) {

        $this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('supplier_id', 'Supplier Name', 'trim|required');
        
        $this->form_validation->set_rules('brand_id', 'Brand Name', 'trim|required');
        
        /*if($this->input->post('category1_id') != '') {
            $category2_list = $this->CategoryMstModel->get_is_store_select($this->input->post('category1_id'));
            if(!empty($category4_list)) {
				$this->form_validation->set_rules('category2_id', 'Category 2', 'trim|required');
            }
        }

        if($this->input->post('category2_id') != '') {
            $category3_list = $this->CategoryMstModel->get_is_store_select($this->input->post('category2_id'));
            if(!empty($category3_list)) {
				$this->form_validation->set_rules('category3_id', 'Category 3', 'trim|required');
            }
        }

        if($this->input->post('category3_id') != '') {
            $category4_list = $this->CategoryMstModel->get_is_store_select($this->input->post('category3_id'));
            if(!empty($category4_list)) {
				$this->form_validation->set_rules('category4_id', 'Category 4', 'trim|required');
            }
        }*/

        $this->form_validation->set_rules('product_id', 'Product Name', 'trim|required');
        
		$this->form_validation->set_rules('standard_barcode', 'Standard Barcode', 'trim|required|max_length[50]');	
        $this->form_validation->set_rules('generate_barcode', 'Generate Barcode', 'trim|max_length[50]');
        
        $this->form_validation->set_rules('mfg_date', 'MFG Date', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('expiry_date', 'Expiry Date', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('batch_no', 'Batch No', 'trim|required|is_natural|min_length[1]|max_length[10]');
        
        $this->form_validation->set_rules('min_qty', 'Minimum Quantity', 'trim|required|is_natural|min_length[1]|max_length[10]');        
        
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|is_natural|min_length[1]|max_length[10]');        
        $this->form_validation->set_rules('unit_id', 'Unit', 'trim|required');

        $this->form_validation->set_rules('mrp_price', 'MRP Price', 'trim|required|is_natural|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('total_mrp', 'Total MRP', 'trim|required|is_natural|min_length[1]|max_length[10]');

        $this->form_validation->set_rules('purchase_rate', 'Purchase Rate', 'trim|required|is_natural|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('total_purchase_rate', 'Total Purchase Rate', 'trim|required|is_natural|min_length[1]|max_length[10]');

        $this->form_validation->set_rules('sales_rate', 'Sales Rate', 'trim|required|is_natural|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('total_sales_rate', 'Total Sales Rate', 'trim|required|is_natural|min_length[1]|max_length[10]');

        $this->form_validation->set_rules('cgst_amount', 'CGST Amount', 'trim|required|is_natural|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('sgst_amount', 'SGST Amount', 'trim|required|is_natural|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('igst_amount', 'IGST Amount', 'trim|required|is_natural|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'trim|required|is_natural|min_length[1]|max_length[10]');
        
        /*$this->form_validation->set_rules('display', 'Display', 'trim|required|is_natural|exact_length[1]');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|is_natural|min_length[1]|max_length[10]');*/
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