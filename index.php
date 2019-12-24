<?php
require "vendor/autoload.php";
use Mediashare\ModulesProvider\Config;
use Mediashare\ModulesProvider\Cluster;
use Mediashare\ModulesProvider\Modules;

$config = new Config();
$config->setModulesDir(__DIR__.'/modules/');
$config->setNamespace("Mediashare\\Modules\\");

// Get all modules instancied.
$modules = new Modules($config);
// dump($modules);

// Use one module
$hello = $modules->getModule("Hello"); 
$hello->prefix = "[Message du module Hello] ";
$hello->echo("Bonjour \n");


$modules->getModule('Git')->message = "Commit message test 4"; // Init message for commit
$cluster = new Cluster(); // Create Cluster
$cluster->setModules([
    clone $modules->getModule('Hello')->setMessage("[RUN] Git push \n"),
    $modules->getModule('Git'),
    clone $modules->getModule('Hello')->setMessage("[END] Git push \n"),
]);
$cluster->run();
dump($cluster);
