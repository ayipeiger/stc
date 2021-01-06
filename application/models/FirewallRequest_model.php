<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallRequest_model extends CI_Model {

	public function inquiry_summary() {
		$this->db->select("RequestID, GROUP_CONCAT(DISTINCT(`bidirectional`)) as `bidirectional`, GROUP_CONCAT(DISTINCT(fw)) as fw, COUNT(1) as total_data, MIN(executed) as executed");
		$this->db->group_by("RequestID");
		$result = $this->db->get('firewall_request');

		return $result->result();
	}

	public function inquiry_detail($requestNumber, $firewallCode) {
		$this->db->select("`RequestID`, GROUP_CONCAT(DISTINCT(`bidirectional`)) AS `bidirectional`, GROUP_CONCAT(DISTINCT(`Src`)) as ipSource, GROUP_CONCAT(DISTINCT(`Dst`)) as ipDestination, GROUP_CONCAT(DISTINCT(`Port`)) as port, GROUP_CONCAT(DISTINCT(`Protocol`)) as protocol");
		$this->db->where('RequestID', $requestNumber);
		$this->db->where('fw', $firewallCode);
		$result = $this->db->get('firewall_request');

		return $result->row();
	}
}