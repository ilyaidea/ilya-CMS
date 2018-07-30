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
            'cryptSalt'       => 'eEAfR\|_&G\&f\,+v\U]:\jF\!!A&\\\+71w1M\\\s9~8_4L!<@[N@DyaI\\P_2My|:\\\+.u>/6m,$D'
        ]
    ]
);