<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 17:54
 */

namespace HsBremen\WebApi\Database;


use HsBremen\WebApi\Entity\Memory;

class MemoryDatabase extends AbstractDatabase
{

    private $memoryDatabase;

    /**
     * MemoryDatabase constructor.
     */
    public function __construct()
    {
       // ($id, $name, $price, $type, $module, $memory)
        $this->memoryDatabase = [
            new Memory(0,"Kingston HyperX DIMM", 76, "ddr4", 2, 16),
            new Memory(1,"Corsair DIMM", 94.90, "ddr4", 2, 16),
            new Memory(2,"G.Skill DIMM", 37.90, "ddr3", 2, 8),
            new Memory(3,"G.Skill DIMM", 155.99, "ddr4", 4, 32),
            new Memory(4,"Kingston HyperX DIMM", 304, "ddr4", 4, 64),
            new Memory(5,"Crucial DIMM", 18.98, "ddr3", 1, 4),
            new Memory(6,"Kingston HyperX SO-DIMM", 159, "ddr4", 2, 32),
            new Memory(7,"Patriot DIMM", 19.99, "ddr3", 1, 8),
            new Memory(8,"Mushkin DIMM", 20.79, "ddr4", 1, 4),
            new Memory(9,"Corsair DIMM", 359, "ddr4", 8, 64),

        ];
    }

    /**
     * @return array
     */
    public function getDatabase()
    {
        return $this->memoryDatabase;
    }

    /**
     * @param $database
     */
    public function setDatabase($database)
    {
        $this->memoryDatabase = $database;
    }

    /**
     * @param $newComponent
     */
    public function addComponent($newComponent)
    {
        array_push($this->memoryDatabase, $newComponent);
    }

    /**
     * @param $componentId
     * @return mixed
     */
    public function getComponent($componentId)
    {
        return $this->memoryDatabase[$componentId];
    }

    /**
     * @param $param0
     * @param $param1
     * @param $param2
     * @param $param3
     * @param $param4
     * @param $param5
     * @param null $param6
     * @param null $param7
     */
    public function updateComponent($param0, $param1, $param2, $param3, $param4, $param5, $param6 = null, $param7 = null)
    {
        $this->memoryDatabase[$param0]->setName($param1);
        $this->memoryDatabase[$param0]->setPrice($param2);
        $this->memoryDatabase[$param0]->setType($param3);
        $this->memoryDatabase[$param0]->setModule($param4);
        $this->memoryDatabase[$param0]->setMemory($param5);
    }

    /**
     * @param $componentId
     */
    public function deleteComponent($componentId)
    {
        unset($this->memoryDatabase[$componentId]);
    }
}