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
        $this->initPowerSupplyRoutes($application);
        $this->initMemoryRoutes($application);
        $this->initMainboardRoutes($application);
        $this->initGraphicCardRoutes($application);
        $this->initHDDRoutes($application);
        $this->initComputerBodyRoutes($application);
        $this->initCdDriveRoutes($application);
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

    private function initPowerSupplyRoutes($application)
    {
        //PowerSupply Routen
        $application->get('/powersupply', 'service.powerSupply:getList');
        $application->get('/powersupply/{id}', 'service.powerSupply:getSinglePowerSupply');
        //add
        $application->post('/powersupply/{id}/{name}/{price}/{power}', 'service.powerSupply:addPowerSupply');
        //update
        $application->put('/powersupply/{id}/{name}/{price}/{power}', 'service.powerSupply:updatePowerSupply');
        $application->delete('/powersupply/{id}', 'service.powerSupply:deletePowerSupply');
    }

    private function initMemoryRoutes($application)
    {
        //Memory Routen
        $application->get('/memory', 'service.memory:getList');
        $application->get('/memory/{id}', 'service.memory:getSingleMemory');
        //add
        $application->post('/memory/{id}/{name}/{price}/{type}/{module}/{memory}', 'service.memory:addMemory');
        //update
        $application->put('/memory/{id}/{name}/{price}/{type}/{module}/{memory}', 'service.memory:updateMemory');
        $application->delete('/memory/{id}', 'service.memory:deleteMemory');
    }

    private function initMainboardRoutes($application)
    {
        //Mainboard Routen
        $application->get('/mainboard', 'service.mainboard:getList');
        $application->get('/mainboard/{id}', 'service.mainboard:getSingleMainboard');
        //add
        $application->post('/mainboard/{id}/{name}/{price}/{processorSocket}/{numberDDR3Slots}/{numberDDR4Slots}/{numberSataConnectors}/{numberPCIeSlots}', 'service.mainboard:addMainboard');
        //update
        $application->put('/mainboard/{id}/{name}/{price}/{processorSocket}/{numberDDR3Slots}/{numberDDR4Slots}/{numberSataConnectors}/{numberPCIeSlots}', 'service.mainboard:updateMainboard');
        $application->delete('/mainboard/{id}', 'service.mainboard:deleteMainboard');
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

    private function initGraphicCardRoutes($application)
    {
        //Graphic Card Routen
        $application->get('/graphiccard', 'service.graphicCard:getList');
        $application->get('/graphiccard/{id}', 'service.graphicCard:getSingleGraphicCard');
        //add
        $application->post('/graphiccard/{id}/{name}/{price}/{slotsOccupied}/{memory}', 'service.graphicCard:addGraphicCard');
        //update
        $application->put('/graphiccard/{id}/{name}/{price}/{slotsOccupied}/{memory}', 'service.graphicCard:updateGraphicCard');
        $application->delete('/graphiccard/{id}', 'service.graphicCard:deleteGraphicCard');
    }

    private function initComputerBodyRoutes($application)
    {
        // ComputerBody Routen
        $application->get('/computerbody', 'service.computerBody:getList');
        $application->get('/computerbody/{id}', 'service.computerBody:getSingleComputerBody');
        //add
        $application->post('/computerbody/{id}/{name}/{price}/{formFactor}', 'service.computerBody:addComputerBody');
        //update
        $application->put('/computerbody/{id}/{name}/{price}/{formFactor}', 'service.computerBody:updateComputerBody');
        $application->delete('/computerbody/{id}', 'service.computerBody:deleteComputerBody');
    }

    private function initCdDriveRoutes($application)
    {
        //CdDrive Routen
        $application->get('/cddrive', 'service.cdDrive:getList');
        $application->get('/cddrive/{id}', 'service.cdDrive:getSingleCdDrive');
        //add
        $application->post('/cddrive/{id}/{name}/{price}/{readingTime}/{writingTime}/{isWritable}/{isBluRay}', 'service.cdDrive:addCdDrive');
        //update
        $application->put('/cddrive/{id}/{name}/{price}/{readingTime}/{writingTime}/{isWritable}/{isBluRay}', 'service.cdDrive:updateCdDrive');
        $application->delete('/cddrive/{id}', 'service.cdDrive:deleteCdDrive');
    }


}