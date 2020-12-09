<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallAddressObject {

	private $ip;
	private $ipname;
	private $location;
	private $type;
	private $address;


	/**
	 * Class Constructor
	 * @param    $ip   
	 * @param    $ipname   
	 * @param    $location   
	 * @param    $type   
	 * @param    $address   
	 */
	public function __construct($ip, $ipname, $location, $type, $address)
	{
		$this->ip = $ip;
		$this->ipname = $ipname;
		$this->location = $location;
		$this->type = $type;
		$this->address = $address;
	}

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     *
     * @return self
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpname()
    {
        return $this->ipname;
    }

    /**
     * @param mixed $ipname
     *
     * @return self
     */
    public function setIpname($ipname)
    {
        $this->ipname = $ipname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     *
     * @return self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}