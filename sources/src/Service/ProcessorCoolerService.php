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