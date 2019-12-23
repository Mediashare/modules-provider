# Modules Provider
:dizzy: Modules provider is an object autoloader for automating and simplifying some code inclusion in different projects. You can call object(s) from different folders (like a container) and then you can use one or more modules with the run() function.
## Installation
```bash
composer require mediashare/modules-provider
```
## Basic Usage
### Class Autoloading
```php
<?php
// ./index.php
require "vendor/autoload.php";
use Mediashare\ModulesProvider\Config;
use Mediashare\ModulesProvider\Modules;

$config = new Config();
$config->setModulesDir(__DIR__.'/modules/');
$config->setNamespace("Mediashare\\Modules\\");
$modules = new Modules($config);
```
### Modules
#### Requirements
- The classname must match the name of the php file & unique.
- A public run() function must be present if you want to be able to execute an automation action on several modules. This can be used when you want to orchestrate a set of events via php classes.  
```php
<?php
// ./modules/Hello.php
namespace Mediashare\Modules;

class Hello
{
    public $prefix;
    public function echo(?string $message) {
        if (empty($message)):
            $message = "Not message recorded :(";
        endif;
        $message = $this->prefix . $message;
        echo $message;
        return $message;
    }
}
```
### Execute
```php
// ./index.php
require "vendor/autoload.php";
use Mediashare\ModulesProvider\Config;
use Mediashare\ModulesProvider\Modules;

$config = new Config();
$config->setModulesDir(__DIR__.'/modules/');
$config->setNamespace("Mediashare\\Modules\\");
$modules = new Modules($config);
$hello = $modules->getModule("Hello");
$hello->prefix = "[Message] ";
$hello->echo('Bonjour');
```
