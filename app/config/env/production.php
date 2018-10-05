<?php
return new \Phalcon\Config(
    [
        'database' => [
            'adapter'  => 'Mysql',
            'host'     => 'localhost',
            'username' => 'username',
            'password' => 'password',
            'dbname'   => 'dbname',
            'charset'  => 'utf8mb4',
            'prefix'   => 'ilya_'
        ],

        'app' => [
            'baseUri'    => '/',
            'modelsDir'  => APP_PATH.'Models/',
            'libraryDir' => APP_PATH.'Library/',
            'pluginsDir' => APP_PATH.'Plugins/',
            'themesDir'  => BASE_PATH.'public/ilya-theme/',
            'cryptSalt'  => 'eEAfR\|_&G\&f\,+v\U]:\jF\!!A&\\\+71w1M\\\s9~8_4L!<@[N@DyaI\\P_2My|:\\\+.u>/6m,$D'
        ]
    ]
);