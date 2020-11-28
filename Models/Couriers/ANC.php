<?php


namespace Models\Couriers;


use Models\TransportMethod\FTP;

class ANC extends Courier implements CourierInterface
{
    /**
     * ANC constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);
        
        $ftpConfig = new FTP();
        
        $ftpConfig->setUsePassive(true);
        $ftpConfig->setHost('ftp://anc.com');
        
        $this->setTransportMethod($ftpConfig);
    }

    /**
     * @return int|string
     */
    public function generateConsignmentNumber()
    {
        // Algorithm from courier
        return base64_encode(md5(rand(0,1000)));
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