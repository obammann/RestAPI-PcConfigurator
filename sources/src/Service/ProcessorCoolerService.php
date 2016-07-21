<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 12.05.16
 * Time: 15:44
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Database\ProcessorCoolerDatabase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProcessorCoolerService
{
    private $database;
    public  static $TAG = 'ProcessorCoolerService';

    public function __construct()
    {
         $this->database = new ProcessorCoolerDatabase();
    }


    /**
     * @return JsonResponse
     */
    public function getList()
    {
        $listOfAllProcessorCoolers = $this->database->getDatabase();
        return new JsonResponse($listOfAllProcessorCoolers);
    }

}