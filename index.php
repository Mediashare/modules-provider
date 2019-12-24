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
// dump($modules);die;

// Use one module
$hello = $modules->getModule("Hello"); 
$hello->prefix = "[Message du module Hello] ";
$hello->echo("Bonjour \n");


// Use modules cluster with automated action
$modules = new Modules($config); // $modules = ['Hello', 'Git']
$modules->getModule('Git')->message = "Commit message test 4"; // Init message for commit
// Create Cluster
$cluster = new Cluster();
$cluster->setModules([
    $modules->getModule('Hello')->setMessage("[RUN] Git push \n"),
    $modules->getModule('Git'),
    $modules->getModule('Hello')->setMessage("[END] Git push \n"),
]);
$cluster->run(); 
// dump($cluster);
// dump($cluster);
