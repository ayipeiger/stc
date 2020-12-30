<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Firewall_model extends CI_Model {

	public function find_all_entry($param = '') {
		$this->db->select('ip, port, is_vdom, vdom, setup_command, spesial_command');
		if(!empty($param)) {
			$this->db->like('ip', $param);
		}
		$resultSet = $this->db->get('firewall');
		$data = array();
		foreach ($resultSet->result() as $row) {
			$firewallObj = new FirewallObject($row->ip, $row->port, $row->is_vdom, $row->vdom, $row->setup_command, $row->spesial_command);
			$data[] = $firewallObj;
		}

		return $data;
	}

	public function find_single_entry($ip) {
		$this->db->select('ip, port, is_vdom, vdom, setup_command, spesial_command');
		$this->db->where('ip', $ip);
		$resultSet = $this->db->get('firewall');

		$data = new FirewallObject();
		if($resultSet->num_rows() > 0) {
			$row = $resultSet->row();
			$data = new FirewallObject($row->ip, $row->port, $row->is_vdom, $row->vdom, $row->setup_command, $row->spesial_command);
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
				'spesial_address_command' => $firewallObject->getSpesialCommandAddressTemplate(),
				'spesial_port_command' => $firewallObject->getSpesialCommandPortTemplate()
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
				'spesial_address_command' => $firewallObject->getSpesialCommandAddressTemplate(),
				'spesial_port_command' => $firewallObject->getSpesialCommandPortTemplate()
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
}