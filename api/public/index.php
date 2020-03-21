<?php

/*----------------------------------------
 | Bootstrap the application              |
 ----------------------------------------*/
require_once __DIR__.'/../config/bootstrap.php';

/*----------------------------------------
 | Dispatch the application               |
 ----------------------------------------*/
$app['router']->dispatch();
