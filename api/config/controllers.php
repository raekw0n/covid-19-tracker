<?php

/*----------------------------------------
 | Register application controllers       |
 ----------------------------------------*/
$controllers = [
    'statistics' => new \Covid\Controllers\StatisticsController($app)
];

return extract($controllers);
