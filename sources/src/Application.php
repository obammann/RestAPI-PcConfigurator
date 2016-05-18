<?php

namespace HsBremen\WebApi;

use HsBremen\WebApi\Service\OrderService;
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
        $app['service.order'] = $app->share(function () {
            return new OrderService();
        });

        $app['service.processor'] = $app->share(function () {
            return new ProcessorService();
        });

        $app['service.processorCooler'] = $app->share(function () {
            return new ProcessorCoolerService();
        });

        // Service Routen
        $this->get('/order', 'service.order:getList');
        $this->get('/order/{orderId}', 'service.order:getDetails');
        $this->post('/order', 'service.order:createOrder');
        $this->put('/order/{orderId}', 'service.order:changeOrder');


        // Processor Routen
        $this->get('/processor', 'service.processor:getList');
        $this->get('/processor/{id}', 'service.processor:getSingleProcessor');
        $this->put('/processor/{id}/{name}/{price}/{processorSocket}/{frequency}/{cores}', 'service.processor:updateProcessor');
        $this->delete('/processor/{id}', 'service.processor:deleteProcessor');

        //Processor cooler Routen
        $this->get('/processorcooler', 'service.processorCooler:getList');




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
