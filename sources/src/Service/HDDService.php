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
    public static $TAG = 'HDDService';

    public function __construct()
    {
        $this->database = new HDDDatabase();

    }


    /**
     * @SWG\Get(
     *     path="/hdd/getList",
     *     summary="Finds all HDDs",
     *     tags={"HDD", "List"},
     *     description="...",
     *     operationId="getHDDList",
     *     consumes={"application/json"},
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
     * @SWG\Get(
     *     path="/hdd/{id}",
     *     summary="Find HDD by ID",
     *     description="Returns a single HDD",
     *     operationId="getHDDByID",
     *     tags={"HDD"},
     *     consumes={
     *         "application/json"
     *     },
     *     produces={"application/xml", "application/json"},
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

    public function addHDD($id, $name, $price, $type, $memory){
        $addHDDResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new HDD($id, $name, $price, $type, $memory));
            $addHDDResponse->initResponse($name, $id, "addHDD()", "success");
            return new JsonResponse($addHDDResponse->jsonSerialize());
        }catch (\Exception $e){
            $addHDDResponse->initResponse($name, $id, "addHDD()", $e->getMessage());
            return new JsonResponse($addHDDResponse->jsonSerialize());
        }
    }

    public function updateHDD($id, $name, $price, $type, $memory){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $type, $memory);
            $updateResponse->initResponse($name, $id, "updateHDD()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateHDD()", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteHDD($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(HDDService::$TAG , $id, "deleteHDD", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(HDDService::$TAG , $id, "deleteHDD", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }

}