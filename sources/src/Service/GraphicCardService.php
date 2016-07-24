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
    private $databaseSize;
    public  static $TAG = 'GraphicCardService';

    /**
     * GraphicCardService constructor.
     */
    public function __construct()
    {
        $this->database = new GraphicCardDatabase();
        $this->databaseSize = count($this->database->getDatabase());
    }

    /**
     * GET /graphiccard
     * @return JsonResponse
     */
    public function getList()
    {
        $listOFAllGraphicCards = $this->database->getDatabase();
        return new JsonResponse($listOFAllGraphicCards);
    }

    /**
     * GET /graphiccard/{id}
     * @param $id
     * @return JsonResponse
     */
    public function getSingleGraphicCard($id){

        if($this->database->getComponent($id) !== null){
            return new JsonResponse($this->database->getComponent($id));
        }else{
            $getSingleGraphicCardResponse = new AbstractResponse();
            $getSingleGraphicCardResponse->initResponse(GraphicCardService::$TAG, $id, "getSingleGraphicCard()", "fail: no item found");
            return new JsonResponse($getSingleGraphicCardResponse->jsonSerialize());
        }
    }

    /**
     * POST /graphiccard/{id}/{name}/{price}/{slotsOccupied}/{memory}
     * @param $id
     * @param $name
     * @param $price
     * @param $slotsOccupied
     * @param $memory
     * @return JsonResponse
     */
    public function addGraphicCard($id, $name, $price, $slotsOccupied, $memory){
        $addGraphicCardResponse = new AbstractResponse();
        if ($id > $this->databaseSize -1) {
            try {
                $this->database->addComponent(new GraphicCard($id, $name, $price, $slotsOccupied, $memory));
                $addedElement = $this->database->getComponent($id);
                return new JsonResponse($addedElement, 200);
            } catch (\Exception $e) {
                $addGraphicCardResponse->initResponse($name, $id, "addGraphicCard()", $e->getMessage());
                return new JsonResponse($addGraphicCardResponse->jsonSerialize());
            }
        }else{
            $addGraphicCardResponse->initResponse($name, $id, "addGraphicCard()", "id is already used");
            return new JsonResponse($addGraphicCardResponse->jsonSerialize(), 406);
        }
    }

    /**
     * PUT /graphiccard/{id}/{name}/{price}/{slotsOccupied}/{memory}
     * @param $id
     * @param $name
     * @param $price
     * @param $slotsOccupied
     * @param $memory
     * @return JsonResponse
     */
    public function updateGraphicCard($id, $name, $price, $slotsOccupied, $memory){
        $updateResponse = new AbstractResponse();
        if($id < $this->databaseSize) {
            try {
                $this->database->updateComponent($id, $name, $price, $slotsOccupied, $memory);
                $updatedElement = $this->database->getComponent($id);
                return new JsonResponse($updatedElement, 200);
            } catch (\Exception $e) {
                $updateResponse->initResponse($name, $id, "updateGraphicCard()", +$e->getMessage());
                return new JsonResponse($updateResponse->jsonSerialize());
            }
        }else{
            $updateResponse->initResponse($name,$id, "updateGraphicCard()", "Element id does not exist");
            return new JsonResponse($updateResponse->jsonSerialize(), 406);
        }
    }

    /**
     * DELETE /graphiccard/{id}
     * @param $id
     * @return JsonResponse
     */
    public function deleteGraphicCard($id){
        $deleteResponse = new AbstractResponse();
        if ($id < $this->databaseSize) {
            try {
                $objectName = $this->database->getComponent($id)->getName();
                $this->database->deleteComponent($id);
                $deleteResponse->initResponse($objectName, $id, "deleteGraphicCard()", "success");
                return new JsonResponse($deleteResponse->jsonSerialize());
            } catch (\Exception $e) {
                $deleteResponse->initResponse(GraphicCardService::$TAG, $id, "deleteGraphicCard()", $e->getMessage());
                return new JsonResponse($deleteResponse->jsonSerialize());
            }
        }else{
            $deleteResponse->initResponse(GraphicCardService::$TAG, $id, "deleteGraphicCard()", "Element id does not exist");
            return new JsonResponse($deleteResponse->jsonSerialize(), 406);
        }
    }
}