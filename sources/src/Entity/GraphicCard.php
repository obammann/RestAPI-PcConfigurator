<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 12.05.16
 * Time: 14:04
 */

namespace HsBremen\WebApi\Entity;

/**
 * @SWG\Definition(required={"name"}, @SWG\XmL(name="GraphicCard"))
 */
class GraphicCard extends Component implements \JsonSerializable
{
    /**
     * @SWG\Property()
     * @var int
     */
    private $slotsOccupied;
    /**
     * @SWG\Property()
     * @var int
     */
    private $memory;


    /**
     * GraphicCard constructor.
     * @param $id
     * @param $name
     * @param $price
     * @param $slotsOccupied
     * @param $memory
     */
    public function __construct($id, $name, $price, $slotsOccupied, $memory)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->slotsOccupied = $slotsOccupied;
        $this->memory = $memory;
    }

    function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'occupied slots'    => $this->slotsOccupied,
            'memory'    => $this->memory,
        ];
    }

    /**
     * @return mixed
     */
    public function getSlotsOccupied()
    {
        return $this->slotsOccupied;
    }

    /**
     * @param mixed $slotsOccupied
     */
    public function setSlotsOccupied($slotsOccupied)
    {
        $this->slotsOccupied = $slotsOccupied;
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