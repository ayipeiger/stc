<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function testExcel()
	{
		$this->load->library('excel');
		$this->load->view('test_excel');
	}

	public function testScriptNewAddress($ip) 
	{
		$connection = ssh2_connect("10.20.25.13", 22);
        if($connection) {
            $authentication = ssh2_auth_password($connection, "smry2018", "6nucvvX@");

            if($authentication) {
                $stdout_stream = ssh2_exec($connection, "config vdom && edit fwry13 && config firewall address && edit ".$ip."_32 && set subnet ".$ip."/32 && next && end && end");

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
}
