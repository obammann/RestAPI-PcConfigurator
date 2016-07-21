<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 17:32
 */

namespace HsBremen\WebApi\Database;


use HsBremen\WebApi\Entity\Mainboard;

class MainboardDatabase extends AbstractDatabase
{

    private $mainboardDatabase;

    public function __construct()
    {
      //  ($id, $name, $price, $processorSocket, $numberDDR3Slots , $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots)
        $this->mainboardDatabase = [
            new Mainboard(0,"ASUS Z170",158,"1151",0,4,1,4),
            new Mainboard(1,"MSI Z170A",179.90,"1151",0,4,1,3),
            new Mainboard(2,"GIGABYTE GA-Z170-HD3P",119.90,"1151",0,4,1,2),
            new Mainboard(3,"MSI Z170A",158,"1151",0,4,1,3),
            new Mainboard(4,"ASUS SABERTOOTH Z170 S Z170",199.90,"1151",0,4,1,3),
            new Mainboard(5,"ASRock H170 PRO4S H170",89,"1151",0,4,1,2),
            new Mainboard(6,"ASUS MAXIMUS VIII",429,"1151",0,4,1,4),
            new Mainboard(7,"ASUS Z170M-PLUS",127.90,"1151",0,4,1,2),
            new Mainboard(8,"ASUS MAXIMUS VIII HERO ALPHA Z170",274,"1151",0,6,1,3),
            new Mainboard(9,"Biostar TA970",63.99,"AM3+",4,0,2,2),
        ];
    }

    public function getDatabase()
    {
        return $this->mainboardDatabase;
    }

    public function setDatabase($database)
    {
        $this->mainboardDatabase = $database;
    }

    public function addComponent($newComponent)
    {
        array_push($this->mainboardDatabase, $newComponent);
    }

    public function getComponent($componentId)
    {
        return $this->mainboardDatabase[$componentId];
    }

    public function updateComponent($param0, $param1, $param2, $param3, $param4, $param5, $param6, $param7)
    {
        $this->mainboardDatabase[$param0]->setName($param1);
        $this->mainboardDatabase[$param0]->setPrice($param2);
        $this->mainboardDatabase[$param0]->setProcessorSocket($param3);
        $this->mainboardDatabase[$param0]->setNumberDDR3Slots($param4);
        $this->mainboardDatabase[$param0]->setNumberDDR4Slots($param5);
        $this->mainboardDatabase[$param0]->setNumberSataConnectors($param6);
        $this->mainboardDatabase[$param0]->setNumberPCIeSlots($param7);
    }

    public function deleteComponent($componentId)
    {
        unset($this->mainboardDatabase[$componentId]);
    }
}