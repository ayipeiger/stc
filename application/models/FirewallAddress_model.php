<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Firewall_model extends CI_Model {

	public function find_by_parameter($ip) {

	}

	public function insert_entry($firewallAddressObj) {

		if(!($firewallAddressObj instanceof FirewallAddressObjeect)) {
			throw new RuntimeException ('Class is not instance of!');
		}

	}

	public function insert_batch_entry($arrFirewallAddressObj = array()) {

		if(count($arrFirewallAddressObj) <= 0) {
			throw new Exception ('Data not found!');
		}

		foreach ($arrFirewallAddressObj as $key => $value) {
			# code...
		}
	}
}