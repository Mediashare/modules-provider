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
$run = $modules->getModule('Hello');
$run->message = "[RUN] Git push";
$modules->getModule('Git')->message = "Commit message test 4"; // Init message for commit
$end = $modules->getModule('Hello');
$end->message = "[END] Git push";

$cluster = new Cluster();
$cluster->setModules([
    $run,
    $modules->getModule('Git'),
    $end,
]);
$cluster->run(); 
dump($cluster);die;
// $git->run(); 
// dump($modules);