<?php
//Main config for all application
return [
    //Application config
    'appStatic' => [
        'charset' => 'utf-8',
        'hostname' => '0.0.0.0', //For docker - expose to all interfaces
        'port' => 4000,
        //Initial app aliases
        'aliases' => [],
        //Components
        'components' => [],
    ],
    //DI definitions and config
    'container' => [
        'singletons' => [ ],
        'definitions' => [ ],
    ],
];