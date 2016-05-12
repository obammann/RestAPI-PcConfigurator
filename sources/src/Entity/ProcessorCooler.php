<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 12.05.16
 * Time: 13:34
 */

namespace HsBremen\WebApi\Entity;


class ProcessorCooler extends Component implements \JsonSerializable
{
    private $processorSocket;


    public function __construct($id, $name, $price, $processorSocket)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->processorSocket= $processorSocket;
    }

    function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'processor socket'    => $this->processorSocket,
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
    public function getProcessorSocket()
    {
        return $this->processorSocket;
    }

    /**
     * @param mixed $processorSocket
     */
    public function setProcessorSocket($processorSocket)
    {
        $this->processorSocket = $processorSocket;
    }



}