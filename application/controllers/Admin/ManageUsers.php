<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ManageUsers extends CI_Controller {
    
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
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_USERS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageUsers';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Users";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['users_info'] = $this->UsersMstModel->get_record();

        $this->load->view('layout/header', $data);
        $this->load->view('Admin/users_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function view($users_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_USERS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageUsers';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Users";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $users_id = base64_decode($users_id);
        $data['users_id'] = $users_id;
        
        $data['users_info'] = $this->UsersMstModel->get_record($users_id)['0'];
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/users_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_USERS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageUsers';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Users";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['store_list'] = $this->StoreMstModel->get_select();

        $data['users_type_list'] = $this->UsersTypeMstModel->get_select();

        $this->users_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/users_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/users_add', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {
            $config['upload_path'] = $this->config->item('users_images');
            $config['allowed_types'] = $this->config->item('allowed_types');
            $config['max_size'] = $this->config->item('max_size');
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['encrypt_name'] = $this->config->item('image_encryption');
            $this->load->library('upload', $config);

            $users_images = '';

            if ($_FILES['users_images']['name'] !== '') {
                if (!$this->upload->do_upload('users_images')) {
                    $users_images = array('error'=>$this->upload->display_errors());

                    $this->load->view('layout/header', $data);
                    $this->load->view('Admin/users_add', $data);
                    $this->load->view('layout/footer', $data);

                } else {            
                    $uploadData = $this->upload->data();
                    $fileData['img_file'] = $uploadData['file_name']; 
                    $users_images = $uploadData['file_name'];
                    
                    $full_path = $this->config->item('users_thumbnail1');					
					$img_width = $this->config->item('thumbnail_width_500');
					$img_height = $this->config->item('thumbnail_height_500');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width,$img_height);
										
					$full_path = $this->config->item('users_thumbnail2');					
					$img_width = $this->config->item('thumbnail_width_250');
					$img_height = $this->config->item('thumbnail_height_250');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width, $img_height);
                }
                /*if($users_images['error'] !== '') {
                    echo $users_images = '';
                }*/
            }
            
            $password = strtolower(random_string('alpha', '6'));

            $this->db->trans_start();

            $users_data['store_id'] = $this->input->post('store_id');
            $users_data['name'] = $this->input->post('name');
            $users_data['images'] = $users_images;
            $users_data['thumbnail1'] = $users_images;
            $users_data['thumbnail2'] = $users_images;
            $users_data['mobile'] = $this->input->post('mobile');
            $users_data['email'] = $this->input->post('email');
            $users_data['username'] = $this->input->post('username');
            $users_data['password'] = md5($password);
            $users_data['forgot_psw'] = $password;
            $users_data['users_type_id'] = $this->input->post('users_type_id');           
            $users_data['activation'] = $this->input->post('activation');
            $users_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $users_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $users_data['created_by'] = $login_info->users_id;
            $users_data['created_name'] = $login_info->name;
            $users_data['created_user_agent'] = $this->customlib->load_agent();
            $users_data['created_ip'] = $this->input->ip_address();
            
            $users_id = $this->UsersMstModel->add($users_data);
            
            $this->db->trans_complete();

            if($users_id > 0) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Admin/ManageUsers');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Admin/ManageUsers/add');

            }                
        }
    }
    
    public function edit($users_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_USERS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageUsers';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Users";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $users_id = base64_decode($users_id);
        $data['users_id'] = $users_id;
        
        $data['store_list'] = $this->StoreMstModel->get_select();

        $data['users_type_list'] = $this->UsersTypeMstModel->get_select();

        $this->users_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $data['users_info'] = $this->UsersMstModel->get_record($users_id)['0'];

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/users_edit', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/users_edit', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            $config['upload_path'] = $this->config->item('users_images');
            $config['allowed_types'] = $this->config->item('allowed_types');
            $config['max_size'] = $this->config->item('max_size');
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['encrypt_name'] = $this->config->item('image_encryption');
            $this->load->library('upload', $config);

            $users_images = '';

            if ($_FILES['users_images']['name'] !== '') {
                if (!$this->upload->do_upload('users_images')) {
                    $users_images = array('error'=>$this->upload->display_errors());

                    $this->load->view('layout/header', $data);
                    $this->load->view('Admin/users_edit', $data);
                    $this->load->view('layout/footer', $data);

                } else {
                    $users_info = $this->UsersMstModel->get_record($users_id)['0'];
       
                    if($users_info->images != '') {			
                        unlink(FCPATH.$this->config->item('users_images').$users_info->images);
                    }

                    if($users_info->thumbnail1 != '') {			
                        unlink(FCPATH.$this->config->item('users_thumbnail1').$users_info->thumbnail1);
                    }
            
                    if($users_info->thumbnail2 != '') {			
                        unlink(FCPATH.$this->config->item('users_thumbnail2').$users_info->thumbnail2);
                    }
                    
                    $uploadData = $this->upload->data();
                    $fileData['img_file'] = $uploadData['file_name']; 
                    $users_images = $uploadData['file_name'];
                    
                    $full_path = $this->config->item('users_thumbnail1');					
					$img_width = $this->config->item('thumbnail_width_500');
					$img_height = $this->config->item('thumbnail_height_500');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width,$img_height);
										
					$full_path = $this->config->item('users_thumbnail2');					
					$img_width = $this->config->item('thumbnail_width_250');
					$img_height = $this->config->item('thumbnail_height_250');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width, $img_height);
                }
                /*if($users_images['error'] !== '') {
                    echo $users_images = '';
                }*/
            }
            
            $this->db->trans_start();
            
            $users_data['store_id'] = $this->input->post('store_id');
            $users_data['name'] = $this->input->post('name');
            if($users_images != '') {
                $users_data['images'] = $users_images;
                $users_data['thumbnail1'] = $users_images;
                $users_data['thumbnail2'] = $users_images;
            }
            $users_data['mobile'] = $this->input->post('mobile');
            $users_data['email'] = $this->input->post('email');
            $users_data['username'] = $this->input->post('username');  
            $users_data['users_type_id'] = $this->input->post('users_type_id');           
            $users_data['activation'] = $this->input->post('activation');
            $users_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $users_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $users_data['updated_by'] = $login_info->users_id;
            $users_data['updated_name'] = $login_info->name;
            $users_data['updated_user_agent'] = $this->customlib->load_agent();
            $users_data['updated_ip'] = $this->input->ip_address();

            $users_where['users_id'] = $users_id;
            
            $this->UsersMstModel->modify($users_data, $users_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Admin/ManageUsers');
        }
    }
    
    public function is_activation($users_id, $activation) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_USERS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageUsers';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Users";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $users_id = base64_decode($users_id);
        $data['users_id'] = $users_id;
        
        $users_where['users_id'] = $users_id;

        $this->db->trans_start();
            
        $users_data['activation'] = base64_decode($activation);
        $users_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $users_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $users_data['updated_by'] = $login_info->users_id;
        $users_data['updated_name'] = $login_info->name;
        $users_data['updated_user_agent'] = $this->customlib->load_agent();
        $users_data['updated_ip'] = $this->input->ip_address();

        $users_where['users_id'] = $users_id;
        
        $this->UsersMstModel->modify($users_data, $users_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Admin/ManageUsers');
    }
    
    public function del($users_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_USERS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageUsers';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Users";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $users_id = base64_decode($users_id);
        $data['users_id'] = $users_id;
        
        $users_where['users_id'] = $users_id;
        
        $users_info = $this->UsersMstModel->get_record($users_id)['0'];
       
        if($users_info->images != '') {			
            unlink(FCPATH.$this->config->item('users_images').$users_info->images);
        }

        if($users_info->thumbnail1 != '') {			
            unlink(FCPATH.$this->config->item('users_thumbnail1').$users_info->thumbnail1);
        }

        if($users_info->thumbnail2 != '') {			
            unlink(FCPATH.$this->config->item('users_thumbnail2').$users_info->thumbnail2);
        }

        $this->UsersMstModel->delete($users_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Admin/ManageUsers');
    }
	
	public function users_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('store_id', 'Store Name', 'trim|required');
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|valid_email|max_length[255]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|max_length[20]');

        $this->form_validation->set_rules('users_type_id', 'Users Type', 'trim|required');		
		$this->form_validation->set_rules('activation', 'Activation', 'trim|required|is_natural|exact_length[1]');
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