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

    /**
     * @SWG\Get(
     *     path="/Mainboard/getList",
     *     summary="Finds all mainboards",
     *     tags={"Mainboard", "List"},
     *     description="...",
     *     operationId="getMainboardList",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Mainboard")
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
        $listOFAllMainboards = $this->database->getDatabase();
        return new JsonResponse($listOFAllMainboards);
    }


    /**
     * @SWG\Get(
     *     path="/mainboard/{id}",
     *     summary="Find mainboard by ID",
     *     description="Returns a single mainboard",
     *     operationId="getMainboardByID",
     *     tags={"mainboard"},
     *     consumes={
     *         "application/json"
     *     },
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="ID of mainboard to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/Mainboard")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Mainboard not found"
     *     )
     * )
     */

    public function getSingleMainboard($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleMainboardResponse = new AbstractResponse();
            $getSingleMainboardResponse->initResponse(MainboardService::$TAG, $id, "getSingleMainboard()", "fail: no item found");
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

    public function updateMainboard($id, $name, $price, $processorSocket, $numberDDR3Slots , $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $processorSocket, $numberDDR3Slots , $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots);
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
            $deleteResponse->initResponse(MainboardService::$TAG , $id, "deleteMainboard()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(MainboardService::$TAG , $id, "deleteMainboard()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }
}