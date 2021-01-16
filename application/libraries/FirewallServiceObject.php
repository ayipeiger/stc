<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallServiceObject {

    private $code;
	private $portname;
	private $protocol;
	private $portAddress;


	/**
	 * Class Constructor
	 * @param    $code   
	 * @param    $portname   
	 * @param    $protocol   
	 * @param    $portAddress   
	 */
	public function __construct($code = null, $portname = null, $protocol = null, $portAddress = null)
	{
        $this->code = $code;
		$this->portname = $portname;
		$this->protocol = $protocol;
		$this->portAddress = $portAddress;
	}
	
    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

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