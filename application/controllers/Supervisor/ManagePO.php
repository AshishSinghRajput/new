<?php defined('BASEPATH') or exit('No direct script access allowed');

class ManagePO extends CI_Controller {

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

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_ORDER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'ManagePO';
        $this->session->set_userdata($main_menu);

        $topbar = "Manage Purchase Order";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['po_mst_info'] = $this->POMstModel->get_record($finyear_info->finyear_id, $login_info->store_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/po_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($po_mst_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_ORDER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'ManagePO';
        $this->session->set_userdata($main_menu);

        $topbar = "Manage Purchase Order";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $po_mst_id = base64_decode($po_mst_id);
        $data['po_mst_id'] = $po_mst_id;

        $data['po_mst_info'] = $this->POMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $po_mst_id)['0'];

        $data['po_det_info'] = $this->PODetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $po_mst_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/po_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add($supplier_id = '') {
        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_ORDER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'ManagePO';
        $this->session->set_userdata($main_menu);

        $topbar = "Manage Purchase Order";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['current_supplier_id'] = $supplier_id;
                
        $data['supplier_list'] = $this->SupplierMstModel->get_select($login_info->store_id);

        $data['product_list'] = array();
        if($supplier_id != '') {
            $data['product_list'] = $this->ProductAccountMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $supplier_id);
        }
        
        $this->po_validation(false);
        if ($this->form_validation->run() == false) {
            if (!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/po_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/po_add', $data);
                $this->load->view('layout/footer', $data);

            }
        } else {

            $po_no_info = $this->POMstModel->get_count($finyear_info->finyear_id, $login_info->store_id)['0'];
            $po_no = $po_no_info->total;

            $po_details = $this->session->userdata('po_details');
            $total_quantity = 0;
            for ($counter = 0; $counter < count($po_details); $counter++) {
                $total_quantity = $total_quantity + $po_details[$counter]['order_qty'];
            }

            $this->db->trans_start();
            
            $po_mst_data['po_no'] = $po_no;
            $po_mst_data['date'] = $this->customlib->get_YYYYMMDD($this->input->post('date'));
            $po_mst_data['store_id'] = $login_info->store_id;
            $po_mst_data['supplier_id'] = $this->input->post('supplier_id');
            $po_mst_data['total_quantity'] = $total_quantity;
            $po_mst_data['remarks'] = $this->input->post('remarks');  
            $po_mst_data['status_id'] = 'Pending';
            $po_mst_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $po_mst_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $po_mst_data['is_cancel'] = '0';
            $po_mst_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $po_mst_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $po_mst_data['finyear_id'] = $finyear_info->finyear_id; 
            $po_mst_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $po_mst_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $po_mst_data['created_by'] = $login_info->users_id;
            $po_mst_data['created_name'] = $login_info->name;
            $po_mst_data['created_user_agent'] = $this->customlib->load_agent();
            $po_mst_data['created_ip'] = $this->input->ip_address();

            $po_mst_id = $this->POMstModel->add($po_mst_data);

            for ($counter = 0; $counter < count($po_details); $counter++) {

                $product_info = $this->ProductMstModel->get_autocomplete($finyear_info->finyear_id, $login_info->store_id, '', $po_details[$counter]['product_id'])['0'];

                $po_det_data['store_id'] = $login_info->store_id;
                $po_det_data['po_mst_id'] = $po_mst_id;
                $po_det_data['product_id'] = $po_details[$counter]['product_id'];
                $po_det_data['product_code'] = $product_info->product_code;
                $po_det_data['product_heading'] = $product_info->heading;
                $po_det_data['available_quantity'] = $product_info->net_amount;
                $po_det_data['packing_id'] = $product_info->packing_id;   
                $po_det_data['packing_title'] = $product_info->packing_title; 
                $po_det_data['unit_id'] = $product_info->unit_id;   
                $po_det_data['unit_title'] = $product_info->unit_title; 
                $po_det_data['order_quantity'] = $po_details[$counter]['order_qty']; 
                $po_det_data['is_cancel'] = '0';
                $po_det_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $po_det_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
                $po_det_data['finyear_id'] = $finyear_info->finyear_id; 
                $po_det_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $po_det_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $po_det_data['created_by'] = $login_info->users_id;
                $po_det_data['created_name'] = $login_info->name;
                $po_det_data['created_user_agent'] = $this->customlib->load_agent();
                $po_det_data['created_ip'] = $this->input->ip_address();
    
                $po_det_id = $this->PODetModel->add($po_det_data);
            }

            $this->db->trans_complete();

            if (($po_mst_id > 0) && ($po_det_id > 0)) {                
                $this->session->unset_userdata('po_details');

                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Supervisor/ManagePO');
            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Supervisor/ManagePO/add');
            }
            
        }
    }

    public function cancel($po_mst_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_ORDER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManagePO';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Purchase Order";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $po_mst_id = base64_decode($po_mst_id);
        $data['po_mst_id'] = $po_mst_id;
        
        $this->cancel_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {        
                $po_mst_info = $this->POMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $po_mst_id)['0'];
                $data['po_mst_info'] = $po_mst_info;        
                $data['po_det_info'] = $this->PODetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $po_mst_id);
                if ($po_mst_info->is_cancel == '1') {
                    $this->session->set_flashdata('error_msg', $this->lang->line('cancel_error_message'));
                    redirect('Supervisor/ManagePO');

                } else {
                    $this->load->view('layout/header', $data);
                    $this->load->view('Supervisor/po_cancel', $data);
                    $this->load->view('layout/footer', $data);

                }

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/po_cancel', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $this->db->trans_start();
            
            $po_mst_data['is_cancel'] = '1';
            $po_mst_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
            $po_mst_data['cancel_reason'] = $this->input->post('cancel_reason');
            $po_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $po_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $po_mst_data['updated_by'] = $login_info->users_id;
            $po_mst_data['updated_name'] = $login_info->name;
            $po_mst_data['updated_user_agent'] = $this->customlib->load_agent();
            $po_mst_data['updated_ip'] = $this->input->ip_address();
            
            $po_mst_where['finyear_id'] = $finyear_info->finyear_id; 
            $po_mst_where['store_id'] = $login_info->store_id;
            $po_mst_where['supplier_id'] = $po_mst_info->supplier_id;
            $po_mst_where['po_mst_id'] = $po_mst_id;
            
            $this->POMstModel->modify($po_mst_data, $po_mst_where);
            
            $po_det_data['is_cancel'] = '1';
            $po_det_data['cancel_date'] = $this->customlib->get_YYYYMMDD($this->input->post('cancel_date'));
            $po_det_data['cancel_reason'] = $this->input->post('cancel_reason');
            $po_det_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $po_det_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $po_det_data['updated_by'] = $login_info->users_id;
            $po_det_data['updated_name'] = $login_info->name;
            $po_det_data['updated_user_agent'] = $this->customlib->load_agent();
            $po_det_data['updated_ip'] = $this->input->ip_address();
            
            $po_det_where['finyear_id'] = $finyear_info->finyear_id; 
            $po_det_where['store_id'] = $login_info->store_id;
            /*$po_det_where['supplier_id'] = $po_det_info->supplier_id;*/
            $po_det_where['po_mst_id'] = $po_mst_id;
            
            $this->PODetModel->modify($po_det_data, $po_det_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('cancel_confirmation_message'));
            redirect('Supervisor/ManagePO');
        }
    }

    public function prints($po_mst_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_MANAGE_PURCHASE_ORDER, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_prints == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManagePO';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Purchase Order";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $po_mst_id = base64_decode($po_mst_id);
        $data['po_mst_id'] = $po_mst_id;

        $data['store_info'] = $this->StoreMstModel->get_record($login_info->store_id)['0'];
        
        $data['po_mst_info'] = $this->POMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $po_mst_id)['0'];

        $data['po_det_info'] = $this->PODetModel->get_record($finyear_info->finyear_id, $login_info->store_id, '', $po_mst_id);

        $this->load->view('Supervisor/po_prints', $data);
    }

    public function po_validation($required = true) {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('po_no', 'PO No.', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[20]');

        $this->form_validation->set_rules('supplier_id', 'Supplier Name', 'trim|required');  

        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[255]'); 
    }

    public function cancel_validation($required = true) {

        $this->form_validation->set_message('required', '%s required');

        $this->form_validation->set_rules('cancel_date', 'Date', 'trim|max_length[20]');
        $this->form_validation->set_rules('cancel_reason', 'Reason', 'trim|required');
    }

    public function ajaxRequestPost()
    {
        $session['po_details'] = $this->session->userdata('po_details');

        $po_details = $this->session->userdata('po_details');
        $found = false;
        for ($counter = 0; $counter < count($po_details); $counter++) {
            if ($this->input->post('product_id') == $po_details[$counter]['product_id']) {
                $found = true;
                $ss = $counter;
                break;
            }
        }
        if ($found) {
            $session['po_details'][$ss]['order_qty'] += $this->input->post('order_qty');

        } else {
            $session['po_details'][] = array(
                'product_id' => $this->input->post('product_id'),
                'product_code' => $this->input->post('product_code'),
                'product_name' => $this->input->post('product_name'),
                'packing_title' => $this->input->post('packing_title'),
                'available_quantity' => $this->input->post('available_quantity'),
                'order_qty' => $this->input->post('order_qty')
            );
        }

        $this->session->set_userdata($session);
        $po_details = $this->session->userdata('po_details');
        for ($counter = 0; $counter < count($po_details); $counter++) {
            $d = $counter;
        }
        if ($found)
            echo "ddd";
        else
            echo $d;
    }
    
    public function remove_item($item_id)
    {
        //$session['po_details'][] = array();

        $po_details = $this->session->userdata('po_details');
        for ($counter = 0; $counter < count($po_details); $counter++) {
            if ($counter != $item_id) {
                $session['po_details'][] = array(
                    'product_code' => $po_details[$counter]['product_code'],
                    'product_name' => $po_details[$counter]['product_name'],
                    'packing_title' => $po_details[$counter]['packing_title'],
                    'available_quantity' => $po_details[$counter]['available_quantity'],
                    'order_qty' => $po_details[$counter]['order_qty'],
                    'product_id' => $po_details[$counter]['product_id']
                );
            }
        }
        $this->session->unset_userdata('po_details');
        $this->session->set_userdata($session);

        redirect(base_url('Supervisor/ManagePO/add'));
    }
    
    
    public function ajaxRequestRemove()
    {
        $item_id = $this->input->post('po_product_code');
        $po_details = $this->session->userdata('po_details');
        for ($counter = 0; $counter < count($po_details); $counter++) {
            if ($counter != $item_id) {
                $session['po_details'][] = array(
                    'product_code' => $po_details[$counter]['product_code'],
                    'product_name' => $po_details[$counter]['product_name'],
                    'packing_title' => $po_details[$counter]['packing_title'],
                    'available_quantity' => $po_details[$counter]['available_quantity'],
                    'order_qty' => $po_details[$counter]['order_qty'],
                    'product_id' => $po_details[$counter]['product_id']
                );
            }
        }
        $this->session->unset_userdata('po_details');
        $this->session->set_userdata($session);
    }
}
