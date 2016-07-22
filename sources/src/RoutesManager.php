<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 22.07.2016
 * Time: 15:27
 */

namespace HsBremen\WebApi;


class RoutesManager
{

    public function __construct()
    {
    }

    public function initRoutes($application)
    {
        $this->initDefaultRoutes($application);
        $this->initProcessorRoutes($application);
        $this->initProcessorCoolerRoutes($application);
        $this->initHDDRoutes($application);
        $this->initComputerBodyRoutes($application);
    }

    private function initDefaultRoutes($application)
    {
        //default Route (Informationen zum Projekt)
        $application->get('/', 'service.abstractResponse:getWelcomeMessage');
    }

    private function initProcessorRoutes($application)
    {
        // Processor Routen
        $application->get('/processor', 'service.processor:getList');
        $application->get('/processor/{id}', 'service.processor:getSingleProcessor');
        //add
        $application->post('processor/{id}/{name}/{price}/{processorSocket}/{frequency}/{cores}', 'service.processor:addProcessor');
        //update
        $application->put('/processor/{id}/{name}/{price}/{processorSocket}/{frequency}/{cores}', 'service.processor:updateProcessor');
        $application->delete('/processor/{id}', 'service.processor:deleteProcessor');
    }

    private function initProcessorCoolerRoutes($application)
    {
        //ProcessorCooler Routen
        $application->get('/processorcooler', 'service.processorCooler:getList');
        $application->get('/processorcooler/{id}', 'service.processorCooler:getSingleProcessorCooler');
        //add
        $application->post('processorcooler/{id}/{name}/{price}/{processorSocket}', 'service.processorCooler:addProcessorCooler');
        //update
        $application->put('/processorcooler/{id}/{name}/{price}/{processorSocket}', 'service.processorCooler:updateProcessorCooler');
        $application->delete('/processorcooler/{id}', 'service.processorCooler:deleteProcessorCooler');
    }

    private function initHDDRoutes($application)
    {
        // HDD Routen
        $application->get('/hdd', 'service.HDD:getList');
        $application->get('/hdd/{id}', 'service.HDD:getSingleHDD');
        //add
        $application->post('/hdd/{id}/{name}/{price}/{type}/{memory}', 'service.HDD:addHDD');
        //update
        $application->put('/hdd/{id}/{name}/{price}/{type}/{memory}', 'service.HDD:updateHDD');
        $application->delete('/hdd/{id}', 'service.HDD:deleteHDD');
    }

    private function initComputerBodyRoutes($application)
    {
        // ComputerBody Routen
        $application->get('/computerbody', 'service.computerBody:getList');
        $application->get('/computerBody/{id}', 'service.computerBody:getSingleComputerBody');
        //add
        $application->post('/computerbody/{id}/{name}/{price}/{formFactor}', 'service.computerBody:addComputerBody');
        //update
        $application->put('/computerbody/{id}/{name}/{price}/{formFactor}', 'service.computerBody:updateComputerBody');
        $application->delete('/computerbody/{id}', 'service.computerBody:deleteComputerBody');
    }
}