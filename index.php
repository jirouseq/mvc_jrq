<?php

session_start();

define('ROOT', __DIR__ . '/');
require(__DIR__ . "/vendor/autoload.php");

use DI\Container;
use library\Authentication;

$container = new Container();

$authentication = $container->get(Authentication::class);

use library\App;

$application = $container->get(App::class);
