<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 22:37
 */

namespace HsBremen\WebApi\Entity;


class Component
{
    protected $id;
    protected $name;
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
    protected function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    protected function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    protected function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    protected function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    protected function setPrice($price)
    {
        $this->price = $price;
    }
}