<?php

/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 23:26
 */

namespace HsBremen\WebApi\Database;

use HsBremen\WebApi\Entity\Processor;


class ProcessorDatabase extends AbstractDatabase
{

    private $processorDatabase;

    public function __construct()
    {
        $this->processorDatabase = [
            new Processor(0, 'Intel Core i7-6700K', 339, '1151', 4000, 4),
            new Processor(1, 'Intel Core i5-6600K', 239.90, '1151', 3500, 4),
            new Processor(2, 'Intel Core i7-5820K', 384, '2011-3', 3300, 6),
            new Processor(3, 'AMD FX-8350', 167.90, 'AM3+', 400, 8),
            new Processor(4, 'Intel Core i7-4790K', 334, '1150', 400, 4),
            new Processor(5, 'Intel Core i5-4460', 169.90, '1150', 3200, 4),
            new Processor(6, 'Intel Core i5-6500', 199.99, '1150', 3300, 4),
            new Processor(7, 'AMD FX-6300', 104.90, 'AM3+', 3500, 6),
            new Processor(8, 'Intel Core i7-5930K', 629, '2011-3', 3500, 6),
            new Processor(9, 'AMD FX-8300', 384, 'AM3+', 3300, 8),
        ];
    }

    public function getDatabase()
    {
        return $this->processorDatabase;
    }

    public function setDatabase($database)
    {
        $this->processorDatabase = $database;
    }

    public function addComponent($newComponent)
    {
        array_push($this->processorDatabase, $newComponent);
    }

    public function getComponent($componentId)
    {
        return $this->processorDatabase[$componentId];
    }

    public function updateComponent($param0, $param1, $param2, $param3, $param4, $param5 , $param6= null, $param7 = null)
    {
        $this->processorDatabase[$param0]->setName($param1);
        $this->processorDatabase[$param0]->setPrice($param2);
        $this->processorDatabase[$param0]->setProcessorSocket($param3);
        $this->processorDatabase[$param0]->setFrequency($param4);
        $this->processorDatabase[$param0]->setCores($param5);
    }

    public function deleteComponent($componentId)
    {
        unset($this->processorDatabase[$componentId]);
    }
}