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

    protected function getDatabase()
    {
        return $this->hddDatabase;
    }

    protected function setDatabase($database)
    {
        $this->hddDatabase = $database;
    }

    protected function addComponent($newComponent)
    {
        array_push($this->hddDatabase, $newComponent);
    }

    protected function getComponent($componentId)
    {
        return $this->hddDatabase[$componentId];
    }

    protected function updateComponent($param0, $param1, $param2, $param3, $param4, $param5 = null, $param6 = null, $param7 = null)
    {
        $this->hddDatabase[$param0]->setName($param1);
        $this->hddDatabase[$param0]->setPrice($param2);
        $this->hddDatabase[$param0]->setType($param3);
        $this->hddDatabase[$param0]->setMemory($param4);
    }

    protected function deleteComponent($componentId)
    {
        unset($this->hddDatabase[$componentId]);
    }
}