<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 13.05.16
 * Time: 20:31
 */

namespace HsBremen\WebApi\Entity;

/**
 * @SWG\Definition(required={"name"}, @SWG\XmL(name="HDD"))
 */
class HDD extends Component implements \JsonSerializable
{

    /**
     * @SWG\Property()
     * @var string
     */
    private $type;
    /**
     * @SWG\Property()
     * @var int
     */
    private $memory;

    public function __construct($id, $name, $price, $type, $memory)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->memory = $memory;
    }

    function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'type'    => $this->type,
            'memory' => $this->memory,
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @param mixed $memory
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    }
}