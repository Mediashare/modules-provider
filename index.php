<?php
require "vendor/autoload.php";
use Mediashare\ModulesProvider\Config;
use Mediashare\ModulesProvider\Cluster;
use Mediashare\ModulesProvider\Modules;

$config = new Config();
$config->setModulesDir(__DIR__.'/modules/');
$config->setNamespace("Mediashare\\Modules\\");
$config->setVerbose(true);

// Get all modules instancied.
$modules = new Modules($config);
// dump($modules);

// Using one module
$hello = $modules->get("Hello"); 
$hello->prefix = "[GIT] ";
$hello->echo("Bonjour \n");