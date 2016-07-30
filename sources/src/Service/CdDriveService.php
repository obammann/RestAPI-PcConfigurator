<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 22.07.16
 * Time: 14:46
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Database\CdDriveDatabase;
use HsBremen\WebApi\Entity\CdDrive;
use Symfony\Component\HttpFoundation\JsonResponse;

class CdDriveService
{
    private $database;
    public  static $TAG = 'CdDriveService';

    public function __construct()
    {
        $this->database = new CdDriveDatabase();
    }

    /**
     * @SWG\Get(
     *     path="/cddrive/getList",
     *     summary="Finds all cd drives",
     *     tags={"cd drive", "List"},
     *     description="...",
     *     operationId="getCdDriveList",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CdDrive")
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
        $listOFAllCdDrives = $this->database->getDatabase();
        return new JsonResponse($listOFAllCdDrives);
    }

    /**
     * @SWG\Get(
     *     path="/cddrive/{id}",
     *     summary="Find cd drive by ID",
     *     description="Returns a single cd drive",
     *     operationId="getCdDriveByID",
     *     tags={"cd drive"},
     *     consumes={
     *         "application/json"
     *     },
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="ID of cd drive to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/CdDrive")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Cd drive not found"
     *     )
     * )
     */

    public function getSingleCdDrive($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleCdDriveResponse = new AbstractResponse();
            $getSingleCdDriveResponse->initResponse(CdDriveService::$TAG, $id, "getSingleCdDrive()", "fail: no item found");
            return new JsonResponse($getSingleCdDriveResponse->jsonSerialize());
        }
    }

    /**
     * @SWG\Post(
     *     path="/cddrive/{id}/{name}/{price}/{readingTime}/{writingTime}/{isWritable}/{isBluRay}",
     *     tags={"cd drive"},
     *     operationId="addCdDrive",
     *     summary="Add a new cd drive",
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the cd drive",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of the cd drive",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="prive of the cd drive",
     *         required=true,
     *         type="number"
     *     ),
     *     @SWG\Parameter(
     *         name="readingTime",
     *         in="path",
     *         description="reading time of the cd drive",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="writingTime",
     *         in="path",
     *         description="writing time of the cd drive",
     *         required=true,
     *         type="integer"
     *     ),
     *      @SWG\Parameter(
     *         name="isWritable",
     *         in="path",
     *         description="defines if the cd drive is writable",
     *         required=true,
     *         type="boolean"
     *     ),
     *      @SWG\Parameter(
     *         name="isBluRay",
     *         in="path",
     *         description="defines if the cd drive is blu ray compatible",
     *         required=true,
     *         type="boolean"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */

    public function addCdDrive($id, $name, $price, $readingTime, $writingTime, $isWritable, $isBluRay){
        $addCdDriveResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new CdDrive($id, $name, $price, $readingTime, $writingTime, $isWritable, $isBluRay));
            $addCdDriveResponse->initResponse($name, $id, "addCdDrive()", "success");
            return new JsonResponse($addCdDriveResponse->jsonSerialize());
        }catch (\Exception $e){
            $addCdDriveResponse->initResponse($name, $id, "addCdDrive()", $e->getMessage());
            return new JsonResponse($addCdDriveResponse->jsonSerialize());
        }
    }

    /**
     * @SWG\Put(
     *     path="/cddrive/{id}/{name}/{price}/{readingTime}/{writingTime}/{isWritable}/{isBluRay}",
     *     tags={"cd drive"},
     *     operationId="updateCdDrive",
     *     summary="Update a cd drive",
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="new id of the cd drive",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="new name of the cd drive",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="new price of the cd drive",
     *         required=true,
     *         type="number"
     *     ),
     *     @SWG\Parameter(
     *         name="readingTime",
     *         in="path",
     *         description="new reading time of the cd drive",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="writingTime",
     *         in="path",
     *         description="new writing time of the cd drive",
     *         required=true,
     *         type="integer"
     *     ),
     *      @SWG\Parameter(
     *         name="isWritable",
     *         in="path",
     *         description="defines if the cd drive is writable",
     *         required=true,
     *         type="boolean"
     *     ),
     *      @SWG\Parameter(
     *         name="isBluRay",
     *         in="path",
     *         description="defines if the cd drive is blu ray compatible",
     *         required=true,
     *         type="boolean"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateCdDrive($id, $name, $price, $readingTime, $writingTime, $isWritable, $isBluRay){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $readingTime, $writingTime, $isWritable, $isBluRay);
            $updateResponse->initResponse($name, $id, "updateCdDrive()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateCdDrive()", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    /**
     * @SWG\Delete(
     *     path="/cddrive/{id}",
     *     summary="Deletes a cd drive",
     *     description="",
     *     operationId="deleteCdDrive",
     *     consumes={"application/json", "multipart/form-data", "application/x-www-form-urlencoded"},
     *     produces={"application/json"},
     *     tags={"cd drive"},
     *     @SWG\Parameter(
     *         description="cd drive id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid pet value"
     *     ),
     * )
     */

    public function deleteCdDrive($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(CdDriveService::$TAG , $id, "deleteCdDrive()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(CdDriveService::$TAG , $id, "deleteCdDrive()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }
}