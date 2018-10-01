<?php
return [
    'guest' => [
        'session/index' => '*',
    ],
    'member' => [
        'session/index' => 'index',
        'session/login' => 'index'
    ],
];