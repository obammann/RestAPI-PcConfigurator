<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 22.07.16
 * Time: 11:20
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Entity\PowerSupply;
use HsBremen\WebApi\Service\AbstractResponse;
use HsBremen\WebApi\Database\PowerSupplyDatabase;
use Symfony\Component\HttpFoundation\JsonResponse;

class PowerSupplyService
{
    private $database;
    public  static $TAG = 'PowerSupplyService';

    public function __construct()
    {
        $this->database = new PowerSupplyDatabase();

    }

    public function getList()
    {
        $listOfAllPowerSupplies = new AbstractResponse();
        try {
            $listOfAllPowerSupplies = $this->database->getDatabase();
            return new JsonResponse($listOfAllPowerSupplies);
        }catch (\Exception $e){
            $listOfAllPowerSupplies->initResponse(PowerSupplyService::TAG, 0, "getList()", $e->getMessage());
            return new JsonResponse($listOfAllPowerSupplies);
        }
    }

    public function getSinglePowerSupply($id){
        $getSinglePowerSupplyResponse = new AbstractResponse();
        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSinglePowerSupplyResponse->initResponse(PowerSupplyService::$TAG, $id, "getSinglePowerSupply", "fail: no item found");
            return new JsonResponse($getSinglePowerSupplyResponse->jsonSerialize());
        }
    }

    public function addPowerSupply($id, $name, $price, $power){
        $addPowerSupplyResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new PowerSupply($id, $name, $price, $power));
            $addPowerSupplyResponse->initResponse($name, $id, "addPowerSupply", "success");
            return new JsonResponse($addPowerSupplyResponse->jsonSerialize());
        }catch (\Exception $e){
            $addPowerSupplyResponse->initResponse($name, $id, "addPowerSupply", $e->getMessage());
            return new JsonResponse($addPowerSupplyResponse->jsonSerialize());
        }
    }

    public function updatePowerSupply($id, $name, $price, $power){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $power);
            $updateResponse->initResponse($name, $id, "updatePowerSupply()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updatePowerSupply()", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deletePowerSupply($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(PowerSupplyService::$TAG , $id, "deletePowerSupply()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(PowerSupplyService::$TAG , $id, "deletePowerSupply()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }

}