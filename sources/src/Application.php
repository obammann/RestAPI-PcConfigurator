<?php

namespace HsBremen\WebApi;

use HsBremen\WebApi\Service\AbstractResponse;
use HsBremen\WebApi\Service\ComputerBodyService;
use HsBremen\WebApi\Service\HDDService;
use HsBremen\WebApi\Service\PowerSupplyService;
use HsBremen\WebApi\Service\ProcessorCoolerService;
use HsBremen\WebApi\Service\ProcessorService;
use Silex\Application as Silex;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\HttpFoundation\Request;


class Application extends Silex
{
    public function __construct(array $values = [])
    {
        parent::__construct($values);
        $this->register(new ServiceControllerServiceProvider());

        $app = $this;


        // Nutzt Pimple DI-Container: https://github.com/silexphp/Pimple/tree/1.1
        $app['service.abstractResponse'] = $app->share(function () {
            return new AbstractResponse();
        });

        $app['service.processor'] = $app->share(function () {
            return new ProcessorService();
        });

        $app['service.processorCooler'] = $app->share(function () {
            return new ProcessorCoolerService();
        });

        $app['service.powerSupply'] = $app->share(function () {
            return new PowerSupplyService();
        });

        $app['service.HDD'] = $app->share(function () {
            return new HDDService();
        });

        $app['service.computerBody'] = $app->share(function () {
            return new ComputerBodyService();
        });



        //default Route (Informationen zum Projekt)
        $this->get('/', 'service.abstractResponse:getWelcomeMessage');

        // Processor Routen
        $this->get('/processor', 'service.processor:getList');
        $this->get('/processor/{id}', 'service.processor:getSingleProcessor');
        //add
        $this->post('processor/{id}/{name}/{price}/{processorSocket}/{frequency}/{cores}', 'service.processor:addProcessor');
        //update
        $this->put('/processor/{id}/{name}/{price}/{processorSocket}/{frequency}/{cores}', 'service.processor:updateProcessor');
        $this->delete('/processor/{id}', 'service.processor:deleteProcessor');

        //ProcessorCooler Routen
        $this->get('/processorCooler', 'service.processorCooler:getList');
        $this->get('/processorCooler/{id}', 'service.processorCooler:getSingleProcessorCooler');
        //add
        $this->post('processorCooler/{id}/{name}/{price}/{processorSocket}', 'service.processorCooler:addProcessorCooler');
        //update
        $this->put('/processorCooler/{id}/{name}/{price}/{processorSocket}', 'service.processorCooler:updateProcessorCooler');
        $this->delete('/processorCooler/{id}', 'service.processorCooler:deleteProcessorCooler');

        //PowerSupply Routen
        $this->get('/powersupply', 'service.powerSupply:getList');
        $this->get('/powersupply/{id}', 'service.powerSupply:getSinglePowerSupply');
        $this->post('/powersupply/{id}/{$name}/{$price}/{$power}', 'service.powerSupply:addPowerSupply');
        //-> get noch nicht RouteNotFound
        $this->put('/powersupply/{id}/{$name}/{$price}/{$power}', 'service.powerSupply:updatePowerSupply');
        //-> get noch nicht RouteNotFound
        $this->delete('/powersupply/{id}', 'service.powerSupply:deletePowerSupply');

        // HDD Routen
        $this->get('/hdd', 'service.HDD:getList');
        $this->get('/hdd/{id}', 'service.HDD:getSingleHDD');
        //add
        $this->post('/hdd/{id}/{name}/{price}/{type}/{memory}', 'service.HDD:addHDD');
        //update
        $this->put('/hdd/{id}/{name}/{price}/{type}/{memory}', 'service.HDD:updateHDD');
        $this->delete('/hdd/{id}', 'service.HDD:deleteHDD');

        // ComputerBody Routen
        $this->get('/computerBody', 'service.computerBody:getList');
        $this->get('/computerBody/{id}', 'service.computerBody:getSingleComputerBody');
        //add
        $this->post('/computerBody/{id}/{name}/{price}/{formFactor}', 'service.computerBody:addComputerBody');
        //update
        $this->put('/computerBody/{id}/{name}/{price}/{formFactor}', 'service.computerBody:updateComputerBody');
        $this->delete('/computerBody/{id}', 'service.computerBody:deleteComputerBody');




        // http://silex.sensiolabs.org/doc/cookbook/json_request_body.html
        $this->before(function (Request $request) use ($app) {
            if ($app->requestIsJson($request)) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : []);
            }
        });
    }

    private function requestIsJson(Request $request)
    {
        return 0 === strpos(
          $request->headers->get('Content-Type'),
          'application/json'
        );
    }
}
