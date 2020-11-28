<?php


namespace Models\Couriers;


use Models\TransportMethod\Email;

/**
 * Class RoyalMail
 * @package Models\Couriers
 */
class RoyalMail extends Courier implements CourierInterface
{
    /**
     * RoyalMail constructor.
     * 
     * Sets the connection method for Royal Mail to email
     * 
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);
        
        $emailConfig = new Email();
        
        $emailConfig->setRecipient('consignments@royalmail.com');
        $emailConfig->setSubject('Consignments for Bobs Clothing');
        
        $this->setTransportMethod($emailConfig);
    }

    /**
     * @return string|int
     */
    public function generateConsignmentNumber()
    {
        // Generate courier algorithm
        return 'GB' . date('YmdHis') . rand(0, 1000) . 'RM';
    }

    /**
     * @param mixed $data
     * @return bool
     */
    public function sendConsignmentData($data)
    {
        $this->getTransportMethod()->setData($data);
        
        return $this->getTransportMethod()->send();
    }
}
