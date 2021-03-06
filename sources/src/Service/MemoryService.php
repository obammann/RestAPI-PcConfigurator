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
use Symfony\Component\HttpFoundation\JsonResponse;

class MemoryService
{
    private $database;
    private $databaseSize;
    public  static $TAG = 'MemoryService';

    /**
     * MemoryService constructor.
     */
    public function __construct()
    {
        $this->database = new MemoryDatabase();
        $this->databaseSize = count($this->database->getDatabase());
    }

    /**
     * GET /memory
     * @return JsonResponse
     */
    /**
     * @SWG\Get(
     *     path="/memory/getList",
     *     summary="Finds all memories",
     *     tags={"Memory", "List"},
     *     description="...",
     *     operationId="getMemoryList",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Memory")
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
        $listOFAllMemories = $this->database->getDatabase();
        return new JsonResponse($listOFAllMemories);
    }


    /**
     * GET /memory/{id}
     * @param $id
     * @return JsonResponse
     */
    /**
     * @SWG\Get(
     *     path="/memory/{id}",
     *     summary="Find Memory by ID",
     *     description="Returns a single memory",
     *     operationId="getMemoryByID",
     *     tags={"memory"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of memory to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/Memory")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Memory not found"
     *     )
     * )
     */

    public function getSingleMemory($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleMemoryResponse = new AbstractResponse();
            $getSingleMemoryResponse->initResponse(MemoryService::$TAG, $id, "getSingleMemory()", "fail: no item found");
            return new JsonResponse($getSingleMemoryResponse->jsonSerialize());
        }
    }

    /**
     * POST /memory/{id}/{name}/{price}/{type}/{module}/{memory}
     * @param $id
     * @param $name
     * @param $price
     * @param $type
     * @param $module
     * @param $memory
     * @return JsonResponse
     */
    /**
     * PUT /memory/{id}/{name}/{price}/{type}/{module}/{memory}
     * @param $id
     * @param $name
     * @param $price
     * @param $type
     * @param $module
     * @param $memory
     * @return JsonResponse
     */
    /**
     * @SWG\Post(
     *     path="/memory/{id}/{name}/{price}/{type}/{module}/{memory}",
     *     tags={"memory"},
     *     operationId="addMemory",
     *     summary="Add a memory unit",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the memory unit",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of the memory unit",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="price of the memory unit",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="type",
     *         in="path",
     *         description="type of the memory unit",
     *         required=true,
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *         name="module",
     *         in="path",
     *         description="number of memory modules per unit",
     *         required=true,
     *         type="integer"
     *     ),
     *      @SWG\Parameter(
     *         name="memory",
     *         in="path",
     *         description="memory capacity of the memory unit",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addMemory($id, $name, $price, $type, $module, $memory){
        $addMemoryResponse = new AbstractResponse();
        if ($id > $this->databaseSize -1) {
            try {
                $this->database->addComponent(new Memory($id, $name, $price, $type, $module, $memory));
                $addedElement = $this->database->getComponent($id);
                return new JsonResponse($addedElement, 200);
            } catch (\Exception $e) {
                $addMemoryResponse->initResponse($name, $id, "addMemory()", $e->getMessage());
                return new JsonResponse($addMemoryResponse->jsonSerialize());
            }
        }else{
            $addMemoryResponse->initResponse($name, $id, "addMemory()", "id is already used");
            return new JsonResponse($addMemoryResponse->jsonSerialize(), 406);
        }
    }

    /**
     * PUT /memory/{id}/{name}/{price}/{type}/{module}/{memory}
     * @param $id
     * @param $name
     * @param $price
     * @param $type
     * @param $module
     * @param $memory
     * @return JsonResponse
     */
    /**
     * @SWG\Put(
     *     path="/memory/{id}/{name}/{price}/{type}/{module}/{memory}",
     *     tags={"memory"},
     *     operationId="updateMemory",
     *     summary="Update a memory unit",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the memory unit",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="new name of the memory unit",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="new price of the memory unit",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="type",
     *         in="path",
     *         description="new type of the memory unit",
     *         required=true,
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *         name="module",
     *         in="path",
     *         description="new number of memory modules per unit",
     *         required=true,
     *         type="integer"
     *     ),
     *      @SWG\Parameter(
     *         name="memory",
     *         in="path",
     *         description="new memory capacity of the memory unit",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateMemory($id, $name, $price, $type, $module, $memory){
        $updateResponse = new AbstractResponse();
        if($id < $this->databaseSize) {
            try {
                $this->database->updateComponent($id, $name, $price, $type, $module, $memory);
                $updatedElement = $this->database->getComponent($id);
                return new JsonResponse($updatedElement, 200);
            } catch (\Exception $e) {
                $updateResponse->initResponse($name, $id, "updateMemory()", +$e->getMessage());
                return new JsonResponse($updateResponse->jsonSerialize());
            }
        }else{
            $updateResponse->initResponse($name,$id, "updateMemory()", "Element id does not exist");
            return new JsonResponse($updateResponse->jsonSerialize(), 406);
        }
    }

    /**
     * DELETE /memory/{id}
     * @param $id
     * @return JsonResponse
     */
    /**
     * @SWG\Delete(
     *     path="/memory/{id}",
     *     summary="Deletes a memory",
     *     description="",
     *     operationId="deleteMemory",
     *     produces={"application/json"},
     *     tags={"memory"},
     *     @SWG\Parameter(
     *         description="memory id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid memory id"
     *     ),
     * )
     */
    public function deleteMemory($id){
        $deleteResponse = new AbstractResponse();
        if ($id < $this->databaseSize) {
            try {
                $objectName = $this->database->getComponent($id)->getName();
                $this->database->deleteComponent($id);
                $deleteResponse->initResponse($objectName, $id, "deleteMemory()", "success");
                return new JsonResponse($deleteResponse->jsonSerialize());
            } catch (\Exception $e) {
                $deleteResponse->initResponse(MemoryService::$TAG, $id, "deleteMemory()", $e->getMessage());
                return new JsonResponse($deleteResponse->jsonSerialize());
            }
        }else{
            $deleteResponse->initResponse(MemoryService::$TAG, $id, "deleteMemory()", "Element id does not exist");
            return new JsonResponse($deleteResponse->jsonSerialize(), 406);
        }
    }
}