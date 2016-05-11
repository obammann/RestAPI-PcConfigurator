<?php

namespace HsBremen\WebApi;

use HsBremen\WebApi\Order\OrderService;
use HsBremen\WebApi\Order\ProcessorService;
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

        // Order Routen
        $this->get('/order', 'service.order:getList');
        $this->get('/order/{orderId}', 'service.order:getDetails');
        $this->post('/order', 'service.order:createOrder');
        $this->put('/order/{orderId}', 'service.order:changeOrder');

        // Processor Routen
        $this->get('/processor', 'service.processor:getList');





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
