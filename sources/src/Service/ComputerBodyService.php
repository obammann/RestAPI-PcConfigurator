<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 22.07.2016
 * Time: 15:01
 */

namespace HsBremen\WebApi\Service;

use HsBremen\WebApi\Database\ComputerBodyDatabase;
use HsBremen\WebApi\Entity\ComputerBody;
use Symfony\Component\HttpFoundation\JsonResponse;

class ComputerBodyService
{
    private $database;
    public static $TAG = 'ComputerBodyService';

    public function __construct()
    {
        $this->database = new ComputerBodyDatabase();
    }

    public function getList()
    {
        $listOFAllProcessors = $this->database->getDatabase();
        return new JsonResponse($listOFAllProcessors);
    }

    public function getSingleComputerBody($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleProcessorResponse = new AbstractResponse();
            $getSingleProcessorResponse->initResponse(ProcessorService::$TAG, $id, "getSingleComputerBody", "fail: no item found");
            return new JsonResponse($getSingleProcessorResponse->jsonSerialize());
        }
    }

    public function addComputerBody($id, $name, $price, $formFactor){
        $addProcessorResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new ComputerBody($id, $name, $price, $formFactor));
            $addProcessorResponse->initResponse($name, $id, "addComputerBody", "success");
            return new JsonResponse($addProcessorResponse->jsonSerialize());
        }catch (\Exception $e){
            $addProcessorResponse->initResponse($name, $id, "addComputerBody", $e->getMessage());
            return new JsonResponse($addProcessorResponse->jsonSerialize());
        }
    }

    public function updateComputerBody($id, $name, $price, $formFactor){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $formFactor);
            $updateResponse->initResponse($name, $id, "updateComputerBody", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateComputerBody", + $e->getMessage());
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteComputerBody($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteComputerBody", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteComputerBody", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }



}