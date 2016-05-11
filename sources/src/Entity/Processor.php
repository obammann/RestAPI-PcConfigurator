<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 14:34
 */

namespace HsBremen\WebApi\Entity;


class Processor extends Component implements \JsonSerializable
{
    private $socket;
    private $frequency;
    private $cores;


    public function __construct($id, $name, $price, $socket, $frequency ,$cores)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->socket= $socket;
        $this->frequency = $frequency;
        $this->cores = $cores;
    }

    function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'socket'    => $this->socket,
            'frequency' => $this->frequency,
            'cores'     => $this->cores,
        ];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * @param mixed $socket
     */
    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return mixed
     */
    public function getCores()
    {
        return $this->cores;
    }

    /**
     * @param mixed $cores
     */
    public function setCores($cores)
    {
        $this->cores = $cores;
    }

    /**
     * @return mixed
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param mixed $frequency
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }


}