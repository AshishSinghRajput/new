<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

class API extends CI_Controller {

    private $success;
    private $input_rs;

    public function __construct() {
        parent::__construct();
        $this->input_rs = json_decode(file_get_contents("php://input"), true);
    }

    public function index() {
        echo "<h1>Welcome to Smart City</h1>";
    }

    public function check_login() {

        $smart_city_id = $this->input_rs['smart_city_id'];
        $username = $this->input_rs['username'];
        $password = $this->input_rs['password'];
        $tokenid = $this->input_rs['token'];

        $response = $this->UsersMstModel->check_login($type = '0', $smart_city_id, $username, $password);
        $data = array();
        if ($response != 0) {
            if ($response['login_type'] == '3') {
                $data['users_id'] = $response->users_id;
                $data['smart_city_id'] = $response->smart_city_id;
                $data['smart_city_name'] = $response->smart_city_name;
                $data['name'] = $response->name;
                $data['images'] = base_url($this->config->item('users_images').$users_info->images);
                $data['thumbnail1'] = base_url($this->config->item('users_thumbnail1').$users_info->thumbnail1);
                $data['thumbnail2'] = base_url($this->config->item('users_thumbnail2').$users_info->thumbnail2);
                $data['address'] = $response->address;
                $data['country_name'] = $response->country_name;
                $data['state_name'] = $response->state_name;
                $data['city_name'] = $response->city_name;
                $data['zip_code'] = $response->zip_code;
                $data['mobile'] = $response->mobile;
                $data['email'] = $response->email;
                $data['tokenid'] = $tokenid;
                
                $this->db->trans_start();
            
                $users_data['tokenid'] = $tokenid;
                $users_data['updated_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $users_data['updated_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
                $users_data['updated_by'] = $response->users_id;
                $users_data['updated_name'] = $response->name;
                $users_data['updated_user_agent'] = $this->customlib->load_agent();
                $users_data['updated_ip'] = $this->input->ip_address();

                $users_where['users_id'] = $response->users_id;
            
                $this->UsersMstModel->modify($users_data, $users_where);
            
                $this->db->trans_complete();

                $status = "success";
                $code = "200";
                $message = "Login Successfull";
                $error = "NA";
                $data = $data;
            } else {
                $status = "failure";
                $code = "500";
                $message = "Login Failed";
                $error = "NA";
                $data = array('status' => false);
            }

            echo $this->response_json($status, $data, $code, $message, $error);
        } else {

            $status = "failure";
            $code = "500";
            $message = "Login Failed";
            $error = "NA";
            $data = array('status' => false);


            echo $this->response_json($status, $data, $code, $message, $error);
        }
    }

    public function project_list() {
        $supervisor_id = $this->input_rs['supervisor_id'];

        $response = $this->ProjSupervisor->getby_supervisorid($supervisor_id);
        if ($response == 'nodata') {
            $status = "failure";
            $code = "500";
            $message = "Project List Failed";
            $error = "NA";
            $data = array('status' => false);
        } else {
            $status = "success";
            $code = "200";
            $message = "Project List Successfull";
            $error = "NA";
            $data = $response;
        }

        echo $this->response_json($status, $data, $code, $message, $error);
    }

    public function task_list() {
        $proj_id = $this->input_rs['proj_id'];
        $response = $this->Tasklist->get($proj_id);
        if ($response == 'nodata') {
            $status = "failure";
            $code = "500";
            $message = "Task List Failed";
            $error = "NA";
            $data = array('status' => false);
        } else {
            $status = "success";
            $code = "200";
            $message = "Task List Successfull";
            $error = "NA";
            $data = $response;
        }

        echo $this->response_json($status, $data, $code, $message, $error);
    }

    public function addtask_report() {
        $data_ins['task_id'] = $this->input_rs['task_id'];
        $data_ins['completed'] = $this->input_rs['completed'];
        $data_ins['heading'] = $this->input_rs['heading'];
        $data_ins['description'] = $this->input_rs['description'];
        $data_ins['supervisor_id'] = $this->input_rs['supervisor_id'];
        $data_ins['latitude'] = $this->input_rs['latitude'];
        $data_ins['longitude'] = $this->input_rs['longitude'];

        $response = $this->Tasklist->add_report($data_ins);

        if ($response == 'nodata') {
            $status = "failure";
            $code = "500";
            $message = "Task Report Not Submitted";
            $error = "NA";
            $data = array('status' => false);
        } else {
            $status = "success";
            $code = "200";
            $message = "Task Report Submitted";
            $error = "NA";
            $data[] = array('report_id' => $response);
        }

        echo $this->response_json($status, $data, $code, $message, $error);
    }

    public function do_upload() {
        $task_id = $_REQUEST['task_id'];
        $report_id = $_REQUEST['report_id'];

        //'allowed_types' => "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp",
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048000; // Can be set to particular file size , here it is 2 MB(2048 Kb)
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('upload')) {
            $error = array('error' => $this->upload->display_errors());
            $status = "failure";
            $code = "500";
            $message = $this->upload->display_errors();
            $data = array('status' => false);
        } else {
            $uploadData = $this->upload->data();
            $fileData['task_id'] = $task_id;
            $fileData['file_name'] = $uploadData['file_name'];
            $fileData['report_id'] = $report_id;

            $this->Tasklist->add_taskfile($fileData);

            $status = "success";
            $code = "200";
            $message = "File Uploaded Successfully";
            $error = "NA";
            $data = $this->upload->data();
        }

        echo $this->response_json($status, $data, $code, $message, $error);
    }

    public function do_multiupload() {

        $task_id = $_REQUEST['task_id'];
        $report_id = $_REQUEST['report_id'];

        // If file upload form submitted
        if (!empty($_FILES['upload']['name'])) {
            $filesCount = count($_FILES['upload']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name'] = $_FILES['upload']['name'][$i];
                $_FILES['file']['type'] = $_FILES['upload']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['upload']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['upload']['error'][$i];
                $_FILES['file']['size'] = $_FILES['upload']['size'][$i];

                // File upload configuration
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048000; // Can be set to particular file size , here it is 2 MB(2048 Kb)
                //$config['max_width'] = 1024;
                //$config['max_height'] = 768;
                $config['encrypt_name'] = TRUE;

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $uploadData = $this->upload->data();

                    $add_data['task_id'] = $task_id;
                    $add_data['file_name'] = $uploadData['file_name'];
                    $add_data['report_id'] = $report_id;

                    $this->Tasklist->add_taskfile($add_data);

                    $fileData[$i]['file_name'] = $uploadData['file_name'];
                    $fileData[$i]['file_error'] = $this->upload->display_errors();
                }
            }

            if (!empty($fileData)) {
                $status = "success";
                $code = "200";
                $message = "File Uploaded Successfully";
                $error = "NA";
                $data = $fileData;
            } else {
                $error = "";
                $status = "failure";
                $code = "500";
                $message = "Not Uploaded";
                $data = array('status' => false);
            }
        } else {
            $error = "";
            $status = "failure";
            $code = "500";
            $message = "Not Uploaded";
            $data = array('status' => false);
        }
        
        echo $this->response_json($status, $data, $code, $message, $error);
    }

    public function task_history() {

        $task_id = $this->input_rs['task_id'];
        $response = $this->Tasklist->get_taskreport($task_id);
        
        if ($response == 'nodata') {
            $status = "failure";
            $code = "500";
            $message = "Task Report Failed";
            $error = "NA";
            $data = array('status' => false);
        } else {
            $status = "success";
            $code = "200";
            $message = "Task Report Successfull";
            $error = "NA";
            $data = $response;
        }

        echo $this->response_json($status, $data, $code, $message, $error);
    }
    
    
    public function version_control(){
        
        $vdata = $this->db->query("select version, update_type, type from version_control")->result_array();
        
        $status = "success";
        $code = "200";
        $message = "Successfully";
        $error = "NA";
        $data = $vdata;
        echo $this->response_json($status, $data, $code, $message, $error);
    }
    
    public function add_reply() {
        $ord_id = $this->input_rs['report_id'];
        $user_reply = $this->input_rs['user_reply'];

        $this->Tasklist->add_user_reply('id',$ord_id,array('user_reply'=>$user_reply));
        if($this->db->affected_rows()>0){
            $status = "success";
            $code = "200";
            $message = "Updated";
            $error = "NA";
            $data[] = array('report_id' => $ord_id);
        }
        else{
            $status = "failure";
            $code = "500";
            $message = "Not Updated";
            $error = "NA";
            $data = array('status' => false);
        } 

        echo $this->response_json($status, $data, $code, $message, $error);
    }    

    public function sentDataSuperAdmin() {
        
        $last_login = $this->Userlog->get_userlogs_lastlogin()['0'];

        $after_45_days = date('Y-m-d', strtotime('+45 days'));
        $total_as_bg = $this->BGManage->get_bg('', '0', '1', '');
        $total_as_bg_amount_array = array_column($total_as_bg, 'amount');
        $total_as_bg_amount = array_sum($total_as_bg_amount_array);

        $total_as_bg_expiry = $this->BGManage->get_bg_all(date('Y-m-d'), $after_45_days, '0', '1', '');
        $total_as_bg_expiry_amount_array = array_column($total_as_bg_expiry, 'amount');
        $total_as_bg_expiry_amount = array_sum($total_as_bg_expiry_amount_array);

        $total_as_fdr = $this->BGManage->get_bg('', '0', '2', '');
        $total_as_fdr_amount_array = array_column($total_as_fdr, 'amount');
        $total_as_fdr_amount = array_sum($total_as_fdr_amount_array);

        $total_as_fdr_expiry = $this->BGManage->get_bg_all(date('Y-m-d'), $after_45_days, '0', '2', '');
        $total_as_fdr_expiry_amount_array = array_column($total_as_fdr_expiry, 'amount');
        $total_as_fdr_expiry_amount = array_sum($total_as_fdr_expiry_amount_array);

        $total_as_emd = $this->BGManage->get_bg('', '0', '3', '');
        $total_as_emd_amount_array = array_column($total_as_emd, 'amount');
        $total_as_emd_amount = array_sum($total_as_emd_amount_array);

        $total_as_emd_expiry = $this->BGManage->get_bg_all(date('Y-m-d'), $after_45_days, '0', '3', '');
        $total_as_emd_expiry_amount_array = array_column($total_as_emd_expiry, 'amount');
        $total_as_emd_expiry_amount = array_sum($total_as_emd_expiry_amount_array);

        $total_from_bg = $this->BGManage->get_bg('', '1', '1', '');
        $total_from_bg_amount_array = array_column($total_from_bg, 'amount');
        $total_from_bg_amount = array_sum($total_from_bg_amount_array);

        $total_from_bg_expiry = $this->BGManage->get_bg_all(date('Y-m-d'), $after_45_days, '1', '1', '');
        $total_from_bg_expiry_amount_array = array_column($total_from_bg_expiry, 'amount');
        $total_from_bg_expiry_amount = array_sum($total_from_bg_expiry_amount_array);

        $total_from_fdr = $this->BGManage->get_bg('', '1', '2', '');
        $total_from_fdr_amount_array = array_column($total_from_fdr, 'amount');
        $total_from_fdr_amount = array_sum($total_from_fdr_amount_array);

        $total_from_fdr_expiry = $this->BGManage->get_bg_all(date('Y-m-d'), $after_45_days, '1', '2', '');
        $total_from_fdr_expiry_amount_array = array_column($total_from_fdr_expiry, 'amount');
        $total_from_fdr_expiry_amount = array_sum($total_from_fdr_expiry_amount_array);

        $total_from_emd = $this->BGManage->get_bg('', '1', '3', '');
        $total_from_emd_amount_array = array_column($total_from_emd, 'amount');
        $total_from_emd_amount = array_sum($total_from_emd_amount_array);

        $total_from_emd_expiry = $this->BGManage->get_bg_all(date('Y-m-d'), $after_45_days, '1', '3', '');
        $total_from_emd_expiry_amount_array = array_column($total_from_emd_expiry, 'amount');
        $total_from_emd_expiry_amount = array_sum($total_from_emd_expiry_amount_array);

        $vdata['login_datatime'] = $last_login['login_datetime'];
        $vdata['login_details'] = $last_login;
        $vdata['total_as_bg'] = count($total_as_bg);
        $vdata['total_as_bg_amount'] = $total_as_bg_amount;
        $vdata['total_as_bg_expiry'] = count($total_as_bg_expiry);
        $vdata['total_as_bg_expiry_amount'] = $total_as_bg_expiry_amount;
        $vdata['total_as_fdr'] = count($total_as_fdr);
        $vdata['total_as_fdr_amount'] = $total_as_fdr_amount;
        $vdata['total_as_fdr_expiry'] = count($total_as_fdr_expiry);
        $vdata['total_as_fdr_expiry_amount'] = $total_as_fdr_expiry_amount;
        $vdata['total_as_emd'] = count($total_as_emd);
        $vdata['total_as_emd_amount'] = $total_as_emd_amount;
        $vdata['total_as_emd_expiry'] = count($total_as_emd_expiry);
        $vdata['total_as_emd_expiry_amount'] = $total_as_emd_expiry_amount;
        $vdata['total_from_bg'] = count($total_from_bg);
        $vdata['total_from_bg_amount'] = $total_from_bg_amount;
        $vdata['total_from_bg_expiry'] = count($total_from_bg_expiry);
        $vdata['total_from_bg_expiry_amount'] = $total_from_bg_expiry_amount;
        $vdata['total_from_fdr'] = count($total_from_fdr);
        $vdata['total_from_fdr_amount'] = $total_from_fdr_amount;
        $vdata['total_from_fdr_expiry'] = count($total_from_fdr_expiry);
        $vdata['total_from_fdr_expiry_amount'] = $total_from_fdr_expiry_amount;
        $vdata['total_from_emd'] = count($total_from_emd);
        $vdata['total_from_emd_amount'] = $total_from_emd_amount;
        $vdata['total_from_emd_expiry'] = count($total_from_emd_expiry);
        $vdata['total_from_emd_expiry_amount'] = $total_from_emd_expiry_amount;

        $status = "success";
        $code = "200";
        $message = "Updated";
        $error = "NA";
        $data[] = $vdata;

        echo $this->response_json($status, $data, $code, $message, $error);
    }

    public function response_json($status, $data, $code, $message, $error, $appversion = "1.0", $apiname = "ULB API") {
        $this->success = array(
            'status' => $status,
            'code' => $code,
            'success message' => $message,
            'appversion' => $appversion,
            'apiname' => $apiname,
            'error' => $error,
            'data' => $data
        );

        return json_encode($this->success);
    }
}
