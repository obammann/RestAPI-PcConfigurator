<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 22.07.16
 * Time: 14:45
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Database\MainboardDatabase;
use HsBremen\WebApi\Entity\Mainboard;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainboardService
{
    private $database;
    public  static $TAG = 'MainboardService';

    public function __construct()
    {
        $this->database = new MainboardDatabase();
    }

    public function getList()
    {
        $listOFAllMainboards = $this->database->getDatabase();
        return new JsonResponse($listOFAllMainboards);
    }


    public function getSingleMainboard($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleMainboardResponse = new AbstractResponse();
            $getSingleMainboardResponse->initResponse(ProcessorService::$TAG, $id, "getSingleMainboard()", "fail: no item found");
            return new JsonResponse($getSingleMainboardResponse->jsonSerialize());
        }
    }


    public function addMainboard($id, $name, $price, $processorSocket, $numberDDR3Slots , $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots){
        $addMainboardResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new Mainboard($id, $name, $price, $processorSocket, $numberDDR3Slots , $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots));
            $addMainboardResponse->initResponse($name, $id, "addMainboard()", "success");
            return new JsonResponse($addMainboardResponse->jsonSerialize());
        }catch (\Exception $e){
            $addMainboardResponse->initResponse($name, $id, "addMainboard()", $e->getMessage());
            return new JsonResponse($addMainboardResponse->jsonSerialize());
        }
    }

    public function updateMainboard($id, $name, $price, $processorSocket, $frequency, $cores){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $processorSocket, $frequency, $cores);
            $updateResponse->initResponse($name, $id, "updateMainboard()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateMainboard()", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteMainboard($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteMainboard()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteMainboard()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }
}