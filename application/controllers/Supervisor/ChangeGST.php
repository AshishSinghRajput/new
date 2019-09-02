<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ChangeGST extends CI_Controller {
    
	var $CI;
    private $login_Detail;

    public function __construct() {
            parent::__construct();
            $this->customlib->expirePage();
    }
    
    public function index($hsn_code = '') {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');        
        $data['login_info'] = $login_info;
        
        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_CHANGE_GST, base_url($this->uri->uri_string()));
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
		
		$topbar = "Change GST";
		
		$page_val = array(
                    'topbar'=>$topbar,
                    'title'=>$this->lang->line('project_short_name').' : '.$topbar,
                    'author'=>'cnvg.in',
                    'keywords'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar,
                    'description'=>base_url().', '.$this->lang->line('project_short_name').', '.$this->lang->line('project_name').','.$topbar
                );
        $data['page_val'] = $page_val;

        $data['current_hsn_code'] = $hsn_code;
                
        $data['hsn_code_list'] = $this->ProductMstModel->get_hsn_code();
        
        if($hsn_code != '') {
            $data['product_info'] = $this->ProductMstModel->get_record('', $hsn_code);
        }
       
        $data['cgst_taxes_list'] = $this->TaxesMstModel->get_select('1');
        $data['sgst_taxes_list'] = $this->TaxesMstModel->get_select('2');
        $data['igst_taxes_list'] = $this->TaxesMstModel->get_select('3');

        $this->change_gst_validation(false);		
		if($this->form_validation->run()==false) {
            if(!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/change_gst', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/change_gst', $data);
                $this->load->view('layout/footer', $data);
                
            }
        } else {

            $product_info = array();
            if($hsn_code != '') {
                $product_info = $this->ProductMstModel->get_record('', $hsn_code);
            }
            
            if(!empty($product_info)) {
                foreach ($product_info as $products_list) {
                    $this->db->trans_start();            
                
                    $product_mst_data['cgst_taxes_id'] = $this->input->post('cgst_taxes_id_'.$products_list->product_id);
                    $product_mst_data['sgst_taxes_id'] = $this->input->post('sgst_taxes_id_'.$products_list->product_id);
                    $product_mst_data['igst_taxes_id'] = $this->input->post('igst_taxes_id_'.$products_list->product_id);
                    $product_mst_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                    $product_mst_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                    $product_mst_data['updated_by'] = $login_info->users_id;
                    $product_mst_data['updated_name'] = $login_info->name;
                    $product_mst_data['updated_user_agent'] = $this->customlib->load_agent();
                    $product_mst_data['updated_ip'] = $this->input->ip_address();

                    $product_mst_where['product_id'] = $products_list->product_id;
                    $product_mst_where['hsn_code'] = $this->input->post('hsn_code');
                    
                    $this->ProductMstModel->modify($product_mst_data, $product_mst_where);
                    
                    $this->db->trans_complete();
                }
                $this->session->set_flashdata('ses_success', $this->lang->line('update_confirmation_message'));
                redirect('Supervisor/ChangeGST');

            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Supervisor/ChangeGST');
            }                         
        }
    }
	
	public function change_gst_validation($required=true) {

        $this->form_validation->set_message('required', '%s required');
        
        $this->form_validation->set_rules('hsn_code', 'HSN code', 'trim|required');
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