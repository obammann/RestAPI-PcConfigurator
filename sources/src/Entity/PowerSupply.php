<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 13.05.16
 * Time: 20:36
 */

namespace HsBremen\WebApi\Entity;

/**
 * @SWG\Definition(required={"name"}, @SWG\XmL(name="PowerSupply"))
 */
class PowerSupply extends Component implements \JsonSerializable
{
    /**
     * @SWG\Property()
     * @var int
     */
    private $power;


    public function __construct($id, $name, $price, $power)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->power = $power;
    }

    function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'power'    => $this->power,
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
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power)
    {
        $this->power = $power;
    }
}