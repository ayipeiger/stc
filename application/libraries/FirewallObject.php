<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallObject {

	private $ip;
	private $port;
	private $isVdom;
	private $nameVdom;
	private $setupCommandTemplate;
	private $spesialCommandTemplate;

	/**
	 * Class Constructor
	 * @param    $ip   
	 * @param    $port   
	 * @param    $isVdom   
	 * @param    $nameVdom   
	 * @param    $setupCommandTemplate   
	 * @param    $spesialCommandTemplate   
	 */
	public function __construct($ip = null, $port = null, $isVdom = null, $nameVdom = null, $setupCommandTemplate = null, $spesialCommandTemplate = null)
	{
		$this->ip = $ip;
		$this->port = $port;
		$this->isVdom = $isVdom;
		$this->nameVdom = $nameVdom;
		$this->setupCommandTemplate = $setupCommandTemplate;
		$this->spesialCommandTemplate = $spesialCommandTemplate;
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
    public function getSpesialCommandTemplate()
    {
        return $this->spesialCommandTemplate;
    }

    /**
     * @param mixed $spesialCommandTemplate
     *
     * @return self
     */
    public function setSpesialCommandTemplate($spesialCommandTemplate)
    {
        $this->spesialCommandTemplate = $spesialCommandTemplate;

        return $this;
    }

    public function __destructors()
    {
    	echo "Destructors";
    }
}