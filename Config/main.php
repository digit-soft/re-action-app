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
        'components' => [
            //DB auth manager
            'authManager' => [
                'class' => 'Reaction\Rbac\ManagerInterface',
            ],
        ],
    ],
    //Request application config
    'appRequest' => [
        'class' => 'Reaction\RequestApplicationInterface',
        'components' => [
            'user' => [
                'class' => 'Reaction\Web\UserInterface',
                'identityClass' => 'App\Models\User',
            ],
        ],
    ],
    //DI definitions and config
    'container' => [
        'definitions' => [
            'Reaction\Rbac\ManagerInterface' => 'Reaction\Rbac\DbManager',
            'Reaction\Web\Sessions\SessionArchiveInterface' => 'Reaction\Web\Sessions\SessionArchiveInDb',
        ],
        'singletons' => [ ],
    ],
];