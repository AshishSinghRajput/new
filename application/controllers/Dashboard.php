<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends CI_Controller {

	public function __construct() {
            parent::__construct();
    } 

    
    

    public function index() {
        
            redirect('Admin/Reports','location');
       
    }

    //=================Login and Session Set===========
    

    public function projectreport(){
        
        $data['listdata']= $this->generalmodel->getRowByWhere('d_projectreport',array(),'','','','id','asc'); 
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MIS_REPORTS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
                            
        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'Reports';
        $this->session->set_userdata($main_menu);

        $topbar = "Project Report";
        
        $page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;  



        $this->load->view('layout/header',$data);
        $this->load->view('Admin/d_projectreport',$data);
        $this->load->view('layout/footer',$data);

       
    }

    public function projectacctivity(){
        
        $data['listdata']= $this->generalmodel->getRowByWhere('d_projectacctivity',array(),'','','','id','asc'); 
        
       $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MIS_REPORTS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
                            
        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'Reports';
        $this->session->set_userdata($main_menu);

        $topbar = "Activity Under Project";
        
        $page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;  



        $this->load->view('layout/header',$data);
        $this->load->view('Admin/d_projectacctivity',$data);
        $this->load->view('layout/footer',$data);
        
    }

    public function fndreceived(){
        
        
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MIS_REPORTS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
                            
        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'Reports';
        $this->session->set_userdata($main_menu);

        $topbar = "Fund Received";
        
        $page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;  



        $this->load->view('layout/header',$data);
        $this->load->view('Admin/d_fndreceived',$data);
        $this->load->view('layout/footer',$data);
        
    }

    public function fundexpenditure(){
        
        
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MIS_REPORTS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
                            
        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'Reports';
        $this->session->set_userdata($main_menu);

        $topbar = "Expenditure Details";
        
        $page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;  



        $this->load->view('layout/header',$data);
        $this->load->view('Admin/d_fundexpenditure',$data);
        $this->load->view('layout/footer',$data);
        
    }

    public function schemfund(){
        
        $data['listdata']= $this->generalmodel->getRowByWhere('d_projectacctivity',array(),'','','','id','asc'); 
        
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MIS_REPORTS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
                            
        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'Reports';
        $this->session->set_userdata($main_menu);

        $topbar = "Scheme Wise Funds";
        
        $page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;  



        $this->load->view('layout/header',$data);
        $this->load->view('Admin/d_schemfund',$data);
        $this->load->view('layout/footer',$data);
       
       
    }

    public function contractordetails(){
        
        
       $data['contractor_info'] = $this->ContractorMstModel->get_record();
        
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MIS_REPORTS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
                            
        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'Reports';
        $this->session->set_userdata($main_menu);

        $topbar = "Contractor Details";
        
        $page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;  



        $this->load->view('layout/header',$data);
        $this->load->view('Admin/d_contractor',$data);
        $this->load->view('layout/footer',$data);
       
    }


    

/*====END====Class===*/

}

