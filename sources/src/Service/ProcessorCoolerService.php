<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 12.05.16
 * Time: 15:44
 */

namespace HsBremen\WebApi\Service;

use HsBremen\WebApi\Entity\ProcessorCooler;
use HsBremen\WebApi\Service\AbstractResponse;
use HsBremen\WebApi\Database\ProcessorCoolerDatabase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProcessorCoolerService
{
    private $database;
    public  static $TAG = 'ProcessorCoolerService';

    public function __construct()
    {
        $this->database = new ProcessorCoolerDatabase();

    }


    public function getList()
    {
        $listOfAllProcessorCoolers = new AbstractResponse();
        try {
            $listOfAllProcessorCoolers = $this->database->getDatabase();
            return new JsonResponse($listOfAllProcessorCoolers);
        }catch (\Exception $e){
            $listOfAllProcessorCoolers->initResponse(ProcessorCoolerService::$TAG, 0, "getList()", $e->getMessage());
            return new JsonResponse($listOfAllProcessorCoolers);
        }
    }

    public function getSingleProcessorCooler($id){
        $getSingleProcessorCoolerResponse = new AbstractResponse();
        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleProcessorCoolerResponse->initResponse(ProcessorService::$TAG, $id, "getSingleProcessorCooler", "fail: no item found");
            return new JsonResponse($getSingleProcessorCoolerResponse->jsonSerialize());
        }
    }

    public function addProcessorCooler($id, $name, $price, $processorSocket){
        $addProcessorCoolerResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new ProcessorCooler($id,$name,$price,$processorSocket ));
            $addProcessorCoolerResponse->initResponse($name, $id, "addProcessorCooler", "success");
            return new JsonResponse($addProcessorCoolerResponse->jsonSerialize());
        }catch (\Exception $e){
            $addProcessorCoolerResponse->initResponse($name, $id, "addProcessorCooler", $e->getMessage());
            return new JsonResponse($addProcessorCoolerResponse->jsonSerialize());
        }
    }

    public function updateProcessorCooler($id, $name, $price, $processorSocket){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $processorSocket);
            $updateResponse->initResponse($name, $id, "updateProcessorCooler()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateProcessorCooler()", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteProcessorCooler($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ProcessorCoolerService::$TAG , $id, "deleteProcessorCooler()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteProcessorCooler()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }

}