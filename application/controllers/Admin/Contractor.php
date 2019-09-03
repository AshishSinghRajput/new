<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contractor extends CI_Controller {
    
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
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_CONTRACTOR, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageContractor';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Contractor";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $data['contractor_info'] = $this->ContractorMstModel->get_record();

        $this->load->view('layout/header', $data);
        $this->load->view('Admin/contractor_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    
    public function add() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_CONTRACTOR, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageContractor';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Contractor";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['state_list'] = $this->LocationMstModel->get_state();
        $data['bank_list'] = $this->BankMstModel->get_select();

        $this->contractor_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/contractor_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                if($this->input->post('state_name') != '') {
                    $data['city_list'] = $this->LocationMstModel->get_city($this->input->post('state_name'));
                }

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/contractor_add', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {                        
            $location_val = $this->LocationMstModel->get_record('', $this->input->post('state_name'), $this->input->post('city'))['0'];
            
            
            $this->db->trans_start();
            
            $contractor_data['users_id'] = $login_info->users_id;
            $contractor_data['firm_type'] = $this->input->post('firm_type');
            $contractor_data['firm_name'] = $this->input->post('firm_name');
            $contractor_data['owner_name'] = $this->input->post('owner_name');
            $contractor_data['address'] = $this->input->post('address');
            $contractor_data['mobile'] = $this->input->post('mobile1');
            $contractor_data['email'] = $this->input->post('email');
            $contractor_data['website'] = $this->input->post('website');
            $contractor_data['gsin_no'] = $this->input->post('gsin_no');
            $contractor_data['pan_no'] = $this->input->post('pan_no');
            $contractor_data['aadhar_no'] = $this->input->post('aadhar_no');
            $contractor_data['bank_id'] = $this->input->post('bank_id');
            $contractor_data['account_no'] = $this->input->post('account_no');
            $contractor_data['ifsc_code'] = $this->input->post('ifsc_code');
            $contractor_data['branch'] = $this->input->post('branch');
            $contractor_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $contractor_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $contractor_data['created_by'] = $login_info->users_id;
            $contractor_data['created_name'] = $login_info->name;
            $contractor_data['created_user_agent'] = $this->customlib->load_agent();
            $contractor_data['created_ip'] = $this->input->ip_address();            
            
            $contractor_id = $this->ContractorMstModel->add($contractor_data);

            

            
        
            $this->db->trans_complete();

            if(($contractor_id > 0)) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Admin/Contractor');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Admin/Contractor/add');

            }
        }
    }

     public function del($supplier_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_CONTRACTOR, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
                            
        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'Manage Contractor';
        $this->session->set_userdata($main_menu);
        
        $topbar = "Manage Store";
        
        $page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $supplier_id = base64_decode($supplier_id);
        $data['supplier_id'] = $supplier_id;
        
        $supplier_where['contractor_id'] = $supplier_id;
        
        $supplier_info = $this->ContractorMstModel->get_record($supplier_id)['0'];

        $this->ContractorMstModel->delete($supplier_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Admin/Contractor');
    }
    

    public function view($supplier_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_CONTRACTOR, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }
                            
        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageContractor';
        $this->session->set_userdata($main_menu);
        
        $topbar = "Manage Contractor";
        
        $page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $supplier_id = base64_decode($supplier_id);
        $data['supplier_id'] = $supplier_id;
        
        $data['supplier_info'] = $this->ContractorMstModel->get_record($supplier_id)['0'];
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/contractor_view', $data);
        $this->load->view('layout/footer', $data);
    }
   
    
    
	
	public function contractor_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
		
		$this->form_validation->set_rules('firm_type', 'Contractor Type', 'trim|required');
        
        $this->form_validation->set_rules('firm_name', 'Firm Name', 'trim|required|max_length[255]');		
		$this->form_validation->set_rules('owner_name', 'Owner Name', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]');	
		$this->form_validation->set_rules('mobile1', 'Mobile No. 1', 'trim|required|numeric|exact_length[10]');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[255]');		
		$this->form_validation->set_rules('website', 'Website', 'callback_valid_url');
        
		$this->form_validation->set_rules('gsin_no', 'GSIN No.', 'trim|max_length[20]');
		$this->form_validation->set_rules('pan_no', 'PAN No.', 'trim|exact_length[10]');
        $this->form_validation->set_rules('aadhar_no', 'Aadhar No.', 'trim|numeric|exact_length[12]');
		
        $this->form_validation->set_rules('bank_id', 'Bank Name', 'trim|required');
        $this->form_validation->set_rules('account_no', 'Account No.', 'trim|required');
        $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required');
        $this->form_validation->set_rules('branch', 'Branch', 'trim|required|max_length[255]');
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