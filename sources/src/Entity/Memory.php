<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 12.05.16
 * Time: 13:52
 */

namespace HsBremen\WebApi\Entity;

/**
 * @SWG\Definition(required={"name"}, @SWG\XmL(name="Memory"))
 */
class Memory extends Component implements \JsonSerializable
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
    private $module;
    /**
     * @SWG\Property()
     * @var int
     */
    private $memory;


    /**
     * Memory constructor.
     * @param $id
     * @param $name
     * @param $price
     * @param $type
     * @param $module
     * @param $memory
     */
    public function __construct($id, $name, $price, $type, $module, $memory)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->module = $module;
        $this->memory = $memory;
    }


    function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'type'    => $this->type,
            'module'    => $this->module,
            'memory'    => $this->memory,
        ];
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
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module)
    {
        $this->module = $module;
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