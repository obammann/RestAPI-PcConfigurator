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

    /**
     * ProcessorCoolerDatabase constructor.
     */
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

    /**
     * @return array
     */
    public function getDatabase()
    {
        return $this->processorCoolerDatabase;
    }

    /**
     * @param $database
     */
    public function setDatabase($database)
    {
       $this->processorCoolerDatabase = $database;
    }

    /**
     * @param $newComponent
     */
    public function addComponent($newComponent)
    {
        array_push($this->processorCoolerDatabase, $newComponent);
    }

    /**
     * @param $componentId
     * @return mixed
     */
    public function getComponent($componentId)
    {
        return $this->processorCoolerDatabase[$componentId];
    }

    /**
     * @param $param0
     * @param $param1
     * @param $param2
     * @param $param3
     * @param null $param4
     * @param null $param5
     * @param null $param6
     * @param null $param7
     */
    public function updateComponent($param0, $param1, $param2, $param3, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
    {
        $this->processorCoolerDatabase[$param0]->setName($param1);
        $this->processorCoolerDatabase[$param0]->setPrice($param2);
        $this->processorCoolerDatabase[$param0]->setProcessorSocket($param3);

    }

    /**
     * @param $componentId
     */
    public function deleteComponent($componentId)
    {
        unset($this->processorCoolerDatabase[$componentId]);
    }
}