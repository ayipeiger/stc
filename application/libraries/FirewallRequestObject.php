<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallRequestObject implements JsonSerializable {

	private $reqNumber;
	private $ipSource;
    private $ipDestination;
	private $tcpPort;
	private $udpPort;
	private $firewall;

	/**
	 * Class Constructor
	 * @param    $reqNumber   
	 * @param    $ipSource   
     * @param    $ipDestination
	 * @param    $tcpPort   
	 * @param    $udpPort   
	 * @param    $firewall   
	 */
	public function __construct($reqNumber = null, $ipSource = null, $ipDestination = null, $tcpPort = null, $udpPort = null, $firewall = null)
	{
		$this->reqNumber = $reqNumber;
		$this->ipSource = $ipSource;
        $this->ipDestination = $ipDestination;
		$this->tcpPort = $tcpPort;
		$this->udpPort = $udpPort;
		$this->firewall = $firewall;
	}
	
    /**
     * @return mixed
     */
    public function getReqNumber()
    {
        return $this->reqNumber;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function setReqNumber($reqNumber)
    {
        $this->reqNumber = $reqNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpSource()
    {
        return $this->ipSource;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function setIpSource($ipSource)
    {
        $this->ipSource = $ipSource;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpDestination()
    {
        return $this->ipDestination;
    }

    /**
     * @param mixed $port
     *
     * @return self
     */
    public function setIpDestination($ipDestination)
    {
        $this->ipDestination = $ipDestination;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTcpPort()
    {
        return $this->tcpPort;
    }

    /**
     * @param mixed $tcpPort
     *
     * @return self
     */
    public function setTcpPort($tcpPort)
    {
        $this->tcpPort = $tcpPort;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUdpPort()
    {
        return $this->udpPort;
    }

    /**
     * @param mixed $nameVdom
     *
     * @return self
     */
    public function setUdpPort($udpPort)
    {
        $this->udpPort = $udpPort;

        return $this;
    }

    public function jsonSerialize() {
        return [
            'reqNumber' => $this->getReqNumber(),
            'ipSource' => $this->getIpSource(),
            'ipDestination' => $this->getIpDestination(),
            'tcpPort' => $this->getTcpPort(),
            'udpPort' => $this->getUdpPort()
        ];
    }

    public function __destructors()
    {
    	echo "Destructors";
    }
}