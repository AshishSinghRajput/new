<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxloader extends CI_Controller {

    public function __construct() {
        parent::__construct();
	}
	
	public function get_city($state_name) {

		$city_list = $this->LocationMstModel->get_city(str_replace('%20', ' ', $state_name));	
		if(!empty($city_list)) {
			$options = "<option value=''>Select City</option>";
			foreach($city_list as $value) {
				$options.= "<option value='$value->city_name'>$value->city_name</option>";			
			}
	    } else {
			$options = "<option value=''>Select City</option>";
		}
		echo $options;
	}
	
	public function get_category($master_id, $level) {
		$category_list = $this->CategoryMstModel->get_is_store_select($master_id);	
		if(!empty($category_list)) {
			$options = "<option value=''>Select Category $level</option>";
			foreach($category_list as $value) {
				$options.= "<option value='$value->category_id'>$value->heading</option>";			
			}
	    } else {
			$options = "<option value=''>Select Category $level</option>";
		}
		echo $options;
	}
	
	public function get_brand_product($brand_id) {
		$product_list = $this->ProductMstModel->get_select($brand_id);	
		if(!empty($product_list)) {
			$options = "<option value=''>Select Product</option>";
			foreach($product_list as $value) {
				$options.= "<option value='$value->product_id'>$value->heading</option>";			
			}
	    } else {
			$options = "<option value=''>Select Product</option>";
		}
		echo $options;
	}

    function load_product_code() {
        //$term = $term;
        if (isset($_GET['term'])) {
            $term = $_GET['term'];

			$data['controller'] = $this;
			
            $login_info = array();
			if($this->session->userdata('priyadarshini_superadmin_login_detail')) {
				$login_info = $this->session->userdata('priyadarshini_superadmin_login_detail');

			} else if($this->session->userdata('priyadarshini_admin_login_detail')) {
				$login_info = $this->session->userdata('priyadarshini_admin_login_detail');

			} else if($this->session->userdata('priyadarshini_accounts_login_detail')) {
				$login_info = $this->session->userdata('priyadarshini_accounts_login_detail');
				
			} else if($this->session->userdata('priyadarshini_bank_login_detail')) {
				$login_info = $this->session->userdata('priyadarshini_bank_login_detail');
				
			} else if($this->session->userdata('priyadarshini_manager_login_detail')) {
				$login_info = $this->session->userdata('priyadarshini_manager_login_detail');
				
			} else if($this->session->userdata('priyadarshini_supervisor_login_detail')) {
				$login_info = $this->session->userdata('priyadarshini_supervisor_login_detail');

			} else if($this->session->userdata('priyadarshini_cashier_login_detail')) {
				$login_info = $this->session->userdata('priyadarshini_cashier_login_detail');

			} else if($this->session->userdata('priyadarshini_returs_login_detail')) {
				$login_info = $this->session->userdata('priyadarshini_returs_login_detail');

			}

            $finyear_info = $this->session->userdata('priyadarshini_finyear_detail');
            $data['finyear_info'] = $finyear_info;

            $product_info = $this->ProductMstModel->get_autocomplete($finyear_info->finyear_id, $login_info->store_id, $term);

            if (count($product_info) > 0) {
                foreach ($product_info as $value) {
					/*echo $value->product_id;
					$product_price = $this->GenerateBarcodeMstModel->get_stock($finyear_info->finyear_id, $login_info->store_id, '', '', $value->product_id);
					if(!empty($product_price)) {*/
						$product_details['product_id'] = $value->product_id;
						$product_details['product_code'] = $value->product_code;
						$product_details['product_name'] = $value->heading;
						$product_details['quantity'] = $value->net_amount;
						$product_details['packing_title'] = $value->packing_title;
						$product_details['mfg_date'] = '1900-01-01'; //$value->packing_title;
						$product_details['expiry_date'] = '1900-01-01'; //$value->packing_title;
						$product_details['batch_no'] = '101010'; //$value->packing_title;
						$product_details['mrp_price'] = '10';
						$product_details['purchase_rate'] = '8';
						$product_details['sales_rate'] = '9';
						$product_result[] = $product_details;
					/*}*/
                }
                echo json_encode($product_result);
            }
        }
	}
}	
