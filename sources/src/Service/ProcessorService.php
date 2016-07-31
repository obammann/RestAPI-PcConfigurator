<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 14:39
 */

namespace HsBremen\WebApi\Service;

use HsBremen\WebApi\Database\ProcessorDatabase;
use HsBremen\WebApi\Entity\Processor;
use Symfony\Component\HttpFoundation\JsonResponse;


class ProcessorService
{
    private $database;
    private $databaseSize;
    public static $TAG = 'ProcessorService';

    /**
     * ProcessorService constructor.
     */
    public function __construct()
    {
        $this->database = new ProcessorDatabase();
        $this->databaseSize = count($this->database->getDatabase());
    }

    /**
     * GET /processor
     * @return JsonResponse
     */
    /**
     * @SWG\Get(
     *     path="/processor/getList",
     *     summary="Finds all processors",
     *     tags={"Processor", "List"},
     *     description="...",
     *     operationId="getProcessorList",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Processor")
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
        $listOFAllProcessors = $this->database->getDatabase();
        return new JsonResponse($listOFAllProcessors);
    }


    /**
     * GET /processor/{id}
     * @param $id
     * @return JsonResponse
     */
    /**
     * @SWG\Get(
     *     path="/processor/{id}",
     *     summary="Find processor by ID",
     *     description="Returns a single processor",
     *     operationId="getProcessorByID",
     *     tags={"processor"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="ID of processor to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/Processor")
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
    public function getSingleProcessor($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleProcessorResponse = new AbstractResponse();
            $getSingleProcessorResponse->initResponse(ProcessorService::$TAG, $id, "getSingleProcessor", "fail: no item found");
            return new JsonResponse($getSingleProcessorResponse->jsonSerialize());
        }
    }

    /**
     * POST /processor/{id}/{name}/{price}/{processorSocket}/{frequency}/{cores}
     * @param $id
     * @param $name
     * @param $price
     * @param $processorSocket
     * @param $frequency
     * @param $cores
     * @return JsonResponse
     */
    /**
     * @SWG\Post(
     *     path="/processor/{id}/{name}/{price}/{processorSocket}/{frequency}/{cores}",
     *     tags={"processor"},
     *     operationId="addCdDrive",
     *     summary="Add a new processor",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the processor",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of the processor",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="price of the processor",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="processorSocket",
     *         in="path",
     *         description="socket of the processor",
     *         required=true,
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *         name="frequency",
     *         in="path",
     *         description="frequency of the processor",
     *         required=true,
     *         type="integer"
     *     ),
     *      @SWG\Parameter(
     *         name="cores",
     *         in="path",
     *         description="number of cores of the processor",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */

    public function addProcessor($id, $name, $price, $processorSocket, $frequency, $cores){
        $addProcessorResponse = new AbstractResponse();
        if ($id > $this->databaseSize -1) {
            try {
                $this->database->addComponent(new Processor($id, $name, $price, $processorSocket, $frequency, $cores));
                $addedElement = $this->database->getComponent($id);
                return new JsonResponse($addedElement, 200);
            } catch (\Exception $e) {
                $addProcessorResponse->initResponse($name, $id, "addProcessor", $e->getMessage());
                return new JsonResponse($addProcessorResponse->jsonSerialize());
            }
        }else{
            $addProcessorResponse->initResponse($name, $id, "addProcessor", "id is already used");
            return new JsonResponse($addProcessorResponse->jsonSerialize(), 406);
        }
    }

    /**
     * PUT /processor/{id}/{name}/{price}/{processorSocket}/{frequency}/{cores}
     * @param $id
     * @param $name
     * @param $price
     * @param $processorSocket
     * @param $frequency
     * @param $cores
     * @return JsonResponse
     */
    /**
     * @SWG\Put(
     *     path="/processor/{id}/{name}/{price}/{processorSocket}/{frequency}/{cores}",
     *     tags={"processor"},
     *     operationId="updateProcessor",
     *     summary="Update a processor",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the processor",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of the processor",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="price of the processor",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="processorSocket",
     *         in="path",
     *         description="socket of the processor",
     *         required=true,
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *         name="frequency",
     *         in="path",
     *         description="frequency of the processor",
     *         required=true,
     *         type="integer"
     *     ),
     *      @SWG\Parameter(
     *         name="cores",
     *         in="path",
     *         description="number of cores of the processor",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateProcessor($id, $name, $price, $processorSocket, $frequency, $cores){
        $updateResponse = new AbstractResponse();
        if($id < $this->databaseSize) {
            try {
                $this->database->updateComponent($id, $name, $price, $processorSocket, $frequency, $cores);
                $updatedElement = $this->database->getComponent($id);
                return new JsonResponse($updatedElement, 200);
            } catch (\Exception $e) {
                $updateResponse->initResponse($name, $id, "updateProcessor", +$e->getMessage());
                return new JsonResponse($updateResponse->jsonSerialize());
            }
        }else{
            $updateResponse->initResponse($name,$id, "updateProcessor", "Element id does not exist");
            return new JsonResponse($updateResponse->jsonSerialize(), 406);
        }
    }

    /**
     * DELETE /processor/{id}
     * @param $id
     * @return JsonResponse
     */
    /**
     * @SWG\Delete(
     *     path="/processor/{id}",
     *     summary="Deletes a processor",
     *     description="",
     *     operationId="deleteCdDrive",
     *     produces={"application/json"},
     *     tags={"processor"},
     *     @SWG\Parameter(
     *         description="processor id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid processor id"
     *     ),
     * )
     */
    public function deleteProcessor($id){
        $deleteResponse = new AbstractResponse();
        if ($id < $this->databaseSize) {
            try {
                $objectName = $this->database->getComponent($id)->getName();
                $this->database->deleteComponent($id);
                $deleteResponse->initResponse($objectName, $id, "deleteProcessor", "success");
                return new JsonResponse($deleteResponse->jsonSerialize(), 200);
            } catch (\OutOfBoundsException  $e) {
                $deleteResponse->initResponse(ProcessorService::$TAG, $id, "deleteProcessor", $e->getMessage());
                return new JsonResponse($deleteResponse->jsonSerialize(), 406);
            }
        }else{
            $deleteResponse->initResponse(ProcessorService::$TAG, $id, "deleteProcessor", "Element id does not exist");
            return new JsonResponse($deleteResponse->jsonSerialize(), 406);
        }
    }
}