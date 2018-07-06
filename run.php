<?php
/**
 * Web run file
 * @var \Composer\Autoload\ClassLoader $composer
 */
$composer = require 'vendor/autoload.php';
$configsPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Config';
$appType = \Reaction\StaticApplicationInterface::APP_TYPE_WEB;

Reaction::init($composer, $configsPath, $appType);

Reaction::$app->initHttp();
Reaction::$app->run();