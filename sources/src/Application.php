<?php

namespace HsBremen\WebApi;

use HsBremen\WebApi\Service\AbstractResponse;
use HsBremen\WebApi\Service\CdDriveService;
use HsBremen\WebApi\Service\ComputerBodyService;
use HsBremen\WebApi\Service\GraphicCardService;
use HsBremen\WebApi\Service\HDDService;
use HsBremen\WebApi\Service\MainboardService;
use HsBremen\WebApi\Service\MemoryService;
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

        $app['service.memory'] = $app->share(function () {
            return new MemoryService();
        });

        $app['service.mainboard'] = $app->share(function () {
            return new MainboardService();
        });

        $app['service.HDD'] = $app->share(function () {
            return new HDDService();
        });

        $app['service.graphicCard'] = $app->share(function () {
            return new GraphicCardService();
        });

        $app['service.computerBody'] = $app->share(function () {
            return new ComputerBodyService();
        });

        $app['service.cdDrive'] = $app->share(function () {
            return new CdDriveService();
        });

        $routesManager = new RoutesManager();
        $routesManager->initRoutes($this);

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
