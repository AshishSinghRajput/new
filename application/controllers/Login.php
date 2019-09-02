<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
	} 

    public function index()
	{
		$page_val = array(
						'title'=>$this->lang->line('project_short_name').' : Sign In',
						'author'=>'cnvg.in',
						'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').', Sign In',
						'description'=>'Sign In'
					);
		$data['page_val'] = $page_val;

		if(!$this->input->post('submit')) {
			// Captcha configuration
			$config = $this->config->item('captcha');
			$captcha = create_captcha($config);
			// Unset previous captcha and set new captcha word
			$this->session->unset_userdata('captchaCode');
			$this->session->set_userdata('captchaCode', $captcha['word']);

			// Pass captcha image to view
			$data['captchaImg'] = $captcha['image'];
			$data['captcha_error'] = false;
			
			$this->load->view('index', $data);
			 
		} else {
			$this->form_validation->set_rules('username', 'UserName', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			if($this->form_validation->run() == false) {
				// Captcha configuration
				$config = $this->config->item('captcha');
				$captcha = create_captcha($config);
				// Unset previous captcha and set new captcha word
				$this->session->unset_userdata('captchaCode');
				$this->session->set_userdata('captchaCode', $captcha['word']);

				// Pass captcha image to view
				$data['captchaImg'] = $captcha['image'];
				$data['captcha_error'] = false;
				
				$this->load->view('index',$data);
			
			} else {			
				$sessCaptcha = $this->session->userdata('captchaCode');
				$inputCaptcha = $this->input->post('captcha');				
				if ($inputCaptcha === $sessCaptcha) {
					$response = $this->UsersMstModel->check_login($this->input->post('username'), $this->input->post('password'))['0'];
					
					$response_finyear = $this->FinyearMstModel->get_record('', '1')['0'];
					
					switch ($response->users_type_id) {
						case '1':
                                /*$this->session->unset_userdata('login_request');
									
								$session['priyadarshini_superadmin_login_detail'] = $response;
								$session['priyadarshini_finyear_detail'] = $response_finyear;
									
								$this->session->set_userdata($session);
								$this->customlib->setUsersLogs($response, '0', base_url($this->uri->uri_string()));
								
								$this->session->set_flashdata('ses_success', $this->lang->line('login_succesfully'));
								redirect('SuperAdmin/Dashboard', 'location');
								break;*/
						
						case '2':
							$this->session->unset_userdata('login_request');
										
							$session['priyadarshini_admin_login_detail'] = $response;
							$session['priyadarshini_finyear_detail'] = $response_finyear;
								
							$this->session->set_userdata($session);
							$this->customlib->setUsersLogs($response, '0', base_url($this->uri->uri_string()));
							
							$this->session->set_flashdata('ses_success', $this->lang->line('login_succesfully'));
							redirect('Admin/Dashboard', 'location');
							break;

						case '3':
							$this->session->unset_userdata('login_request');
										
							$session['priyadarshini_account_login_detail'] = $response;
							$session['priyadarshini_finyear_detail'] = $response_finyear;
								
							$this->session->set_userdata($session);
							$this->customlib->setUsersLogs($response, '0', base_url($this->uri->uri_string()));
							
							$this->session->set_flashdata('ses_success', $this->lang->line('login_succesfully'));
            				redirect('Account/Dashboard','location');
							break;

						case '4':
							/*$this->session->unset_userdata('login_request');
									
							$session['priyadarshini_bank_login_detail'] = $response;
							$session['priyadarshini_finyear_detail'] = $response_finyear;
								
							$this->session->set_userdata($session);
							$this->customlib->setUsersLogs($response, '0', base_url($this->uri->uri_string()));
							
							$this->session->set_flashdata('ses_success', $this->lang->line('login_succesfully'));
							redirect('Bank/Dashboard', 'location');*/
							break;

						case '5':
							/*$this->session->unset_userdata('login_request');
										
							$session['priyadarshini_manager_login_detail'] = $response;
							$session['priyadarshini_finyear_detail'] = $response_finyear;
								
							$this->session->set_userdata($session);
							$this->customlib->setUsersLogs($response, '0', base_url($this->uri->uri_string()));
							
							$this->session->set_flashdata('ses_success', $this->lang->line('login_succesfully'));
							redirect('Manager/Dashboard', 'location');
							break;*/

						case '6':
							$this->session->unset_userdata('login_request');
										
							$session['priyadarshini_supervisor_login_detail'] = $response;
							$session['priyadarshini_finyear_detail'] = $response_finyear;
								
							$this->session->set_userdata($session);
							$this->customlib->setUsersLogs($response, '0', base_url($this->uri->uri_string()));
							
							$this->session->set_flashdata('ses_success', $this->lang->line('login_succesfully'));
							redirect('Supervisor/Dashboard', 'location');
							break;

						case '7':
							$this->session->unset_userdata('login_request');
										
							$session['priyadarshini_cashier_login_detail'] = $response;
							$session['priyadarshini_finyear_detail'] = $response_finyear;
								
							$this->session->set_userdata($session);
							$this->customlib->setUsersLogs($response, '0', base_url($this->uri->uri_string()));
							
							$this->session->set_flashdata('ses_success', $this->lang->line('login_succesfully'));
							redirect('Cashier/Dashboard', 'location');
							break;

						case '8':
							/*$this->session->unset_userdata('login_request');
										
							$session['priyadarshini_returs_login_detail'] = $response;
							$session['priyadarshini_finyear_detail'] = $response_finyear;
								
							$this->session->set_userdata($session);
							$this->customlib->setUsersLogs($response, '0', base_url($this->uri->uri_string()));
							
							$this->session->set_flashdata('ses_success', $this->lang->line('login_succesfully'));
							//redirect('Returs/Dashboard', 'location');
							break;*/

						default :
							$this->session->unset_userdata('login_request');
									
							$this->session->set_flashdata('error_msg', $this->lang->line('login_failed'));
							redirect(base_url('Login'));
					}
				} else {
					// Captcha configuration
					$config = $this->config->item('captcha');
					$captcha = create_captcha($config);
					// Unset previous captcha and set new captcha word
					$this->session->unset_userdata('captchaCode');
					$this->session->set_userdata('captchaCode', $captcha['word']);
	
					// Pass captcha image to view
					$data['captchaImg'] = $captcha['image'];
					$data['captcha_error'] = false;
					
					$this->load->view('index',$data);

				}		
			}
		}
	}

    public function refresh() {
        // Captcha configuration
        $config = $this->config->item('captcha');
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);

        // Display captcha image
        echo $captcha['image'];
    }
}
