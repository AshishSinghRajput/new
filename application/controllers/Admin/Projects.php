<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {
    
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
        
        $main_menu['active'] = 'Projects';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Schemes';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['projects_info'] = $this->ProjectsMstModel->get_record($login_info->department_id);
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/projects_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function view($project_id) {
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
        
        $main_menu['active'] = 'Projects';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Schemes';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $project_id = base64_decode($project_id);
        $data['project_id'] = $project_id;
        
        $data['projects_info'] = $this->ProjectsMstModel->get_record($login_info->department_id, $project_id)['0'];
       
        $data['project_activity_list'] = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, $project_id);
       
        $data['fund_received_info'] = $this->FundReceivedMstModel->get_record($login_info->department_id, $project_id);
       
        $data['expenditure_details_info'] = $this->ExpenditureDetailsMstModel->get_record($login_info->department_id, $project_id);
       
        $data['interest_info'] = $this->InterestMstModel->get_record($login_info->department_id, $project_id);
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/projects_view', $data);
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
        
        $main_menu['active'] = 'Projects';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Schemes';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val; 
        
        $data['bank_list'] = $this->BankMstModel->get_select();       
        
        $this->project_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/projects_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/projects_add', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {
            $this->db->trans_start();

            $projects_data['department_id'] = $login_info->department_id;            
            $projects_data['project_name'] = $this->input->post('project_name');            
            $projects_data['sanctioned_funds'] = $this->input->post('sanctioned_funds');
            $projects_data['funds_received'] = $this->input->post('funds_received');           
            $projects_data['interest'] = $this->input->post('interest');                 
            $projects_data['expenditure'] = $this->input->post('expenditure');            
            $projects_data['funds_available'] = $this->input->post('funds_available');
            $projects_data['remarks'] = $this->input->post('remarks');
            $projects_data['status_id'] = 'Pending';
            $projects_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $projects_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $projects_data['is_cancel'] = 'No';
            $projects_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $projects_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $projects_data['finyear_id'] = $finyear_info->finyear_id;
            $projects_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $projects_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $projects_data['created_by'] = $login_info->users_id;
            $projects_data['created_name'] = $login_info->name;
            $projects_data['created_user_agent'] = $this->customlib->load_agent();
            $projects_data['created_ip'] = $this->input->ip_address();
            
            $project_id = $this->ProjectsMstModel->add($projects_data);
            
            $this->db->trans_complete();

            if($project_id > 0) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Admin/Projects');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Admin/Projects/add');

            }                
        }
    }
    
    public function edit($project_id) {
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
        
        $main_menu['active'] = 'Projects';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Schemes';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $project_id = base64_decode($project_id);
        $data['project_id'] = $project_id;

        $data['bank_list'] = $this->BankMstModel->get_select();
        
        $this->project_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $data['projects_info'] = $this->ProjectsMstModel->get_record($login_info->department_id, $project_id)['0'];

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/projects_edit', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/projects_edit', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $this->db->trans_start();
            
            $projects_data['department_id'] = $login_info->department_id;            
            $projects_data['project_name'] = $this->input->post('project_name');            
            $projects_data['sanctioned_funds'] = $this->input->post('sanctioned_funds');
            $projects_data['funds_received'] = $this->input->post('funds_received');            
            $projects_data['interest'] = $this->input->post('interest');                 
            $projects_data['expenditure'] = $this->input->post('expenditure');            
            $projects_data['funds_available'] = $this->input->post('funds_available');
            $projects_data['remarks'] = $this->input->post('remarks');
            /*$projects_data['status_id'] = 'Pending';
            $projects_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $projects_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $projects_data['is_cancel'] = 'No';
            $projects_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $projects_data['cancel_reason'] = ''; //$this->input->post('status_remarks');*/
            $projects_data['finyear_id'] = $finyear_info->finyear_id;
            $projects_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $projects_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $projects_data['updated_by'] = $login_info->users_id;
            $projects_data['updated_name'] = $login_info->name;
            $projects_data['updated_user_agent'] = $this->customlib->load_agent();
            $projects_data['updated_ip'] = $this->input->ip_address();

            $projects_where['department_id'] = $login_info->department_id;            
            $projects_where['project_id'] = $project_id;
            $projects_where['finyear_id'] = $finyear_info->finyear_id;
            
            $this->ProjectsMstModel->modify($projects_data, $projects_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Admin/Projects');
        }
    }
    
    public function del($project_id) {
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
        
        $main_menu['active'] = 'Projects';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Schemes';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $project_id = base64_decode($project_id);
        $data['project_id'] = $project_id;
        
        $this->db->trans_start();
            
        $projects_where['department_id'] = $login_info->department_id;            
        $projects_where['project_id'] = $project_id;
        
        $this->ProjectsMstModel->delete($projects_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Admin/Projects');
    }
	
	public function project_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('project_name', 'Scheme Name', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('sanctioned_funds', 'Sanctioned funds', 'trim|required|numeric|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('funds_received', 'Funds Received', 'trim|required|numeric|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('interest', 'Interest', 'trim|required|numeric|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('expenditure', 'Expenditure Incurred', 'trim|required|numeric|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('funds_available', 'Funds available', 'trim|required|numeric|min_length[1]|max_length[10]');
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