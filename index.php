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
$config->setModules(['Hello']); // Add Hello object from ./modules/Hello.php
$modules = new Modules($config);
$hello = $modules->getModule("Hello"); 
$hello->prefix = "[Message du module Hello] ";
// $hello->echo("Bonjour \n");

// Use modules cluster with automated action
$config->setModules(["Hello", "Git"]);
// dump($config);die;
$modules = new Modules($config); // $modules = ['Hello', 'Git']
// dump($modules->modules, $config);die;
$modules->getModule('Git')->message = "Commit message test 2"; // Init message for commit
$modules->run(); 
// $git->run(); 
dump($modules);