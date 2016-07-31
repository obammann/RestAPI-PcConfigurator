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
    private $databaseSize;
    public  static $TAG = 'ProcessorCoolerService';

    /**
     * ProcessorCoolerService constructor.
     */
    public function __construct()
    {
        $this->database = new ProcessorCoolerDatabase();
        $this->databaseSize = count($this->database->getDatabase());
    }

    /**
     * GET /processorcooler
     * @return JsonResponse
     */

    /**
     * @SWG\Get(
     *     path="/processorcooler/getList",
     *     summary="Finds all processor coolers",
     *     tags={"processor cooler", "List"},
     *     description="...",
     *     operationId="getProcessorCoolerList",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ProcessorCooler")
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
        $listOfAllProcessorCoolers = new AbstractResponse();
        try {
            $listOfAllProcessorCoolers = $this->database->getDatabase();
            return new JsonResponse($listOfAllProcessorCoolers);
        }catch (\Exception $e){
            $listOfAllProcessorCoolers->initResponse(ProcessorCoolerService::$TAG, 0, "getList()", $e->getMessage());
            return new JsonResponse($listOfAllProcessorCoolers);
        }
    }

    /**
     * GET /processorcooler/{id}
     * @param $id
     * @return JsonResponse
     */
    /**
     * @SWG\Get(
     *     path="/processorcooler/{id}",
     *     summary="Find processor cooler by ID",
     *     description="Returns a single processor cooler",
     *     operationId="getProcessorCoolerByID",
     *     tags={"processor cooler"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of processor cooler to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/ProcessorCooler")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Processor not found"
     *     )
     * )
     */

    public function getSingleProcessorCooler($id){
        $getSingleProcessorCoolerResponse = new AbstractResponse();
        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleProcessorCoolerResponse->initResponse(ProcessorCoolerService::$TAG, $id, "getSingleProcessorCooler()", "fail: no item found");
            return new JsonResponse($getSingleProcessorCoolerResponse->jsonSerialize());
        }
    }

    /**
     * POST /processorcooler/{id}/{name}/{price}/{processorSocket}
     * @param $id
     * @param $name
     * @param $price
     * @param $processorSocket
     * @return JsonResponse
     */
    /**
     * @SWG\Post(
     *     path="/processorcooler/{id}/{name}/{price}/{processorSocket}",
     *     tags={"processor cooler"},
     *     operationId="update processor cooler",
     *     summary="Add a new processor cooler",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the processor cooler",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of the processor cooler",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="price of the processor cooler",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="processorSocket",
     *         in="path",
     *         description="processor socket compatible with the cooler",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addProcessorCooler($id, $name, $price, $processorSocket){
        $addProcessorResponse = new AbstractResponse();
        if ($id > $this->databaseSize -1) {
            try {
                $this->database->addComponent(new ProcessorCooler($id, $name, $price, $processorSocket));
                $addedElement = $this->database->getComponent($id);
                return new JsonResponse($addedElement, 200);
            } catch (\Exception $e) {
                $addProcessorResponse->initResponse($name, $id, "addProcessorCooler", $e->getMessage());
                return new JsonResponse($addProcessorResponse->jsonSerialize());
            }
        }else{
            $addProcessorResponse->initResponse($name, $id, "addProcessorCooler", "id is already used");
            return new JsonResponse($addProcessorResponse->jsonSerialize(), 406);
        }
    }

    /**
     * PUT /processorcooler/{id}/{name}/{price}/{processorSocket}
     * @param $id
     * @param $name
     * @param $price
     * @param $processorSocket
     * @return JsonResponse
     */
    /**
     * @SWG\Put(
     *     path="/cddrive/{id}/{name}/{price}/{processorSocket}",
     *     tags={"processor cooler"},
     *     operationId="update processor cooler",
     *     summary="Add a new processor cooler",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the processor socket",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="new name of the processor cooler",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="new price of the processor cooler",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="processorSocket",
     *         in="path",
     *         description="new processor socket compatible with the cooler",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateProcessorCooler($id, $name, $price, $processorSocket){
        $updateResponse = new AbstractResponse();
        if($id < $this->databaseSize) {
            try {
                $this->database->updateComponent($id, $name, $price, $processorSocket);
                $updatedElement = $this->database->getComponent($id);
                return new JsonResponse($updatedElement, 200);
            } catch (\Exception $e) {
                $updateResponse->initResponse($name, $id, "updateProcessorCooler", +$e->getMessage());
                return new JsonResponse($updateResponse->jsonSerialize());
            }
        }else{
            $updateResponse->initResponse($name,$id, "updateProcessorCooler", "Element id does not exist");
            return new JsonResponse($updateResponse->jsonSerialize(), 406);
        }
    }

    /**
     * DELETE /processorcooler/{id}
     * @param $id
     * @return JsonResponse
     */
    /**
     * @SWG\Delete(
     *     path="/processorcooler/{id}",
     *     summary="Deletes a processor cooler",
     *     description="",
     *     operationId="deleteProcessorCooler",
     *     consumes={"application/json", "multipart/form-data", "application/x-www-form-urlencoded"},
     *     produces={"application/json"},
     *     tags={"processor cooler"},
     *     @SWG\Parameter(
     *         description="processor cooler id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid processor cooler id"
     *     ),
     * )
     */
    public function deleteProcessorCooler($id){
        $deleteResponse = new AbstractResponse();
        if ($id < $this->databaseSize) {
            try {
                $objectName = $this->database->getComponent($id)->getName();
                $this->database->deleteComponent($id);
                $deleteResponse->initResponse($objectName, $id, "deleteProcessorCooler", "success");
                return new JsonResponse($deleteResponse->jsonSerialize(), 200);
            } catch (\OutOfBoundsException  $e) {
                $deleteResponse->initResponse(ProcessorService::$TAG, $id, "deleteProcessor", $e->getMessage());
                return new JsonResponse($deleteResponse->jsonSerialize(), 406);
            }
        }else{
            $deleteResponse->initResponse(ProcessorCoolerService::$TAG, $id, "deleteProcessorCooler", "Element id does not exist");
            return new JsonResponse($deleteResponse->jsonSerialize(), 406);
        }
    }


}