<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 15:58
 */

namespace HsBremen\WebApi\Database;

use HsBremen\WebApi\Entity\CdDrive;


class CdDriveDatabase extends AbstractDatabase
{

    private $cdDriveDatabase;

    /**
     * CdDriveDatabase constructor.
     */
    public function __construct()
    {
        $this->cdDriveDatabase= [
            new CdDrive(0,"LG BH16NS55",69.90, 12, 16, true , true ),
            new CdDrive(1,"ASUS BW-16D1HT ",79.90, 12, 16, true , true ),
            new CdDrive(2,"LG BP55EB40",89.90, 6, 8, true , true ),
            new CdDrive(3,"Pioneer BDR-209EBK",69.90, 12, 16, true , true ),
            new CdDrive(4,"ASUS BW-16D1H-U Pro",149.90, 12, 16, true , true ),
            new CdDrive(5,"LG GH24NSD1,",14.99, 16, 24, true , false ),
            new CdDrive(6,"LG CH12NS40",54.90, 12, 16, true , false ),
            new CdDrive(7,"Samsung SH",15.97, 16, 14, true , false ),
            new CdDrive(8,"Pioneer DVR-221BK",18.99, 16, 0, false , false ),
            new CdDrive(9,"Teac DV-W5600S-300",31.90, 48, 0, false , false ),
        ];
    }

    /**
     * @return array
     */
    public function getDatabase()
    {
        return $this->cdDriveDatabase;
    }

    /**
     * @param $database
     */
    public function setDatabase($database)
    {
        $this->cdDriveDatabase = $database;
    }

    /**
     * @param $newComponent
     */
    public function addComponent($newComponent)
    {
        array_push($this->cdDriveDatabase, $newComponent);
    }

    /**
     * @param $componentId
     * @return mixed
     */
    public function getComponent($componentId)
    {
        return $this->cdDriveDatabase[$componentId];
    }

    /**
     * @param $param0
     * @param $param1
     * @param $param2
     * @param $param3
     * @param $param4
     * @param $param5
     * @param $param6
     * @param null $param7
     */
    public function updateComponent($param0, $param1, $param2, $param3, $param4, $param5, $param6, $param7=null)
    {
        $this->cdDriveDatabase[$param0]->setName($param1);
        $this->cdDriveDatabase[$param0]->setPrice($param2);
        $this->cdDriveDatabase[$param0]->setReadingTime($param3);
        $this->cdDriveDatabase[$param0]->setWritingTime($param4);
        $this->cdDriveDatabase[$param0]->setIsWritable($param5);
        $this->cdDriveDatabase[$param0]->setIsBluRay($param6);
    }

    /**
     * @param $componentId
     */
    public function deleteComponent($componentId)
    {
        unset($this->cdDriveDatabase[$componentId]);
    }
}


