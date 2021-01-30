<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallObject implements JsonSerializable {

	private $ip;
	private $port;
    private $code;
	private $isVdom;
	private $nameVdom;
    private $counter;
	private $setupCommandTemplate;
	private $spesialCommandAddressTemplate;
    private $spesialCommandPortTemplate;

	/**
	 * Class Constructor
	 * @param    $ip   
	 * @param    $port   
     * @param    $code
	 * @param    $isVdom   
	 * @param    $nameVdom   
	 * @param    $setupCommandTemplate   
	 * @param    $spesialCommandAddressTemplate   
     * @param    $spesialCommandPortTemplate
	 */
	public function __construct($ip = null, $code = null, $port = null, $isVdom = null, $nameVdom = null, $counter = 0, $setupCommandTemplate = null, $spesialCommandAddressTemplate = null, $spesialCommandPortTemplate = null)
	{
		$this->ip = $ip;
		$this->port = $port;
        $this->code = $code;
		$this->isVdom = $isVdom;
		$this->nameVdom = $nameVdom;
        $this->counter = $counter;
		$this->setupCommandTemplate = $setupCommandTemplate;
		$this->spesialCommandAddressTemplate = $spesialCommandAddressTemplate;
        $this->spesialCommandPortTemplate = $spesialCommandPortTemplate;
	}
	
    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $code
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
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     *
     * @return self
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsVdom()
    {
        return $this->isVdom;
    }

    /**
     * @param mixed $isVdom
     *
     * @return self
     */
    public function setIsVdom($isVdom)
    {
        $this->isVdom = $isVdom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameVdom()
    {
        return $this->nameVdom;
    }

    /**
     * @param mixed $nameVdom
     *
     * @return self
     */
    public function setNameVdom($nameVdom)
    {
        $this->nameVdom = $nameVdom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * @param mixed $counter
     *
     * @return self
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSetupCommandTemplate()
    {
        return $this->setupCommandTemplate;
    }

    /**
     * @param mixed $setupCommandTemplate
     *
     * @return self
     */
    public function setSetupCommandTemplate($setupCommandTemplate)
    {
        $this->setupCommandTemplate = $setupCommandTemplate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpesialCommandAddressTemplate()
    {
        return $this->spesialCommandAddressTemplate;
    }

    /**
     * @param mixed $spesialCommandAddressTemplate
     *
     * @return self
     */
    public function setSpesialCommandAddressTemplate($spesialCommandAddressTemplate)
    {
        $this->spesialCommandAddressTemplate = $spesialCommandAddressTemplate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpesialCommandPortTemplate()
    {
        return $this->spesialCommandPortTemplate;
    }

    /**
     * @param mixed $spesialCommandPortTemplate
     *
     * @return self
     */
    public function setSpesialCommandPortTemplate($spesialCommandPortTemplate)
    {
        $this->spesialCommandPortTemplate = $spesialCommandPortTemplate;

        return $this;
    }

    public function jsonSerialize() {
        return [
            'code' => $this->getCode(),
            'ip' => $this->getIp(),
            'port' => $this->getPort(),
            'isVdom' => $this->getIsVdom(),
            'nameVdom' => $this->getNameVdom(),
            'counter' => $this->getCounter(),
            'setupCommandTemplate' => $this->getSetupCommandTemplate(),
            'spesialCommandAddressTemplate' => $this->getSpesialCommandAddressTemplate(),
            'spesialCommandPortTemplate' => $this->getSpesialCommandPortTemplate()
        ];
    }

    public function __destructors()
    {
    	echo "Destructors";
    }
}