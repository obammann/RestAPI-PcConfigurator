<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 22.07.16
 * Time: 14:46
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Database\GraphicCardDatabase;
use HsBremen\WebApi\Entity\GraphicCard;
use Symfony\Component\HttpFoundation\JsonResponse;

class GraphicCardService
{
    private $database;
    public  static $TAG = 'GraphicCardService';

    public function __construct()
    {
        $this->database = new GraphicCardDatabase();
    }

    public function getList()
    {
        $listOFAllGraphicCards = $this->database->getDatabase();
        return new JsonResponse($listOFAllGraphicCards);
    }


    public function getSingleGraphicCard($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleGraphicCardResponse = new AbstractResponse();
            $getSingleGraphicCardResponse->initResponse(ProcessorService::$TAG, $id, "getSingleGraphicCard", "fail: no item found");
            return new JsonResponse($getSingleGraphicCardResponse->jsonSerialize());
        }
    }


    public function addGraphicCard($id, $name, $price, $slotsOccupied, $memory){
        $addGraphicCardResponse = new AbstractResponse();
        try{
            $this->database->addComponent(new GraphicCard($id, $name, $price, $slotsOccupied, $memory));
            $addGraphicCardResponse->initResponse($name, $id, "addGraphicCard()", "success");
            return new JsonResponse($addGraphicCardResponse->jsonSerialize());
        }catch (\Exception $e){
            $addGraphicCardResponse->initResponse($name, $id, "addGraphicCard()", $e->getMessage());
            return new JsonResponse($addGraphicCardResponse->jsonSerialize());
        }
    }

    public function updateGraphicCard($id, $name, $price, $slotsOccupied, $memory){
        $updateResponse = new AbstractResponse();
        try {
            $this->database->updateComponent($id, $name, $price, $slotsOccupied, $memory);
            $updateResponse->initResponse($name, $id, "updateGraphicCard()", "success");
            return new JsonResponse($updateResponse->jsonSerialize());
        }catch (\Exception $e){
            $updateResponse->initResponse($name, $id, "updateGraphicCard()", + $e->getMessage() );
            return new JsonResponse($updateResponse->jsonSerialize());
        }
    }

    public function deleteGraphicCard($id){
        $deleteResponse = new AbstractResponse();
        try {
            $this->database->deleteComponent($id);
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteGraphicCard()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(ProcessorService::$TAG , $id, "deleteGraphicCard()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }
}