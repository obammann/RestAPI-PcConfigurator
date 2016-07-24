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

    /**
     * HDDService constructor.
     */
    public function __construct()
    {
        $this->database = new HDDDatabase();

    }

    /**
     * GET/hdd
     * @return JsonResponse
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
    public function addHDD($id, $name, $price, $type, $memory){
        $addProcessorResponse = new AbstractResponse();
        $databaseSize = sizeof($this->database->getDatabase());
        if ($id > $databaseSize -1) {
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
    public function updateHDD($id, $name, $price, $type, $memory){
        $updateResponse = new AbstractResponse();
        $databaseSize = sizeof($this->database->getDatabase());
        if($id < $databaseSize) {
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
    public function deleteHDD($id){
        $deleteResponse = new AbstractResponse();
        $databaseSize = sizeof($this->database->getDatabase());
        if ($id < $databaseSize) {
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