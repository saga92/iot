<?php
use Phalcon\Mvc\Router;

$router = new Router();

$router->add(
    "/iot/:controller/:action/:params",
    array(
        "controller" => 1,
        "action"     => 2,
        "params"     => 3,
    )
);

