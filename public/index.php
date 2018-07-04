<?php
/**
 * Summary File ${NAME}
 *
 * Description File ${NAME}
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/30/2018
 * Time: 6:19 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__). '/');
define('APP_PATH', BASE_PATH. 'app/');

// Register AutoLoaders
$loader = new Loader();
$loader->registerDirs(
    [
        APP_PATH. 'controllers/',
        APP_PATH. 'models/',
        BASE_PATH. 'lib/'
    ]
)->register();

// Create a di
$di = new FactoryDefault();

// Setup the view component
$di->set('view', function () {
    $view = new \Phalcon\Mvc\View();
    $view->setViewsDir(APP_PATH. 'views');
    return $view;
});

$di->set('url', function () {
    $url = new \Phalcon\Mvc\Url();
    $url->setBaseUri('/cms/');
    return $url;
});

// Setup the database service
$di->set('db', function () {
    $db = new \Phalcon\Db\Adapter\Pdo\Mysql([
        'host'     => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'cms'
    ]);

    return $db;
});

$application = new \Phalcon\Mvc\Application($di);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}