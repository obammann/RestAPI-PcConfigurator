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
    public static $TAG = 'ProcessorService';

    /**
     * ProcessorService constructor.
     */
    public function __construct()
    {
        $this->database = new ProcessorDatabase();
    }

    /**
     * GET /processor
     * @return JsonResponse
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
    public function addProcessor($id, $name, $price, $processorSocket, $frequency, $cores){
        $addProcessorResponse = new AbstractResponse();
        $databaseSize = sizeof($this->database->getDatabase());
        if ($id > $databaseSize -1) {
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
    public function updateProcessor($id, $name, $price, $processorSocket, $frequency, $cores){
        $updateResponse = new AbstractResponse();
        $databaseSize = sizeof($this->database->getDatabase());
        if($id < $databaseSize) {
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
    public function deleteProcessor($id){
        $deleteResponse = new AbstractResponse();
        $databaseSize = sizeof($this->database->getDatabase());
        if ($id < $databaseSize) {
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