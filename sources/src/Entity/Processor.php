<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 14:34
 */

namespace HsBremen\WebApi\Entity;


class Processor implements \JsonSerializable
{
    private $name;
    private $sockel;

    public function __construct($name, $sockel)
    {
        $this->name = $name;
        $this->sockel= $sockel;
    }

    function jsonSerialize()
    {
        return [
            'name'     => $this->name,
            'sockel'    => $this->sockel,
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
    public function getSockel()
    {
        return $this->sockel;
    }

    /**
     * @param mixed $sockel
     */
    public function setSockel($sockel)
    {
        $this->sockel = $sockel;
    }


}