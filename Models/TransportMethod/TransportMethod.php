<?php


namespace Models\TransportMethod;


/**
 * Class TransportMethod
 * @package Models\TransportMethod
 */
abstract class TransportMethod implements TransportMethodInterface
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
