<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customlib {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('user_agent');
        $this->CI->load->library('email');
    }

    public function load_agent() {
        $agent = $this->CI->agent->platform();
        if ($this->CI->agent->is_browser()) {
            $agent = $this->CI->agent->browser().' '.$this->CI->agent->version().', '.$agent;
        } elseif ($this->CI->agent->is_robot()) {
            $agent = $this->CI->agent->robot().', '.$agent;
        } elseif ($this->CI->agent->is_mobile()) {
            $agent = $this->CI->agent->mobile().', '.$agent;
        } else {
            $agent = 'Unidentified User Agent'.', '.$agent;
        }

        return $agent;
    }

    public function setUsersLogs($response, $permission_id, $url) {
        if(empty($response)) {
            redirect(base_url('Login'), 'location');
        }

        $this->CI->db->trans_start();

        $userslogs_data['date'] =  date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $userslogs_data['time'] =  date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $userslogs_data['users_id'] = $response->users_id;
        $userslogs_data['users_type_id'] = $response->users_type_id;
        $userslogs_data['permission_id'] = $permission_id;
        $userslogs_data['url'] = $url;
        $userslogs_data['created_date'] = date('Y-m-d', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $userslogs_data['created_time'] = date('H:i:s', mktime(gmdate('H')+5, gmdate('i')+30, gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y')));
        $userslogs_data['created_by'] = $response->users_id;
        $userslogs_data['created_name'] = $response->name;
        $userslogs_data['created_user_agent'] = $this->load_agent();
        $userslogs_data['created_ip'] = $this->CI->input->ip_address();
        
        $user_log_id = $this->CI->UsersLogsMstModel->add($userslogs_data);
        
        $users_pages_info = $this->CI->UsersPermissionMstModel->get_record($permission_id, $response->users_type_id)['0'];
                
        $this->CI->db->trans_complete();

        return $users_pages_info;
    }

    public function expirePage() {
        $this->CI->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->CI->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
        $this->CI->output->set_header('Pragma: no-cache');

        $login_info = array();

        if($this->CI->session->userdata('priyadarshini_superadmin_login_detail')) {
            $login_info = $this->CI->session->userdata('priyadarshini_superadmin_login_detail');

        } else if($this->CI->session->userdata('priyadarshini_admin_login_detail')) {
            $login_info = $this->CI->session->userdata('priyadarshini_admin_login_detail');

        } else if($this->CI->session->userdata('priyadarshini_accounts_login_detail')) {
            $login_info = $this->CI->session->userdata('priyadarshini_accounts_login_detail');
            
        } else if($this->CI->session->userdata('priyadarshini_bank_login_detail')) {
            $login_info = $this->CI->session->userdata('priyadarshini_bank_login_detail');
            
        } else if($this->CI->session->userdata('priyadarshini_manager_login_detail')) {
            $login_info = $this->CI->session->userdata('priyadarshini_manager_login_detail');
            
        } else if($this->CI->session->userdata('priyadarshini_supervisor_login_detail')) {
            $login_info = $this->CI->session->userdata('priyadarshini_supervisor_login_detail');

        } else if($this->CI->session->userdata('priyadarshini_cashier_login_detail')) {
            $login_info = $this->CI->session->userdata('priyadarshini_cashier_login_detail');

        } else if($this->CI->session->userdata('priyadarshini_returs_login_detail')) {
            $login_info = $this->CI->session->userdata('priyadarshini_returs_login_detail');

        }
        
        if(!isset($login_info)) {
            redirect(base_url('Login'), 'location');
        }        
    }

    public function getPrivilege() {
        $user = $this->CI->session->userdata('login_detail');
        $username = $user['username'];
        $privilege = $this->CI->Privilege->get_privilege($username);
        $module = array_column($privilege, 'module');
        return($module);
    }

    function getMonthDropdown() {
        $array = array();
        for ($m = 1; $m <= 12; $m++) {
            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $array[$month] = $month;
        }
        return $array;
    }

    function get_DDMMYYYY_FULL($date) {
        return date('d-M-Y', strtotime($date));
    }

    function get_DDMMYYYY($date) {
        return date('d/m/Y', strtotime($date));
    }

    function get_YYYYMMDD($date) {
        return date('Y-m-d', strtotime($date));
    }

    function get_MMYY($date) {
        return date('m/y', strtotime($date));
    }

    function getMonthList() {
        $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'Decmber');
        return $months;
    }
	
	public function number_words($number) {
		$no = round($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'One', '2' => 'Two',
		'3' => 'Three', '4' => 'Four', '5' => 'five', '6' => 'six',
		'7' => 'seven', '8' => 'eight', '9' => 'nine',
		'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
		'13' => 'thirteen', '14' => 'fourteen',
		'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
		'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
		'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
		'60' => 'sixty', '70' => 'seventy',
		'80' => 'eighty', '90' => 'ninety');
		$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
		while ($i < $digits_1)
		{
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number)
			{
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number] .
				" " . $digits[$counter] . $plural . " " . $hundred
				:
				$words[floor($number / 10) * 10]
				. " " . $words[$number % 10] . " "
				. $digits[$counter] . $plural . " " . $hundred;
			} 
			else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$points = ($point) ?
		"." . $words[$point / 10] . " " . 
		$words[$point = $point % 10] : '';
		$converter='';
		if($result!='')
		{
			$converter=$result."Rupees  ";			  
		}
		if($points!='')
		{
			$converter.=$points."Paise  ";			  
		}
		return strtoupper($converter);
	}

    function calculate_gst($rate, $taxes) {
        $gst1_val = $rate*$taxes;
        $gst2_val = $taxes+100;
        $gst_amount = $gst1_val/$gst2_val;
        return $gst_amount;
    }

    public function inr_rupees_format($figure) {
        if ($figure > 99000 && $figure <= 9900000) {
            $figure = (float) ($figure / 100000);
            return number_format(round($figure, 2), 2) . " Lakh";
        } elseif ($figure > 9900000) {
            $figure = (float) ($figure / 10000000);
            return number_format(round($figure, 2), 2) . " Cr";
        } else {
            return number_format(round($figure, 2), 2);
        }
    }
    
    public function inr_format($num) {
        if($num !== '') {
            $explrestunits = "" ;
            if(strlen($num) > 3) {
                $lastthree = substr($num, strlen($num)-3, strlen($num));
                $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
                $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
                $expunit = str_split($restunits, 2);
                for($i=0; $i<sizeof($expunit); $i++) {
                    // creates each of the 2's group and adds a comma to the end
                    if($i==0) {
                        $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                    } else {
                        $explrestunits .= $expunit[$i].",";
                    }
                }
                $thecash = $explrestunits.$lastthree;
            } else {
                $thecash = $num;
            }
        } else {
            $thecash = '0'; 
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }

    public function mail_body($content) {
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
    <title>' . html_escape($subject) . '</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 18px;
        }
    </style>
</head>
<body>
' . $content . '
</body>
</html>';

        return $body;
    }

    public function send_mail($to, $subject, $body) {
        $this->CI->email
                ->from('admin@cnvg.in', 'CNVG Fund Management')
                ->to($to)
                ->subject($subject)
                ->message($body)
                ->send();
    }    

    public function sendMail($to, $fromEmail, $fromName, $subject, $message) {
        $this->CI->load->library('email');
        $this->CI->email->mailtype = 'html';
        $this->CI->email->from($fromEmail, $fromName);
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        $result = $this->CI->email->send();
        if ($result == 1)
            return 1;
        else
            return 0;
    }

    public function latlongtoAddress($latlong) {
        $api_key = "AIzaSyAePZPUdoiiJCHnc7lQxPGfpVGHQnQ_fl0";
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latlong . "&key=" . $api_key;
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
        echo "<pre>";
        print_r($response);
        echo "</pre>";
    }
}
