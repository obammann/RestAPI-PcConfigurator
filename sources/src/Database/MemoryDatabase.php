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

    protected function getDatabase()
    {
        return $this->memoryDatabase;
    }

    protected function setDatabase($database)
    {
        $this->memoryDatabase = $database;
    }

    protected function addComponent($newComponent)
    {
        array_push($this->memoryDatabase, $newComponent);
    }

    protected function getComponent($componentId)
    {
        return $this->memoryDatabase[$componentId];
    }

    protected function updateComponent($param0, $param1, $param2, $param3, $param4, $param5, $param6 = null, $param7 = null)
    {
        $this->memoryDatabase[$param0]->setName($param1);
        $this->memoryDatabase[$param0]->setPrice($param2);
        $this->memoryDatabase[$param0]->setType($param3);
        $this->memoryDatabase[$param0]->setModule($param4);
        $this->memoryDatabase[$param0]->setMemory($param5);
    }

    protected function deleteComponent($componentId)
    {
        unset($this->memoryDatabase[$componentId]);
    }
}