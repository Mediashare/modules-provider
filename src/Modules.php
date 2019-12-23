<?php
namespace Mediashare\ModulesProvider;

use Exception;
use Mediashare\ModulesProvider\Config;


Class Modules
{
    public $modules = [];
    public function __construct(?Config $config = null) {
        if (!$config): $config = new Config(); endif;
        $this->config = $config;
        $this->modules = $this->getModules();
    }

    public function run(?string $module = null) {
        if ($module):
            $this->$modules = [$this->getModule($module)];
        endif;
        if (!$this->modules):
            $this->modules = $this->getModules();
        endif;

        foreach ($this->modules as $className => $module):
            if (method_exists($module, 'run')):
                $module->run();
            else:
                $message = "public function run() in Module [".$className."] not found in [".$this->config->getModulesDir().$className.".php]. public function run() is needle for call automated action.";
                trigger_error($message, E_USER_NOTICE);
            endif;
        endforeach;
    }


    public function getModule(string $className) {
        $modules = $this->getModules();
        foreach ($modules as $moduleName => $module):
            if ($className == $moduleName):
                return $module;
            endif;
        endforeach;
        throw new Exception("Module [".$className."] not found in [".$this->config->getModulesDir().$className.".php] with namespace [".\rtrim($this->config->getNamespace(), "\\")."]", 1);
    }

    /**
     * Get all modules from modules directory. These modules are init in an array.
     *
     * @return array
     */
    public function getModules(): array {
        $moduleDir = $this->config->getModulesDir();
        $modulesFiles = glob($moduleDir.'*.php');
        $modules = [];
        foreach($modulesFiles as $moduleFile) {
            require_once $moduleFile;
            $className = $this->config->getNamespace().basename($moduleFile, '.php');
            $module = new $className();
            $module->methods = get_class_methods($module);
            $moduleName = basename($moduleFile, '.php');
            $modules[$moduleName] = $module;
        }
        return $modules;
    }
}
