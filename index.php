<?php
require "vendor/autoload.php";
use Mediashare\ModulesProvider\Config;
use Mediashare\ModulesProvider\Modules;

$config = new Config();
$config->setModulesDir(__DIR__.'/modules/');
$config->setNamespace("Mediashare\\Modules\\");
$modules = new Modules($config);
$hello = $modules->getModule("Hello");
$hello->prefix = "[Message] ";
$hello->echo('Bonjour \n');
$modules->run();