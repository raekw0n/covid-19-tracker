<?php

/*----------------------------------------
 | Auto-load classes                      |
 ----------------------------------------*/
require_once __DIR__.'/../vendor/autoload.php';

Dotenv\Dotenv::create(__DIR__ . '/../')->load();

/*----------------------------------------
 | Register service providers             |
 ----------------------------------------*/
$app = new Pimple\Container();

$app->register(new Danielle\Providers\LogServiceProvider());
$app->register(new Danielle\Providers\DatabaseServiceProvider());
$app->register(new Danielle\Providers\RouteServiceProvider());

/** custom providers */
$app->register(new Covid\Providers\ApiServiceProvider());

/**
 * boot method to fetch services from the container
 *
 * @param $dependency
 * @return mixed
 */
function app($dependency = null)
{
    global $app;
    return $app->offsetExists($dependency) ? $app->offsetGet($dependency) : false;
}

/*----------------------------------------
 | Load controllers                       | 
 ----------------------------------------*/
require_once __DIR__.'/../config/controllers.php';

/*----------------------------------------
 | Load application routes                |
 ----------------------------------------*/
require_once __DIR__.'/../config/routes.php';
