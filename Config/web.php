<?php
/**
 * Default web config
 */

use Reaction\DI\Instance;
use Reaction\DI\Value;

return [
    //Static application config
    'appStatic' => [],
    //Request application config
    'appRequest' => [
        'components' => [
            'view' => [
                'class' => 'Reaction\Web\View',
                'layout' => '@views/layout/main'
            ],
        ],
    ],
    'container' => [
        'definitions' => [],
        'singletons' => [],
    ],
];