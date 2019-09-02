<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ChangePassword extends CI_Controller {
    
	var $CI;
    private $login_Detail;

    public function __construct() {
            parent::__construct();
            $this->customlib->expirePage();
    }
    
    public function index() {
        $data['controller'] = $this;

        $login_info = array();

        if($this->session->userdata('priyadarshini_superadmin_login_detail')) {
            $login_info = $this->session->userdata('priyadarshini_superadmin_login_detail');

        } else if($this->session->userdata('priyadarshini_admin_login_detail')) {
            $login_info = $this->session->userdata('priyadarshini_admin_login_detail');

        } else if($this->session->userdata('priyadarshini_accounts_login_detail')) {
            $login_info = $this->session->userdata('priyadarshini_accounts_login_detail');
            
        } else if($this->session->userdata('priyadarshini_bank_login_detail')) {
            $login_info = $this->session->userdata('priyadarshini_bank_login_detail');
            
        } else if($this->session->userdata('priyadarshini_manager_login_detail')) {
            $login_info = $this->session->userdata('priyadarshini_manager_login_detail');
            
        } else if($this->session->userdata('priyadarshini_supervisor_login_detail')) {
            $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');

        } else if($this->session->userdata('priyadarshini_cashier_login_detail')) {
            $login_info = $this->session->userdata('priyadarshini_cashier_login_detail');

        } else if($this->session->userdata('priyadarshini_returs_login_detail')) {
            $login_info = $this->session->userdata('priyadarshini_returs_login_detail');

        }

        $data['login_info'] = $login_info;
        $this->customlib->setUsersLogs($login_info, '1', base_url($this->uri->uri_string()));
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ChangePassword';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Change Password";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        if(!$this->input->post('submit')) {
            $this->load->view('layout/header',$data);
            $this->load->view('change_password',$data);
            $this->load->view('layout/footer',$data);

        } else {
            $this->change_password_validation(false);
            if($this->form_validation->run() == false){
                $this->load->view('layout/header',$data);
                $this->load->view('change_password',$data);
                $this->load->view('layout/footer',$data);

            } else {
                $response = $this->UsersMstModel->get_record($login_info->users_id)['0'];
                $db_password = $response->password;
                
                $npassword = $this->input->post('new_password');        
                $ncpassword = $this->input->post('new_password_confirm');        
                $old_password = md5($this->input->post('old_password'));
        
                if($old_password == $db_password) {        
                    $this->db->trans_start();
        
                    $post_data['password'] = md5($this->input->post('new_password'));
                    $post_data['forgot_psw'] = $this->input->post('new_password');
                    $post_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                    $post_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                    $post_data['updated_by'] = $login_info->users_id;
                    $post_data['updated_name'] = $login_info->name;
                    $post_data['updated_user_agent'] = $this->customlib->load_agent();
                    $post_data['updated_ip'] = $this->input->ip_address();
            
                    $post_where['id'] = $login_info->users_id;
		
                    $userDetails = $this->UsersMstModel->modify($post_data, $post_where);

                    $this->db->trans_complete();

                    $this->session->set_flashdata('success_msg', $this->lang->line('password_updated'));        
                    redirect(base_url('ChangePassword'));
        
                } else {        
                    $this->session->set_flashdata('error_msg', $this->lang->line('password_not_match'));        
                    redirect(base_url('ChangePassword'));
                }
            }
        }
    }
	
	public function change_password_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('old_password','Old Password','required|trim|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]|max_length[20]|matches[new_password]');
        $this->form_validation->set_rules('new_password_confirm','Confirm Password','required|trim|min_length[6]|max_length[20]');		
	}
}