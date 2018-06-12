<?php

/** Default console config */
return [
    //Static application config
    'appStatic' => [
        'debug' => true,
        //Components
        'components' => [
            'router' => [
                'class' => 'Reaction\Routes\RouterInterface',
                'controllerMap' => [
                    'migrate' => [
                        'class' => 'Reaction\Console\Controllers\MigrateController',
                        'migrationNamespaces' => [
                            'Reaction\Web\Sessions\Migrations',
                            'Reaction\Rbac\Migrations',
                            'Reaction\I18n\Migrations',
                        ],
                    ]
                ],
            ],
        ],
    ],
    //Request application config
    'appRequest' => [],
];