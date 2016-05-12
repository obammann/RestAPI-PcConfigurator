<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 12.05.16
 * Time: 13:40
 */

namespace HsBremen\WebApi\Entity;


class Mainboard extends Component implements \JsonSerializable
{
    private $processorSocket;
    private $numberDDR3Slots;
    private $numberDDR4Slots;
    private $numberSataConnectors;
    private $numberPCIeSlots;



    public function __construct($id, $name, $price, $processorSocket, $numberDDR3Slots , $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->processorSocket= $processorSocket;
        $this->numberDDR3Slots = $numberDDR3Slots;
        $this->numberDDR4Slots = $numberDDR4Slots;
        $this->numberSataConnectors = $numberSataConnectors;
        $this->numberPCIeSlots = $numberPCIeSlots;
    }

    function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'processor socket'    => $this->processorSocket,
            'number of DDR3 slots' => $this->numberDDR3Slots,
            'number of DDR4 slots'     => $this->numberDDR4Slots,
            'number of SATA connectors' => $this->numberSataConnectors,
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

    /**
     * @return mixed
     */
    public function getNumberDDR4Slots()
    {
        return $this->numberDDR4Slots;
    }

    /**
     * @param mixed $numberDDR4Slots
     */
    public function setNumberDDR4Slots($numberDDR4Slots)
    {
        $this->numberDDR4Slots = $numberDDR4Slots;
    }

    /**
     * @return mixed
     */
    public function getNumberDDR3Slots()
    {
        return $this->numberDDR3Slots;
    }

    /**
     * @param mixed $numberDDR3Slots
     */
    public function setNumberDDR3Slots($numberDDR3Slots)
    {
        $this->numberDDR3Slots = $numberDDR3Slots;
    }

    /**
     * @return mixed
     */
    public function getNumberSataConnectors()
    {
        return $this->numberSataConnectors;
    }

    /**
     * @param mixed $numberSataConnectors
     */
    public function setNumberSataConnectors($numberSataConnectors)
    {
        $this->numberSataConnectors = $numberSataConnectors;
    }

    /**
     * @return mixed
     */
    public function getNumberPCIeSlots()
    {
        return $this->numberPCIeSlots;
    }

    /**
     * @param mixed $numberPCIeSlots
     */
    public function setNumberPCIeSlots($numberPCIeSlots)
    {
        $this->numberPCIeSlots = $numberPCIeSlots;
    }


}