<?php

// Register AutoLoaders
$loader = new \Phalcon\Loader();
$loader->registerDirs(
    [
        $this->config->app->modelsDir,
    ]
)->registerNamespaces(
    [
        'Ilya' => APP_PATH,
        'Lib' => $this->config->app->libraryDir
    ]
)->registerFiles(
    [
        BASE_PATH. 'vendor/autoload.php'
    ]
)->register();