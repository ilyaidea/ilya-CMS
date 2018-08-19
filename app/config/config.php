<?php
return new \Phalcon\Config(
    [
        'database' => [
            'adapter'  => 'Mysql',
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'cms',
            'charset'  => 'utf8mb4'
        ],

        'app' => [
            'baseUri'    => '/'.PROJECT_NAME.'/',
            'modelsDir'  => APP_PATH.'Models/',
            'libraryDir' => APP_PATH.'Library/',
            'themesDir'  => BASE_PATH.'public/ilya-theme/',
            'cryptSalt'  => 'eEAfR\|_&G\&f\,+v\U]:\jF\!!A&\\\+71w1M\\\s9~8_4L!<@[N@DyaI\\P_2My|:\\\+.u>/6m,$D'
        ]
    ]
);