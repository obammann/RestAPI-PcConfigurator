<?php

use Swagger\Annotations as SWG;


require_once __DIR__ . '/../vendor/autoload.php';

$app = new \HsBremen\WebApi\Application(['debug' => true]);
$app->register(new SwaggerUI\Silex\Provider\SwaggerUIServiceProvider(), array(
    'swaggerui.path'=>'/api/swagger',
    'swaggerui.apiDocPath'=> '/api/api-docs'
));

$app->register(new Basster\Silex\Provider\Swagger\SwaggerProvider(), [
    'swagger.servicePath' => __DIR__.'/../src/'
]);


$app->run();
