<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 14:39
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Database\ProcessorDatabase;
use HsBremen\WebApi\Entity\Processor;

use Symfony\Component\HttpFoundation\JsonResponse;

class ProcessorService
{
    private $database;

    public function __construct()
    {
        $this->database = new ProcessorDatabase();
    }

    /**
     * GET /processor
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList()
    {
        $listOFAllProcessors = $this->database->getProcessorDatabase();
        return new JsonResponse($listOFAllProcessors);
    }


    public function getSingleProcessor($name, $sockel){

        //TODO get Database (Object array)

        $processor = $this->database->getProcessorDatabase();

        foreach ($processor as $iter) {

            if($iter->getName() === $name && $iter->getSocket() === $sockel){
                return new JsonResponse($iter);
            }
        }
        return new JsonResponse(new Processor(0,0,0,0,0, 0));
    }

}