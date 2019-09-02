<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
            parent::__construct();
            $this->general->expirePage();
            
    }

    public function index() {
    	/*
        $this->load->view('templete/Topbar');
        $this->load->view('templete/Sidebar');
        $this->load->view('index');
        $this->load->view('templete/Footer');*/

        $data['pageTitle'] = 'Home'; 
        $data['view'] = 'index';
        $this->template->base($data);

    }
}
