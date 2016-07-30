<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 17:06
 */

namespace HsBremen\WebApi\Database;


use HsBremen\WebApi\Entity\HDD;

class HDDDatabase extends AbstractDatabase
{

    private $hddDatabase;

    /**
     * HDDDatabase constructor.
     */
    public function __construct()
    {
        $this->hddDatabase = [
            new HDD(0,"Seagate ST4000NM0023", 232.90, "sas", 4),
            new HDD(1,"HGST HUH728080AL5200", 494, "sas", 8),
            new HDD(2,"HGST HUS726050AL5210", 304, "sas", 5),
            new HDD(3,"Samsung MZ-75E250B ", 92.90, "ssd", 0.25),
            new HDD(4,"Seagate ST4000NM0023", 232.90, "ssd", 4),
            new HDD(5,"Mushkin Reactor", 264, "ssd", 1),
            new HDD(6,"Seagate ST1000DM003", 64.90, "sata", 1),
            new HDD(7,"Western Digital WD30EFRX", 112.90, "sata", 3),
            new HDD(8,"Toshiba DT01ACA100", 45.90, "sata", 1),
            new HDD(9,"Samsung MZ-75E1T0B", 304, "ssd", 1),
        ];
    }

    /**
     * @return array
     */
    public function getDatabase()
    {
        return $this->hddDatabase;
    }

    /**
     * @param $database
     */
    public function setDatabase($database)
    {
        $this->hddDatabase = $database;
    }

    /**
     * @param $newComponent
     */
    public function addComponent($newComponent)
    {
        array_push($this->hddDatabase, $newComponent);
    }

    /**
     * @param $componentId
     * @return mixed
     */
    public function getComponent($componentId)
    {
        return $this->hddDatabase[$componentId];
    }

    /**
     * @param $param0
     * @param $param1
     * @param $param2
     * @param $param3
     * @param $param4
     * @param null $param5
     * @param null $param6
     * @param null $param7
     */
    public function updateComponent($param0, $param1, $param2, $param3, $param4, $param5 = null, $param6 = null, $param7 = null)
    {
        $this->hddDatabase[$param0]->setName($param1);
        $this->hddDatabase[$param0]->setPrice($param2);
        $this->hddDatabase[$param0]->setType($param3);
        $this->hddDatabase[$param0]->setMemory($param4);
    }

    /**
     * @param $componentId
     */
    public function deleteComponent($componentId)
    {
        unset($this->hddDatabase[$componentId]);
    }
}