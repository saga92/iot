<?php

$loader = new \Phalcon\Loader();

$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir
    )
);

$loader->registerNamespaces(
    array(
        'Iot\Models' => dirname(__DIR__)."/models/",
        "Iot"        => dirname(__DIR__)."",
    )
);

$loader->register();
