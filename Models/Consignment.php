<?php


namespace Models;


use Models\Couriers\Courier;

/**
 * Class Consignment
 * @package Models
 */
class Consignment
{
    /**
     * @var Courier
     */
    private $courier;

    /**
     * @var string
     */
    private $consignmentNumber = '';

    /**
     * @var string
     */
    private $id = '';

    /**
     * @return Courier
     */
    public function getCourier()
    {
        return $this->courier;
    }

    /**
     * @param Courier $courier
     */
    public function setCourier(Courier $courier)
    {
        $this->courier = $courier;
    }

    /**
     * @return string
     */
    public function getConsignmentNumber()
    {
        return $this->consignmentNumber;
    }

    /**
     * @param string $consignmentNumber
     */
    public function setConsignmentNumber($consignmentNumber)
    {
        $this->consignmentNumber = $consignmentNumber;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
}
