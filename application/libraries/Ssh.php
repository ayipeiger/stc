<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH."/third_party/phpseclib/Net/SSH2.php";
set_include_path(get_include_path() . PATH_SEPARATOR . APPPATH . 'third_party/phpseclib');

class Ssh extends Net_SSH2 {
	// public $host;
	// public $port;
	// public $timeout;

    public function __construct() {
    	// $this->host = $host;
    	// $this->port = $port;
    	// $this->timeout = $timeout;
        parent::__construct("192.168.163.30", "22", "1");
    }
}