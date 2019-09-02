<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php class Logout extends CI_Controller {
	var $CI;
    private $login_Detail;

    public function __construct() {
		parent::__construct();
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
        
        $main_menu['active'] = 'Logout';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Logout";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $this->session->sess_destroy();
		redirect(base_url('Login'), 'location');		
	}

}?>