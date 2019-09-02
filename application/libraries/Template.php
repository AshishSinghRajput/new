<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template {
  var $CI;
  public function __construct() {
    $this->CI = & get_instance();
  }

  public function base($data) {
    $template['header'] = $this->CI->load->view('template/Topbar', $data, TRUE);
    $template['sidebarnav'] = $this->CI->load->view('template/Sidebar', $data, TRUE);
    $template['mainContent'] = $this->CI->load->view($data['view'], $data, TRUE);
    $template['footer'] = $this->CI->load->view('template/Footer', '', TRUE);
    $this->CI->load->view('load_template', $template);

  }
  
  public function adminBase($data) {
    $template['header'] = $this->CI->load->view('admin/template/Topbar', $data, TRUE);
    $template['sidebarnav'] = $this->CI->load->view('admin/template/Sidebar', $data, TRUE);
    $template['mainContent'] = $this->CI->load->view('admin/'.$data['view'], $data, TRUE);
    $template['footer'] = $this->CI->load->view('admin/template/Footer', '', TRUE);
    $this->CI->load->view('admin/load_template', $template);
  }


  public function supervisor($data) {
    $template['header'] = $this->CI->load->view('Supervisor/template/Topbar', $data, TRUE);
    $template['sidebarnav'] = $this->CI->load->view('Supervisor/template/Sidebar', $data, TRUE);
    $template['mainContent'] = $this->CI->load->view('Supervisor/'.$data['view'], $data, TRUE);
    $template['footer'] = $this->CI->load->view('Supervisor/template/Footer', '', TRUE);
    $this->CI->load->view('Supervisor/load_template', $template);
  }

  public function accounts($data) {
    $template['header'] = $this->CI->load->view('accounts/template/Topbar', $data, TRUE);
    $template['sidebarnav'] = $this->CI->load->view('accounts/template/Sidebar', $data, TRUE);
    $template['mainContent'] = $this->CI->load->view('accounts/'.$data['view'], $data, TRUE);
    $template['footer'] = $this->CI->load->view('accounts/template/Footer', '', TRUE);
    $this->CI->load->view('accounts/load_template', $template);
  }
}