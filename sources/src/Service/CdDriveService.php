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

    public function getList()
    {
        $listOFAllCdDrives = $this->database->getDatabase();
        return new JsonResponse($listOFAllCdDrives);
    }


    public function getSingleCdDrive($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleCdDriveResponse = new AbstractResponse();
            $getSingleCdDriveResponse->initResponse(ProcessorService::$TAG, $id, "getSingleCdDrive()", "fail: no item found");
            return new JsonResponse($getSingleCdDriveResponse->jsonSerialize());
        }
    }


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

    public function deleteCdDrive($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteCdDrive()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteCdDrive()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }
}