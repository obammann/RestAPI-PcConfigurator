<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 14:34
 */

namespace HsBremen\WebApi\Entity;


/**
 * @SWG\Definition(required={"name"}, @SWG\XmL(name="Processor"))
 */

class Processor extends Component implements \JsonSerializable
{

    /**
     * @SWG\Property()
     * @var string
     */
    private $processorSocket;

    /**
     * @SWG\Property()
     * @var int
     */
    private $frequency;

    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    private $cores;


    public function __construct($id, $name, $price, $processorSocket, $frequency, $cores)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->processorSocket= $processorSocket;
        $this->frequency = $frequency;
        $this->cores = $cores;
    }

    function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'processor socket'    => $this->processorSocket,
            'frequency' => $this->frequency,
            'cores'     => $this->cores,
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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