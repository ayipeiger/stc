<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallService_model extends CI_Model {

	public function find_all_registered($ip) {
		$this->db->select('ip, portname, protocol, portaddress');
		$this->db->where('ip', $ip);
		$resultSet = $this->db->get('firewall_object_services');

		$data = array();
		if($resultSet->num_rows() > 0) {
			foreach($resultSet->result() as $row) {
				$data[] = new FirewallServiceObject($row->ip, $row->portname, $row->protocol, $row->portaddress);
			}
		}
		
		return $data;
	}

	public function find_by_portaddress($ip, $protocol, $portaddress) {
		$this->db->select('ip, portname, protocol, portaddress');
		$this->db->where('ip', $ip);
		$this->db->where('protocol', $protocol);
		$this->db->where('portaddress', $portaddress);
		$resultSet = $this->db->get('firewall_object_services');

		$data = array();
		if($resultSet->num_rows() > 0) {
			$row = $resultSet->row();
			$data = new FirewallServiceObject($row->ip, $row->portname, $row->protocol, $row->portaddress);
		}
		
		return $data;
	}

	public function insert_entry($firewallServicesObj) {

		if(!($firewallServicesObj instanceof FirewallServiceObject)) {
			throw new RuntimeException ('Class is not instance of!');
		}

		$data = array(
				'ip' => $firewallServicesObj->getIp(),
				'portname' => $firewallServicesObj->getPortname(),
				'protocol' => $firewallServicesObj->getProtocol(),
				'portaddress' => $firewallServicesObj->getPortAddress()
			);
		$affectedRow = $this->db->insert('firewall_object_services', $data);
		return boolval($affectedRow);
	}

	public function insert_batch_entry($arrFirewallServicesObj = array()) {

		if(count($arrFirewallServicesObj) <= 0) {
			throw new Exception ('Data is empty!');
		}

		foreach ($arrFirewallServicesObj as $firewallServicesObj) {

			if(!($firewallServicesObj instanceof FirewallServiceObject)) {
				throw new RuntimeException ('Class is not instance of!');
			}

			$data[] = array(
					'ip' => $firewallServicesObj->getIp(),
					'portname' => $firewallServicesObj->getPortname(),
					'protocol' => $firewallServicesObj->getProtocol(),
					'portaddress' => $firewallServicesObj->getPortAddress()
				);
		}
		$affectedRow = $this->db->insert_batch('firewall_object_services', $data);
		return boolval($affectedRow);
	}

	public function truncate_entry($ip) {
		$this->db->where('ip', $ip);
		$affectedRow = $this->db->delete('firewall_object_services');
		return boolval($affectedRow);
	}
}