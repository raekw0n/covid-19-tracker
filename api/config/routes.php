<?php

/*----------------------------------------
 | Configure application routes           |
 ----------------------------------------*/

/** @var \Covid\Controllers\StatisticsController $statistics */
$app['router']->get('/', function ($request, $response) use ($statistics) {
    return $statistics->get();
});
