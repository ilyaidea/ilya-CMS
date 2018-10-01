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
        'Lib' => $this->config->app->libraryDir,
        'Plugins' => $this->config->app->pluginsDir
    ]
)->registerFiles(
    [
        BASE_PATH. 'vendor/autoload.php'
    ]
)->register();