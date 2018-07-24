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
            'baseUri'         => '/cms/',
            'modelsDir'       => APP_PATH. 'models/',
            'libraryDir'      => APP_PATH. 'library/',
            'themesDir'       => BASE_PATH. 'public/ilya-theme/',
            'cryptSalt'       => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
        ]
    ]
);