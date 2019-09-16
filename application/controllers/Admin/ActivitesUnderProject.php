<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ActivitesUnderProject extends CI_Controller {
    
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
        
        $main_menu['active'] = 'ActivitesUnderProject';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Activites Under Project';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['project_activity_info'] = $this->ProjectsActivitesMstModel->get_record($login_info->department_id);
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/projects_activites_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function view($project_activity_id) {
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
        
        $main_menu['active'] = 'ActivitesUnderProject';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Activites Under Project';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $project_activity_id = base64_decode($project_activity_id);
        $data['project_activity_id'] = $project_activity_id;
        
        $data['project_activity_info'] = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '',$project_activity_id)['0'];
       
        $data['expenditure_details_info'] = $this->ExpenditureDetailsMstModel->get_record($login_info->department_id, '', $project_activity_id);
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/projects_activites_view', $data);
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
        
        $main_menu['active'] = 'ActivitesUnderProject';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Activites Under Project';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['projects_list'] = $this->ProjectsMstModel->get_record($login_info->department_id);
        
        $data['contractor_list'] = $this->UsersMstModel->get_select($login_info->department_id, '5');
        
        $data['supervisor_list'] = $this->UsersMstModel->get_select($login_info->department_id, '4');
        
        $this->project_activity_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/projects_activites_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/projects_activites_add', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {
            $this->db->trans_start();

            $project_activity_data['department_id'] = $login_info->department_id;
            $project_activity_data['project_id'] = $this->input->post('project_id');
            $project_activity_data['activity_name'] = $this->input->post('activity_name'); 
            $project_activity_data['address'] = $this->input->post('address');       
            $project_activity_data['funds_allocated'] = $this->input->post('funds_allocated');             
            $project_activity_data['sanction_amount'] = $this->input->post('sanction_amount');            
            $project_activity_data['dnit_amount'] = $this->input->post('dnit_amount');            
            $project_activity_data['allotment_below_above'] = $this->input->post('allotment_below_above');            
            $project_activity_data['allotment_amount'] = $this->input->post('allotment_amount');           
            $project_activity_data['contractor_id'] = $this->input->post('contractor_id');           
            $project_activity_data['supervisor_id'] = $this->input->post('supervisor_id');             
            $project_activity_data['date_start'] = $this->customlib->get_YYYYMMDD($this->input->post('date_start'));
            $project_activity_data['scheduled_date_completion'] = $this->customlib->get_YYYYMMDD($this->input->post('scheduled_date_completion'));   
            $project_activity_data['extension'] = $this->input->post('extension');   
            $project_activity_data['actual_date_completion'] = $this->customlib->get_YYYYMMDD($this->input->post('actual_date_completion'));   
            $project_activity_data['expenditure_released'] = $this->input->post('expenditure_released');            
            $project_activity_data['remarks'] = $this->input->post('remarks');
            $project_activity_data['status_id'] = 'Pending';
            $project_activity_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $project_activity_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $project_activity_data['is_cancel'] = 'No';
            $project_activity_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $project_activity_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $project_activity_data['finyear_id'] = $finyear_info->finyear_id;
            $project_activity_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $project_activity_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $project_activity_data['created_by'] = $login_info->users_id;
            $project_activity_data['created_name'] = $login_info->name;
            $project_activity_data['created_user_agent'] = $this->customlib->load_agent();
            $project_activity_data['created_ip'] = $this->input->ip_address();
            
            $project_activity_id = $this->ProjectsActivitesMstModel->add($project_activity_data);
            
            $this->db->trans_complete();

            if($project_activity_id > 0) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Admin/ActivitesUnderProject');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Admin/ActivitesUnderProject/add');

            }                
        }
    }
    
    public function edit($project_activity_id) {
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
        
        $main_menu['active'] = 'ActivitesUnderProject';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Activites Under Project';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $project_activity_id = base64_decode($project_activity_id);
        $data['project_activity_id'] = $project_activity_id;
        
        $data['projects_list'] = $this->ProjectsMstModel->get_record($login_info->department_id);
        
        $data['contractor_list'] = $this->UsersMstModel->get_select($login_info->department_id, '5');
        
        $data['supervisor_list'] = $this->UsersMstModel->get_select($login_info->department_id, '4');
        
        $this->project_activity_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $data['project_activity_info'] = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $project_activity_id)['0'];

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/projects_activites_edit', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/projects_activites_edit', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $this->db->trans_start();
            
            $project_activity_data['department_id'] = $login_info->department_id; 
            $project_activity_data['project_id'] = $this->input->post('project_id');
            $project_activity_data['activity_name'] = $this->input->post('activity_name'); 
            $project_activity_data['address'] = $this->input->post('address');       
            $project_activity_data['funds_allocated'] = $this->input->post('funds_allocated');             
            $project_activity_data['sanction_amount'] = $this->input->post('sanction_amount');            
            $project_activity_data['dnit_amount'] = $this->input->post('dnit_amount');            
            $project_activity_data['allotment_below_above'] = $this->input->post('allotment_below_above');            
            $project_activity_data['allotment_amount'] = $this->input->post('allotment_amount');           
            $project_activity_data['contractor_id'] = $this->input->post('contractor_id');           
            $project_activity_data['supervisor_id'] = $this->input->post('supervisor_id');             
            $project_activity_data['date_start'] = $this->customlib->get_YYYYMMDD($this->input->post('date_start'));
            $project_activity_data['scheduled_date_completion'] = $this->customlib->get_YYYYMMDD($this->input->post('scheduled_date_completion'));   
            $project_activity_data['extension'] = $this->input->post('extension');   
            $project_activity_data['actual_date_completion'] = $this->customlib->get_YYYYMMDD($this->input->post('actual_date_completion'));   
            $project_activity_data['expenditure_released'] = $this->input->post('expenditure_released');            
            $project_activity_data['remarks'] = $this->input->post('remarks');
            /*$project_activity_data['status_id'] = 'Pending';
            $project_activity_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $project_activity_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $project_activity_data['is_cancel'] = 'No';
            $project_activity_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $project_activity_data['cancel_reason'] = ''; //$this->input->post('status_remarks');*/
            $project_activity_data['finyear_id'] = $finyear_info->finyear_id;
            $project_activity_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $project_activity_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $project_activity_data['updated_by'] = $login_info->users_id;
            $project_activity_data['updated_name'] = $login_info->name;
            $project_activity_data['updated_user_agent'] = $this->customlib->load_agent();
            $project_activity_data['updated_ip'] = $this->input->ip_address();

            $project_activity_where['department_id'] = $login_info->department_id;            
            $project_activity_where['project_activity_id'] = $project_activity_id;
            $project_activity_where['finyear_id'] = $finyear_info->finyear_id;
            
            $this->ProjectsActivitesMstModel->modify($project_activity_data, $project_activity_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Admin/ActivitesUnderProject');
        }
    }
    
    public function del($project_activity_id) {
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
        
        $main_menu['active'] = 'ActivitesUnderProject';
		$this->session->set_userdata($main_menu);
		
		$topbar = 'Activites Under Project';
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $project_activity_id = base64_decode($project_activity_id);
        $data['project_activity_id'] = $project_activity_id;
        
        $this->db->trans_start();
            
        $project_activity_where['department_id'] = $login_info->department_id;            
        $project_activity_where['project_activity_id'] = $project_activity_id;
        
        $this->ProjectsActivitesMstModel->delete($project_activity_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Admin/ActivitesUnderProject');
    }
	
	public function project_activity_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('project_id', 'Scheme Name', 'trim|required');
        $this->form_validation->set_rules('activity_name', 'Projects', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('address', 'Address'
        , 'trim|max_length[255]');
        $this->form_validation->set_rules('funds_allocated', 'Technical Sanction Amount', 'trim|required|numeric|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('sanction_amount', 'Technical Sanction Amount', 'trim|required|numeric|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('dnit_amount', 'DNIT Amount', 'trim|required|numeric|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('allotment_below_above', 'Allotment Below / above', 'trim|required|numeric|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('allotment_amount', 'Allotment Amount', 'trim|required|numeric|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('contractor_id', 'Contractor Name', 'trim|required');
        $this->form_validation->set_rules('supervisor_id', 'Supervisor Name', 'trim');
        $this->form_validation->set_rules('date_start', 'Date of Start', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('scheduled_date_completion', 'Scheduled Date of Completion', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('extension', 'Extension if any', 'trim|max_length[255]');
        $this->form_validation->set_rules('actual_date_completion', 'Actual Date of Completion', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('expenditure_released', 'Expenditure / payment release', 'trim|required|numeric|min_length[1]|max_length[20]');
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