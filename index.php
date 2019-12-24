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
// $hello->echo("Bonjour \n");


// Use modules cluster with automated action
$modules = new Modules($config); // $modules = ['Hello', 'Git']
$modules->getModule('Git')->message = "Commit message test 3"; // Init message for commit
$cluster = new Cluster();
$cluster->setModules([
    $modules->getModule('Hello'),
    $modules->getModule('Git'),
    $modules->getModule('Hello'),    
]);
$cluster->run(); 
// $git->run(); 
// dump($modules);