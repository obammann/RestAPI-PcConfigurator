<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 22:37
 */

namespace HsBremen\WebApi\Entity;

/**
 * @SWG\Definition(@SWG\XmL(name="Component"))
 */
class Component
{
    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    protected $id;

    /**
     * @SWG\Property(example="Test")
     * @var string
     */
    protected $name;

    /**
     * @SWG\Property(format="double")
     * @var Double
     */
    protected $price;


    public function __construct($id, $name, $price)
    {

        $this->id = id;
        $this->name = name;
        $this->price = $price;
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
}