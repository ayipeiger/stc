<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallAddressObject {

    private $code;
	private $ipname;
	private $type;
	private $address;


	/**
	 * Class Constructor
	 * @param    $code   
	 * @param    $ipname   
	 * @param    $location   
	 * @param    $type   
	 * @param    $address   
	 */
	public function __construct($code = null, $ipname = null, $type = null, $address = null)
	{
        $this->code = $code;
		$this->ipname = $ipname;
		$this->type = $type;
		$this->address = $address;
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