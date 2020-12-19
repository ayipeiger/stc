<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallAddress_model extends CI_Model {

	public function find_all_registered($ip) {
		$this->db->select('ip, ipname, location, type, address');
		$this->db->where('ip', $ip);
		$resultSet = $this->db->get('firewall_object_addresses');

		$data = array();
		if($resultSet->num_rows() > 0) {
			foreach($resultSet->result() as $row) {
				$data[] = new FirewallAddressObject($row->ip, $row->ipname, $row->location, $row->type, $row->address);
			}
		}
		
		return $data;
	}

	public function find_by_address($ip, $address) {
		$this->db->select('ip, ipname, location, type, address');
		$this->db->where('ip', $ip);
		$this->db->where('address', $address);
		$resultSet = $this->db->get('firewall_object_addresses');
		
		$data = new FirewallAddressObject();
		if($resultSet->num_rows() > 0) {
			$row = $resultSet->row();
			$data = new FirewallAddressObject($row->ip, $row->ipname, $row->location, $row->type, $row->address);
		}
		
		return $data;
	}

	public function insert_entry($firewallAddressObj) {

		if(!($firewallAddressObj instanceof FirewallAddressObject)) {
			throw new RuntimeException ('Class is not instance of!');
		}

		$data = array(
				'ip' => $firewallAddressObj->getIp(),
				'ipname' => $firewallAddressObj->getIpname(),
				'location' => $firewallAddressObj->getLocation(),
				'type' => $firewallAddressObj->getType(),
				'address' => $firewallAddressObj->getAddress()
			);
		$affectedRow = $this->db->insert('firewall_object_addresses', $data);
		return boolval($affectedRow);
	}

	public function insert_batch_entry($arrFirewallAddressObj = array()) {

		if(count($arrFirewallAddressObj) <= 0) {
			throw new Exception ('Data is empty!');
		}

		foreach ($arrFirewallAddressObj as $firewallAddressObj) {

			if(!($firewallAddressObj instanceof FirewallAddressObject)) {
				throw new RuntimeException ('Class is not instance of!');
			}

			$data[] = array(
					'ip' => $firewallAddressObj->getIp(),
					'ipname' => $firewallAddressObj->getIpname(),
					'location' => $firewallAddressObj->getLocation(),
					'type' => $firewallAddressObj->getType(),
					'address' => $firewallAddressObj->getAddress()
				);
		}
		$affectedRow = $this->db->insert_batch('firewall_object_addresses', $data);
		return boolval($affectedRow);
	}

	public function truncate_entry($ip) {
		$this->db->where('ip', $ip);
		$affectedRow = $this->db->delete('firewall_object_addresses');
		return boolval($affectedRow);
	}
}