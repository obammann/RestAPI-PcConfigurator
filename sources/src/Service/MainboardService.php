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
    private $databaseSize;
    public  static $TAG = 'MainboardService';

    /**
     * MainboardService constructor.
     */
    public function __construct()
    {
        $this->database = new MainboardDatabase();
        $this->databaseSize = count($this->database->getDatabase());
    }

    /**
     * GET /mainboard
     * @return JsonResponse
     */
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
     * GET /mainboard/{id}
     * @param $id
     * @return JsonResponse
     */

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

    /**
     * POST /mainboard/{id}/{name}/{price}/{processorSocket}/{numberDDR3Slots}/{numberDDR4Slots}/{numberSataConnectors}/{numberPCIeSlots}
     * @param $id
     * @param $name
     * @param $price
     * @param $processorSocket
     * @param $numberDDR3Slots
     * @param $numberDDR4Slots
     * @param $numberSataConnectors
     * @param $numberPCIeSlots
     * @return JsonResponse
     */
    public function addMainboard($id, $name, $price, $processorSocket, $numberDDR3Slots , $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots){
        $addMainboardResponse = new AbstractResponse();
        if ($id > $this->databaseSize -1) {
            try {
                $this->database->addComponent(new Mainboard($id, $name, $price, $processorSocket, $numberDDR3Slots, $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots));
                $addedElement = $this->database->getComponent($id);
                return new JsonResponse($addedElement, 200);
            } catch (\Exception $e) {
                $addMainboardResponse->initResponse($name, $id, "addMainboard()", $e->getMessage());
                return new JsonResponse($addMainboardResponse->jsonSerialize());
            }
        }else{
            $addMainboardResponse->initResponse($name, $id, "addMainboard()", "id is already used");
            return new JsonResponse($addMainboardResponse->jsonSerialize(), 406);
        }
    }

    /**
     * PUT /mainboard/{id}/{name}/{price}/{processorSocket}/{numberDDR3Slots}/{numberDDR4Slots}/{numberSataConnectors}/{numberPCIeSlots}
     * @param $id
     * @param $name
     * @param $price
     * @param $processorSocket
     * @param $numberDDR3Slots
     * @param $numberDDR4Slots
     * @param $numberSataConnectors
     * @param $numberPCIeSlots
     * @return JsonResponse
     */
    public function updateMainboard($id, $name, $price, $processorSocket, $numberDDR3Slots , $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots){
        $updateResponse = new AbstractResponse();
        if($id < $this->databaseSize) {
            try {
                $this->database->updateComponent($id, $name, $price, $processorSocket, $numberDDR3Slots, $numberDDR4Slots, $numberSataConnectors, $numberPCIeSlots);
                $updatedElement = $this->database->getComponent($id);
                return new JsonResponse($updatedElement, 200);
            } catch (\Exception $e) {
                $updateResponse->initResponse($name, $id, "updateMainboard()", +$e->getMessage());
                return new JsonResponse($updateResponse->jsonSerialize());
            }
        }else{
            $updateResponse->initResponse($name,$id, "updateMainboard()", "Element id does not exist");
            return new JsonResponse($updateResponse->jsonSerialize(), 406);
        }
    }

    /**
     * DELETE /mainboard/{id}
     * @param $id
     * @return JsonResponse
     */
    public function deleteMainboard($id){
        $deleteResponse = new AbstractResponse();
        if ($id < $this->databaseSize) {
            try {
                $objectName = $this->database->getComponent($id)->getName();
                $this->database->deleteComponent($id);
                $deleteResponse->initResponse($objectName, $id, "deleteMainboard()", "success");
                return new JsonResponse($deleteResponse->jsonSerialize());
            } catch (\Exception $e) {
                $deleteResponse->initResponse(MainboardService::$TAG, $id, "deleteMainboard()", $e->getMessage());
                return new JsonResponse($deleteResponse->jsonSerialize());
            }
        }else{
            $deleteResponse->initResponse(MainboardService::$TAG, $id, "deleteMainboard()", "Element id does not exist");
            return new JsonResponse($deleteResponse->jsonSerialize(), 406);
        }
    }
}