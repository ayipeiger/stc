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

	public function testSsh() 
	{
		try {
			$connection = ssh2_connect("10.35.65.151", 22);
			ssh2_auth_password($connection, "administrator", "P@ssw0rd");
			$cmd = 'php -v && ls -l /var/log/nginx/';
			$stdout = ssh2_exec($connection, $cmd);
			$stderr = ssh2_fetch_stream($stdout, SSH2_STREAM_STDERR);
			if (!empty($stdout)) {

			    $t0 = time();
			    $err_buf = null;
			    $out_buf = null;

			    // Try for 30s
			    do {

			        $err_buf.= fread($stderr, 4096);
			        $out_buf.= fread($stdout, 4096);

			        $done = 0;
			        if (feof($stderr)) {
			            $done++;
			        }
			        if (feof($stdout)) {
			            $done++;
			        }

			        $t1 = time();
			        $span = $t1 - $t0;

			        // Info note
			        echo "while (($t0 < 20) && ($done < 2));\n";

			        // Wait here so we don't hammer in this loop
			        sleep(1);

			    } while (($span < 30) && ($done < 2));

			    echo "STDERR:\n".nl2br($err_buf)."\n";
			    echo "STDOUT:\n".nl2br($out_buf)."\n";

			    echo "Done\n";

			} else {
			    echo "Failed to Shell\n";
			}
		} catch(Exception $e) {
			echo $e->getMessage().PHP_EOL;
		}
		
	}
}
