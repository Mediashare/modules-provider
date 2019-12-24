<?php
require "vendor/autoload.php";
use Mediashare\ModulesProvider\Config;
use Mediashare\ModulesProvider\Modules;

$config = new Config();
$config->setModulesDir(__DIR__.'/modules/');
$config->setNamespace("Mediashare\\Modules\\");

// Get all modules instancied.
$modules = new Modules($config);
// dump($modules);die;

// Use one module
$config->addModule('Hello'); // Add Hello object from ./modules/Hello.php
$modules = new Modules($config);
$hello = $modules->getModule("Hello"); 
$hello->prefix = "[Message du module Hello] ";
$hello->echo("Bonjour \n");

// Use modules cluster with automated action
$config->addModule('Git');
$modules = new Modules($config);
$modules->modules['Git']->message = "Commit message test 2";
$modules->run();
// $git->run(); 
dump($modules);