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
    private $databaseSize;
    public  static $TAG = 'PowerSupplyService';

    /**
     * PowerSupplyService constructor.
     */
    public function __construct()
    {
        $this->database = new PowerSupplyDatabase();
        $this->databaseSize = count($this->database->getDatabase());

    }

    /**
     * GET /powersupply
     * @return JsonResponse
     */
    /**
     * @SWG\Get(
     *     path="/powersupply/getList",
     *     summary="Finds all power supplies",
     *     tags={"power supply", "List"},
     *     description="...",
     *     operationId="getPowerSupplyList",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/PowerSupply")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid tag value",
     *     )
     * )
     */
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

    /**
     * GET /powersupply/{id}
     * @param $id
     * @return JsonResponse
     */
    /**
     * @SWG\Get(
     *     path="/powersupply/{id}",
     *     summary="Find power supply by ID",
     *     description="Returns a single power supply",
     *     operationId="getPowerSupplyByID",
     *     tags={"power supply"},
     *     consumes={
     *         "application/json"
     *     },
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="ID of power supply to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/PowerSupply")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Power supply not found"
     *     )
     * )
     */
    public function getSinglePowerSupply($id){
        $getSinglePowerSupplyResponse = new AbstractResponse();
        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSinglePowerSupplyResponse->initResponse(PowerSupplyService::$TAG, $id, "getSinglePowerSupply()", "fail: no item found");
            return new JsonResponse($getSinglePowerSupplyResponse->jsonSerialize());
        }
    }

    /**
     * POST /powersupply/{id}/{name}/{price}/{power}
     * @param $id
     * @param $name
     * @param $price
     * @param $power
     * @return JsonResponse
     */
    /**
     * @SWG\Post(
     *     path="/powersupply/{id}/{name}/{price}/{power}",
     *     tags={"power supply"},
     *     operationId="addPowerSupply",
     *     summary="Add a new power supply",
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the power supply",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of the power supply",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="price of the power supply",
     *         required=true,
     *         type="number"
     *     ),
     *     @SWG\Parameter(
     *         name="power",
     *         in="path",
     *         description="power of the power supply",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addPowerSupply($id, $name, $price, $power){
        $addPowerSupplyResponse = new AbstractResponse();
        if ($id > $this->databaseSize -1) {
            try {
                $this->database->addComponent(new PowerSupply($id, $name, $price, $power));
                $addedElement = $this->database->getComponent($id);
                $addPowerSupplyResponse->initResponse($name, $id, "addPowerSupply()", "success");
                return new JsonResponse($addedElement, 200);
            } catch (\Exception $e) {
                $addPowerSupplyResponse->initResponse($name, $id, "addPowerSupply()", $e->getMessage());
                return new JsonResponse($addPowerSupplyResponse->jsonSerialize());
            }
        }else{
            $addPowerSupplyResponse->initResponse($name, $id, "addPowerSupply()", "id is already used");
            return new JsonResponse($addPowerSupplyResponse->jsonSerialize(), 406);
        }
    }

    /**
     * PUT /powersupply/{id}/{name}/{price}/{power}
     * @param $id
     * @param $name
     * @param $price
     * @param $power
     * @return JsonResponse
     */
    /**
     * @SWG\Put(
     *     path="/powersupply/{id}/{name}/{price}/{power}",
     *     tags={"power supply"},
     *     operationId="updatePowerSupply",
     *     summary="update a power supply",
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the power supply",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="new name of the power supply",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="new price of the power supply",
     *         required=true,
     *         type="number"
     *     ),
     *     @SWG\Parameter(
     *         name="power",
     *         in="path",
     *         description="new power of the power supply",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updatePowerSupply($id, $name, $price, $power){
        $updateResponse = new AbstractResponse();
        if($id < $this->databaseSize) {
            try {
                $this->database->updateComponent($id, $name, $price, $power);
                $updatedElement = $this->database->getComponent($id);
                return new JsonResponse($updatedElement, 200);
            } catch (\Exception $e) {
                $updateResponse->initResponse($name, $id, "updatePowerSupply()", +$e->getMessage());
                return new JsonResponse($updateResponse->jsonSerialize());
            }
        }else{
            $updateResponse->initResponse($name,$id, "updatePowerSupply()", "Element id does not exist");
            return new JsonResponse($updateResponse->jsonSerialize(), 406);
        }
    }

    /**
     * DELETE /powersupply/{id}
     * @param $id
     * @return JsonResponse
     */
    /**
     * @SWG\Delete(
     *     path="/powersupply/{id}",
     *     summary="Deletes a power supply",
     *     description="",
     *     operationId="deletePowerSupply",
     *     consumes={"application/json", "multipart/form-data", "application/x-www-form-urlencoded"},
     *     produces={"application/json"},
     *     tags={"power supply"},
     *     @SWG\Parameter(
     *         description="power supply id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid power supply id"
     *     ),
     * )
     */
    public function deletePowerSupply($id){
        $deleteResponse = new AbstractResponse();
        if ($id < $this->databaseSize) {
            try {
                $objectName = $this->database->getComponent($id)->getName();
                $this->database->deleteComponent($id);
                $deleteResponse->initResponse($objectName, $id, "deletePowerSupply()", "success");
                return new JsonResponse($deleteResponse->jsonSerialize());
            } catch (\Exception $e) {
                $deleteResponse->initResponse(PowerSupplyService::$TAG, $id, "deletePowerSupply()", $e->getMessage());
                return new JsonResponse($deleteResponse->jsonSerialize());
            }
        }else{
            $deleteResponse->initResponse(PowerSupplyService::$TAG, $id, "deletePowerSupply()", "Element id does not exist");
            return new JsonResponse($deleteResponse->jsonSerialize(), 406);
        }
    }

}