<?php
require "vendor/autoload.php";
use Mediashare\ModulesProvider\Config;
use Mediashare\ModulesProvider\Modules;

$config = new Config();
$config->setModulesDir(__DIR__.'/modules/');
$config->setNamespace("Mediashare\\Modules\\");
$config->addModule('Hello');
$config->addModule('Git');
$modules = new Modules($config);

// Get all modules instancied.
$modules_list = $modules->getModules();
// dump($modules_list);die;

$git = $modules->getModule("Git");
$git->message = "Commit message test";
$git->run();
dump($git);die;

// Use one module
$hello = $modules->getModule("Hello"); // Get Hello object from ./modules/Hello.php
$hello->prefix = "[Message du module Hello] ";
$hello->echo("Bonjour \n");

// Use several modules 