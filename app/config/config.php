<?php
return new \Phalcon\Config(
    [
        'database' => [
            'adapter' => 'Mysql',
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'dbname' => 'cms'
        ],

        'app' => [
            'baseUri' => '/cms/',
            'viewsDir' => APP_PATH. 'views/',
            'controllersDir'  => APP_PATH. 'controllers/',
            'modelsDir'  => APP_PATH. 'models/',
            'libraryDir'  => APP_PATH. 'library/',
            'themesDir'       => BASE_PATH. 'public/ilya-theme/',
        ]
    ]
);