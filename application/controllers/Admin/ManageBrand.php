<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ManageBrand extends CI_Controller {
    
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
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BRAND, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageBrand';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Brand";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['brand_info'] = $this->BrandMstModel->get_record();

        $this->load->view('layout/header', $data);
        $this->load->view('Admin/brand_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function view($brand_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BRAND, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageBrand';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Brand";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $brand_id = base64_decode($brand_id);
        $data['brand_id'] = $brand_id;
        
        $data['brand_info'] = $this->BrandMstModel->get_record($brand_id)['0'];
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/brand_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BRAND, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageBrand';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Brand";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $this->brand_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/brand_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/brand_add', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {
            $config['upload_path'] = $this->config->item('brand_images');
            $config['allowed_types'] = $this->config->item('allowed_types');
            $config['max_size'] = $this->config->item('max_size');
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['encrypt_name'] = $this->config->item('image_encryption');
            $this->load->library('upload', $config);

            $brand_images = '';

            if ($_FILES['brand_images']['name'] !== '') {
                if (!$this->upload->do_upload('brand_images')) {
                    $brand_images = array('error'=>$this->upload->display_errors());

                    $this->load->view('layout/header', $data);
                    $this->load->view('Admin/brand_add', $data);
                    $this->load->view('layout/footer', $data);

                } else {            
                    $uploadData = $this->upload->data();
                    $fileData['img_file'] = $uploadData['file_name']; 
                    $brand_images = $uploadData['file_name'];
                    
                    $full_path = $this->config->item('brand_thumbnail1');					
					$img_width = $this->config->item('thumbnail_width_500');
					$img_height = $this->config->item('thumbnail_height_250');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width,$img_height);
										
					$full_path = $this->config->item('brand_thumbnail2');					
					$img_width = $this->config->item('thumbnail_width_250');
					$img_height = $this->config->item('thumbnail_height_125');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width, $img_height);
                }
                /*if($brand_images['error'] !== '') {
                    echo $brand_images = '';
                }*/
            }
            
            $this->db->trans_start();

            $brand_data['meta_title'] = ''; //$this->input->post('meta_title');
            $brand_data['meta_keywords'] = ''; //$this->input->post('meta_keywords');
            $brand_data['meta_description'] = ''; //$this->input->post('meta_description');
            $brand_data['slug'] = ''; //$this->input->post('slug');
            $brand_data['heading'] = $this->input->post('heading');
            $brand_data['sub_heading'] = ''; //$this->input->post('sub_heading');
            $brand_data['is_show'] = '0'; //$this->input->post('is_show');
            $brand_data['images'] = $brand_images;
            $brand_data['thumbnail1'] = $brand_images;
            $brand_data['thumbnail2'] = $brand_images;
            $brand_data['video'] = ''; //$this->input->post('video');
            $brand_data['short_description1'] = ''; //$this->input->post('short_description1');
            $brand_data['short_description2'] = ''; //$this->input->post('short_description2');
            $brand_data['description'] = ''; //$this->input->post('description');
            $brand_data['tags'] = ''; //$this->input->post('tags');
            $brand_data['is_store'] = $this->input->post('is_store');
            $brand_data['store_priority'] = $this->input->post('store_priority');
            $brand_data['is_app'] = '1'; //$this->input->post('is_app');
            $brand_data['app_priority'] = '0'; //$this->input->post('app_priority');
            $brand_data['is_web'] = '1'; //$this->input->post('is_web');
            $brand_data['web_priority'] = '0'; //$this->input->post('web_priority');
            $brand_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $brand_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $brand_data['created_by'] = $login_info->users_id;
            $brand_data['created_name'] = $login_info->name;
            $brand_data['created_user_agent'] = $this->customlib->load_agent();
            $brand_data['created_ip'] = $this->input->ip_address();
            
            $brand_id = $this->BrandMstModel->add($brand_data);
            
            $this->db->trans_complete();

            if($brand_id > 0) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Admin/ManageBrand');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Admin/ManageBrand/add');

            }                
        }
    }
    
    public function edit($brand_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BRAND, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageBrand';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Brand";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $brand_id = base64_decode($brand_id);
        $data['brand_id'] = $brand_id;
        
        $this->brand_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $data['brand_info'] = $this->BrandMstModel->get_record($brand_id)['0'];

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/brand_edit', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/brand_edit', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $config['upload_path'] = $this->config->item('brand_images');
            $config['allowed_types'] = $this->config->item('allowed_types');
            $config['max_size'] = $this->config->item('max_size');
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['encrypt_name'] = $this->config->item('image_encryption');
            $this->load->library('upload', $config);

            $brand_images = '';

            if ($_FILES['brand_images']['name'] !== '') {
                if (!$this->upload->do_upload('brand_images')) {
                    $brand_images = array('error'=>$this->upload->display_errors());

                    $this->load->view('layout/header', $data);
                    $this->load->view('Admin/brand_edit', $data);
                    $this->load->view('layout/footer', $data);

                } else {
                    $brand_info = $this->BrandMstModel->get_record($brand_id)['0'];
       
                    if($brand_info->images != '') {			
                        unlink(FCPATH.$this->config->item('brand_images').$brand_info->images);
                    }

                    if($brand_info->thumbnail1 != '') {			
                        unlink(FCPATH.$this->config->item('brand_thumbnail1').$brand_info->thumbnail1);
                    }
            
                    if($brand_info->thumbnail2 != '') {			
                        unlink(FCPATH.$this->config->item('brand_thumbnail2').$brand_info->thumbnail2);
                    }
                    
                    $uploadData = $this->upload->data();
                    $fileData['img_file'] = $uploadData['file_name']; 
                    $brand_images = $uploadData['file_name'];
                    
                    $full_path = $this->config->item('brand_thumbnail1');					
					$img_width = $this->config->item('thumbnail_width_500');
					$img_height = $this->config->item('thumbnail_height_250');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width,$img_height);
										
					$full_path = $this->config->item('brand_thumbnail2');					
					$img_width = $this->config->item('thumbnail_width_250');
					$img_height = $this->config->item('thumbnail_height_125');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width, $img_height);
                }
                /*if($brand_images['error'] !== '') {
                    echo $brand_images = '';
                }*/
            }
            
            $this->db->trans_start();
            
            $brand_data['meta_title'] = ''; //$this->input->post('meta_title');
            $brand_data['meta_keywords'] = ''; //$this->input->post('meta_keywords');
            $brand_data['meta_description'] = ''; //$this->input->post('meta_description');
            $brand_data['slug'] = ''; //$this->input->post('slug');
            $brand_data['heading'] = $this->input->post('heading');
            $brand_data['sub_heading'] = ''; //$this->input->post('sub_heading');
            $brand_data['is_show'] = '0'; //$this->input->post('is_show');
            if($brand_images != '') {
                $brand_data['images'] = $brand_images;
                $brand_data['thumbnail1'] = $brand_images;
                $brand_data['thumbnail2'] = $brand_images;
            }
            $brand_data['video'] = ''; //$this->input->post('video');
            $brand_data['short_description1'] = ''; //$this->input->post('short_description1');
            $brand_data['short_description2'] = ''; //$this->input->post('short_description2');
            $brand_data['description'] = ''; //$this->input->post('description');
            $brand_data['tags'] = ''; //$this->input->post('tags');
            $brand_data['is_store'] = $this->input->post('is_store');
            $brand_data['store_priority'] = $this->input->post('store_priority');
            $brand_data['is_app'] = '1'; //$this->input->post('is_app');
            $brand_data['app_priority'] = '0'; //$this->input->post('app_priority');
            $brand_data['is_web'] = '1'; //$this->input->post('is_web');
            $brand_data['web_priority'] = '0'; //$this->input->post('web_priority');
            $brand_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $brand_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $brand_data['updated_by'] = $login_info->users_id;
            $brand_data['updated_name'] = $login_info->name;
            $brand_data['updated_user_agent'] = $this->customlib->load_agent();
            $brand_data['updated_ip'] = $this->input->ip_address();

            $brand_where['brand_id'] = $brand_id;
            
            $this->BrandMstModel->modify($brand_data, $brand_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Admin/ManageBrand');
        }
    }
    
    public function is_store($brand_id, $is_store) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BRAND, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageBrand';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Brand";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $brand_id = base64_decode($brand_id);
        $data['brand_id'] = $brand_id;
        
        $brand_where['brand_id'] = $brand_id;

        $this->db->trans_start();
            
        $brand_data['is_store'] = base64_decode($is_store);
        $brand_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $brand_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $brand_data['updated_by'] = $login_info->users_id;
        $brand_data['updated_name'] = $login_info->name;
        $brand_data['updated_user_agent'] = $this->customlib->load_agent();
        $brand_data['updated_ip'] = $this->input->ip_address();

        $brand_where['brand_id'] = $brand_id;
        
        $this->BrandMstModel->modify($brand_data, $brand_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Admin/ManageBrand');
    }
    
    public function is_app($brand_id, $is_app) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BRAND, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageBrand';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Brand";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $brand_id = base64_decode($brand_id);
        $data['brand_id'] = $brand_id;
        
        $brand_where['brand_id'] = $brand_id;

        $this->db->trans_start();
            
        $brand_data['is_app'] = base64_decode($is_app);
        $brand_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $brand_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $brand_data['updated_by'] = $login_info->users_id;
        $brand_data['updated_name'] = $login_info->name;
        $brand_data['updated_user_agent'] = $this->customlib->load_agent();
        $brand_data['updated_ip'] = $this->input->ip_address();

        $brand_where['brand_id'] = $brand_id;
        
        $this->BrandMstModel->modify($brand_data, $brand_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Admin/ManageBrand');
    }
    
    public function is_web($brand_id, $is_web) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BRAND, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageBrand';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Brand";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $brand_id = base64_decode($brand_id);
        $data['brand_id'] = $brand_id;
        
        $brand_where['brand_id'] = $brand_id;

        $this->db->trans_start();
            
        $brand_data['is_web'] = base64_decode($is_web);
        $brand_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $brand_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $brand_data['updated_by'] = $login_info->users_id;
        $brand_data['updated_name'] = $login_info->name;
        $brand_data['updated_user_agent'] = $this->customlib->load_agent();
        $brand_data['updated_ip'] = $this->input->ip_address();

        $brand_where['brand_id'] = $brand_id;
        
        $this->BrandMstModel->modify($brand_data, $brand_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Admin/ManageBrand');
    }
    
    public function del($brand_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_BRAND, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageBrand';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Brand";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $brand_id = base64_decode($brand_id);
        $data['brand_id'] = $brand_id;
        
        $brand_where['brand_id'] = $brand_id;
        
        $brand_info = $this->BrandMstModel->get_record($brand_id)['0'];
       
        if($brand_info->images != '') {			
            unlink(FCPATH.$this->config->item('brand_images').$brand_info->images);
        }

        if($brand_info->thumbnail1 != '') {			
            unlink(FCPATH.$this->config->item('brand_thumbnail1').$brand_info->thumbnail1);
        }

        if($brand_info->thumbnail2 != '') {			
            unlink(FCPATH.$this->config->item('brand_thumbnail2').$brand_info->thumbnail2);
        }

        $this->BrandMstModel->delete($brand_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Admin/ManageBrand');
    }
	
	public function brand_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
        
        /*$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|max_length[255]');		
		$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|max_length[255]');		
		$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|max_length[50000]');
        $this->form_validation->set_rules('slug', 'Slug', 'trim|max_length[255]');*/
        
		$this->form_validation->set_rules('heading', 'Brand Name', 'trim|required|max_length[255]');		
		/*$this->form_validation->set_rules('sub_heading', 'Sub Heading', 'trim|max_length[255]');		
        
        $this->form_validation->set_rules('is_show', 'Show', 'trim|required|is_natural|exact_length[1]');
		$this->form_validation->set_rules('video', 'Video', 'trim|max_length[5000]');
        
        $this->form_validation->set_rules('short_description1', 'Short Description 1', 'trim|min_length[0]|max_length[100]');
		$this->form_validation->set_rules('short_description2', 'Short Description 2', 'trim|min_length[0]|max_length[250]');
		$this->form_validation->set_rules('description', 'Description', 'trim|min_length[0]|max_length[5000000]');		
		$this->form_validation->set_rules('tags', 'Tags', 'trim|max_length[1000]');*/
		
		$this->form_validation->set_rules('is_store', 'Store Display', 'trim|required|is_natural|exact_length[1]');
        $this->form_validation->set_rules('store_priority', 'Store Priority', 'trim|required|is_natural|min_length[1]|max_length[10]');
        
		/*$this->form_validation->set_rules('is_app', 'App Display', 'trim|required|is_natural|exact_length[1]');
		$this->form_validation->set_rules('app_priority', 'App Priority', 'trim|required|is_natural|min_length[1]|max_length[10]');
		$this->form_validation->set_rules('is_web', 'Web Display', 'trim|required|is_natural|exact_length[1]');
		$this->form_validation->set_rules('web_priority', 'Web Priority', 'trim|required|is_natural|min_length[1]|max_length[10]');*/		
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