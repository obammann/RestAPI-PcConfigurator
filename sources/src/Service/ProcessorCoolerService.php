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
    public  static $TAG = 'ProcessorCoolerService';

    public function __construct()
    {
        $this->database = new ProcessorCoolerDatabase();

    }


    /**
     * @SWG\Get(
     *     path="/processorcooler/getList",
     *     summary="Finds all processor coolers",
     *     tags={"processor cooler", "List"},
     *     description="...",
     *     operationId="getProcessorCoolerList",
     *     consumes={"application/json"},
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
     * @SWG\Get(
     *     path="/processorcooler/{id}",
     *     summary="Find processor cooler by ID",
     *     description="Returns a single processor cooler",
     *     operationId="getProcessorCoolerByID",
     *     tags={"processor cooler"},
     *     consumes={
     *         "application/json",
     *         "application/x-www-form-urlencoded"
     *     },
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

    public function addProcessorCooler($id, $name, $price, $processorSocket){
        $addProcessorCoolerResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new ProcessorCooler($id,$name,$price,$processorSocket ));
            $addProcessorCoolerResponse->initResponse($name, $id, "addProcessorCooler()", "success");
            return new JsonResponse($addProcessorCoolerResponse->jsonSerialize());
        }catch (\Exception $e){
            $addProcessorCoolerResponse->initResponse($name, $id, "addProcessorCooler()", $e->getMessage());
            return new JsonResponse($addProcessorCoolerResponse->jsonSerialize());
        }
    }

    public function updateProcessorCooler($id, $name, $price, $processorSocket){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $processorSocket);
            $updateResponse->initResponse($name, $id, "updateProcessorCooler()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateProcessorCooler()", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteProcessorCooler($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ProcessorCoolerService::$TAG , $id, "deleteProcessorCooler()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ProcessorCoolerService::$TAG , $id, "deleteProcessorCooler()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }

}