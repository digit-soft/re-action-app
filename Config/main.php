<?php
//Main config for all application
return [
    //Application config
    'app' => [
        'charset' => 'utf-8',
        'hostname' => '0.0.0.0',    //For docker - expose to all interfaces
        'port' => 4000,
        //Initial app aliases
        'aliases' => [],
        //Components
        'components' => [],
    ],
    //DI definitions
    'container' => [

    ],
    //DI config
    'container.config' => [
        'useAnnotations' => false,
        'useAutowiring' => true,
    ],
];