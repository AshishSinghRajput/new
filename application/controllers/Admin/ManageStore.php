<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ManageStore extends CI_Controller {
    
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
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_STORE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageStore';
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
        
        $data['store_info'] = $this->StoreMstModel->get_record();

        $this->load->view('layout/header', $data);
        $this->load->view('Admin/store_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function view($store_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_STORE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageStore';
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
        
        $store_id = base64_decode($store_id);
        $data['store_id'] = $store_id;
        
        $data['store_info'] = $this->StoreMstModel->get_record($store_id)['0'];
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/store_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_STORE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageStore';
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
        
        $data['state_list'] = $this->LocationMstModel->get_state();

        $this->store_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/store_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                if($this->input->post('state_name') != '') {
                    $data['city_list'] = $this->LocationMstModel->get_city($this->input->post('state_name'));
                }

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/store_add', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $config['upload_path'] = $this->config->item('store_images');
            $config['allowed_types'] = $this->config->item('allowed_types');
            $config['max_size'] = $this->config->item('max_size');
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['encrypt_name'] = $this->config->item('image_encryption');
            $this->load->library('upload', $config);

            $store_images = '';

            if ($_FILES['store_images']['name'] !== '') {
                if (!$this->upload->do_upload('store_images')) {
                    $store_images = array('error'=>$this->upload->display_errors());

                    $this->load->view('layout/header', $data);
                    $this->load->view('Admin/store_add', $data);
                    $this->load->view('layout/footer', $data);

                } else {            
                    $uploadData = $this->upload->data();
                    $fileData['img_file'] = $uploadData['file_name']; 
                    $store_images = $uploadData['file_name'];
                    
                    $full_path = $this->config->item('store_thumbnail1');					
					$img_width = $this->config->item('thumbnail_width_500');
					$img_height = $this->config->item('thumbnail_height_250');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width,$img_height);
										
					$full_path = $this->config->item('store_thumbnail2');					
					$img_width = $this->config->item('thumbnail_width_250');
					$img_height = $this->config->item('thumbnail_height_125');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width, $img_height);
                }
                /*if($store_images['error'] !== '') {
                    echo $store_images = '';
                }*/
            }
            
            $location_val = $this->LocationMstModel->get_record('', $this->input->post('state_name'), $this->input->post('city'))['0'];
            
            $this->db->trans_start();
            
            $store_data['store_name'] = $this->input->post('store_name');
            $store_data['owner_name'] = $this->input->post('owner_name');
            $store_data['images'] = $store_images;
            $store_data['thumbnail1'] = $store_images;
            $store_data['thumbnail2'] = $store_images;
            $store_data['address'] = $this->input->post('address');
            $store_data['country_name'] = $location_val->country_name;
            $store_data['state_name'] = $this->input->post('state_name');
            $store_data['city_name'] = $this->input->post('city_name');
            $store_data['zip_code'] = $this->input->post('zip_code');
            $store_data['mobile1'] = $this->input->post('mobile1');
            $store_data['mobile2'] = $this->input->post('mobile2');
            $store_data['email'] = $this->input->post('email');
            $store_data['website'] = $this->input->post('website');
            $store_data['gsin_no'] = $this->input->post('gsin_no');
            $store_data['pan_no'] = $this->input->post('pan_no');
            $store_data['aadhar_no'] = $this->input->post('aadhar_no');
            $store_data['display'] = $this->input->post('display');
            $store_data['priority'] = $this->input->post('priority');
            $store_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $store_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $store_data['created_by'] = $login_info->users_id;
            $store_data['created_name'] = $login_info->name;
            $store_data['created_user_agent'] = $this->customlib->load_agent();
            $store_data['created_ip'] = $this->input->ip_address();
            
            $store_id = $this->StoreMstModel->add($store_data);
            
            $this->db->trans_complete();

            if($store_id > 0) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Admin/ManageStore');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Admin/ManageStore/add');

            }                
        }
    }
    
    public function edit($store_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_STORE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageStore';
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
        
        $store_id = base64_decode($store_id);
        $data['store_id'] = $store_id;
        
        $data['state_list'] = $this->LocationMstModel->get_state();

        $this->store_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $data['store_info'] = $this->StoreMstModel->get_record($store_id)['0'];
                $data['city_list'] = $this->LocationMstModel->get_city($data['store_info']->state_name);

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/store_edit', $data);
                $this->load->view('layout/footer', $data);

            } else {
                if($this->input->post('state_name') != '') {
                    $data['city_list'] = $this->LocationMstModel->get_city($this->input->post('state_name'));
                }

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/store_edit', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $config['upload_path'] = $this->config->item('store_images');
            $config['allowed_types'] = $this->config->item('allowed_types');
            $config['max_size'] = $this->config->item('max_size');
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['encrypt_name'] = $this->config->item('image_encryption');
            $this->load->library('upload', $config);

            $store_images = '';

            if ($_FILES['store_images']['name'] !== '') {
                if (!$this->upload->do_upload('store_images')) {
                    $store_images = array('error'=>$this->upload->display_errors());

                    $this->load->view('layout/header', $data);
                    $this->load->view('Admin/store_edit', $data);
                    $this->load->view('layout/footer', $data);

                } else {            
                    $store_info = $this->StoreMstModel->get_record($store_id)['0'];
       
                    if($store_info->images != '') {			
                        unlink(FCPATH.$this->config->item('store_images').$store_info->images);
                    }

                    if($store_info->thumbnail1 != '') {			
                        unlink(FCPATH.$this->config->item('store_thumbnail1').$store_info->thumbnail1);
                    }
            
                    if($store_info->thumbnail2 != '') {			
                        unlink(FCPATH.$this->config->item('store_thumbnail2').$store_info->thumbnail2);
                    }

                    $uploadData = $this->upload->data();
                    $fileData['img_file'] = $uploadData['file_name']; 
                    $store_images = $uploadData['file_name'];
                    
                    $full_path = $this->config->item('store_thumbnail1');					
					$img_width = $this->config->item('thumbnail_width_500');
					$img_height = $this->config->item('thumbnail_height_250');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width,$img_height);
										
					$full_path = $this->config->item('store_thumbnail2');					
					$img_width = $this->config->item('thumbnail_width_250');
					$img_height = $this->config->item('thumbnail_height_125');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width, $img_height);
                }
                /*if($store_images['error'] !== '') {
                    echo $store_images = '';
                }*/
            }
            
            $location_val = $this->LocationMstModel->get_record('', $this->input->post('state_name'), $this->input->post('city'))['0'];
            
            $this->db->trans_start();
            
            $store_data['store_name'] = $this->input->post('store_name');
            $store_data['owner_name'] = $this->input->post('owner_name');
            if($store_images != '') {
                $store_data['images'] = $store_images;
                $store_data['thumbnail1'] = $store_images;
                $store_data['thumbnail2'] = $store_images;
            }
            $store_data['address'] = $this->input->post('address');
            $store_data['country_name'] = $location_val->country_name;
            $store_data['state_name'] = $this->input->post('state_name');
            $store_data['city_name'] = $this->input->post('city_name');
            $store_data['zip_code'] = $this->input->post('zip_code');
            $store_data['mobile1'] = $this->input->post('mobile1');
            $store_data['mobile2'] = $this->input->post('mobile2');
            $store_data['email'] = $this->input->post('email');
            $store_data['website'] = $this->input->post('website');
            $store_data['gsin_no'] = $this->input->post('gsin_no');
            $store_data['pan_no'] = $this->input->post('pan_no');
            $store_data['aadhar_no'] = $this->input->post('aadhar_no');
            $store_data['display'] = $this->input->post('display');
            $store_data['priority'] = $this->input->post('priority');
            $store_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $store_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $store_data['updated_by'] = $login_info->users_id;
            $store_data['updated_name'] = $login_info->name;
            $store_data['updated_user_agent'] = $this->customlib->load_agent();
            $store_data['updated_ip'] = $this->input->ip_address();

            $store_where['store_id'] = $store_id;
            
            $this->StoreMstModel->modify($store_data, $store_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Admin/ManageStore');
        }
    }
    
    public function is_display($store_id, $display) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_STORE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageStore';
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
        
        $store_id = base64_decode($store_id);
        $data['store_id'] = $store_id;
        
        $store_where['store_id'] = $store_id;

        $this->db->trans_start();
            
        $store_data['display'] = base64_decode($display);
        $store_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $store_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $store_data['updated_by'] = $login_info->users_id;
        $store_data['updated_name'] = $login_info->name;
        $store_data['updated_user_agent'] = $this->customlib->load_agent();
        $store_data['updated_ip'] = $this->input->ip_address();

        $store_where['store_id'] = $store_id;
        
        $this->StoreMstModel->modify($store_data, $store_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Admin/ManageStore');
    }
    
    public function del($store_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_STORE, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageStore';
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
        
        $store_id = base64_decode($store_id);
        $data['store_id'] = $store_id;
        
        $store_where['store_id'] = $store_id;
        
        $store_info = $this->StoreMstModel->get_record($store_id)['0'];
       
        if($store_info->images != '') {			
            unlink(FCPATH.$this->config->item('store_images').$store_info->images);
        }

        if($store_info->thumbnail1 != '') {			
            unlink(FCPATH.$this->config->item('store_thumbnail1').$store_info->thumbnail1);
        }

        if($store_info->thumbnail2 != '') {			
            unlink(FCPATH.$this->config->item('store_thumbnail2').$store_info->thumbnail2);
        }

        $this->StoreMstModel->delete($store_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Admin/ManageStore');
    }
	
	public function store_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[255]');		
		$this->form_validation->set_rules('owner_name', 'Owner Name', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]');		
        $this->form_validation->set_rules('state_name', 'State', 'trim|required');		
        $this->form_validation->set_rules('city_name', 'City', 'trim|required');
        $this->form_validation->set_rules('zip_code', 'Zip code', 'trim|required|numeric|exact_length[6]');
		$this->form_validation->set_rules('mobile1', 'Mobile No. 1', 'trim|required|numeric|exact_length[10]');
		$this->form_validation->set_rules('mobile2', 'Mobile No. 2', 'trim|numeric|exact_length[10]');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[255]');		
		$this->form_validation->set_rules('website', 'Website', 'callback_valid_url');
        
		$this->form_validation->set_rules('gsin_no', 'GSIN No.', 'trim|max_length[20]');
		$this->form_validation->set_rules('pan_no', 'PAN No.', 'trim|exact_length[10]');
        $this->form_validation->set_rules('aadhar_no', 'Aadhar No.', 'trim|numeric|exact_length[12]');
		
		$this->form_validation->set_rules('display', 'Display', 'trim|required|is_natural|exact_length[1]');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|is_natural|min_length[1]|max_length[10]');
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