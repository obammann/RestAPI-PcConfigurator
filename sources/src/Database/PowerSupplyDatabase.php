<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 18:12
 */

namespace HsBremen\WebApi\Database;


use HsBremen\WebApi\Entity\PowerSupply;

class PowerSupplyDatabase extends AbstractDatabase
{

    private $powerSupplyDatabase;

    /**
     * PowerSupplyDatabase constructor.
     */
    public function __construct()
    {
        $this->powerSupplyDatabase = [
            new PowerSupply(0, "be quiet! PURE POWER 9" ,79, 600),
            new PowerSupply(1, "Thermaltake Berlin" ,59.99, 630),
            new PowerSupply(2, "Aerocool Xpredator Modular" ,69.90, 750),
            new PowerSupply(3, "Corsair VENGEANCE " ,69.90, 650),
            new PowerSupply(4, "Xilence Performance" ,45, 700),
            new PowerSupply(5, "Enermax Revolution" ,99.99, 650),
            new PowerSupply(6, "Antec HCP-1000 Platinum" ,229.99, 1000),
            new PowerSupply(7, "bXilence Performance" ,46.99, 530),
            new PowerSupply(8, "Sharkoon WPM500" ,53.90, 500),
            new PowerSupply(9, "Seasonic Snow Silent" ,264, 1050),
        ];
    }

    /**
     * @return array
     */
    public function getDatabase()
    {
        return $this->powerSupplyDatabase;
    }

    /**
     * @param $database
     */
    public function setDatabase($database)
    {
        $this->powerSupplyDatabase = $database;
    }

    /**
     * @param $newComponent
     */
    public function addComponent($newComponent)
    {
        array_push($this->powerSupplyDatabase, $newComponent);
    }

    public function getComponent($componentId)
    {
        return $this->powerSupplyDatabase[$componentId];
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
        $this->powerSupplyDatabase[$param0]->setName($param1);
        $this->powerSupplyDatabase[$param0]->setPrice($param2);
        $this->powerSupplyDatabase[$param0]->setPower($param3);
    }

    /**
     * @param $componentId
     */
    public function deleteComponent($componentId)
    {
        unset($this->powerSupplyDatabase[$componentId]);
    }
}