<?php
return new \Phalcon\Config([
    'module' => [
        'name' => strtolower(basename(dirname(__DIR__))),
        'path' => dirname(__DIR__)
    ]
]);