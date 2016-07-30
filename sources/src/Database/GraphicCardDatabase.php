<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 16:48
 */

namespace HsBremen\WebApi\Database;

use HsBremen\WebApi\Entity\GraphicCard;

class GraphicCardDatabase extends AbstractDatabase
{
    private $graphicCardDatabase;

    /**
     * GraphicCardDatabase constructor.
     */
    public function __construct()
    {
        $this->graphicCardDatabase = [
        new GraphicCard(0,"GeForce GTX 1070 G1", 499, 2, 8),
        new GraphicCard(1,"GeForce GTX 1070 Gaming X 8G", 529, 2, 8),
        new GraphicCard(2,"GeForce GTX 1080 G1", 799, 2, 8),
        new GraphicCard(3,"Sapphire Radeon RX 480", 269, 2, 8),
        new GraphicCard(4,"GeForce 4GB GTX 960", 220, 2, 4),
        new GraphicCard(5,"GeForce MATRIX-GTX980TI", 499, 2, 6),
        new GraphicCard(6,"Gainward GTX750 Ti", 117, 2, 2),
        new GraphicCard(7,"GeForce GTX 1060 ", 329, 2, 6),
        new GraphicCard(8,"GeForce STRIX-GTX960-", 212, 4, 2),
        new GraphicCard(9,"XFX HD5450 ", 29, 2, 1),
        ];
    }

    /**
     * @return array
     */
    public function getDatabase()
    {
        return $this->graphicCardDatabase;
    }

    /**
     * @param $database
     */
    public function setDatabase($database)
    {
       $this->graphicCardDatabase = $database;
    }

    /**
     * @param $newComponent
     */
    public function addComponent($newComponent)
    {
        array_push($this->graphicCardDatabase, $newComponent);
    }

    /**
     * @param $componentId
     * @return mixed
     */
    public function getComponent($componentId)
    {
        return $this->graphicCardDatabase[$componentId];
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
        $this->graphicCardDatabase[$param0]->setName($param1);
        $this->graphicCardDatabase[$param0]->setPrice($param2);
        $this->graphicCardDatabase[$param0]->setSlotsOccupied($param3);
        $this->graphicCardDatabase[$param0]->setMemory($param4);
    }

    /**
     * @param $componentId
     */
    public function deleteComponent($componentId)
    {
        unset($this->graphicCardDatabase[$componentId]);
    }
}