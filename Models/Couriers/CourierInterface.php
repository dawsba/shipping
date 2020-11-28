<?php


namespace Models\Couriers;


use Models\TransportMethod\TransportMethod;

/**
 * Interface CourierInterface
 * @package Models\Couriers
 */
interface CourierInterface
{
    /**
     * CourierInterface constructor.
     * @param string $name
     */
    public function __construct($name);

    /**
     * @return string|int
     */
    public function generateConsignmentNumber();

    /**
     * @param TransportMethod $method
     * @return null
     */
    public function setTransportMethod(TransportMethod $method);

    /**
     * @return TransportMethod
     */
    public function getTransportMethod();

    /**
     * @param mixed $data
     * @return bool
     */
    public function sendConsignmentData($data);

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();
}
