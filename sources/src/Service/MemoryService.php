<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 22.07.16
 * Time: 14:30
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Database\MemoryDatabase;
use HsBremen\WebApi\Entity\Memory;

class MemoryService
{
    private $database;
    public  static $TAG = 'MemoryService';

    public function __construct()
    {
        $this->database = new MemoryDatabase();
    }

    public function getList()
    {
        $listOFAllMemories = $this->database->getDatabase();
        return new JsonResponse($listOFAllMemories);
    }


    public function getSingleMemory($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleMemoryResponse = new AbstractResponse();
            $getSingleMemoryResponse->initResponse(MemoryService::$TAG, $id, "getSingleMemory", "fail: no item found");
            return new JsonResponse($getSingleMemoryResponse->jsonSerialize());
        }
    }


    public function addMemory($id, $name, $price, $type, $module, $memory){
        $addMemoryResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new Memory($id, $name, $price, $type, $module, $memory));
            $addMemoryResponse->initResponse($name, $id, "addMemory", "success");
            return new JsonResponse($addMemoryResponse->jsonSerialize());
        }catch (\Exception $e){
            $addMemoryResponse->initResponse($name, $id, "addMemory", $e->getMessage());
            return new JsonResponse($addMemoryResponse->jsonSerialize());
        }
    }

    public function updateMemory($id, $name, $price, $type, $module, $memory){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $type, $module, $memory);
            $updateResponse->initResponse($name, $id, "updateMemory()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateMemory()", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteMemory($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteMemory()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteMemory()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }
}