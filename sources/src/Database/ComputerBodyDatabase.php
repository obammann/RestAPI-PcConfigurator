<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 16:30
 */

namespace HsBremen\WebApi\Database;
use HsBremen\WebApi\Entity\ComputerBody;


class ComputerBodyDatabase extends AbstractDatabase
{

    private $computerBodyDatabase;

    public function __construct()
    {
        $this->computerBodyDatabase= [
            new ComputerBody(0, "Fractal Design Define R5 ", 99.99,"ATX"),
            new ComputerBody(1, "Sharkoon VS4-S", 27.99,"ATX"),
            new ComputerBody(2, "Corsair Carbide 200R", 61.90,"ATX"),
            new ComputerBody(3, "MS-TECH X3 Crow", 89.99,"ATX"),
            new ComputerBody(4, "NZXT Phantom", 144.99,"E-ATX"),
            new ComputerBody(5, "Corsair SPEC-ALPHA", 79.90,"ATX"),
            new ComputerBody(6, "Zalman Z11 Plus", 59.90,"ATX"),
            new ComputerBody(7, "SilverStone SST-ML09B", 69.99,"ITX"),
            new ComputerBody(8, "Chieftec IX-04B-OP", 34.99,"ITX"),
            new ComputerBody(9, "Thermaltake Level 10 GT ", 189.90,"ATX"),
        ];
    }

    public function getDatabase()
    {
       return $this->computerBodyDatabase;
    }

    public function setDatabase($database)
    {
        $this->computerBodyDatabase = $database;
    }

    public function addComponent($newComponent)
    {
        array_push($this->computerBodyDatabase, $newComponent);
    }

    public function getComponent($componentId)
    {
        return $this->computerBodyDatabase[$componentId];
    }

    public function updateComponent($param0, $param1, $param2, $param3, $param4 = null, $param5 = null, $param6 = null, $param7= null)
    {
        $this->computerBodyDatabase[$param0]->setName($param1);
        $this->computerBodyDatabase[$param0]->setPrice($param2);
        $this->computerBodyDatabase[$param0]->setFormFactor($param3);
    }

    public function deleteComponent($componentId)
    {
        unset($this->computerBodyDatabase[$componentId]);
    }
}