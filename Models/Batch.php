<?php


namespace Models;


use Models\Couriers\ANC;
use Models\Couriers\Courier;
use Models\Couriers\RoyalMail;

/**
 * Class Batch
 * @package Models
 */
class Batch
{
    /**
     * @var Consignment[]
     */
    private $consignments = array();

    /**
     * @var null|\DateTime
     */
    private $startTimestamp = null;

    /**
     * @var null|\DateTime
     */
    private $endTimestamp = null;

    /**
     * @var Courier[]
     */
    private $couriers;

    /**
     * Batch constructor.
     */
    public function __construct()
    {
        // todo generate the below from config or DB        
        $this->setCouriers(
            array(
                'RoyalMail' => new RoyalMail('RoyalMail'),
                'ANC' => new ANC('ANC'),
            )
        );
    }

    /**
     * @param Courier $courier
     * @param array $data
     *
     * Create new consignment, passing the Courier model to be used and formatted data
     */
    public function newConsignment(Courier $courier, array $data)
    {
        $consignment = new Consignment();

        // Generate consignment ID
        $nextConsignmentId = count($this->getConsignments())+1;

        $courier->getTransportMethod()->setData($data);

        // Build Consignment Model and push into var
        $consignment->setId($nextConsignmentId);
        $consignment->setCourier($courier);
        $consignment->setConsignmentNumber(
            $courier->generateConsignmentNumber()
        );

        $this->setConsignment($consignment);
    }

    /**
     * @return \DateTime
     * @throws \Exception
     *
     * Generates a timestamp for starting batch
     */
    public function startBatch()
    {
        $this->setStartTimestamp(new \DateTime());

        return $this->getStartTimestamp();
    }

    /**
     * @return \DateTime
     * @throws \Exception
     */
    public function endBatch()
    {
        $this->setEndTimestamp(new \DateTime());

        // If elements exists in consignment array step each
        if ( ! empty($this->getConsignments())) {
            foreach ($this->getConsignments() as $consignment) {
                $courier = $consignment->getCourier();

                $data = $courier->getTransportMethod()->getData();

                $courier->sendConsignmentData($data);
            }
        }

        return $this->getEndTimestamp();
    }

    /**
     * @return Consignment[]
     */
    public function getConsignments()
    {
        return $this->consignments;
    }

    /**
     * @param Consignment[] $consignments
     *
     * todo build ORM to populate this data
     */
    public function setConsignments($consignments)
    {
        $this->consignments = $consignments;
    }

    /**
     * @param Consignment $consignment
     */
    public function setConsignment(Consignment $consignment)
    {
        $this->consignments[] = $consignment;
    }

    /**
     * @return null|\DateTime
     */
    public function getStartTimestamp()
    {
        return $this->startTimestamp;
    }

    /**
     * @param \DateTime $startTimestamp
     */
    public function setStartTimestamp(\DateTime $startTimestamp)
    {
        $this->startTimestamp = $startTimestamp;
    }

    /**
     * @return null|\DateTime
     */
    public function getEndTimestamp()
    {
        return $this->endTimestamp;
    }

    /**
     * @param \DateTime $endTimestamp
     */
    public function setEndTimestamp(\DateTime $endTimestamp)
    {
        $this->endTimestamp = $endTimestamp;
    }

    /**
     * @return Courier[]
     */
    public function getCouriers()
    {
        return $this->couriers;
    }

    /**
     * @param string $name
     * @return Courier
     * @throws \Exception
     */
    public function getCourierByName($name)
    {
        $couriers = $this->getCouriers();
        
        if (array_key_exists($name, $couriers) && $couriers[$name] instanceof Courier) {
            return $couriers[$name];
        }
        
        throw new \Exception('Unknown Courier');
    }

    /**
     * @param Courier[] $couriers
     */
    public function setCouriers($couriers)
    {
        $this->couriers = $couriers;
    }
}
