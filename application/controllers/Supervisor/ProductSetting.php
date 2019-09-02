<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProductSetting extends CI_Controller {
    
	var $CI;
    private $login_Detail;

    public function __construct() {
            parent::__construct();
            $this->customlib->expirePage();
    }
    
    public function index() {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_PRODUCT_SETTINGS, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }
							
		$finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;
       
        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }
        
        $main_menu['active'] = '';
		$this->session->set_userdata($main_menu);
		
		$topbar = "Product Setting";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;

        $data['supplier_list'] = $this->SupplierMstModel->get_select($login_info->store_id);
        
        $data['brand_list'] = $this->BrandMstModel->get_is_store_select();

        /*$data['category1_list'] = $this->CategoryMstModel->get_is_store_select('0');*/
        
        $this->product_setting_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/product_setting', $data);
                $this->load->view('layout/footer', $data);

            } else {
                if($this->input->post('category1_id') != '') {
                    $data['category2_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category1_id'));	
                }

                /*if($this->input->post('category1_id') != '') {
                    $data['category2_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category1_id'));	
                }

                if($this->input->post('category2_id') != '') {
                    $data['category3_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category2_id'));	
                }

                if($this->input->post('category3_id') != '') {
                    $data['category4_list'] = $this->CategoryMstModel->get_is_store_select($this->input->post('category3_id'));	
                }*/

                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/product_setting', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {

            $account_mst_info = $this->ProductAccountMstModel->get_record(
                $finyear_info->finyear_id,
                $login_info->store_id,
                '', //$this->input->post('supplier_id'),
                $this->input->post('brand_id'),
                $this->input->post('product_id'));
            
            $product_account_mst_id = 0;

            if(!empty($account_mst_info)) {
                $this->db->trans_start();

                $product_account_mst_id = $account_mst_info['0']->product_account_mst_id;

                $product_account_mst_data['min_qty'] = $this->input->post('min_qty');
                $product_account_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $product_account_mst_data['updated_by'] = $login_info->users_id;
                $product_account_mst_data['updated_name'] = $login_info->name;
                $product_account_mst_data['updated_user_agent'] = $this->customlib->load_agent();
                $product_account_mst_data['updated_ip'] = $this->input->ip_address();
    
                $product_account_mst_where['store_id'] = $login_info->store_id;
                $product_account_mst_where['supplier_id'] = $this->input->post('supplier_id');           
                $product_account_mst_where['brand_id'] = $this->input->post('brand_id');
                /*$product_account_mst_where['category1_id'] = $product_info->category1_id;
                $product_account_mst_where['category2_id'] = $product_info->category2_id;
                $product_account_mst_where['category3_id'] = $product_info->category3_id;
                $product_account_mst_where['category4_id'] = $product_info->category4_id;*/
                $product_account_mst_where['product_id'] = $this->input->post('product_id');
                $product_account_mst_where['product_account_mst_id'] = $product_account_mst_id;
    
                $this->ProductAccountMstModel->modify($product_account_mst_data, $product_account_mst_where);
                
                $this->db->trans_complete();

                $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
                redirect('Supervisor/ProductSetting');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Supervisor/ProductSetting');
            }                         
        }
    }
	
	public function product_setting_validation($required=true) {

        $this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('supplier_id', 'Supplier Name', 'trim|required');
        
        $this->form_validation->set_rules('brand_id', 'Brand Name', 'trim|required');
        
        /*if($this->input->post('category1_id') != '') {
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
        }*/

        $this->form_validation->set_rules('product_id', 'Product Name', 'trim|required');
        
		$this->form_validation->set_rules('min_qty', 'Minimum Quantity', 'trim|required|is_natural|min_length[1]|max_length[10]');
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