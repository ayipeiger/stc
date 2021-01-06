<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallUser_model extends CI_Model {

	public function authenticate($username, $password) {
		$this->db->select('count(*) as found');
		$this->db->where('username', $username);
		$this->db->where('AES_DECRYPT(password, "stckeyEncrypt")='.$this->db->escape($password));
		$result = $this->db->get('firewall_user');
		
		return boolval($result->row()->found);
	}
}