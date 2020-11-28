<?php


namespace Models\TransportMethod;


/**
 * Interface TransportMethodInterface
 * @package Models\TransportMethod
 */
interface TransportMethodInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @param $data
     * @return void
     */
    public function setData($data);

    /**
     * @return bool
     */
    public function send();
}
