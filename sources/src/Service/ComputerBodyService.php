<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 22.07.2016
 * Time: 15:01
 */

namespace HsBremen\WebApi\Service;

use HsBremen\WebApi\Database\ComputerBodyDatabase;
use HsBremen\WebApi\Entity\ComputerBody;
use Symfony\Component\HttpFoundation\JsonResponse;

class ComputerBodyService
{
    private $database;
    public static $TAG = 'ComputerBodyService';

    public function __construct()
    {
        $this->database = new ComputerBodyDatabase();
    }


    /**
     * @SWG\Get(
     *     path="/computerbody/getList",
     *     summary="Finds all computer bodies",
     *     tags={"computer body", "List"},
     *     description="...",
     *     operationId="getComputerBodyList",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ComputerBody")
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
        $listOFAllComputerBodies = $this->database->getDatabase();
        return new JsonResponse($listOFAllComputerBodies);
    }


    /**
     * @SWG\Get(
     *     path="/computerbody/{id}",
     *     summary="Find computer body by ID",
     *     description="Returns a single computer body",
     *     operationId="getComputerBodyByID",
     *     tags={"computer body"},
     *     consumes={
     *         "application/json"
     *     },
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="ID of computer body to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/ComputerBody")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Computer body not found"
     *     )
     * )
     */

    public function getSingleComputerBody($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleComputerBodyResponse = new AbstractResponse();
            $getSingleComputerBodyResponse->initResponse(ComputerBodyService::$TAG, $id, "getSingleComputerBody()", "fail: no item found");
            return new JsonResponse($getSingleComputerBodyResponse->jsonSerialize());
        }
    }

    public function addComputerBody($id, $name, $price, $formFactor){
        $addComputerBodyResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new ComputerBody($id, $name, $price, $formFactor));
            $addComputerBodyResponse->initResponse($name, $id, "addComputerBody()", "success");
            return new JsonResponse($addComputerBodyResponse->jsonSerialize());
        }catch (\Exception $e){
            $addComputerBodyResponse->initResponse($name, $id, "addComputerBody()", $e->getMessage());
            return new JsonResponse($addComputerBodyResponse->jsonSerialize());
        }
    }

    public function updateComputerBody($id, $name, $price, $formFactor){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $formFactor);
            $updateResponse->initResponse($name, $id, "updateComputerBody()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateComputerBody()", + $e->getMessage());
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteComputerBody($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ComputerBodyService::$TAG , $id, "deleteComputerBody()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ComputerBodyService::$TAG , $id, "deleteComputerBody()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }



}