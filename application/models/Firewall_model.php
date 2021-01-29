<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Firewall_model extends CI_Model {

	public function find_all_entry($param = '') {
		$this->db->select('ip, code, port, is_vdom, vdom, counter, setup_command, spesial_address_command, spesial_port_command');
		if(!empty($param)) {
			$this->db->like('ip', $param);
		}
		$resultSet = $this->db->get('firewall');
		$data = array();
		foreach ($resultSet->result() as $row) {
			$firewallObj = new FirewallObject($row->ip, $row->code, $row->port, $row->is_vdom, $row->vdom, $row->counter, $row->setup_command, $row->spesial_address_command, $row->spesial_port_command);
			$data[] = $firewallObj;
		}

		return $data;
	}

	public function find_all_entry_by_fwcode($code = '') {
		$this->db->select('ip, code, port, is_vdom, vdom, counter, setup_command, spesial_address_command, spesial_port_command');
		if(!empty($code)) {
			$this->db->like('code', $code);
		}
		$resultSet = $this->db->get('firewall');
		$data = array();
		foreach ($resultSet->result() as $row) {
			$firewallObj = new FirewallObject($row->ip, $row->code, $row->port, $row->is_vdom, $row->vdom, $row->counter, $row->setup_command, $row->spesial_address_command, $row->spesial_port_command);
			$data[] = $firewallObj;
		}

		return $data;
	}

	public function find_single_entry($ip) {
		$this->db->select('ip, code, port, is_vdom, vdom, counter, setup_command, spesial_address_command, spesial_port_command');
		$this->db->where('ip', $ip);
		$resultSet = $this->db->get('firewall');

		$data = new StdClass();
		if($resultSet->num_rows() > 0) {
			$row = $resultSet->row();
			$data = new FirewallObject($row->ip, $row->code, $row->port, $row->is_vdom, $row->vdom, $row->counter, $row->setup_command, $row->spesial_address_command, $row->spesial_port_command);
		}
		
		return $data;
	}

	public function find_single_entry_by_fwcode($code) {
		$this->db->select('ip, code, port, is_vdom, vdom, counter, setup_command, spesial_address_command, spesial_port_command');
		$this->db->where('code', $code);
		$resultSet = $this->db->get('firewall');

		$data = new StdClass();
		if($resultSet->num_rows() > 0) {
			$row = $resultSet->row();
			$data = new FirewallObject($row->ip, $row->code, $row->port, $row->is_vdom, $row->vdom, $row->counter, $row->setup_command, $row->spesial_address_command, $row->spesial_port_command);
		}
		
		return $data;
	}

	public function insert_entry($firewallObject) {

		if(!($firewallObject instanceof FirewallObject)) {
			throw new RuntimeException ('Class is not instance of!');
		}

		$data = array(
				'ip' => $firewallObject->getIp(),
				'code' => $firewallObject->getCode(),
				'port' => $firewallObject->getPort(),
				'is_vdom' => $firewallObject->getIsVdom(),
				'vdom' => $firewallObject->getNameVdom(),
				'counter' => $firewallObject->getCounter(),
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
				'code' => $firewallObject->getCode(),
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

	public function counterIncrement($firewallObject) {
		if(!($firewallObject instanceof FirewallObject)) {
			throw new RuntimeException ('Class is not instance of!');
		}

		$affectedRow = $this->db->update('firewall', array('counter' => $firewallObject->getCounter()+1), array('ip' => $firewallObject->getIp()));
		return boolval($affectedRow);
	}

	public function delete_entry($firewallObject) {
		
		if(!($firewallObject instanceof FirewallObject)) {
			throw new RuntimeException ('Class is not instance of!');
		}
		
		$affectedRow = $this->db->delete('firewall', array('code' => $firewallObject->getCode()));
		return boolval($affectedRow);
	}
}