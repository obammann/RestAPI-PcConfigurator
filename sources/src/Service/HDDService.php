<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 22.07.2016
 * Time: 14:38
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Database\HDDDatabase;
use HsBremen\WebApi\Entity\HDD;
use Symfony\Component\HttpFoundation\JsonResponse;

class HDDService
{
    private $database;
    private $databaseSize;
    public static $TAG = 'HDDService';

    /**
     * HDDService constructor.
     */
    public function __construct()
    {
        $this->database = new HDDDatabase();
        $this->databaseSize = count($this->database->getDatabase());
    }

    /**
     * GET/hdd
     * @return JsonResponse
     */

    /**
     * @SWG\Get(
     *     path="/hdd/getList",
     *     summary="Finds all HDDs",
     *     tags={"HDD", "List"},
     *     description="...",
     *     operationId="getHDDList",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/HDD")
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
        $listOFAllHDDs = $this->database->getDatabase();
        return new JsonResponse($listOFAllHDDs);
    }

    /**
     * GET /hdd/{id}
     * @param $id
     * @return JsonResponse
     */

    /**
     * @SWG\Get(
     *     path="/hdd/{id}",
     *     summary="Find HDD by ID",
     *     description="Returns a single HDD",
     *     operationId="getHDDByID",
     *     tags={"HDD"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of HDD to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/HDD")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="HDD not found"
     *     )
     * )
     */

    public function getSingleHDD($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleHDDResponse = new AbstractResponse();
            $getSingleHDDResponse->initResponse(HDDService::$TAG, $id, "getSingleHDD()", "fail: no item found");
            return new JsonResponse($getSingleHDDResponse->jsonSerialize());
        }
    }

    /**
     * POST /hdd/{id}/{name}/{price}/{type}/{memory}
     * @param $id
     * @param $name
     * @param $price
     * @param $type
     * @param $memory
     * @return JsonResponse
     */
    /**
     * @SWG\Post(
     *     path="/hdd/{id}/{name}/{price}/{type}/{memory}",
     *     tags={"addHDD"},
     *     operationId="updateHDD",
     *     summary="add a HDD",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the HDD",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of the HDD",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="price of the HDD",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="type",
     *         in="path",
     *         description="type of the HDD",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="memory",
     *         in="path",
     *         description="memory capacity of the HDD",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addHDD($id, $name, $price, $type, $memory){
        $addProcessorResponse = new AbstractResponse();
        if ($id > $this->databaseSize -1) {
            try {
                $this->database->addComponent(new HDD($id, $name, $price, $type, $memory));
                $addedElement = $this->database->getComponent($id);
                return new JsonResponse($addedElement, 200);
            } catch (\Exception $e) {
                $addProcessorResponse->initResponse($name, $id, "addHDD", $e->getMessage());
                return new JsonResponse($addProcessorResponse->jsonSerialize());
            }
        }else{
            $addProcessorResponse->initResponse($name, $id, "addHDD", "id is already used");
            return new JsonResponse($addProcessorResponse->jsonSerialize(), 406);
        }
    }

    /**
     * PUT /hdd/{id}/{name}/{price}/{type}/{memory}
     * @param $id
     * @param $name
     * @param $price
     * @param $type
     * @param $memory
     * @return JsonResponse
     */
    /**
     * @SWG\Put(
     *     path="/hdd/{id}/{name}/{price}/{type}/{memory}",
     *     tags={"HDD"},
     *     operationId="updateHDD",
     *     summary="Update a HDD",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the HDD",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="new name of the HDD",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="new price of the HDD",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="type",
     *         in="path",
     *         description="new type of the HDD",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="memory",
     *         in="path",
     *         description="new memory capacity of the HDD",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateHDD($id, $name, $price, $type, $memory){
        $updateResponse = new AbstractResponse();
        if($id < $this->databaseSize) {
            try {
                $this->database->updateComponent($id, $name, $price, $type, $memory);
                $updatedElement = $this->database->getComponent($id);
                return new JsonResponse($updatedElement, 200);
            } catch (\Exception $e) {
                $updateResponse->initResponse($name, $id, "updateHDD", +$e->getMessage());
                return new JsonResponse($updateResponse->jsonSerialize());
            }
        }else{
            $updateResponse->initResponse($name,$id, "updateHDD", "Element id does not exist");
            return new JsonResponse($updateResponse->jsonSerialize(), 406);
        }
    }

    /**
     * DELETE /hdd/{id}
     * @param $id
     * @return JsonResponse
     */
    /**
     * @SWG\Delete(
     *     path="/hdd/{id}",
     *     summary="Deletes a hdd",
     *     description="",
     *     operationId="deleteHDD",
     *     produces={"application/json"},
     *     tags={"hdd"},
     *     @SWG\Parameter(
     *         description="hdd id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid hdd id"
     *     ),
     * )
     */
    public function deleteHDD($id){
        $deleteResponse = new AbstractResponse();
        if ($id < $this->databaseSize) {
            try {
                $objectName = $this->database->getComponent($id)->getName();
                $this->database->deleteComponent($id);
                $deleteResponse->initResponse($objectName, $id, "deleteHDD", "success");
                return new JsonResponse($deleteResponse->jsonSerialize(), 200);
            } catch (\OutOfBoundsException  $e) {
                $deleteResponse->initResponse(ProcessorService::$TAG, $id, "deleteHDD", $e->getMessage());
                return new JsonResponse($deleteResponse->jsonSerialize(), 406);
            }
        }else{
            $deleteResponse->initResponse(ProcessorService::$TAG, $id, "deleteHDD", "Element id does not exist");
            return new JsonResponse($deleteResponse->jsonSerialize(), 406);
        }
    }

}