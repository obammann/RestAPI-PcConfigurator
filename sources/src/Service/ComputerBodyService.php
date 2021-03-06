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
    private $databaseSize;
    public static $TAG = 'ComputerBodyService';

    /**
     * ComputerBodyService constructor.
     */
    public function __construct()
    {
        $this->database = new ComputerBodyDatabase();
        $this->databaseSize = count($this->database->getDatabase());
    }

    /**
     * GET /computerbody
     * @return JsonResponse
     */

    /**
     * @SWG\Get(
     *     path="/computerbody/getList",
     *     summary="Finds all computer bodies",
     *     tags={"computer body", "List"},
     *     description="...",
     *     operationId="getComputerBodyList",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ComputerBody")
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
        $listOFAllComputerBodies = $this->database->getDatabase();
        return new JsonResponse($listOFAllComputerBodies);
    }

    /**
     * GET /computerbody/{id}
     * @param $id
     * @return JsonResponse
     */

    /**
     * @SWG\Get(
     *     path="/computerbody/{id}",
     *     summary="Find computer body by ID",
     *     description="Returns a single computer body",
     *     operationId="getComputerBodyByID",
     *     tags={"computer body"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of computer body to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/ComputerBody")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Computer body not found"
     *     )
     * )
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
    /**
     * @SWG\Post(
     *     path="/computerbody/{id}/{name}/{price}/{formFactor}",
     *     tags={"computer body"},
     *     operationId="addComputerBody",
     *     summary="add a computer body",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the computer body",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of the computer body",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="price of the computer body",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="formFactor",
     *         in="path",
     *         description="form factor of the computer body",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addComputerBody($id, $name, $price, $formFactor){
        $addProcessorResponse = new AbstractResponse();
        if ($id > $this->databaseSize -1) {
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
    /**
     * @SWG\Put(
     *     path="/computerbody/{id}/{name}/{price}/{formFactor}",
     *     tags={"computer body"},
     *     operationId="updateComputerBody",
     *     summary="update a computer body",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of the computer body",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="path",
     *         description="new name of the computer body",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="path",
     *         description="new price of the computer body",
     *         required=true,
     *         type="number",
     *         format="double"
     *     ),
     *     @SWG\Parameter(
     *         name="formFactor",
     *         in="path",
     *         description="new form factor of the computer body",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateComputerBody($id, $name, $price, $formFactor){
        $updateResponse = new AbstractResponse();
        if($id < $this->databaseSize) {
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
    /**
     * @SWG\Delete(
     *     path="/computerbody/{id}",
     *     summary="Deletes a computer body",
     *     description="",
     *     operationId="deleteComputerBody",
     *     produces={"application/json"},
     *     tags={"Computer Body"},
     *     @SWG\Parameter(
     *         description="computer body id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid computer body id"
     *     ),
     * )
     */
    public function deleteComputerBody($id){
        $deleteResponse = new AbstractResponse();
        if ($id < $this->databaseSize) {
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