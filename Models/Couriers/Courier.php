<?php


namespace Models\Couriers;


use Models\TransportMethod\TransportMethod;

/**
 * Class Courier
 * @package Models\Couriers
 */
abstract class Courier implements CourierInterface
{
    /**
     * @var string 
     */
    private $name = '';
    
    /**
     * @var TransportMethod $transportMethod
     */
    private $transportMethod;

    /**
     * Courier constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @return TransportMethod
     */
    public function getTransportMethod()
    {
        return $this->transportMethod;
    }

    /**
     * @param TransportMethod $transportMethod
     */
    public function setTransportMethod(TransportMethod $transportMethod)
    {
        $this->transportMethod = $transportMethod;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}