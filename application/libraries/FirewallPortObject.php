<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallPortObject {

	private $ip;
	private $portname;
	private $protocol;
	private $portAddress;


	/**
	 * Class Constructor
	 * @param    $ip   
	 * @param    $portname   
	 * @param    $protocol   
	 * @param    $portAddress   
	 */
	public function __construct($ip, $portname, $protocol, $portAddress)
	{
		$this->ip = $ip;
		$this->portname = $portname;
		$this->protocol = $protocol;
		$this->portAddress = $portAddress;
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
    public function getPortname()
    {
        return $this->portname;
    }

    /**
     * @param mixed $portname
     *
     * @return self
     */
    public function setPortname($portname)
    {
        $this->portname = $portname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param mixed $protocol
     *
     * @return self
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPortAddress()
    {
        return $this->portAddress;
    }

    /**
     * @param mixed $portAddress
     *
     * @return self
     */
    public function setPortAddress($portAddress)
    {
        $this->portAddress = $portAddress;

        return $this;
    }
}