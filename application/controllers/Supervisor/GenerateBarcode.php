<?php defined('BASEPATH') or exit('No direct script access allowed');

class GenerateBarcode extends CI_Controller
{
    var $CI;
    private $login_Detail;

    public function __construct()
    {
        parent::__construct();
        $this->customlib->expirePage();
    }

    public function index()
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_list == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'GenerateBarcode';
        $this->session->set_userdata($main_menu);

        $topbar = "Generate Barcode";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['generate_barcode_info'] = $this->GenerateBarcodeMstModel->get_record($finyear_info->finyear_id, $login_info->store_id);

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/generate_barcode_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($generate_barcode_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'GenerateBarcode';
        $this->session->set_userdata($main_menu);

        $topbar = "Generate Barcode";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $generate_barcode_id = base64_decode($generate_barcode_id);
        $data['generate_barcode_id'] = $generate_barcode_id;

        $data['generate_barcode_info'] = $this->GenerateBarcodeMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $generate_barcode_id)['0'];

        $this->load->view('layout/header', $data);
        $this->load->view('Supervisor/generate_barcode_view', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add()
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_add == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $main_menu['active'] = 'GenerateBarcode';
        $this->session->set_userdata($main_menu);

        $topbar = "Generate Barcode";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $data['supplier_list'] = $this->SupplierMstModel->get_select($login_info->store_id);        
        $data['brand_list'] = $this->BrandMstModel->get_is_store_select();
        $data['unit_list'] = $this->UnitMstModel->get_select();

        $this->generate_barcode_validation(false);
        if ($this->form_validation->run() == false) {
            if (!$this->input->post('submit')) {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/generate_barcode_add', $data);
                $this->load->view('layout/footer', $data);

            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('Supervisor/generate_barcode_add', $data);
                $this->load->view('layout/footer', $data);

            }
        } else {
            $product_info = $this->ProductMstModel->get_full_record($this->input->post('product_id'))['0'];

            $this->db->trans_start();

            $generate_barcode_data['date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $generate_barcode_data['store_id'] = $login_info->store_id;
            $generate_barcode_data['supplier_id'] = $this->input->post('supplier_id');           
            $generate_barcode_data['brand_id'] = $product_info->brand_id;
            $generate_barcode_data['brand_heading'] = $product_info->brand_heading;
            $generate_barcode_data['category1_id'] = $product_info->category1_id;
            $generate_barcode_data['category2_id'] = $product_info->category2_id;
            $generate_barcode_data['category3_id'] = $product_info->category3_id;
            $generate_barcode_data['category4_id'] = $product_info->category4_id;
            $generate_barcode_data['product_id'] = $this->input->post('product_id');
            $generate_barcode_data['product_code'] = $product_info->product_code;
            $generate_barcode_data['product_heading'] = $product_info->heading;
            $generate_barcode_data['standard_barcode'] = $this->input->post('standard_barcode');
            $generate_barcode_data['generate_barcode'] = $this->input->post('generate_barcode');
            $generate_barcode_data['batch_no'] = $this->input->post('batch_no');
            $generate_barcode_data['quantity'] = $this->input->post('quantity');
            $generate_barcode_data['packing_id'] = $product_info->packing_id;   
            $generate_barcode_data['packing_title'] = $product_info->packing_title; 
            $generate_barcode_data['unit_id'] = $product_info->unit_id;   
            $generate_barcode_data['unit_title'] = $product_info->unit_title;
            $generate_barcode_data['mfg_date'] = $this->customlib->get_YYYYMMDD($this->input->post('mfg_date'));  
            $generate_barcode_data['expiry_date'] = $this->customlib->get_YYYYMMDD($this->input->post('expiry_date'));  
            $generate_barcode_data['batch_no'] = $this->input->post('batch_no');
            $generate_barcode_data['mrp_price'] = $this->input->post('mrp_price');
            $generate_barcode_data['total_mrp'] = $this->input->post('total_mrp');
            $generate_barcode_data['purchase_rate'] = $this->input->post('purchase_rate');
            $generate_barcode_data['total_purchase_rate'] = $this->input->post('total_purchase_rate');
            $generate_barcode_data['sales_rate'] = $this->input->post('sales_rate');
            $generate_barcode_data['total_sales_rate'] = $this->input->post('total_sales_rate');
            $credit_note_data['status_id'] = 'Pending';
            $credit_note_data['status_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $credit_note_data['status_remarks'] = ''; //$this->input->post('status_remarks');
            $generate_barcode_data['is_cancel'] = '0';
            $generate_barcode_data['cancel_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $generate_barcode_data['cancel_reason'] = ''; //$this->input->post('status_remarks');
            $generate_barcode_data['finyear_id'] = $finyear_info->finyear_id;  
            
            $generate_barcode_data['display'] = '1'; //$this->input->post('display');
            $generate_barcode_data['priority'] = '0'; //$this->input->post('priority');
            $generate_barcode_data['created_date'] = date('Y-m-d', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $generate_barcode_data['created_time'] = date('H:i:s', mktime(gmdate('H') + 5, gmdate('i') + 30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
            $generate_barcode_data['created_by'] = $login_info->users_id;
            $generate_barcode_data['created_name'] = $login_info->name;
            $generate_barcode_data['created_user_agent'] = $this->customlib->load_agent();
            $generate_barcode_data['created_ip'] = $this->input->ip_address();

            $generate_barcode_id = $this->GenerateBarcodeMstModel->add($generate_barcode_data);

            $this->db->trans_complete();

            if ($generate_barcode_id > 0) {
                $this->session->set_flashdata('ses_success', $this->lang->line('insert_confirmation_message'));
                redirect('Supervisor/GenerateBarcode');
            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('insert_update_error_message'));
                redirect('Supervisor/GenerateBarcode/add');
            }
        }
    }

    public function del($generate_barcode_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_delete == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        if ($finyear_info->activation == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $main_menu['active'] = 'GenerateBarcode';
        $this->session->set_userdata($main_menu);

        $topbar = "Generate Barcode";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $generate_barcode_id = base64_decode($generate_barcode_id);
        $data['generate_barcode_id'] = $generate_barcode_id;

        $generate_barcode_where['generate_barcode_id'] = $generate_barcode_id;

        $this->GenerateBarcodeMstModel->delete($generate_barcode_where);

        $this->db->trans_complete();

        $this->session->set_flashdata('ses_success', $this->lang->line('delete_confirmation_message'));
        redirect('Supervisor/GenerateBarcode');
    }

    public function prints($generate_barcode_id)
    {
        $data['controller'] = $this;

        $login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');
        $data['login_info'] = $login_info;

        $load_permission = $this->customlib->setUsersLogs($login_info, SUPERVISOR_COUNTER_MAPPING, base_url($this->uri->uri_string()));
        $data['load_permission'] = $load_permission;
        if ($load_permission->is_view == '0') {
            redirect(base_url('NotFound/index/403'));
        }

        $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
        $data['finyear_info'] = $finyear_info;

        $main_menu['active'] = 'GenerateBarcode';
        $this->session->set_userdata($main_menu);

        $topbar = "Generate Barcode";

        $page_val = array(
            'topbar' => $topbar,
            'title' => $this->lang->line('project_short_name') . ' : ' . $topbar,
            'author' => 'cnvg.in',
            'keywords' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar,
            'description' => base_url() . ', ' . $this->lang->line('project_short_name') . ', ' . $this->lang->line('project_name') . ',' . $topbar
        );
        $data['page_val'] = $page_val;

        $generate_barcode_id = base64_decode($generate_barcode_id);
        $data['generate_barcode_id'] = $generate_barcode_id;

        $data['generate_barcode_info'] = $this->GenerateBarcodeMstModel->get_record($finyear_info->finyear_id, $login_info->store_id, $generate_barcode_id)['0'];

        $this->load->view('Supervisor/generate_barcode_prints', $data);
    }

    public function generate_barcode_validation($required = true)
    {

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
        
		$this->form_validation->set_rules('standard_barcode', 'Standard Barcode', 'trim|required|max_length[50]');	
        $this->form_validation->set_rules('generate_barcode', 'Generate Barcode', 'trim|max_length[50]');
        
        $this->form_validation->set_rules('mfg_date', 'MFG Date', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('expiry_date', 'Expiry Date', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('batch_no', 'Batch No', 'trim|required|is_natural|min_length[1]|max_length[10]');
        
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|is_natural|min_length[1]|max_length[10]');        
        $this->form_validation->set_rules('unit_id', 'Unit', 'trim|required');

        $this->form_validation->set_rules('mrp_price', 'MRP Price', 'trim|required|is_natural|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('total_mrp', 'Total MRP', 'trim|required|is_natural|min_length[1]|max_length[10]');

        $this->form_validation->set_rules('purchase_rate', 'Purchase Rate', 'trim|required|is_natural|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('total_purchase_rate', 'Total Purchase', 'trim|required|is_natural|min_length[1]|max_length[10]');

        $this->form_validation->set_rules('sales_rate', 'Sales Rate', 'trim|required|is_natural|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('total_sales_rate', 'Total Sales', 'trim|required|is_natural|min_length[1]|max_length[10]');
        
        /*$this->form_validation->set_rules('display', 'Display', 'trim|required|is_natural|exact_length[1]');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|is_natural|min_length[1]|max_length[10]');*/

        
    }

    public function valid_url($str)
    {
        if ($str != "") {
            if (filter_var($str, FILTER_VALIDATE_URL)) {
                $this->form_validation->set_message('valid_url', "Invalid website url");
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    public function create_thumb($full_path, $new_img, $img_width, $img_height)
    {
        $config_create_thumb['image_library'] = 'gd2';
        $config_create_thumb['source_image'] = $new_img;
        $config_create_thumb['new_image'] = $full_path;
        //$config_create_thumb['create_thumb'] = TRUE;
        $config_create_thumb['maintain_ratio'] = TRUE;
        $config_create_thumb['width'] = $img_width;
        $config_create_thumb['height'] = $img_height;
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
