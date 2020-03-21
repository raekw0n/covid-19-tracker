<?php

/*----------------------------------------
 | Configure application routes           |
 ----------------------------------------*/

/** @var \Covid\Controllers\StatisticsController $statistics */
$app['router']->get('/statistics', function ($request, $response) use ($statistics) {
    return $statistics->fetch($response);
});

$app['router']->get('/update', function ($request, $response) use ($statistics) {
    return $statistics->update($response);
});
