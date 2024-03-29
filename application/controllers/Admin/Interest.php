<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Interest extends CI_Controller {
    
	var $CI;
    private $login_Detail;

    public function __construct() {
            parent::__construct();
            $this->customlib->expirePage();
    }
    
    public function index() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BANK, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'Interest';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Interest Details';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['interest_info'] = $this->InterestMstModel->get_record($login_info->department_id);
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/interest_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function view($interest_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BANK, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'Interest';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Interest Details';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $interest_id = base64_decode($interest_id);
        $data['interest_id'] = $interest_id;
        
        $data['interest_info'] = $this->InterestMstModel->get_record($login_info->department_id, '',$interest_id)['0'];
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/interest_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BANK, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'Interest';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Interest Details';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['projects_list'] = $this->ProjectsMstModel->get_record($login_info->department_id);
        
        $data['project_activity_list'] = $this->ProjectsActivitesMstModel->get_record($login_info->department_id);
        
        $data['payment_mode_list'] = $this->PaymentModeMstModel->get_is_store_select();
        
        $data['bank_list'] = $this->BankMstModel->get_select();

        $this->interest_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/interest_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/interest_add', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {
            $this->db->trans_start();

            $interest_data['department_id'] = $login_info->department_id;
            $interest_data['bill_no'] = $this->input->post('bill_no');             
            $interest_data['date'] = $this->customlib->get_YYYYMMDD($this->input->post('date'));
            $interest_data['project_id'] = $this->input->post('project_id');
            $interest_data['project_activity_id'] = $this->input->post('project_activity_id');
            $interest_data['gross_amount'] = $this->input->post('gross_amount');            
            $interest_data['net_amount_released'] = $this->input->post('net_amount_released');          
            $interest_data['payment_mode_id'] = $this->input->post('payment_mode_id');
            $interest_data['bank_id'] = $this->input->post('bank_id');
            $interest_data['transaction_no'] = $this->input->post('transaction_no');
            $interest_data['transaction_date'] = $this->customlib->get_YYYYMMDD($this->input->post('transaction_date'));  
            $interest_data['branch'] = $this->input->post('branch');
            $interest_data['remarks'] = $this->input->post('remarks');
            $interest_data['status_id'] = 'Pending';
            $interest_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $interest_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $interest_data['is_cancel'] = 'No';
            $interest_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $interest_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $interest_data['finyear_id'] = $finyear_info->finyear_id;
            $interest_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $interest_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $interest_data['created_by'] = $login_info->users_id;
            $interest_data['created_name'] = $login_info->name;
            $interest_data['created_user_agent'] = $this->customlib->load_agent();
            $interest_data['created_ip'] = $this->input->ip_address();
            
            $interest_id = $this->InterestMstModel->add($interest_data);
            
            $this->db->trans_complete();

            if($interest_id > 0) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Admin/Interest');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Admin/Interest/add');

            }                
        }
    }
    
    public function edit($interest_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BANK, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'Interest';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Interest Details';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $interest_id = base64_decode($interest_id);
        $data['interest_id'] = $interest_id;
        
        $data['projects_list'] = $this->ProjectsMstModel->get_record($login_info->department_id);
        
        $data['project_activity_list'] = $this->ProjectsActivitesMstModel->get_record($login_info->department_id);
        
        $data['contractor_list'] = $this->UsersMstModel->get_select($login_info->department_id, '5');
        
        $data['payment_mode_list'] = $this->PaymentModeMstModel->get_is_store_select();
        
        $data['bank_list'] = $this->BankMstModel->get_select();

        $this->interest_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $data['interest_info'] = $this->InterestMstModel->get_record($login_info->department_id, '', '', $interest_id)['0'];

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/interest_edit', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/interest_edit', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $this->db->trans_start();
            
            $interest_data['department_id'] = $login_info->department_id;
            $interest_data['bill_no'] = $this->input->post('bill_no');             
            $interest_data['date'] = $this->customlib->get_YYYYMMDD($this->input->post('date'));
            $interest_data['project_id'] = $this->input->post('project_id');
            $interest_data['project_activity_id'] = $this->input->post('project_activity_id');
            $interest_data['gross_amount'] = $this->input->post('gross_amount');            
            $interest_data['net_amount_released'] = $this->input->post('net_amount_released');          
            $interest_data['payment_mode_id'] = $this->input->post('payment_mode_id');
            $interest_data['payment_mode'] = $payment_mode_info->payment_mode;
            $interest_data['bank_id'] = $this->input->post('bank_id');
            $interest_data['transaction_no'] = $this->input->post('transaction_no');
            $interest_data['transaction_date'] = $this->customlib->get_YYYYMMDD($this->input->post('transaction_date'));  
            $interest_data['branch'] = $this->input->post('branch');
            $interest_data['remarks'] = $this->input->post('remarks');
            /*$interest_data['status_id'] = 'Pending';
            $interest_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $interest_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $interest_data['is_cancel'] = 'No';
            $interest_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $interest_data['cancel_reason'] = ''; //$this->input->post('status_remarks');*/
            $interest_data['finyear_id'] = $finyear_info->finyear_id;
            $interest_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $interest_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $interest_data['updated_by'] = $login_info->users_id;
            $interest_data['updated_name'] = $login_info->name;
            $interest_data['updated_user_agent'] = $this->customlib->load_agent();
            $interest_data['updated_ip'] = $this->input->ip_address();

            $interest_where['department_id'] = $login_info->department_id;            
            $interest_where['interest_id'] = $interest_id;
            $interest_where['finyear_id'] = $finyear_info->finyear_id;
            
            $this->InterestMstModel->modify($interest_data, $interest_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Admin/Interest');
        }
    }
    
    public function del($interest_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BANK, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'Interest';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Interest Details';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $interest_id = base64_decode($interest_id);
        $data['interest_id'] = $interest_id;
        
        $this->db->trans_start();
            
        $interest_where['department_id'] = $login_info->department_id;            
        $interest_where['interest_id'] = $interest_id;
        
        $this->InterestMstModel->delete($interest_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Admin/Interest');
    }
	
	public function interest_validation($required=true) {

        $this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('bill_no', 'Description of Bills', 'trim|required|max_length[20]');        
        $this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[20]');

        $this->form_validation->set_rules('project_id', 'Scheme Name', 'trim|required');
        //$this->form_validation->set_rules('project_activity_id', 'Projects', 'trim|required');
        $this->form_validation->set_rules('gross_amount', 'Gross Amount', 'trim|required|numeric|min_length[1]|max_length[20]');
        //$this->form_validation->set_rules('net_amount_released', 'Net Amount Released', 'trim|required|numeric|min_length[1]|max_length[20]');
        
        /*$this->form_validation->set_rules('payment_mode_id', 'Payment Mode', 'trim|required');
        if($this->input->post('payment_mode_id') != '1') {
            $this->form_validation->set_rules('bank_id', 'Bank', 'trim|required');
            $this->form_validation->set_rules('transaction_no', 'Transaction / Cheque No.', 'trim|max_length[20]');
            $this->form_validation->set_rules('transaction_date', 'Transaction / Cheque Date', 'trim|max_length[20]');
            $this->form_validation->set_rules('branch', 'Branch', 'trim|required|max_length[255]');
        }*/
        
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[255]');
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