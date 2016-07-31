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

    /**
     * @SWG\Get(
     *     path="/graphiccard/getList",
     *     summary="Finds all graphic cards",
     *     tags={"graphic card", "List"},
     *     description="...",
     *     operationId="getGraphicCardList",
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
     * GET /graphiccard/{id}
     * @param $id
     * @return JsonResponse
     */

    /**
     * @SWG\Get(
     *     path="/graphiccard/{id}",
     *     summary="Find Graphic card by ID",
     *     description="Returns a single Graphic card",
     *     operationId="getGraphicCardByID",
     *     tags={"graphic Card"},
     *     produces={"application/json"},
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

    /**
     * POST /graphiccard/{id}/{name}/{price}/{slotsOccupied}/{memory}
     * @param $id
     * @param $name
     * @param $price
     * @param $slotsOccupied
     * @param $memory
     * @return JsonResponse
     */
    /**
     * @SWG\Post(
     *     path="/graphiccard/{id}/{name}/{price}/{slotsOccupied}/{memory}",
     *     tags={"graphic card"},
     *     operationId="addGraphicCard",
     *     summary="add a graphic card",
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the graphic card",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of the graphic card",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="price of the graphic card",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="slotsOccupied",
     *         in="path",
     *         description="number of PCIe slots occupied by the graphic card",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="memory",
     *         in="path",
     *         description="memory capacity of the graphic card",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
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
    /**
     * @SWG\Put(
     *     path="/graphiccard/{id}/{name}/{price}/{slotsOccupied}/{memory}",
     *     tags={"graphic card"},
     *     operationId="updateGraphicCard",
     *     summary="Update a graphic card",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the graphic card",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="new name of the graphic card",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="new price of the graphic card",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="slotsOccupied",
     *         in="path",
     *         description="new number of PCIe slots occupied by the graphic card",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="memory",
     *         in="path",
     *         description="new memory capacity of the graphic card",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
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
    /**
     * @SWG\Delete(
     *     path="/graphiccard/{id}",
     *     summary="Deletes a graphiccard",
     *     description="",
     *     operationId="deleteGraphicCard",
     *     produces={"application/json"},
     *     tags={"graphic card"},
     *     @SWG\Parameter(
     *         description="graphiccard id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid graphiccard id"
     *     ),
     * )
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