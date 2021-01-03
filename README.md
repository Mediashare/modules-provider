# Modules Provider
**[DEPRECATED] Go to [Gitlab Project](https://gitlab.marquand.pro/MarquandT/modules-provider)**
:dizzy: Modules provider is an object autoloader for automating and simplifying some code inclusion in different projects. You can call object(s) from different folders and create a container with multiple objects.
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
    public $message;
    public function run() {
        if (empty($this->message)):
            $this->message = "Not message recorded :(";
        endif;
        echo $this->message;
        return $this;
    }

    public function setMessage(string $message) {
        $this->message = $message;
        return $this;
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
$hello->setMessage('Hello World!');
$hello->run();
```
