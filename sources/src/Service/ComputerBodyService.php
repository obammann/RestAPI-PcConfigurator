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

    /**
     * ComputerBodyService constructor.
     */
    public function __construct()
    {
        $this->database = new ComputerBodyDatabase();
    }

    /**
     * GET /computerbody
     * @return JsonResponse
     */
    public function getList()
    {
        $listOFAllComputerBodies = $this->database->getDatabase();
        return new JsonResponse($listOFAllComputerBodies);
    }

    /**
     * GET /computerbody/{id}
     * @param $id
     * @return JsonResponse
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

    /**
     * POST /computerbody/{id}/{name}/{price}/{formFactor}
     * @param $id
     * @param $name
     * @param $price
     * @param $formFactor
     * @return JsonResponse
     */
    public function addComputerBody($id, $name, $price, $formFactor){
        $addProcessorResponse = new AbstractResponse();
        $databaseSize = sizeof($this->database->getDatabase());
        if ($id > $databaseSize -1) {
            try {
                $this->database->addComponent(new ComputerBody($id, $name, $price, $formFactor));
                $addedElement = $this->database->getComponent($id);
                return new JsonResponse($addedElement, 200);
            } catch (\Exception $e) {
                $addProcessorResponse->initResponse($name, $id, "addComputerBody", $e->getMessage());
                return new JsonResponse($addProcessorResponse->jsonSerialize());
            }
        }else{
            $addProcessorResponse->initResponse($name, $id, "addComputerBody", "id is already used");
            return new JsonResponse($addProcessorResponse->jsonSerialize(), 406);
        }
    }

    /**
     * PUT /computerbody/{id}/{name}/{price}/{formFactor}
     * @param $id
     * @param $name
     * @param $price
     * @param $formFactor
     * @return JsonResponse
     */
    public function updateComputerBody($id, $name, $price, $formFactor){
        $updateResponse = new AbstractResponse();
        $databaseSize = sizeof($this->database->getDatabase());
        if($id < $databaseSize) {
            try {
                $this->database->updateComponent($id, $name, $price, $formFactor);
                $updatedElement = $this->database->getComponent($id);
                return new JsonResponse($updatedElement, 200);
            } catch (\Exception $e) {
                $updateResponse->initResponse($name, $id, "updateComputerBody", +$e->getMessage());
                return new JsonResponse($updateResponse->jsonSerialize());
            }
        }else{
            $updateResponse->initResponse($name,$id, "updateComputerBody", "Element id does not exist");
            return new JsonResponse($updateResponse->jsonSerialize(), 406);
        }
    }

    /**
     * DELETE /computerbody/{id}
     * @param $id
     * @return JsonResponse
     */
    public function deleteComputerBody($id){
        $deleteResponse = new AbstractResponse();
        $databaseSize = sizeof($this->database->getDatabase());
        if ($id < $databaseSize) {
            try {
                $objectName = $this->database->getComponent($id)->getName();
                $this->database->deleteComponent($id);
                $deleteResponse->initResponse($objectName, $id, "deleteComputerBody", "success");
                return new JsonResponse($deleteResponse->jsonSerialize(), 200);
            } catch (\OutOfBoundsException  $e) {
                $deleteResponse->initResponse(ProcessorService::$TAG, $id, "deleteComputerBody", $e->getMessage());
                return new JsonResponse($deleteResponse->jsonSerialize(), 406);
            }
        }else{
            $deleteResponse->initResponse(ProcessorService::$TAG, $id, "deleteComputerBody", "Element id does not exist");
            return new JsonResponse($deleteResponse->jsonSerialize(), 406);
        }
    }



}