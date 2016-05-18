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
use Symfony\Component\HttpFoundation\Response;

class ProcessorService
{
    private $database;

    public function __construct()
    {
        $this->database = new ProcessorDatabase();

//        $this->updateProcessor(1,2,3,4,5,6);
//        $this->deleteProcessor(9);
//
//        $trash = new Processor(10, 'name', 123, '1155', 2.4, 8);
//        $this->addProcessor($trash);
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
        return new JsonResponse(new Processor($id,$name,$price,$processorSocket,$frequency,$cores));
    }

    public function deleteProcessor($id){
        $deletedProcessor = $this->database->readProcessor($id);
        $this->database->deleteProcessor($id);
        return new JsonResponse($deletedProcessor);
    }


}