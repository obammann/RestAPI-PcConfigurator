<?php
/**
 * Created by PhpStorm.
 * User: oliverbammann
 * Date: 12.05.16
 * Time: 15:44
 */

namespace HsBremen\WebApi\Service;


use HsBremen\WebApi\Entity\ProcessorCooler;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProcessorCoolerService
{
    public function getList()
    {
        $processorCoolers = [
            new ProcessorCooler(1, 'cooler', 100, 'AM2'),
        ];
        return new JsonResponse($processorCoolers);
        /*$listOFAllProcessors = $this->database->getProcessorDatabase();
        return new JsonResponse($listOFAllProcessors);*/
    }

}