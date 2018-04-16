<?php
/**
 * Run file
 */
/** @var \Composer\Autoload\ClassLoader $composer */
$composer = require 'vendor/autoload.php';

Reaction::init($composer, dirname(__FILE__) . '/Config');

Reaction::$app->run();