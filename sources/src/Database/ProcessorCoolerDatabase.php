<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 18:26
 */

namespace HsBremen\WebApi\Database;


use HsBremen\WebApi\Entity\ProcessorCooler;

class ProcessorCoolerDatabase extends AbstractDatabase
{

    private $processorCoolerDatabase;

    public function __construct()
    {
        $this->processorCoolerDatabase = [
            new ProcessorCooler(0,"be quiet! Dark Rock 3", 59,"1155"),
            new ProcessorCooler(1,"Alpenföhn Brocken Eco", 32.99,"1155"),
            new ProcessorCooler(2,"Scythe Mugen 4", 44.99,"1155"),
            new ProcessorCooler(3,"Noctua NH-D15", 89.99,"1155"),
            new ProcessorCooler(4,"Thermaltake Water 3.0 Riing RGB 240", 139.90,"1155"),
            new ProcessorCooler(5,"Corsair Cooling Hydro Series H115i", 144.90,"1155"),
            new ProcessorCooler(6,"LEPA Aquachanger 12", 59.90,"1155"),
            new ProcessorCooler(7,"be quiet! Shadow Rock Slim", 42.99,"1155"),
            new ProcessorCooler(8,"Alpenfoehn Atlas", 25.90,"1155"),
            new ProcessorCooler(9,"Scythe Fuma SCFM-1000", 45.99,"1155"),
        ];
    }

    public function getDatabase()
    {
        return $this->processorCoolerDatabase;
    }

    public function setDatabase($database)
    {
       $this->processorCoolerDatabase = $database;
    }

    public function addComponent($newComponent)
    {
        array_push($this->processorCoolerDatabase, $newComponent);
    }

    public function getComponent($componentId)
    {
        return $this->processorCoolerDatabase[$componentId];
    }

    public function updateComponent($param0, $param1, $param2, $param3, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
    {
        $this->processorCoolerDatabase[$param0]->setName($param1);
        $this->processorCoolerDatabase[$param0]->setPrice($param2);
        $this->processorCoolerDatabase[$param0]->setProcessorSocket($param3);

    }

    public function deleteComponent($componentId)
    {
        unset($this->processorCoolerDatabase[$componentId]);
    }
}