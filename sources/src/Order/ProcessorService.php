<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11.05.16
 * Time: 14:39
 */

namespace HsBremen\WebApi\Order;


use HsBremen\WebApi\Entity\Processor;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProcessorService
{

    public function getList()
    {
        $orders = [
            new Processor('name 1', 'processor 1'),
            new Processor('name 2', 'processor 2'),
        ];

        return new JsonResponse($orders);
    }

    public function getSingleProcessor($name, $sockel){

        //TODO get Database (Object array)
        $orders = [
            new Processor('name 1', 'processor 1'),
            new Processor('name 2', 'processor 2'),
        ];

        foreach ($orders as $iter) {

            if($iter->getName() === $name && $iter->getSockel() === $sockel){
                return new JsonResponse($iter);
            }
            else{
                return new JsonResponse(new Processor('0', '0'));
            }
        }
    }

}