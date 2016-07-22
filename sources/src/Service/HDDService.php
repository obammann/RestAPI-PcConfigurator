<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 22.07.2016
 * Time: 14:38
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Database\HDDDatabase;
use HsBremen\WebApi\Entity\HDD;
use Symfony\Component\HttpFoundation\JsonResponse;

class HDDService
{
    private $database;
    public static $TAG = 'HDDService';

    public function __construct()
    {
        $this->database = new HDDDatabase();

    }

    public function getList()
    {
        $listOFAllProcessors = $this->database->getDatabase();
        return new JsonResponse($listOFAllProcessors);
    }

    public function getSingleHDD($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleProcessorResponse = new AbstractResponse();
            $getSingleProcessorResponse->initResponse(ProcessorService::$TAG, $id, "getSingleHDD", "fail: no item found");
            return new JsonResponse($getSingleProcessorResponse->jsonSerialize());
        }
    }

    public function addHDD($id, $name, $price, $type, $memory){
        $addProcessorResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new HDD($id, $name, $price, $type, $memory));
            $addProcessorResponse->initResponse($name, $id, "addHDD", "success");
            return new JsonResponse($addProcessorResponse->jsonSerialize());
        }catch (\Exception $e){
            $addProcessorResponse->initResponse($name, $id, "addHDD", $e->getMessage());
            return new JsonResponse($addProcessorResponse->jsonSerialize());
        }
    }

    public function updateHDD($id, $name, $price, $type, $memory){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $type, $memory);
            $updateResponse->initResponse($name, $id, "updateHDD", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateHDD", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteHDD($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteHDD", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteHDD", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }

}