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
        $listOFAllComputerBodies = $this->database->getDatabase();
        return new JsonResponse($listOFAllComputerBodies);
    }

    public function getSingleComputerBody($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleComputerBodyResponse = new AbstractResponse();
            $getSingleComputerBodyResponse->initResponse(ComputerBodyService::$TAG, $id, "getSingleComputerBody()", "fail: no item found");
            return new JsonResponse($getSingleComputerBodyResponse->jsonSerialize());
        }
    }

    public function addComputerBody($id, $name, $price, $formFactor){
        $addComputerBodyResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new ComputerBody($id, $name, $price, $formFactor));
            $addComputerBodyResponse->initResponse($name, $id, "addComputerBody()", "success");
            return new JsonResponse($addComputerBodyResponse->jsonSerialize());
        }catch (\Exception $e){
            $addComputerBodyResponse->initResponse($name, $id, "addComputerBody()", $e->getMessage());
            return new JsonResponse($addComputerBodyResponse->jsonSerialize());
        }
    }

    public function updateComputerBody($id, $name, $price, $formFactor){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $formFactor);
            $updateResponse->initResponse($name, $id, "updateComputerBody()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateComputerBody()", + $e->getMessage());
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteComputerBody($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ComputerBodyService::$TAG , $id, "deleteComputerBody()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ComputerBodyService::$TAG , $id, "deleteComputerBody()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }



}