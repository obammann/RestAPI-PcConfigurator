<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 14:39
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Database\ProcessorDatabase;
use HsBremen\WebApi\Entity\Processor;

use Symfony\Component\HttpFoundation\JsonResponse;

class ProcessorService
{
    private $database;

    public function __construct()
    {
        $this->database = new ProcessorDatabase();
    }

    /**
     * GET /processor
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList()
    {
        $listOFAllProcessors = $this->database->getProcessorDatabase();
        return new JsonResponse($listOFAllProcessors);
    }


    public function getSingleProcessor($id){

        if($this->database->readProcessor($id) !== null){
            return new JsonResponse($this->database->readProcessor($id));
        }else{
            return new JsonResponse(new Processor(0,0,0,0,0,0));
        }
    }


    public function addProcessor($processor){
        $this->database->addProcessor($processor);
    }

    public function updateProcessor($id, $name, $price, $processorSocket, $frequency, $cores){
        $this->database->updateProcessor($id, $name, $price, $processorSocket, $frequency, $cores);
    }


}