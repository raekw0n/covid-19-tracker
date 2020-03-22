<?php

/*----------------------------------------
 | Configure application routes           |
 ----------------------------------------*/
/** @var \Covid\Controllers\StatisticsController $statistics */
$app['router']->get('/', function ($request, $response) use ($statistics) {
    return $statistics->info($response);
});

$app['router']->get('/statistics', function ($request, $response) use ($statistics) {
    return $statistics->fetch($request, $response);
});

/** @var \Covid\Controllers\StatisticsController $statistics */
$app['router']->get('/countries', function ($request, $response) use ($statistics) {
    return $statistics->countries($response);
});


$app['router']->get('/update', function ($request, $response) use ($statistics) {
    app('auth')->require();
    return $statistics->update($response);
});
