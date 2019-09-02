<?php defined('BASEPATH') OR exit('No direct script access allowed');

class NotFound extends CI_Controller {
    
	var $CI;
    private $login_Detail;

    public function __construct() {
            parent::__construct();
    }
    
    public function index($error = 0) {
        $data['controller'] = $this;

        $main_menu['active'] = 'NotFound';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Not Found";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        if($error == '403') {
            $this->load->view('not_found_403',$data);
        }
        else {
            $this->load->view('not_found_404',$data);
        }
    }
}