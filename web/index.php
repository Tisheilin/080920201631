<?php

include_once __DIR__.'/../vendor/autoload.php'; //автоподключение классов (неймспес)
include_once __DIR__.'/../configs/config.php';
use \App\Router;

$route = new Router();
$route->run();
