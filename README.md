# Modules Provider
:dizzy: Modules provider is an object autoloader for automating and simplifying some code inclusion in different projects. You can call object(s) from different folders and create several container with multiple objects.
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
$hello = $modules->get("Hello");
$hello->prefix = "[Message] ";
$hello->echo('Bonjour');
```

## Cluster Usage
```php
<?php
// ./index.php
require "vendor/autoload.php";
use Mediashare\ModulesProvider\Config;
use Mediashare\ModulesProvider\Cluster;
use Mediashare\ModulesProvider\Modules;

$config = new Config();
$config->setModulesDir(__DIR__.'/modules/');
$config->setNamespace("Mediashare\\Modules\\");
$modules = new Modules($config);

$modules->get('Git')->message = "Commit message test 4"; // Init message for commit
$cluster = new Cluster(); // Create Cluster
$cluster->setModules([
    clone $modules->get('Hello')->setMessage("[RUN] Git push \n"),
    $modules->get('Git'),
    clone $modules->get('Hello')->setMessage("[END] Git push \n"),
]);
$cluster->run();
```