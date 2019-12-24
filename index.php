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

// Using one module
$hello = $modules->get("Hello"); 
$hello->prefix = "[Message du module Hello] ";
$hello->echo("Bonjour \n");


// Using Cluster
$modules->get('Git')->message = "Commit message test 4"; // Init message for commit
$cluster = new Cluster(); // Create Cluster
$cluster->setModules([
    clone $modules->get('Hello')->setMessage("[RUN] Git push \n"),
    $modules->get('Git'),
    clone $modules->get('Hello')->setMessage("[END] Git push \n"),
]);
$cluster->run();
