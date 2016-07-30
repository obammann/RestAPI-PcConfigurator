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


    /**
     * @SWG\Get(
     *     path="/graphiccard/getList",
     *     summary="Finds all graphic cards",
     *     tags={"graphic card", "List"},
     *     description="...",
     *     operationId="getGraphicCardList",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/GraphicCard")
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
        $listOFAllGraphicCards = $this->database->getDatabase();
        return new JsonResponse($listOFAllGraphicCards);
    }


    /**
     * @SWG\Get(
     *     path="/graphiccard/{id}",
     *     summary="Find Graphic card by ID",
     *     description="Returns a single Graphic card",
     *     operationId="getGraphicCardByID",
     *     tags={"graphic Card"},
     *     consumes={
     *         "application/json"
     *     },
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="ID of graphic card to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/GraphicCard")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Graphic Card not found"
     *     )
     * )
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
            $deleteResponse->initResponse(GraphicCardService::$TAG , $id, "deleteGraphicCard()", "success");
            return new JsonResponse($deleteResponse->jsonSerialize());
        }catch (\Exception $e){
            $deleteResponse->initResponse(GraphicCardService::$TAG , $id, "deleteGraphicCard()", $e->getMessage());
            return new JsonResponse($deleteResponse->jsonSerialize());
        }
    }
}