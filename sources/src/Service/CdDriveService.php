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
    private $databaseSize;
    public  static $TAG = 'CdDriveService';

    /**
     * CdDriveService constructor.
     */
    public function __construct()
    {
        $this->database = new CdDriveDatabase();
        $this->databaseSize = count($this->database->getDatabase());
    }

    /**
     * GET /cddrive
     * @return JsonResponse
     */
    public function getList()
    {
        $listOFAllCdDrives = $this->database->getDatabase();
        return new JsonResponse($listOFAllCdDrives);
    }

    /**
     * GET /cddrive/{id}
     * @param $id
     * @return JsonResponse
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
     * POST /cddrive/{id}/{name}/{price}/{readingTime}/{writingTime}/{isWritable}/{isBluRay}
     * @param $id
     * @param $name
     * @param $price
     * @param $readingTime
     * @param $writingTime
     * @param $isWritable
     * @param $isBluRay
     * @return JsonResponse
     */
    public function addCdDrive($id, $name, $price, $readingTime, $writingTime, $isWritable, $isBluRay){
        $addCdDriveResponse = new AbstractResponse();
        if ($id > $this->databaseSize -1) {
            try {
                $this->database->addComponent(new CdDrive($id, $name, $price, $readingTime, $writingTime, $isWritable, $isBluRay));
                $addedElement = $this->database->getComponent($id);
                return new JsonResponse($addedElement, 200);
            } catch (\Exception $e) {
                $addCdDriveResponse->initResponse($name, $id, "addCdDrive()", $e->getMessage());
                return new JsonResponse($addCdDriveResponse->jsonSerialize());
            }
        }else{
            $addCdDriveResponse->initResponse($name, $id, "addCdDrive()", "id is already used");
            return new JsonResponse($addCdDriveResponse->jsonSerialize(), 406);
        }
    }

    /**
     * PUT /cddrive/{id}/{name}/{price}/{readingTime}/{writingTime}/{isWritable}/{isBluRay}
     * @param $id
     * @param $name
     * @param $price
     * @param $readingTime
     * @param $writingTime
     * @param $isWritable
     * @param $isBluRay
     * @return JsonResponse
     */
    public function updateCdDrive($id, $name, $price, $readingTime, $writingTime, $isWritable, $isBluRay){
        $updateResponse = new AbstractResponse();
        if($id < $this->databaseSize) {
            try {
                $this->database->updateComponent($id, $name, $price, $readingTime, $writingTime, $isWritable, $isBluRay);
                $updatedElement = $this->database->getComponent($id);
                return new JsonResponse($updatedElement, 200);
            } catch (\Exception $e) {
                $updateResponse->initResponse($name, $id, "updateCdDrive()", +$e->getMessage());
                return new JsonResponse($updateResponse->jsonSerialize());
            }
        }else{
            $updateResponse->initResponse($name,$id, "updateCdDrive()", "Element id does not exist");
            return new JsonResponse($updateResponse->jsonSerialize(), 406);
        }
    }

    /**
     * DELETE /cddrive/{id}
     * @param $id
     * @return JsonResponse
     */
    public function deleteCdDrive($id){
        $deleteResponse = new AbstractResponse();
        if ($id < $this->databaseSize) {
            try {
                $objectName = $this->database->getComponent($id)->getName();
                $this->database->deleteComponent($id);
                $deleteResponse->initResponse($objectName, $id, "deleteCdDrive()", "success");
                return new JsonResponse($deleteResponse->jsonSerialize());
            } catch (\Exception $e) {
                $deleteResponse->initResponse(CdDriveService::$TAG, $id, "deleteCdDrive()", $e->getMessage());
                return new JsonResponse($deleteResponse->jsonSerialize());
            }
        }else{
            $deleteResponse->initResponse(CdDriveService::$TAG, $id, "deleteCdDrive()", "Element id does not exist");
            return new JsonResponse($deleteResponse->jsonSerialize(), 406);
        }
    }
}