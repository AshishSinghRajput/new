<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ManageProduct extends CI_Controller {
    
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
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_PRODUCT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageProduct';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Product";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['product_info'] = $this->ProductMstModel->get_record();

        $this->load->view('layout/header', $data);
        $this->load->view('Admin/product_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function view($product_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_PRODUCT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        $main_menu['active'] = 'ManageProduct';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Product";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;
        
        $product_id = base64_decode($product_id);
        $data['product_id'] = $product_id;
        
        $data['product_info'] = $this->ProductMstModel->get_full_record($product_id)['0'];
       
        $this->load->view('layout/header', $data);
        $this->load->view('Admin/product_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function add() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_PRODUCT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageProduct';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Product";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $data['brand_list'] = $this->BrandMstModel->get_is_store_select();

        $data['category1_list'] = $this->CategoryMstModel->get_is_store_select('0');

        $data['packing_list'] = $this->PackingMstModel->get_select();

        $data['unit_list'] = $this->UnitMstModel->get_select();
        $data['weight_unit_list'] = $this->UnitMstModel->get_select('1');
        $data['lwh_unit_list'] = $this->UnitMstModel->get_select('2');

        $data['cgst_taxes_list'] = $this->TaxesMstModel->get_select('1');
        $data['sgst_taxes_list'] = $this->TaxesMstModel->get_select('2');
        $data['igst_taxes_list'] = $this->TaxesMstModel->get_select('3');

        $this->product_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Admin/product_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                if($this->input->post('category1_id') != '') {
                    $data['category2_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category1_id'));	
                }

                if($this->input->post('category2_id') != '') {
                    $data['category3_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category2_id'));	
                }

                if($this->input->post('category3_id') != '') {
                    $data['category4_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category3_id'));	
                }

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/product_add', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {
            $config['upload_path'] = $this->config->item('product_images');
            $config['allowed_types'] = $this->config->item('allowed_types');
            $config['max_size'] = $this->config->item('max_size');
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['encrypt_name'] = $this->config->item('image_encryption');
            $this->load->library('upload', $config);

            $product_images = '';

            if ($_FILES['product_images']['name'] !== '') {
                if (!$this->upload->do_upload('product_images')) {
                    $product_images = array('error'=>$this->upload->display_errors());

                    $this->load->view('layout/header', $data);
                    $this->load->view('Admin/product_add', $data);
                    $this->load->view('layout/footer', $data);

                } else {            
                    $uploadData = $this->upload->data();
                    $fileData['img_file'] = $uploadData['file_name']; 
                    $product_images = $uploadData['file_name'];
                    
                    $full_path = $this->config->item('product_thumbnail1');					
					$img_width = $this->config->item('thumbnail_width_500');
					$img_height = $this->config->item('thumbnail_height_250');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width,$img_height);
										
					$full_path = $this->config->item('product_thumbnail2');					
					$img_width = $this->config->item('thumbnail_width_250');
					$img_height = $this->config->item('thumbnail_height_125');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width, $img_height);
                }
                /*if($product_images['error'] !== '') {
                    echo $product_images = '';
                }*/
            }
            
            $this->db->trans_start();

            $product_mst_data['meta_title'] = ''; //$this->input->post('meta_title');
            $product_mst_data['meta_keywords'] = ''; //$this->input->post('meta_keywords');
            $product_mst_data['meta_description'] = ''; //$this->input->post('meta_description');
            $product_mst_data['slug'] = ''; //$this->input->post('slug');
            
            $product_mst_data['master_id'] = '0'; //$this->input->post('master_id');
            
            $product_mst_data['ean_upc_gtin'] = $this->input->post('ean_upc_gtin');
            $product_mst_data['hsn_code'] = $this->input->post('hsn_code');
            $product_mst_data['mpn_code'] = $this->input->post('mpn_code');
            $product_mst_data['sku_code'] = $this->input->post('sku_code');
            $product_mst_data['product_code'] = $this->input->post('product_code');
            
            $product_mst_data['heading'] = $this->input->post('heading');
            $product_mst_data['sub_heading'] = ''; //$this->input->post('sub_heading');

            $product_mst_data['brand_id'] = $this->input->post('brand_id');
            $product_mst_data['category1_id'] = $this->input->post('category1_id');
            $product_mst_data['category2_id'] = $this->input->post('category2_id');
            $product_mst_data['category3_id'] = $this->input->post('category3_id');
            $product_mst_data['category4_id'] = $this->input->post('category4_id');
            
            $product_mst_data['is_download'] = '0'; //$this->input->post('is_download');
            $product_mst_data['is_show'] = '0'; //$this->input->post('is_show');
            $product_mst_data['images'] = $product_images;
            $product_mst_data['thumbnail1'] = $product_images;
            $product_mst_data['thumbnail2'] = $product_images;
            $product_mst_data['video'] = ''; //$this->input->post('video');
            $product_mst_data['pdf'] = ''; //$this->input->post('pdf');
            $product_mst_data['zip'] = ''; //$this->input->post('zip');
        
            $product_mst_data['model'] = $this->input->post('model');
            $product_mst_data['is_product_type'] = $this->input->post('is_product_type');
            $product_mst_data['packing_id'] = $this->input->post('packing_id');
            $product_mst_data['unit_id'] = $this->input->post('unit_id');
            $product_mst_data['weight'] = $this->input->post('weight');
            $product_mst_data['weight_unit_id'] = $this->input->post('weight_unit_id');
            $product_mst_data['length'] = $this->input->post('length');
            $product_mst_data['width'] = $this->input->post('width');
            $product_mst_data['height'] = $this->input->post('height');
            $product_mst_data['lwh_unit_id'] = $this->input->post('lwh_unit_id');
            $product_mst_data['cgst_taxes_id'] = $this->input->post('cgst_taxes_id');
            $product_mst_data['sgst_taxes_id'] = $this->input->post('sgst_taxes_id');
            $product_mst_data['igst_taxes_id'] = $this->input->post('igst_taxes_id');

            $product_mst_data['additional'] = ''; //$this->input->post('additional');
            $product_mst_data['short_description1'] = ''; //$this->input->post('short_description1');
            $product_mst_data['short_description2'] = ''; //$this->input->post('short_description2');
            $product_mst_data['description'] = ''; //$this->input->post('description');
            $product_mst_data['tags'] = ''; //$this->input->post('tags');

            $product_mst_data['is_store'] = $this->input->post('is_store');
            $product_mst_data['store_priority'] = $this->input->post('store_priority');
            $product_mst_data['is_app'] = '1'; //$this->input->post('is_app');
            $product_mst_data['app_priority'] = '0'; //$this->input->post('app_priority');
            $product_mst_data['is_web'] = '1'; //$this->input->post('is_web');
            $product_mst_data['web_priority'] = '0'; //$this->input->post('web_priority');
            $product_mst_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $product_mst_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $product_mst_data['created_by'] = $login_info->users_id;
            $product_mst_data['created_name'] = $login_info->name;
            $product_mst_data['created_user_agent'] = $this->customlib->load_agent();
            $product_mst_data['created_ip'] = $this->input->ip_address();
            
            $product_id = $this->ProductMstModel->add($product_mst_data);
            
            $this->db->trans_complete();

            if($product_id > 0) {                    
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Admin/ManageProduct');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Admin/ManageProduct/add');

            }                
        }
    }
    
    public function edit($product_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_PRODUCT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageProduct';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Product";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $product_id = base64_decode($product_id);
        $data['product_id'] = $product_id;
        
        $data['brand_list'] = $this->BrandMstModel->get_is_store_select();

        $data['category1_list'] = $this->CategoryMstModel->get_is_store_select('0');

        $data['packing_list'] = $this->PackingMstModel->get_select();

        $data['unit_list'] = $this->UnitMstModel->get_select();
        $data['weight_unit_list'] = $this->UnitMstModel->get_select('1');
        $data['lwh_unit_list'] = $this->UnitMstModel->get_select('2');

        $data['cgst_taxes_list'] = $this->TaxesMstModel->get_select('1');
        $data['sgst_taxes_list'] = $this->TaxesMstModel->get_select('2');
        $data['igst_taxes_list'] = $this->TaxesMstModel->get_select('3');
        
        $this->product_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $product_info = $this->ProductMstModel->get_record($product_id)['0'];
                $data['product_info'] = $product_info;

                $data['category2_list'] = $this->CategoryMstModel->get_is_store_select($product_info->category1_id);
                
                $data['category3_list'] = $this->CategoryMstModel->get_is_store_select($product_info->category2_id);
                
                $data['category4_list'] = $this->CategoryMstModel->get_is_store_select($product_info->category3_id);                

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/product_edit', $data);
                $this->load->view('layout/footer', $data);

            } else {
                if($this->input->post('category1_id') != '') {
                    $data['category2_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category1_id'));	
                }

                if($this->input->post('category2_id') != '') {
                    $data['category3_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category2_id'));	
                }

                if($this->input->post('category3_id') != '') {
                    $data['category4_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category3_id'));	
                }

                $this->load->view('layout/header', $data);
                $this->load->view('Admin/product_edit', $data);
                $this->load->view('layout/footer', $data);

            }
        } else {
            $config['upload_path'] = $this->config->item('product_images');
            $config['allowed_types'] = $this->config->item('allowed_types');
            $config['max_size'] = $this->config->item('max_size');
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['encrypt_name'] = $this->config->item('image_encryption');
            $this->load->library('upload', $config);

            $product_images = '';

            if ($_FILES['product_images']['name'] !== '') {
                if (!$this->upload->do_upload('product_images')) {
                    $product_images = array('error'=>$this->upload->display_errors());

                    $this->load->view('layout/header', $data);
                    $this->load->view('Admin/product_edit', $data);
                    $this->load->view('layout/footer', $data);

                } else {
                    $product_info = $this->ProductMstModel->get_record($product_id)['0'];
       
                    if($product_info->images != '') {			
                        unlink(FCPATH.$this->config->item('product_images').$product_info->images);
                    }

                    if($product_info->thumbnail1 != '') {			
                        unlink(FCPATH.$this->config->item('product_thumbnail1').$product_info->thumbnail1);
                    }
            
                    if($product_info->thumbnail2 != '') {			
                        unlink(FCPATH.$this->config->item('product_thumbnail2').$product_info->thumbnail2);
                    }
                    
                    $uploadData = $this->upload->data();
                    $fileData['img_file'] = $uploadData['file_name']; 
                    $product_images = $uploadData['file_name'];
                    
                    $full_path = $this->config->item('product_thumbnail1');					
					$img_width = $this->config->item('thumbnail_width_500');
					$img_height = $this->config->item('thumbnail_height_250');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width,$img_height);
										
					$full_path = $this->config->item('product_thumbnail2');					
					$img_width = $this->config->item('thumbnail_width_250');
					$img_height = $this->config->item('thumbnail_height_125');
					$this->create_thumb($full_path, $uploadData['file_path'].'/'.$uploadData['file_name'],$img_width, $img_height);
                }
                /*if($product_images['error'] !== '') {
                    echo $product_images = '';
                }*/
            }
            
            $this->db->trans_start();            
            
            $product_mst_data['meta_title'] = ''; //$this->input->post('meta_title');
            $product_mst_data['meta_keywords'] = ''; //$this->input->post('meta_keywords');
            $product_mst_data['meta_description'] = ''; //$this->input->post('meta_description');
            $product_mst_data['slug'] = ''; //$this->input->post('slug');
            
            $product_mst_data['master_id'] = '0'; //$this->input->post('master_id');
            
            $product_mst_data['ean_upc_gtin'] = $this->input->post('ean_upc_gtin');
            $product_mst_data['hsn_code'] = $this->input->post('hsn_code');
            $product_mst_data['mpn_code'] = $this->input->post('mpn_code');
            $product_mst_data['sku_code'] = $this->input->post('sku_code');
            $product_mst_data['product_code'] = $this->input->post('product_code');
            
            $product_mst_data['heading'] = $this->input->post('heading');
            $product_mst_data['sub_heading'] = ''; //$this->input->post('sub_heading');

            $product_mst_data['brand_id'] = $this->input->post('brand_id');
            $product_mst_data['category1_id'] = $this->input->post('category1_id');
            $product_mst_data['category2_id'] = $this->input->post('category2_id');
            $product_mst_data['category3_id'] = $this->input->post('category3_id');
            $product_mst_data['category4_id'] = $this->input->post('category4_id');
            
            /*$product_mst_data['is_download'] = '0'; //$this->input->post('is_download');
            $product_mst_data['is_show'] = '0'; //$this->input->post('is_show');*/
            
            if($product_images != '') {
                $product_mst_data['images'] = $product_images;
                $product_mst_data['thumbnail1'] = $product_images;
                $product_mst_data['thumbnail2'] = $product_images;
            }
            
            /*$product_mst_data['video'] = ''; //$this->input->post('video');
            $product_mst_data['pdf'] = ''; //$this->input->post('pdf');
            $product_mst_data['zip'] = ''; //$this->input->post('zip');*/
        
            $product_mst_data['model'] = $this->input->post('model');
            $product_mst_data['is_product_type'] = $this->input->post('is_product_type');
            $product_mst_data['packing_id'] = $this->input->post('packing_id');
            $product_mst_data['unit_id'] = $this->input->post('unit_id');
            $product_mst_data['weight'] = $this->input->post('weight');
            $product_mst_data['weight_unit_id'] = $this->input->post('weight_unit_id');
            $product_mst_data['length'] = $this->input->post('length');
            $product_mst_data['width'] = $this->input->post('width');
            $product_mst_data['height'] = $this->input->post('height');
            $product_mst_data['lwh_unit_id'] = $this->input->post('lwh_unit_id');
            $product_mst_data['cgst_taxes_id'] = $this->input->post('cgst_taxes_id');
            $product_mst_data['sgst_taxes_id'] = $this->input->post('sgst_taxes_id');
            $product_mst_data['igst_taxes_id'] = $this->input->post('igst_taxes_id');

            $product_mst_data['additional'] = ''; //$this->input->post('additional');
            $product_mst_data['short_description1'] = ''; //$this->input->post('short_description1');
            $product_mst_data['short_description2'] = ''; //$this->input->post('short_description2');
            $product_mst_data['description'] = ''; //$this->input->post('description');
            $product_mst_data['tags'] = ''; //$this->input->post('tags');

            $product_mst_data['is_store'] = $this->input->post('is_store');
            $product_mst_data['store_priority'] = $this->input->post('store_priority');
            $product_mst_data['is_app'] = '1'; //$this->input->post('is_app');
            $product_mst_data['app_priority'] = '0'; //$this->input->post('app_priority');
            $product_mst_data['is_web'] = '1'; //$this->input->post('is_web');
            $product_mst_data['web_priority'] = '0'; //$this->input->post('web_priority');
            $product_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $product_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $product_mst_data['updated_by'] = $login_info->users_id;
            $product_mst_data['updated_name'] = $login_info->name;
            $product_mst_data['updated_user_agent'] = $this->customlib->load_agent();
            $product_mst_data['updated_ip'] = $this->input->ip_address();

            $product_mst_where['product_id'] = $product_id;
            
            $this->ProductMstModel->modify($product_mst_data, $product_mst_where);
            
            $product_account_data['brand_id'] = $this->input->post('brand_id');
            $product_account_data['category1_id'] = $this->input->post('category1_id');
            $product_account_data['category2_id'] = $this->input->post('category2_id');
            $product_account_data['category3_id'] = $this->input->post('category3_id');
            $product_account_data['category4_id'] = $this->input->post('category4_id');
            $product_account_data['display'] = $this->input->post('display');
            $product_account_data['priority'] = $this->input->post('priority');
            $product_account_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $product_account_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $product_account_data['updated_by'] = $login_info->users_id;
            $product_account_data['updated_name'] = $login_info->name;
            $product_account_data['updated_user_agent'] = $this->customlib->load_agent();
            $product_account_data['updated_ip'] = $this->input->ip_address();

            $product_account_where['product_id'] = $product_id;
            $product_account_where['finyear_id'] = $finyear_info->finyear_id;
            
            $this->ProductAccountMstModel->modify($product_account_data, $product_account_where);
            
            $this->db->trans_complete();
                       
            $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
            redirect('Admin/ManageProduct');
        }
    }
    
    public function is_product_type($product_id, $is_product_type) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_PRODUCT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageProduct';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Product";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $product_id = base64_decode($product_id);
        $data['product_id'] = $product_id;
        
        $product_mst_where['product_id'] = $product_id;

        $this->db->trans_start();
            
        $product_mst_data['is_product_type'] = base64_decode($is_product_type);
        $product_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_mst_data['updated_by'] = $login_info->users_id;
        $product_mst_data['updated_name'] = $login_info->name;
        $product_mst_data['updated_user_agent'] = $this->customlib->load_agent();
        $product_mst_data['updated_ip'] = $this->input->ip_address();

        $product_mst_where['product_id'] = $product_id;
        
        $this->ProductMstModel->modify($product_mst_data, $product_mst_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Admin/ManageProduct');
    }
    
    public function is_store($product_id, $is_store) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_PRODUCT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageProduct';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Product";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $product_id = base64_decode($product_id);
        $data['product_id'] = $product_id;
        
        $product_mst_where['product_id'] = $product_id;

        $this->db->trans_start();
            
        $product_mst_data['is_store'] = base64_decode($is_store);
        $product_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_mst_data['updated_by'] = $login_info->users_id;
        $product_mst_data['updated_name'] = $login_info->name;
        $product_mst_data['updated_user_agent'] = $this->customlib->load_agent();
        $product_mst_data['updated_ip'] = $this->input->ip_address();

        $product_mst_where['product_id'] = $product_id;
        
        $this->ProductMstModel->modify($product_mst_data, $product_mst_where);
        
        $product_account_data['is_store'] = base64_decode($is_store);
        $product_account_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_account_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_account_data['updated_by'] = $login_info->users_id;
        $product_account_data['updated_name'] = $login_info->name;
        $product_account_data['updated_user_agent'] = $this->customlib->load_agent();
        $product_account_data['updated_ip'] = $this->input->ip_address();

        $product_account_where['product_id'] = $product_id;
        //$product_account_where['finyear_id'] = $finyear_info->finyear_id;
        
        $this->ProductAccountMstModel->modify($product_account_data, $product_account_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Admin/ManageProduct');
    }
    
    public function is_app($product_id, $is_app) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_PRODUCT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageProduct';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Product";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $product_id = base64_decode($product_id);
        $data['product_id'] = $product_id;
        
        $product_mst_where['product_id'] = $product_id;

        $this->db->trans_start();
            
        $product_mst_data['is_app'] = base64_decode($is_app);
        $product_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_mst_data['updated_by'] = $login_info->users_id;
        $product_mst_data['updated_name'] = $login_info->name;
        $product_mst_data['updated_user_agent'] = $this->customlib->load_agent();
        $product_mst_data['updated_ip'] = $this->input->ip_address();

        $product_mst_where['product_id'] = $product_id;
        
        $this->ProductMstModel->modify($product_mst_data, $product_mst_where);
        
        /*$product_account_data['is_app'] = base64_decode($is_app);
        $product_account_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_account_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_account_data['updated_by'] = $login_info->users_id;
        $product_account_data['updated_name'] = $login_info->name;
        $product_account_data['updated_user_agent'] = $this->customlib->load_agent();
        $product_account_data['updated_ip'] = $this->input->ip_address();

        $product_account_where['product_id'] = $product_id;
        //$product_account_where['finyear_id'] = $finyear_info->finyear_id;
        
        $this->ProductAccountMstModel->modify($product_account_data, $product_account_where);*/
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Admin/ManageProduct');
    }
    
    public function is_web($product_id, $is_web) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_PRODUCT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_edit == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageProduct';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Product";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $product_id = base64_decode($product_id);
        $data['product_id'] = $product_id;
        
        $product_mst_where['product_id'] = $product_id;

        $this->db->trans_start();
            
        $product_mst_data['is_web'] = base64_decode($is_web);
        $product_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_mst_data['updated_by'] = $login_info->users_id;
        $product_mst_data['updated_name'] = $login_info->name;
        $product_mst_data['updated_user_agent'] = $this->customlib->load_agent();
        $product_mst_data['updated_ip'] = $this->input->ip_address();

        $product_mst_where['product_id'] = $product_id;
        
        $this->ProductMstModel->modify($product_mst_data, $product_mst_where);
        
        /*$product_account_data['is_web'] = base64_decode($is_web);
        $product_account_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_account_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $product_account_data['updated_by'] = $login_info->users_id;
        $product_account_data['updated_name'] = $login_info->name;
        $product_account_data['updated_user_agent'] = $this->customlib->load_agent();
        $product_account_data['updated_ip'] = $this->input->ip_address();

        $product_account_where['product_id'] = $product_id;
        //$product_account_where['finyear_id'] = $finyear_info->finyear_id;
        
        $this->ProductAccountMstModel->modify($product_account_data, $product_account_where);*/
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
        redirect($_SERVER['HTTP_REFERER']);
		//redirect('Admin/ManageProduct');
    }
    
    public function del($product_id) {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_admin_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, ADMIN_MANAGE_PRODUCT, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
        
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = 'ManageProduct';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Manage Product";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;        
        
        $product_id = base64_decode($product_id);
        $data['product_id'] = $product_id;
        
        $product_mst_where['product_id'] = $product_id;
        
        $product_info = $this->ProductMstModel->get_record($product_id)['0'];
       
        if($product_info->images != '') {			
            unlink(FCPATH.$this->config->item('product_images').$product_info->images);
        }

        if($product_info->thumbnail1 != '') {			
            unlink(FCPATH.$this->config->item('product_thumbnail1').$product_info->thumbnail1);
        }

        if($product_info->thumbnail2 != '') {			
            unlink(FCPATH.$this->config->item('product_thumbnail2').$product_info->thumbnail2);
        }

        $this->ProductMstModel->delete($product_mst_where);
        
        $this->db->trans_complete();
                    
        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Admin/ManageProduct');
    }
	
	public function product_validation($required=true) {

		$this->form_validation->set_message('required', '%s required');
        
        /*$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|max_length[255]');		
		$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|max_length[255]');		
		$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|max_length[50000]');
        $this->form_validation->set_rules('slug', 'Slug', 'trim|max_length[255]');*/
        
		$this->form_validation->set_rules('ean_upc_gtin', 'EAN/UPC/GTIN Code', 'trim|max_length[50]');
		$this->form_validation->set_rules('hsn_code', 'HSN Code', 'trim|max_length[50]');
		$this->form_validation->set_rules('mpn_code', 'MPN Code', 'trim|max_length[50]');				
		$this->form_validation->set_rules('sku_code', 'SKU Code', 'trim|max_length[50]');	
		$this->form_validation->set_rules('product_code', 'Product Code', 'trim|max_length[50]');
		
		$this->form_validation->set_rules('heading', 'Product Name', 'trim|required|max_length[255]');						
		/*$this->form_validation->set_rules('sub_heading', 'Sub Heading', 'trim|max_length[255]');
		
		$this->form_validation->set_rules('is_download', 'Download', 'trim|required|is_natural|exact_length[1]');
		$this->form_validation->set_rules('is_show', 'Show', 'trim|required|is_natural|exact_length[1]');		
		//$this->form_validation->set_rules('images', 'Image', 'callback_handle_upload');
		$this->form_validation->set_rules('video', 'Video', 'trim|max_length[5000]');*/
		
        $this->form_validation->set_rules('brand_id', 'Brand Name', 'trim|required');
        
        if($this->input->post('category1_id') != '') {
            $category2_list = $this->CategoryMstModel->get_is_store_select($this->input->post('category1_id'));
            if(!empty($category4_list)) {
				$this->form_validation->set_rules('category2_id', 'Category 2', 'trim|required');
            }
        }

        if($this->input->post('category2_id') != '') {
            $category3_list = $this->CategoryMstModel->get_is_store_select($this->input->post('category2_id'));
            if(!empty($category3_list)) {
				$this->form_validation->set_rules('category3_id', 'Category 3', 'trim|required');
            }
        }

        if($this->input->post('category3_id') != '') {
            $category4_list = $this->CategoryMstModel->get_is_store_select($this->input->post('category3_id'));
            if(!empty($category4_list)) {
				$this->form_validation->set_rules('category4_id', 'Category 4', 'trim|required');
            }
        }
        
        $this->form_validation->set_rules('model', 'Model', 'trim|max_length[255]');
		
		$this->form_validation->set_rules('is_product_type', 'Product Type', 'trim|required|is_natural|exact_length[1]');
		
		$this->form_validation->set_rules('packing_id', 'Packing', 'trim|required');
		$this->form_validation->set_rules('unit_id', 'Unit', 'trim|required');
		
		$this->form_validation->set_rules('weight', 'Weight', 'trim|required|numeric|min_length[1]|max_length[10]');
		//$this->form_validation->set_rules('weight_unit_id', 'Unit', 'trim|required');
		
		$this->form_validation->set_rules('length', 'Length', 'trim|required|numeric|min_length[1]|max_length[10]');
		$this->form_validation->set_rules('width', 'Width', 'trim|required|numeric|min_length[1]|max_length[10]');
		$this->form_validation->set_rules('height', 'Height', 'trim|required|numeric|min_length[1]|max_length[10]');
        //$this->form_validation->set_rules('lwh_unit_id', 'Unit', 'trim|required');
        
        $this->form_validation->set_rules('cgst_taxes_id', 'CGST', 'trim|required');
        $this->form_validation->set_rules('sgst_taxes_id', 'SGST', 'trim|required');
        $this->form_validation->set_rules('igst_taxes_id', 'IGST', 'trim|required');
        
        /*$this->form_validation->set_rules('short_description1', 'Short Description 1', 'trim|min_length[0]|max_length[100]');
		$this->form_validation->set_rules('short_description2', 'Short Description 2', 'trim|min_length[0]|max_length[250]');
		$this->form_validation->set_rules('description', 'Description', 'trim|min_length[0]|max_length[5000000]');		
		$this->form_validation->set_rules('additional', 'Additional Information', 'trim|min_length[0]|max_length[5000000]');		
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