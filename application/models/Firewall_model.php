<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Firewall_model extends CI_Model {

	public function findall_entry() {
		$result_set = $this->db->select('ip, port, is_vdom, vdom, setup_command, spesial_command')->get('firewall');
		
		$data = array();
		foreach ($result_set->result() as $row) {
			$firewallObj = new FirewallObject($row->ip, $row->port, $row->is_vdom, $row->vdom, $row->setup_command, $row->spesial_command);
			$data[] = $firewallObj;
		}

		return $data;
	}

	public function insert_entry($firewallObject) {

		if(!($firewallObject instanceof FirewallObject)) {
			throw new RuntimeException ('Class is not instance of!');
		}

		$data = array(
				'ip' => $firewallObject->getIp(),
				'port' => $firewallObject->getPort(),
				'is_vdom' => $firewallObject->getIsVdom(),
				'vdom' => $firewallObject->getNameVdom(),
				'setup_command' => $firewallObject->getSetupCommandTemplate(),
				'spesial_command' => $firewallObject->getSpesialCommandTemplate()
			);
		$affectedRow = $this->db->insert('firewall', $data);
		return boolval($affectedRow);
	}

	public function update_entry($firewallObject) {

		if(!($firewallObject instanceof FirewallObject)) {
			throw new RuntimeException ('Class is not instance of!');
		}

		$data = array(
				'port' => $firewallObject->getPort(),
				'is_vdom' => $firewallObject->getIsVdom(),
				'vdom' => $firewallObject->getNameVdom(),
				'setup_command' => $firewallObject->getSetupCommandTemplate(),
				'spesial_command' => $firewallObject->getSpesialCommandTemplate()
			);
		$affectedRow = $this->db->update('firewall', $data, array('ip' => $firewallObject->getIp()));
		return boolval($affectedRow);
	}

	public function delete_entry($firewallObject) {

		if(!($firewallObject instanceof FirewallObject)) {
			throw new RuntimeException ('Class is not instance of!');
		}

		$affectedRow = $this->db->delete('firewall', array('ip' => $firewallObject->getIp()));
		return boolval($affectedRow);
	}

	public function delete_all_registered_firewall_addresses($firewallObject) {
		$affectedRow = $this->db->delete('firewall_object_addresses', array('ip' => $firewallObject->getIp()));
		return boolval($affectedRow);
	}

	public function delete_all_registered_firewall_services($firewallObject) {
		$affectedRow = $this->db->delete('firewall_object_services', array('ip' => $firewallObject->getIp()));
		return boolval($affectedRow);
	}
}