<?php

ini_set('date.timezone', 'Europe/London');
ini_set('max_execution_time', 0);

// configuration file
require_once 'config.php';
// helpers
require_once __DIR__ . '/../vendor/basic-framework/framework/src/support/helpers.php';
// autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// routes
$router = new BasicFramework\Router;
// routes and directions added here
$router->add('', ['controller' => 'home', 'method' => 'index']);

// examples below
// $router->add('{controller}');
// $router->add('{controller}/{method}');
// $router->add('{controller}/{method}/{id:\d+}');

$router->dispatch($_SERVER['QUERY_STRING']);
