<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Firewall extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('firewall_model');
        $this->load->model('firewalladdress_model');
        $this->load->model('firewallservice_model');
    }

	public function connection()
	{
		$data = array();
		if($this->input->post('submit')=='login') {
            $this->session->set_userdata("is_connected", true);
            // set session IP, PORT, FortiOS version
            $this->session->set_userdata("firewall_ip", $this->input->post('firewall'));
            $this->session->set_userdata("firewall_port", $this->input->post('port'));
            $this->session->set_userdata("firewall_isvdom", $this->input->post('vdom') ? true : false);
            $this->session->set_userdata("firewall_vdom", $this->input->post('vdom'));
            $this->session->set_userdata("firewall_user", $this->input->post('username'));
            $this->session->set_userdata("firewall_pass", $this->input->post('password'));
            redirect('Firewall/sub_menu');
			// ini_set('default_socket_timeout', 3);
			// $connection = ssh2_connect($this->input->post('firewall'), $this->input->post('port'));
			// if($connection) {
			// 	$authentication = ssh2_auth_password($connection, $this->input->post('username'), $this->input->post('password'));
			// 	if($authentication) {
			// 		$stdout_stream = ssh2_exec($connection, "get system status");
			// 		$dio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
			// 		stream_set_blocking($dio_stream, true);
			// 		while($line=fgets($dio_stream)){
			// 			if(preg_match('/Version:\s(.*)/', $line, $output)) {
   //                          $this->session->set_userdata("firewall_version", isset($output[1]) && $output[1] ? $output[1] : "n/a");
   //                      }
   //                      if(preg_match('/Hostname:\s(.*)/', $line, $output)) {
   //                          $this->session->set_userdata("firewall_hostname", isset($output[1]) && $output[1] ? $output[1] : "n/a");
   //                      }
			// 		}
			// 		$this->session->set_userdata("is_connected", true);
			// 		// set session IP, PORT, FortiOS version
			// 		$this->session->set_userdata("firewall_ip", $this->input->post('firewall'));
			// 		$this->session->set_userdata("firewall_port", $this->input->post('port'));
   //                  $this->session->set_userdata("firewall_isvdom", $this->input->post('vdom') ? true : false);
   //                  $this->session->set_userdata("firewall_vdom", $this->input->post('vdom'));
			// 		$this->session->set_userdata("firewall_user", $this->input->post('username'));
			// 		$this->session->set_userdata("firewall_pass", $this->input->post('password'));
			// 		redirect('Firewall/cleanup_rule');
			// 	} else {
			// 		$data['error_message'] = "Authentication failed for ".$this->input->post('username')." using password";
			// 	}
			// } else {
			// 	$data['error_message'] = "Cannot connecting to ".$this->input->post('firewall')." through port ".$this->input->post('port').". Please contact your administrator.";
			// }
		} else {
            if($this->session->userdata("is_connected")) {
                redirect('Firewall/cleanup_rule');
            }
        }
		$this->load->view('firewall/connection_page', $data);
	}

    public function sub_menu() {
        if($this->session->userdata('is_connected')) {
            $data = array();
            $this->load->view('firewall/sub_menu_page', $data);
        }
    }

    public function sub_menu_setup() {
        if($this->session->userdata('is_connected')) {
            $data = array();
            $this->load->view('firewall/sub_menu_setup_page', $data);
        }
    }

    public function sub_menu_cleanup() {
        if($this->session->userdata('is_connected')) {
            $data = array();
            $this->load->view('firewall/sub_menu_cleanup_page', $data);
        }
    }

	public function disconnect()
	{
		$this->session->unset_userdata("is_connected");
		$this->session->unset_userdata("firewall_ip");
		$this->session->unset_userdata("firewall_port");
        $this->session->unset_userdata("firewall_isvdom");
        $this->session->unset_userdata("firewall_vdom");
		$this->session->unset_userdata("firewall_user");
		$this->session->unset_userdata("firewall_pass");
		redirect('Firewall/connection');
	}

    public function setup_rule()
    {
        if($this->session->userdata('is_connected')) {
            $data = array();
            $this->load->view('firewall/setup_rule_page', $data);
        }  
    }

	public function cleanup_rule()
	{
		if($this->session->userdata('is_connected')) {
			$data = array();
			$this->load->view('firewall/cleanup_rule_page', $data);
		} else {
			
		}		
	}

    public function save_file_address_object() {
        $response = array();
        try {
            if(!isset($_FILES['file_address_object'])) {
                throw new Exception("File not found");
            }

            $filename = basename($_FILES['file_address_object']['name']);
            
            $ext = substr($filename, strrpos($filename, '.') + 1);
            
            if(!in_array($ext, array('xls', 'xlsx'))) {
                throw new Exception("File format not supported");
            }
            
            $this->load->library('excel');
            $input_file_type = (($ext == 'xls') ? "Excel5" : ($ext=='xlsx' ? "Excel2007" : ""));
            $objReader = PHPExcel_IOFactory::createReader($input_file_type);
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($_FILES['file_address_object']['tmp_name']);

            $objActiveWorksheet = $objPHPExcel->getSheet(0);
            $highestRow = $objActiveWorksheet->getHighestRow(); // e.g. 10
            $highestColumn = $objActiveWorksheet->getHighestColumn(); // e.g 'F'

            if($highestRow <= 2) {
                throw new Exception("File excel is empty");
            }

            $affectedRow = $this->firewalladdress_model->truncate_entry($this->input->post('ip_address_object'));

            $arrFirewalAddressObj = array();
            for($counter_row = 2; $counter_row <= $highestRow; $counter_row++) {
                $address = $objActiveWorksheet->getCell("C".$counter_row)->getValue();
                if($address <> null || $address <> '') {
                    preg_match_all('/(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})/', $address, $matches);
                    if(isset($matches[0]) && count($matches[0]) == 2) {
                        $address = $matches[1][0].".".$matches[2][0]."-".$matches[2][1];
                    }
                }

                $firewallAddressObj = new FirewallAddressObject($this->input->post('ip_address_object'), $objActiveWorksheet->getCell("A".$counter_row)->getValue(), $objActiveWorksheet->getCell("B".$counter_row)->getValue(), $address);
                $arrFirewalAddressObj[] = $firewallAddressObj;
            }
            $affectedRow = $this->firewalladdress_model->insert_batch_entry($arrFirewalAddressObj);

            if($affectedRow <= 0) {
                throw new Exception("Insert to database failed!");
            }

            $response['status'] = true;
            $response['status_desc'] = "Success truncate all address data then insert ".count($arrFirewalAddressObj)." data.";
        } catch (Exception $e) {
            $response['status'] = false;
            $response['status_desc'] = $e->getMessage();
        }
        
        echo json_encode($response);
    }

    public function save_file_service_object() {
        $response = array();
        try {
            if(!isset($_FILES['file_service_object'])) {
                throw new Exception("File not found");
            }

            $filename = basename($_FILES['file_service_object']['name']);
            
            $ext = substr($filename, strrpos($filename, '.') + 1);
            
            if(!in_array($ext, array('xls', 'xlsx'))) {
                throw new Exception("File format not supported");
            }

            $this->load->library('excel');
            $input_file_type = (($ext == 'xls') ? "Excel5" : ($ext=='xlsx' ? "Excel2007" : ""));
            $objReader = PHPExcel_IOFactory::createReader($input_file_type);
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($_FILES['file_service_object']['tmp_name']);

            $objActiveWorksheet = $objPHPExcel->getSheet(0);
            $highestRow = $objActiveWorksheet->getHighestRow(); // e.g. 10
            $highestColumn = $objActiveWorksheet->getHighestColumn(); // e.g 'F'
            
            if($highestRow <= 2) {
                throw new Exception("File excel is empty");
            }

            $affectedRow = $this->firewallservice_model->truncate_entry($this->input->post('ip_service_object'));

            $arrFirewalServicesObj = array();
            for($counter_row = 2; $counter_row <= $highestRow; $counter_row++) {
                $firewallServicesObj = new FirewallServiceObject($this->input->post('ip_service_object'), $objActiveWorksheet->getCell("A".$counter_row)->getValue(), $objActiveWorksheet->getCell("B".$counter_row)->getValue(), $objActiveWorksheet->getCell("C".$counter_row)->getValue());
                $arrFirewalServicesObj[] = $firewallServicesObj;
            }
            $affectedRow = $this->firewallservice_model->insert_batch_entry($arrFirewalServicesObj);

            if($affectedRow <= 0) {
                throw new Exception("Insert to database failed!");
            }

            $response['status'] = true;
            $response['status_desc'] = "Success truncate all service data then insert ".count($arrFirewalServicesObj)." data.";
        } catch (Exception $e) {
            $response['status'] = false;
            $response['status_desc'] = $e->getMessage();
        }
        
        echo json_encode($response);
    }

	public function parsed_excel()
	{
		$data = array();
		try {
			if(!isset($_FILES['file_report'])) {
				throw new Exception("File not found");
			}

			$filename = basename($_FILES['file_report']['name']);
			$ext = substr($filename, strrpos($filename, '.') + 1);

			if(!in_array($ext, array('xls', 'xlsx'))) {
				throw new Exception("File format not supported");
			}

			$folder = APPPATH.'../uploads/';
			if (!is_dir($folder)) {
				mkdir($folder);
			}
			$pathfile = $folder.'/'. basename($_FILES['file_report']['name']);
			move_uploaded_file($_FILES['file_report']['tmp_name'], $pathfile);

			$this->load->library('excel');
			$input_file_type = (($ext == 'xls') ? "Excel5" : ($ext=='xlsx' ? "Excel2007" : ""));
			$objReader = PHPExcel_IOFactory::createReader($input_file_type);
	        $objReader->setReadDataOnly(true);
	        $objPHPExcel = $objReader->load($pathfile);
	        $objActiveWorksheet = $objPHPExcel->getSheet(0);
			$highestRow = $objActiveWorksheet->getHighestRow(); // e.g. 10
			$highestColumn = $objActiveWorksheet->getHighestColumn(); // e.g 'F'
			
			for($counter_row = 2; $counter_row <= $highestRow; $counter_row++) {
				$arr_temp = array(
					'policy_id' => $objActiveWorksheet->getCell("A".$counter_row)->getValue(),
					'src_resolved' => $objActiveWorksheet->getCell("B".$counter_row)->getValue(),
					'dest_resolved' => $objActiveWorksheet->getCell("C".$counter_row)->getValue(),
					'service_resolved' => $objActiveWorksheet->getCell("D".$counter_row)->getValue(),
					'action' => $objActiveWorksheet->getCell("E".$counter_row)->getValue(),
					'hit' => $objActiveWorksheet->getCell("F".$counter_row)->getValue()
				);
				$data['arr_policy'][] = $arr_temp;
			}
			unlink($pathfile);
			$data['result'] = true;
		} catch (Exception $e) {
			$data['result'] = false;
			$data['result_message'] = $e->getMessage();
		}
		
		$this->load->view('firewall/parsed_excel_page', $data);
	}

	public function disable_single() 
	{
         if(!empty($this->input->post('param'))) {
            list($policy_id, $src_resolved, $dest_resolved, $service_resolved, $action, $hit) = explode(";", $this->input->post('param'));
            
            $data = array();
            $connection = ssh2_connect($this->session->userdata('firewall_ip'), $this->session->userdata('firewall_port'));
            if($connection) {
                $authentication = ssh2_auth_password($connection, $this->session->userdata('firewall_user'), $this->session->userdata('firewall_pass'));
                if($authentication) {
                    $shell = ssh2_shell($connection);

                    if($this->session->userdata("firewall_isvdom")) {
                        fwrite($shell, "config vdom".PHP_EOL);
                        usleep(300000);
                        // echo stream_get_contents($shell)."<br>";
                        fwrite($shell, "edit ".$this->session->userdata("firewall_vdom").PHP_EOL);
                        usleep(300000);
                        // echo stream_get_contents($shell)."<br>";
                    }
                    fwrite($shell, "config firewall policy".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    fwrite($shell, "edit ".$policy_id.PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    fwrite($shell, "set status disable".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    fwrite($shell, "next".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    fwrite($shell, "end".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    if($this->session->userdata("firewall_isvdom")) {
                        fwrite($shell, "end".PHP_EOL);
                        usleep(300000);
                        // echo stream_get_contents($shell)."<br>";
                    }
                    fclose($shell);

                    $this->insert_log(trim($policy_id), trim($src_resolved), trim($dest_resolved), trim($service_resolved), trim($action), trim($hit), "disable", date("Y-m-d H:i:s"), $this->session->userdata('firewall_user'));
                    $data['result'] = true;
                    $data['success_id'] = $policy_id;
                    $data['result_message'] = "The policy id ".$policy_id." has been successfull disable";
                } else {
                    $data['result'] = false;
                    $data['result_message'] = "Authentication failed for ".$this->session->userdata('firewall_user')." using password";
                }
            } else {
                $data['result'] = false;
                $data['result_message'] = "Cannot connecting to ".$this->session->userdata('firewall_ip')." through port ".$this->session->userdata('firewall_port').". Please contact your administrator.";
            }    
        } else {
            $data['result'] = false;
            $data['result_message'] = "Parameter tidak lengkap";
        }

		echo json_encode($data);
	}

	public function disable_multiple()
	{
        $arr_param = $this->input->post('param');

		$data = array();
		$connection = ssh2_connect($this->session->userdata('firewall_ip'), $this->session->userdata('firewall_port'));
    	if($connection) {
    		$authentication = ssh2_auth_password($connection, $this->session->userdata('firewall_user'), $this->session->userdata('firewall_pass'));
    		if($authentication) {
    			$shell = ssh2_shell($connection);

                if($this->session->userdata("firewall_isvdom")) {
                    fwrite($shell, "config vdom".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    fwrite($shell, "edit ".$this->session->userdata("firewall_vdom").PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                }
    			fwrite($shell, "config firewall policy".PHP_EOL);
    			usleep(300000);
    			// echo stream_get_contents($shell)."<br>";
    			$data['result_message'] = "";
    			foreach($arr_param as $param) {
                    list($policy_id, $src_resolved, $dest_resolved, $service_resolved, $action, $hit) = explode(";", $param);

    				fwrite($shell, "edit ".$policy_id.PHP_EOL);
	    			usleep(100000);
	    			// echo stream_get_contents($shell)."<br>";
	    			fwrite($shell, "set status disable".PHP_EOL);
	    			usleep(100000);
	    			// echo stream_get_contents($shell)."<br>";
	    			fwrite($shell, "next".PHP_EOL);
	    			usleep(100000);
	    			// echo stream_get_contents($shell)."<br>";
	    			$data['arr_success_id'][] = $policy_id;

                    $this->insert_log(trim($policy_id), trim($src_resolved), trim($dest_resolved), trim($service_resolved), trim($action), trim($hit), "disable", date("Y-m-d H:i:s"), $this->session->userdata('firewall_user'));
    			}
    			fwrite($shell, "end".PHP_EOL);
    			usleep(300000);
    			// echo stream_get_contents($shell)."<br>";
                if($this->session->userdata("firewall_isvdom")) {
                    fwrite($shell, "end".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                }
    			fclose($shell);

    			$data['result'] = true;
    			$data['result_message'] .= "The policy id ".implode(',', $data['arr_success_id'])." has been successfull disable\n";
    		} else {
    			$data['result'] = false;
    			$data['result_message'] = "Authentication failed for ".$this->session->userdata('firewall_user')." using password";
    		}
    	} else {
    		$data['result'] = false;
			$data['result_message'] = "Cannot connecting to ".$this->session->userdata('firewall_ip')." through port ".$this->session->userdata('firewall_port').". Please contact your administrator.";
    	}
		echo json_encode($data);
	}

	public function delete_single()
	{
        if(!empty($this->input->post('param'))) {
            list($policy_id, $src_resolved, $dest_resolved, $service_resolved, $action, $hit) = explode(";", $this->input->post('param'));

            $data = array();
            $connection = ssh2_connect($this->session->userdata('firewall_ip'), $this->session->userdata('firewall_port'));
            if($connection) {
                $authentication = ssh2_auth_password($connection, $this->session->userdata('firewall_user'), $this->session->userdata('firewall_pass'));
                if($authentication) {
                    $shell = ssh2_shell($connection);
                    if($this->session->userdata("firewall_isvdom")) {
                        fwrite($shell, "config vdom".PHP_EOL);
                        usleep(300000);
                        // echo stream_get_contents($shell)."<br>";
                        fwrite($shell, "edit ".$this->session->userdata("firewall_vdom").PHP_EOL);
                        usleep(300000);
                        // echo stream_get_contents($shell)."<br>";
                    }
                    fwrite($shell, "config firewall policy".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    fwrite($shell, "delete ".$policy_id.PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    fwrite($shell, "end".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    if($this->session->userdata("firewall_isvdom")) {
                        fwrite($shell, "end".PHP_EOL);
                        usleep(300000);
                        // echo stream_get_contents($shell)."<br>";
                    }
                    fclose($shell);
                    
                    $this->insert_log(trim($policy_id), trim($src_resolved), trim($dest_resolved), trim($service_resolved), trim($action), trim($hit), "delete", date("Y-m-d H:i:s"), $this->session->userdata('firewall_user'));
                    $data['result'] = true;
                    $data['success_id'] = $policy_id;
                    $data['result_message'] = "The policy id ".$policy_id." has been successfull deleted";
                } else {
                    $data['result'] = false;
                    $data['result_message'] = "Authentication failed for ".$this->session->userdata('firewall_user')." using password";
                }
            } else {
                $data['result'] = false;
                $data['result_message'] = "Cannot connecting to ".$this->session->userdata('firewall_ip')." through port ".$this->session->userdata('firewall_port').". Please contact your administrator.";
            }
        } else {
            $data['result'] = false;
            $data['result_message'] = "Parameter tidak lengkap";
        }
		
		echo json_encode($data);
	}

	public function delete_multiple()
	{
		$arr_param = $this->input->post('param');

		$data = array();
		$connection = ssh2_connect($this->session->userdata('firewall_ip'), $this->session->userdata('firewall_port'));
    	if($connection) {
    		$authentication = ssh2_auth_password($connection, $this->session->userdata('firewall_user'), $this->session->userdata('firewall_pass'));
    		if($authentication) {
    			$shell = ssh2_shell($connection);
                if($this->session->userdata("firewall_isvdom")) {
                    fwrite($shell, "config vdom".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                    fwrite($shell, "edit ".$this->session->userdata("firewall_vdom").PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                }
    			fwrite($shell, "config firewall policy".PHP_EOL);
    			usleep(300000);
    			// echo stream_get_contents($shell)."<br>";
    			$data['result_message'] = "";
    			foreach ($arr_param as $param) {
                    list($policy_id, $src_resolved, $dest_resolved, $service_resolved, $action, $hit) = explode(";", $param);

    				fwrite($shell, "delete ".$policy_id.PHP_EOL);
	    			usleep(100000);
	    			// echo stream_get_contents($shell)."<br>";
	    			$data['arr_success_id'][] = $policy_id;

                    $this->insert_log(trim($policy_id), trim($src_resolved), trim($dest_resolved), trim($service_resolved), trim($action), trim($hit), "delete", date("Y-m-d H:i:s"), $this->session->userdata('firewall_user'));
    			}
    			fwrite($shell, "end".PHP_EOL);
    			usleep(300000);
    			// echo stream_get_contents($shell)."<br>";
                if($this->session->userdata("firewall_isvdom")) {
                    fwrite($shell, "end".PHP_EOL);
                    usleep(300000);
                    // echo stream_get_contents($shell)."<br>";
                }
    			fclose($shell);
    			
    			$data['result'] = true;
    			$data['result_message'] .= "The policy id ".implode(',', $data['arr_success_id'])." has been successfull deleted\n";
    		} else {
    			$data['result'] = false;
    			$data['result_message'] = "Authentication failed for ".$this->session->userdata('firewall_user')." using password";
    		}
    	} else {
    		$data['result'] = false;
			$data['result_message'] = "Cannot connecting to ".$this->session->userdata('firewall_ip')." through port ".$this->session->userdata('firewall_port').". Please contact your administrator.";
    	}
		echo json_encode($data);
	}

	public function register()
	{
		$data = array();
        if($this->input->post('submit') === 'register') {
            $spesialCommandAddress1Template = $this->input->post('spesial_command_address1_template'); //ip single digit
            $spesialCommandAddress2Template = $this->input->post('spesial_command_address2_template'); //ip with spesific subnet
            $spesialCommandAddress3Template = $this->input->post('spesial_command_address3_template'); //ip with spesific range
            $spesialCommandAddressTemplate = $spesialCommandAddress1Template."~~".$spesialCommandAddress2Template."~~".$spesialCommandAddress3Template;

            $spesialCommandPortTcpTemplate = $this->input->post('spesial_command_port_tcp_template');
            $spesialCommandPortUdpTemplate = $this->input->post('spesial_command_port_udp_template');
            $spesialCommandPortTemplate = $spesialCommandPortTcpTemplate."~~".$spesialCommandPortUdpTemplate;


            $firewallObj = new FirewallObject($this->input->post('firewall'), $this->input->post('firewall_code'), $this->input->post('port'), $this->input->post('vdom')<>'' ? true : false, $this->input->post('vdom'), $this->input->post('setup_command_template'), $spesialCommandAddressTemplate, $spesialCommandPortTemplate);
            $result = $this->firewall_model->insert_entry($firewallObj);
        }
		$this->load->view('firewall/register_page', $data);
	}

    public function registered()
    {
        $data['arrFirewall'] = $this->firewall_model->find_all_entry();
        $this->load->view('firewall/registered_page', $data);
    }

    public function registered_template()
    {
        $ip = $this->input->get('ip');
        $data['firewall'] = $this->firewall_model->find_single_entry($ip);
        $this->load->view('firewall/registered_template_page', $data);
    }

    public function registered_address()
    {
        $ip = $this->input->get('ip');
        $data['arrFirewallAddress'] = $this->firewalladdress_model->find_all_registered($ip);
        $this->load->view('firewall/registered_address_page', $data);
    }

    public function registered_service()
    {
        $ip = $this->input->get('ip');
        $data['arrFirewallService'] = $this->firewallservice_model->find_all_registered($ip);
        $this->load->view('firewall/registered_service_page', $data);
    }

    public function delete_registered()
    {
        $firewallObj = new FirewallObject($this->input->post('ip'));
        $this->db->trans_start();
        $affectedRow = $this->firewall_model->delete_entry($firewallObj);
        $affectedRow = $this->firewalladdress_model->truncate_entry($firewallObj->getIp());
        $affectedRow = $this->firewallservice_model->truncate_entry($firewallObj->getIp());
        $this->db->trans_complete();
        if($this->db->trans_status() === TRUE) {
            $response = array('status' => true, 'status_desc' => 'success');
        } else {
            $response = array('status' => false, 'status_desc' => 'failure');
        }
        echo json_encode($response);
    }

	public function list_register()
	{
		$data = array();
		$fileuser = APPPATH.'../uploads/user.txt';
		if(file_exists($fileuser)) {
			$fp = fopen($fileuser, 'r');
			$counter = 0;
			while($line = fgets($fp)) {
				list($ip, $port, $is_vdom, $vdom_name) = explode(';', $line);
				$data['arr_firewall'][$counter]['ip'] = $ip;
				$data['arr_firewall'][$counter]['port'] = $port;
				$data['arr_firewall'][$counter]['is_vdom'] = $is_vdom;
				$data['arr_firewall'][$counter]['vdom_name'] = $vdom_name;
				$counter++;
			}
			fclose($fp);
		}

		$this->load->view('firewall/list_register_page', $data);
	}

	public function save_register()
	{
		$host = $this->input->post('host');
		$port = $this->input->post('port');
		$is_vdom = $this->input->post('is_vdom') ? '1' : '0';
		$vdom_name = $this->input->post('vdom_name') ? $this->input->post('vdom_name') : '';

		$fileuser = APPPATH.'../uploads/user.txt';
		if(file_exists($fileuser) && fopen($fileuser, 'a')) {
			$fp = fopen($fileuser, 'a');
			fwrite($fp, $host.';'.$port.';'.$is_vdom.';'.$vdom_name.PHP_EOL);
			$data['result'] = true;
		}
		echo json_encode($data);
	}

	public function delete_register()
	{
		$host = $this->input->post('host');
		$port = $this->input->post('port');
		$is_vdom = $this->input->post('is_vdom') ? '1' : '0';
		$vdom_name = $this->input->post('vdom_name') && $this->input->post('vdom_name')<>'undefined' ? $this->input->post('vdom_name') : '';

		$fileuser = APPPATH.'../uploads/user.txt';
		if(file_exists($fileuser) && fopen($fileuser, 'r')) {
			$tmp = "";
			$fp = fopen($fileuser, 'r');
			while($line = fgets($fp)) {
				if(trim($line)<>trim($host.';'.$port.';'.$is_vdom.';'.$vdom_name)) {
					$tmp .= $line;
				}
			}
			fclose($fp);

			$fp = fopen($fileuser, 'wr');
			fwrite($fp, $tmp);
			$data['result'] = true;
		}
		echo json_encode($data);
	}

    public function list_firewall()
    {
        $query = $this->input->get('q');
        $arrFirewall = $this->firewall_model->find_all_entry($query);
        $data['arrFirewall'] = array();
        foreach($arrFirewall as $row) {
            $data['arrFirewall'][] = $row->getIp()."|".$row->getPort()."|".$row->getNameVdom();
        }
        return $this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode($data['arrFirewall']));
    }

    public function generate_command_template() 
    {
        $postRequestNumber = str_replace(" ", "", $this->input->post('request_number'));
        $postIpSource = str_replace(" ", "", $this->input->post('ip_source'));
        $postIpDestination = str_replace(" ", "", $this->input->post('ip_destination'));
        $postTcpPort = str_replace(" ", "", $this->input->post('tcp_port'));
        $postUdpPort = str_replace(" ", "", $this->input->post('udp_port'));
        $postFirewall = $this->input->post('firewall');

        $firewallObj = $this->firewall_model->find_single_entry($postFirewall);
        $mappingNotFound = false;
        $mappingNotFoundDesc = "We found that : ";

        $parsedReqNumber = trim($postRequestNumber);

        $arrIpSource = array_map("trim", explode(",", $postIpSource));
        $arrParsedIpSource = array();
        $arrNotFoundIpSource = array();
        foreach($arrIpSource as $row) {
            $ipSrcFirewallObj = $this->firewalladdress_model->find_by_address($postFirewall, $row);
            if($ipSrcFirewallObj instanceof FirewallAddressObject) {
                $arrParsedIpSource[] = $ipSrcFirewallObj->getIpname();
            } else {
                $mappingNotFound = true;
                $mappingNotFoundDesc .= " IP ".$row." doesn't exist\r\n".PHP_EOL;
                if(preg_match_all('/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})\-(\d{1,3})$/', $row, $matches)) { // if IP range
                    $selectedParsedIpSource = $row;
                } else if(preg_match_all('/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})\/(\d{1,2})$/', $row, $matches)) { // if IP subnet
                    $selectedParsedIpSource = str_replace("/", "_", $row);
                } else if(preg_match_all("/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})$/", $row, $matches)) { // if IP single
                    $selectedParsedIpSource = $row."_32";
                }
                $arrNotFoundIpSource[$row] = $selectedParsedIpSource;
            }
        }
        $parsedIpSource = implode(" ", $arrParsedIpSource);
        
        $arrIpDestination = array_map("trim", explode(",", $postIpDestination));
        $arrParsedIpDestination = array();
        $arrNotFoundIpDestination = array();
        foreach($arrIpDestination as $row) {
            $ipDestFirewallObj = $this->firewalladdress_model->find_by_address($postFirewall, $row);
            if($ipDestFirewallObj instanceof FirewallAddressObject) {
                $arrParsedIpDestination[] = $ipDestFirewallObj->getIpname();
            } else {
                $mappingNotFound = true;
                $mappingNotFoundDesc .= " IP ".$row." doesn't exist\r\n".PHP_EOL;
                if(preg_match_all('/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})\-(\d{1,3})$/', $row, $matches)) { // if IP range
                    $selectedParsedIpDestination = $row;
                } else if(preg_match_all('/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})\/(\d{1,2})$/', $row, $matches)) { // if IP subnet
                    $selectedParsedIpDestination = str_replace("/", "_", $row);
                } else if(preg_match_all("/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})$/", $row, $matches)) { // if IP single
                    $selectedParsedIpDestination = $row."_32";
                }
                $arrNotFoundIpDestination[$row] = $selectedParsedIpDestination;
            }
        }
        $parsedIpDestination = implode(" ", $arrParsedIpDestination);

        $arrTcpPort = array_map("trim", explode(",", $postTcpPort));
        $arrParsedTcpPort = array();
        $arrNotFoundTcpPort = array();
        foreach($arrTcpPort as $row) {
            $tcpPortFirewallObj = $this->firewallservice_model->find_by_portaddress($postFirewall, "TCP", $row);
            if($tcpPortFirewallObj instanceof FirewallServiceObject) {
                $arrParsedTcpPort[] = $tcpPortFirewallObj->getPortname();
            } else {
                $mappingNotFound = true;
                $mappingNotFoundDesc .= " TCP Port ".$row." doesn't exist\r\n".PHP_EOL;
                $selectedParsedTcpPort= $row."-tcp";
                $arrNotFoundTcpPort[$row] = $selectedParsedTcpPort;
            }
        }
        $parsedTcpPort = implode(" ", $arrParsedTcpPort);

        $arrUdpPort = array_map("trim", explode(",", $postUdpPort));
        $arrParsedUdpPort = array();
        $arrNotFoundUdpPort = array();
        foreach ($arrUdpPort as $row) {
            $udpPortFirewallObj = $this->firewallservice_model->find_by_portaddress($postFirewall, "UDP", $row);
            if($udpPortFirewallObj instanceof FirewallServiceObject) {
                $arrParsedUdpPort[] = $udpPortFirewallObj->getPortname();
            } else {
                $mappingNotFound = true;
                $mappingNotFoundDesc .= "UDP Port ".$row." doesn't exist\r\n".PHP_EOL;
                $selectedParsedUdpPort= $row."-udp";
                $arrNotFoundUdpPort[$row] = $selectedParsedUdpPort;
            }
        }
        $parsedUdpPort = implode(" ", $arrParsedUdpPort);
        
        if(!$mappingNotFound) {
            $setupCommandTemplate = $firewallObj->getSetupCommandTemplate();
            $setupCommandTemplate = str_replace("{#REQNUM}", $parsedReqNumber, $setupCommandTemplate);
            $setupCommandTemplate = str_replace("{#IPSRC}", $parsedIpSource, $setupCommandTemplate);
            $setupCommandTemplate = str_replace("{#IPDEST}", $parsedIpDestination, $setupCommandTemplate);
            $setupCommandTemplate = str_replace("{#PORTTCP}", $parsedTcpPort, $setupCommandTemplate);
            $setupCommandTemplate = str_replace("{#PORTUDP}", $parsedUdpPort, $setupCommandTemplate);
            $firewallObj->setSetupCommandTemplate($setupCommandTemplate);
        } else {
            $spesialCommandAddressTemplate = $firewallObj->getSpesialCommandAddressTemplate();
            if(count(explode("~~", $spesialCommandAddressTemplate)) > 0) {
                list($spesialCommandAddress1Template, $spesialCommandAddress2Template, $spesialCommandAddress3Template) = explode("~~", $spesialCommandAddressTemplate);
            }

            $spesialCommandPortTemplate = $firewallObj->getSpesialCommandPortTemplate();
            if(count(explode("~~", $spesialCommandPortTemplate)) > 0) {
                list($spesialCommandPortTcpTemplate, $spesialCommandPortUdpTemplate) = explode("~~", $spesialCommandPortTemplate);
            }

            $spesialCommandAddressTemplate = str_replace("{#IPNEW}", $postIpSource, $spesialCommandAddressTemplate);
            $spesialCommandAddressTemplate = str_replace("{#IPNAME}", $postIpDestination, $spesialCommandAddressTemplate);
            $spesialCommandAddressTemplate = str_replace("{#IPSTART}", $parsedIpSource, $spesialCommandAddressTemplate);
            $spesialCommandAddressTemplate = str_replace("{#IPEND}", $parsedIpDestination, $spesialCommandAddressTemplate);

            $commandAddress = '';

            if(count($arrNotFoundIpSource) > 0) {
                foreach($arrNotFoundIpSource as $key => $row) {
                    if(preg_match_all('/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})\-(\d{1,3})$/', $key, $matches)) { // if IP range
                        // echo "<pre>"; var_dump($spesialCommandAddress3Template); echo "</pre>"; die;
                        $tmpCommandAddress = isset($spesialCommandAddress3Template) ? $spesialCommandAddress3Template : 'n/a';
                        $tmpCommandAddress = str_replace("{#IPNAME}", $row, $tmpCommandAddress);
                        $tmpCommandAddress = str_replace("{#IPSTART}", $matches[1][0].".".$matches[2][0], $tmpCommandAddress);
                        $tmpCommandAddress = str_replace("{#IPEND}", $matches[1][0].".".$matches[3][0], $tmpCommandAddress);
                        $commandAddress .= $tmpCommandAddress.PHP_EOL;
                    } else if(preg_match_all('/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})\/(\d{1,2})$/', $key, $matches)) { // if IP subnet
                        $tmpCommandAddress = isset($spesialCommandAddress2Template) ? $spesialCommandAddress2Template : 'n/a';
                        $tmpCommandAddress = str_replace("{#IPNEW}", $key, $tmpCommandAddress);
                        $tmpCommandAddress = str_replace("{#IPNAME}", $row, $tmpCommandAddress);
                        $commandAddress .= $tmpCommandAddress.PHP_EOL;
                    } else if(preg_match_all("/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})$/", $key, $matches)) { // if IP single
                        $tmpCommandAddress = isset($spesialCommandAddress1Template) ? $spesialCommandAddress1Template : 'n/a';
                        $tmpCommandAddress = str_replace("{#IPNEW}", $key."/32", $tmpCommandAddress);
                        $tmpCommandAddress = str_replace("{#IPNAME}", $row."_32", $tmpCommandAddress);
                        $commandAddress .= $tmpCommandAddress.PHP_EOL;
                    }
                }
            }

            if(count($arrNotFoundIpDestination) > 0) {
                foreach($arrNotFoundIpDestination as $key => $row) {
                    if(preg_match_all('/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})\-(\d{1,3})$/', $key, $matches)) { // if IP range
                        // echo "<pre>"; var_dump($spesialCommandAddress3Template); echo "</pre>"; die;
                        $tmpCommandAddress = isset($spesialCommandAddress3Template) ? $spesialCommandAddress3Template : 'n/a';
                        $tmpCommandAddress = str_replace("{#IPNAME}", $row, $tmpCommandAddress);
                        $tmpCommandAddress = str_replace("{#IPSTART}", $matches[1][0].".".$matches[2][0], $tmpCommandAddress);
                        $tmpCommandAddress = str_replace("{#IPEND}", $matches[1][0].".".$matches[3][0], $tmpCommandAddress);
                        $commandAddress .= $tmpCommandAddress.PHP_EOL;
                    } else if(preg_match_all('/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})\/(\d{1,2})$/', $key, $matches)) { // if IP subnet
                        $tmpCommandAddress = isset($spesialCommandAddress2Template) ? $spesialCommandAddress2Template : 'n/a';
                        $tmpCommandAddress = str_replace("{#IPNEW}", $key, $tmpCommandAddress);
                        $tmpCommandAddress = str_replace("{#IPNAME}", $row, $tmpCommandAddress);
                        $commandAddress .= $tmpCommandAddress.PHP_EOL;
                    } else if(preg_match_all("/^(\d{1,3}\.\d{1,3}\.\d{1,3})\.(\d{1,3})$/", $key, $matches)) { // if IP single
                        $tmpCommandAddress = isset($spesialCommandAddress1Template) ? $spesialCommandAddress1Template : 'n/a';
                        $tmpCommandAddress = str_replace("{#IPNEW}", $key."/32", $tmpCommandAddress);
                        $tmpCommandAddress = str_replace("{#IPNAME}", $row."_32", $tmpCommandAddress);
                        $commandAddress .= $tmpCommandAddress.PHP_EOL;
                    }
                }
            }

            $commandPort = '';

            if(count($arrNotFoundTcpPort) > 0) {
                foreach($arrNotFoundTcpPort as $key => $row) {
                    $tmpCommandPort = isset($spesialCommandPortTcpTemplate) ? $spesialCommandPortTcpTemplate : 'n/a';
                    $tmpCommandPort = str_replace("{#PORTNEW}", $key, $tmpCommandPort);
                    $tmpCommandPort = str_replace("{#PORTNAME}", $row, $tmpCommandPort);
                    $commandPort .= $tmpCommandPort.PHP_EOL;
                }
            }

            if(count($arrNotFoundUdpPort) > 0) {
                foreach($arrNotFoundUdpPort as $key => $row) {
                    $tmpCommandPort = isset($spesialCommandPortUdpTemplate) ? $spesialCommandPortUdpTemplate : 'n/a';
                    $tmpCommandPort = str_replace("{#PORTNEW}", $key, $tmpCommandPort);
                    $tmpCommandPort = str_replace("{#PORTNAME}", $row, $tmpCommandPort);
                    $commandPort .= $tmpCommandPort.PHP_EOL;
                }
            }

            $firewallObj->setSpesialCommandAddressTemplate($commandAddress);
            $firewallObj->setSpesialCommandPortTemplate($commandPort);
        }
        
        $data['mappingNotFound'] = $mappingNotFound;
        $data['mappingNotFoundDesc'] = $mappingNotFoundDesc;
        $data['arrNotFoundIpSource'] = $arrNotFoundIpSource;
        $data['arrNotFoundIpDestination'] = $arrNotFoundIpDestination;
        $data['arrNotFoundTcpPort'] = $arrNotFoundTcpPort;
        $data['arrNotFoundUdpPort'] = $arrNotFoundUdpPort;
        $data['firewall'] = $firewallObj;
        $this->load->view('firewall/generate_command_template', $data);
    }

    public function execute_command_template()
    {
        $postFirewall = $this->input->post('firewall');
        $postSetupCommand = $this->input->post('setup_command');
        $postArrNotFoundIpSource = json_decode($this->input->post('arr_not_found_ipsource'), true);
        $postArrNotFoundIpDestination = json_decode($this->input->post('arr_not_found_ipdestination'), true);
        $postArrNotFoundTcpPort = json_decode($this->input->post('arr_not_found_tcpport'), true);
        $postArrNotFoundUdpPort = json_decode($this->input->post('arr_not_found_udpport'), true);
        $postAddressCommand = $this->input->post('address_command');
        $postPortCommand = $this->input->post('port_command');
        $firewallObj = $this->firewall_model->find_single_entry($postFirewall);

        if(count($postArrNotFoundIpSource) > 0) {
            $arrFirewallAddressObj = array();
            foreach($postArrNotFoundIpSource as $key => $val) {
                $arrFirewallAddressObj[] = new FirewallAddressObject($firewallObj->getIp(), $val, 'IP Netmask', $key);
            }
            $this->firewalladdress_model->insert_batch_entry($arrFirewallAddressObj);
        }

        if(count($postArrNotFoundIpDestination) > 0) {
            $arrFirewallAddressObj = array();
            foreach($postArrNotFoundIpDestination as $key => $val) {
                $arrFirewallAddressObj[] = new FirewallAddressObject($firewallObj->getIp(), $val, 'IP Netmask', $key);
            }
            $this->firewalladdress_model->insert_batch_entry($arrFirewallAddressObj);
        }

        if(count($postArrNotFoundTcpPort) > 0) {
            $arrFirewallServiceObj = array();
            foreach($postArrNotFoundTcpPort as $key => $val) {
                $arrFirewallServiceObj[] = new FirewallServiceObject($firewallObj->getIp(), $val, 'TCP', $key);
            }
            $this->firewallservice_model->insert_batch_entry($arrFirewallServiceObj);
        }

        if(count($postArrNotFoundUdpPort) > 0) {
            $arrFirewallServiceObj = array();
            foreach($postArrNotFoundUdpPort as $key => $val) {
                $arrFirewallServiceObj[] = new FirewallServiceObject($firewallObj->getIp(), $val, 'UDP', $key);
            }
            $this->firewallservice_model->insert_batch_entry($arrFirewallServiceObj);
        }

        if($postSetupCommand) {
            $arrCommand = array_filter(preg_split('/[\r\n]+/', $postSetupCommand));
            
            $strCommand = implode(" && ", $arrCommand);

            $connection = ssh2_connect($firewallObj->getIp(), $firewallObj->getPort());
            if($connection) {
                $authentication = ssh2_auth_password($connection, $this->session->userdata('firewall_user'), $this->session->userdata('firewall_pass'));

                if($authentication) {
                    $stdout_stream = ssh2_exec($connection, $strCommand);

                    $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
                    $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);

                    stream_set_blocking($sio_stream, true);
                    stream_set_blocking($err_stream, true);

                    $result_dio = stream_get_contents($sio_stream);
                    $result_err = stream_get_contents($err_stream);

                    echo 'stderr: ';
                    echo nl2br($result_err);
                    echo 'stdio : ';
                    echo nl2br($result_dio);
                } else {
                    echo "Authentication failed"; die;
                }
                
            } else {
                echo "Connection failed"; die;
            }
        }

        if($postAddressCommand) {
            $arrCommand = array_filter(preg_split('/[\r\n]+/', $postAddressCommand));
            
            $strCommand = implode(" && ", $arrCommand);

            $connection = ssh2_connect($firewallObj->getIp(), $firewallObj->getPort());
            if($connection) {
                $authentication = ssh2_auth_password($connection, $this->session->userdata('firewall_user'), $this->session->userdata('firewall_pass'));

                if($authentication) {
                    $stdout_stream = ssh2_exec($connection, $strCommand);

                    $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
                    $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);

                    stream_set_blocking($sio_stream, true);
                    stream_set_blocking($err_stream, true);

                    $result_dio = stream_get_contents($sio_stream);
                    $result_err = stream_get_contents($err_stream);

                    echo 'stderr: ';
                    echo nl2br($result_err);
                    echo 'stdio : ';
                    echo nl2br($result_dio);
                } else {
                    echo "Authentication failed"; die;
                }
                
            } else {
                echo "Connection failed"; die;
            }
        }

        if($postPortCommand) {
            $arrCommand = array_filter(preg_split('/[\r\n]+/', $postPortCommand));
            
            $strCommand = implode(" && ", $arrCommand);

            $connection = ssh2_connect($firewallObj->getIp(), $firewallObj->getPort());
            if($connection) {
                $authentication = ssh2_auth_password($connection, $this->session->userdata('firewall_user'), $this->session->userdata('firewall_pass'));

                if($authentication) {
                    $stdout_stream = ssh2_exec($connection, $strCommand);

                    $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
                    $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);

                    stream_set_blocking($sio_stream, true);
                    stream_set_blocking($err_stream, true);

                    $result_dio = stream_get_contents($sio_stream);
                    $result_err = stream_get_contents($err_stream);

                    echo 'stderr: ';
                    echo nl2br($result_err);
                    echo 'stdio : ';
                    echo nl2br($result_dio);
                } else {
                    echo "Authentication failed"; die;
                }
                
            } else {
                echo "Connection failed"; die;
            }
        }
        
        $data = array();
        $this->load->view('firewall/execute_command_template', $data);
    }

    public function execute_test()
    {
        $connection = ssh2_connect("10.35.65.151", 22);
        if($connection) {
            $authentication = ssh2_auth_password($connection, "administrator", "P@ssw0rd");

            if($authentication) {
                $stdout_stream = ssh2_exec($connection, "cd /var/www ; mkdir testost");

                $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
                $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);

                stream_set_blocking($sio_stream, true);
                stream_set_blocking($err_stream, true);

                $result_dio = stream_get_contents($sio_stream);
                $result_err = stream_get_contents($err_stream);

                echo PHP_EOL;
                echo 'stderr: ' . $result_err;
                echo 'stdio : ' . $result_dio;

                $stdout_stream = ssh2_exec($connection, "mkdir ayipeiger");

                $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
                $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);

                stream_set_blocking($sio_stream, true);
                stream_set_blocking($err_stream, true);

                $result_dio = stream_get_contents($sio_stream);
                $result_err = stream_get_contents($err_stream);

                echo PHP_EOL;
                echo 'stderr: ' . $result_err;
                echo 'stdio : ' . $result_dio;
            } else {
                echo "Authentication failed"; die;
            }
            
        } else {
            echo "Connection failed"; die;
        }
    }

    public function insert_log($policy_id, $src, $dest, $service, $action, $hit, $hist_action, $time_execute, $user)
    {
        // var_dump($policy_id)."|".var_dump($src)."|".var_dump($dest)."|".var_dump($service)."|".var_dump($action)."|".var_dump($hit)."|".var_dump($hist_action)."|".var_dump($time_execute); die;
        // policy_id, action disable/delete, time_execute
        $filename = str_replace(".", "", $this->session->userdata("firewall_ip"));
        $filelog = APPPATH.'../logs/'.$filename.'.txt';
        if(!file_exists($filelog)) {
            $handle = fopen($filelog, 'w') or die("Cannot create file ".$filelog);
            fclose($handle);
        }

        $fp = fopen($filelog, 'a');
        fwrite($fp, $policy_id.";".$src.";".$dest.";".$service.";".$action.";".$hit.";".$hist_action.";".$time_execute.";".$user.PHP_EOL);
        fclose($fp);
    }

    public function history_log()
    {
        $data = array();
        $filename = str_replace(".", "", $this->session->userdata("firewall_ip"));
        $filelog = APPPATH.'../logs/'.$filename.'.txt';
        if(!file_exists($filelog)) {
            $handle = fopen($filelog, 'w') or die("Cannot create file ".$filelog);
            fclose($handle);
        }

        if(file_exists($filelog)) {
            $fp = fopen($filelog, 'r');
            $counter = 0;
            while($line = fgets($fp)) {
                list($policy_id, $src_resolved, $dest_resolved, $service_resolved, $action, $hit, $hist_action, $time_execute, $user) = explode(";", $line);
                $data['arr_log'][$counter]['policy_id'] = $policy_id;
                $data['arr_log'][$counter]['src_resolved'] = $src_resolved;
                $data['arr_log'][$counter]['dest_resolved'] = $dest_resolved;
                $data['arr_log'][$counter]['service_resolved'] = $service_resolved;
                $data['arr_log'][$counter]['action'] = $action;
                $data['arr_log'][$counter]['hit'] = $hit;
                $data['arr_log'][$counter]['hits'] = $hist_action;
                $data['arr_log'][$counter]['time_execute'] = $time_execute;
                $data['arr_log'][$counter]['user'] = $user;
                $counter++;
            }
            fclose($fp);
        }
        $this->load->view('firewall/history_log_page', $data);
    }
}