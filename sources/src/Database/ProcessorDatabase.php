<?php

/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 23:26
 */

namespace HsBremen\WebApi\Database;

use HsBremen\WebApi\Entity\Processor;


class ProcessorDatabase
{

    private $processorDatabase;



    public function __construct()
    {

        $this->processorDatabase = [
            new Processor('0', 'Intel® Core i7-6700K', 339, '1151', 4000, 4),
            new Processor('1', 'Intel® Core i5-6600K', 239.90, '1151', 3500, 4),
            new Processor('2', 'Intel® Core™ i7-5820K', 384, '2011-3', 3300, 6),
            new Processor('3', 'AMD FX-8350', 167.90, 'AM3+', 400, 8),
            new Processor('4', 'Intel® Core™ i7-4790K', 334, '1150', 400, 4),
            new Processor('5', 'Intel® Core™ i5-4460', 169.90, '1150', 3200, 4),
            new Processor('6', 'Intel® Core™ i5-6500', 199.99, '1150', 3300, 4),
            new Processor('7', 'AMD FX-6300', 104.90, 'AM3+', 3500, 6),
            new Processor('8', 'Intel® Core™ i7-5930K', 629, '2011-3', 3500, 6),
            new Processor('9', 'AMD FX-8300', 384, 'AM3+', 3300, 8),
        ];

    }


    /**
     * GETTER: get the whole database
     * @return array
     */
    public function getProcessorDatabase()
    {
        return $this->processorDatabase;
    }

    /**
     * SETTER: set the database
     * @param array $processorDatabase
     */
    public function setProcessorDatabase($processorDatabase)
    {
        $this->processorDatabase = $processorDatabase;
    }

    /**
     * CREATE: add a new element into database
     * @return array
     */
    public function addProcessor($newProcessor){
        array_push($this->processorDatabase, $newProcessor);
    }

    /**
     * READ: read element by id
     * @param $id
     * @return array
     */
    public function readProcessor($id){
        return $this->processorDatabase[$id];
    }

    /**
     * UPDATE
     * @param $id
     * @param $name
     * @param $price
     * @param $processorSocket
     * @param $frequency
     * @param $cores
     */
    public function updateProcessor($id, $name, $price, $processorSocket, $frequency, $cores){

        $this->processorDatabase[$id]->setName($name);
        $this->processorDatabase[$id]->setPrice($price);
        $this->processorDatabase[$id]->setProcessorSocket($processorSocket);
        $this->processorDatabase[$id]->setFrequency($frequency);
        $this->processorDatabase[$id]->setCores($cores);
    }

    /**
     * DELETE
     * @param $id
     */
    public function deleteProcessor($id){
        unset($this->processorDatabase[$id]);
    }


}