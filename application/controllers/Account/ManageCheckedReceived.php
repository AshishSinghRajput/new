<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ManageCheckedReceived extends CI_Controller {
    
	var $CI;
    private $login_Detail;

    public function __construct() {
            parent::__construct();
            $this->customlib->expirePage();
    }
    
    public function index() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_CHECKEDBY_RECEIVEDBY, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageCheckedReceived';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Checked By / Received By";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['checked_received_info'] = $this->CheckedReceivedMstModel->get_record($login_info->store_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Account/checked_received_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function view($checked_received_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_CHECKEDBY_RECEIVEDBY, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageCheckedReceived';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Checked By / Received By";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $checked_received_id = base64_decode($checked_received_id);
        $data['checked_received_id'] = $checked_received_id;
        
        $data['checked_received_info'] = $this->CheckedReceivedMstModel->get_record($login_info->store_id, $checked_received_id)['0'];
       
        $this->load->view('layout/header', $data);
        $this->load->view('Account/checked_received_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_CHECKEDBY_RECEIVEDBY, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageCheckedReceived';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Checked By / Received By";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $this->checked_received_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Account/checked_received_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Account/checked_received_add', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {
            $this->db->trans_start();

            $checked_received_data['store_id'] = $login_info->store_id;
            $checked_received_data['checked_received'] = $this->input->post('checked_received');
            $checked_received_data['display'] = $this->input->post('display');
            $checked_received_data['priority'] = $this->input->post('priority');
            $checked_received_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $checked_received_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $checked_received_data['created_by'] = $login_info->users_id;
            $checked_received_data['created_name'] = $login_info->name;
            $checked_received_data['created_user_agent'] = $this->customlib->load_agent();
            $checked_received_data['created_ip'] = $this->input->ip_address();
            
            $checked_received_id = $this->CheckedReceivedMstModel->add($checked_received_data);
            
            $this->db->trans_complete();

            if($checked_received_id > 0) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Account/ManageCheckedReceived');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Account/ManageCheckedReceived/add');

            }                
        }
    }
    
    public function edit($checked_received_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_CHECKEDBY_RECEIVEDBY, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageCheckedReceived';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Checked By / Received By";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $checked_received_id = base64_decode($checked_received_id);
        $data['checked_received_id'] = $checked_received_id;
        
        $this->checked_received_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $data['checked_received_info'] = $this->CheckedReceivedMstModel->get_record($login_info->store_id, $checked_received_id)['0'];

                $this->load->view('layout/header', $data);
                $this->load->view('Account/checked_received_edit', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Account/checked_received_edit', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $this->db->trans_start();
            
            $checked_received_data['store_id'] = $login_info->store_id;
            $checked_received_data['checked_received'] = $this->input->post('checked_received');
            $checked_received_data['display'] = $this->input->post('display');
            $checked_received_data['priority'] = $this->input->post('priority');
            $checked_received_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $checked_received_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $checked_received_data['updated_by'] = $login_info->users_id;
            $checked_received_data['updated_name'] = $login_info->name;
            $checked_received_data['updated_user_agent'] = $this->customlib->load_agent();
            $checked_received_data['updated_ip'] = $this->input->ip_address();

            $checked_received_where['store_id'] = $login_info->store_id;
            $checked_received_where['checked_received_id'] = $checked_received_id;
            
            $this->CheckedReceivedMstModel->modify($checked_received_data, $checked_received_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Account/ManageCheckedReceived');
        }
    }
    
    public function is_display($checked_received_id, $display) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_CHECKEDBY_RECEIVEDBY, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageCheckedReceived';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Checked By / Received By";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $checked_received_id = base64_decode($checked_received_id);
        $data['checked_received_id'] = $checked_received_id;
        
        $checked_received_where['checked_received_id'] = $checked_received_id;

        $this->db->trans_start();
            
        $checked_received_data['display'] = base64_decode($display);
        $checked_received_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $checked_received_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $checked_received_data['updated_by'] = $login_info->users_id;
        $checked_received_data['updated_name'] = $login_info->name;
        $checked_received_data['updated_user_agent'] = $this->customlib->load_agent();
        $checked_received_data['updated_ip'] = $this->input->ip_address();

        $checked_received_where['checked_received_id'] = $checked_received_id;
        
        $this->CheckedReceivedMstModel->modify($checked_received_data, $checked_received_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Account/ManageCheckedReceived');
    }
    
    public function del($checked_received_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_account_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ACCOUNT_MANAGE_CHECKEDBY_RECEIVEDBY, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageCheckedReceived';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Checked By / Received By";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $checked_received_id = base64_decode($checked_received_id);
        $data['checked_received_id'] = $checked_received_id;
        
        $checked_received_where['checked_received_id'] = $checked_received_id;
        
        $this->CheckedReceivedMstModel->delete($checked_received_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Account/ManageCheckedReceived');
    }
	
	public function checked_received_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('checked_received', 'Checked By / Received By', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('display', 'Display', 'trim|required|is_natural|exact_length[1]');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|is_natural|min_length[1]|max_length[10]');		
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