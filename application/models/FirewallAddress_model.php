<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallAddress_model extends CI_Model {

	public function find_all_registered($code) {
		$this->db->select('code, ipname, type, address');
		$this->db->where('code', $code);
		$resultSet = $this->db->get('firewall_object_addresses');

		$data = array();
		if($resultSet->num_rows() > 0) {
			foreach($resultSet->result() as $row) {
				$data[] = new FirewallAddressObject($row->code, $row->ipname, $row->type, $row->address);
			}
		}
		
		return $data;
	}

	public function find_by_address($code, $address) {
		$this->db->select('code, ipname, type, address');
		$this->db->where('code', $code);
		$this->db->where('address', $address);
		$resultSet = $this->db->get('firewall_object_addresses');
		
		$data = new StdClass();
		if($resultSet->num_rows() > 0) {
			$row = $resultSet->row();
			$data = new FirewallAddressObject($row->code, $row->ipname, $row->type, $row->address);
		}
		
		return $data;
	}

	public function insert_entry($firewallAddressObj) {

		if(!($firewallAddressObj instanceof FirewallAddressObject)) {
			throw new RuntimeException ('Class is not instance of!');
		}

		$data = array(
				'code' => $firewallAddressObj->getCode(),
				'ipname' => $firewallAddressObj->getIpname(),
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
					'code' => $firewallAddressObj->getCode(),
					'ipname' => $firewallAddressObj->getIpname(),
					'type' => $firewallAddressObj->getType(),
					'address' => $firewallAddressObj->getAddress()
				);
		}
		$affectedRow = $this->db->insert_batch('firewall_object_addresses', $data);
		return boolval($affectedRow);
	}

	public function truncate_entry($code) {
		$this->db->where('code', $code);
		$affectedRow = $this->db->delete('firewall_object_addresses');
		return boolval($affectedRow);
	}
}