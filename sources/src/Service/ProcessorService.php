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
    public  static $TAG = 'ProcessorService';

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
        $listOFAllProcessors = $this->database->getDatabase();
        return new JsonResponse($listOFAllProcessors);
    }


    public function getSingleProcessor($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleProcessorResponse = new AbstractResponse();
            $getSingleProcessorResponse->initResponse(ProcessorService::$TAG, $id, "getSingleProcessor", "fail: no item found");
            return new JsonResponse($getSingleProcessorResponse->jsonSerialize());
        }
    }


    public function addProcessor($id, $name, $price, $processorSocket, $frequency, $cores){
        $addProcessorResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new Processor($id,$name, $price, $processorSocket, $frequency, $cores ));
            $addProcessorResponse->initResponse($name, $id, "addProcessor", "success");
            return new JsonResponse($addProcessorResponse->jsonSerialize());
        }catch (\Exception $e){
            $addProcessorResponse->initResponse($name, $id, "addProcessor", $e->getMessage());
            return new JsonResponse($addProcessorResponse->jsonSerialize());
        }
    }

    public function updateProcessor($id, $name, $price, $processorSocket, $frequency, $cores){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $processorSocket, $frequency, $cores);
            $updateResponse->initResponse($name, $id, "updateProcessor()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateProcessor()", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteProcessor($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteProcessor()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteProcessor()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }


}