<?php
namespace Mediashare\ModulesProvider;

use Exception;
use Mediashare\ModulesProvider\Config;

/**
 * Modules Provider
 * Autoload Modules from $config->getModulesDir() with $config->getNamespace() 
 */
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


    /**
     * Get specific module & init this.
     *
     * @param string $className
     * @return object $module;
     */
    public function getModule(string $className) {
        $modules = $this->getModules();
        foreach ($modules as $module):
            if ($className == $module->name):
                return $module;
            endif;
        endforeach;
        throw new Exception("Module [".$className."] not found in [".$this->config->getModulesDir().$className.".php] with namespace [".\rtrim($this->config->getNamespace(), "\\")."]", 1);
    }

    /**
     * Get all modules from modules directory. These modules are init in an array.
     *
     * @return array|null $modules
     */
    public function getModules(): ?array {
        $moduleDir = $this->config->getModulesDir();
        $modulesFiles = glob($moduleDir.'*.php');
        $modules = [];
        foreach($modulesFiles as $moduleFile) {
            $module = $this->initModule($moduleFile);
            if ($module):
                $modules[] = $module;
            endif;
        }
        return $modules;
    }

    public function initModule(string $moduleFile) {
        $className = $this->config->getNamespace().basename($moduleFile, '.php');
        $moduleName = basename($moduleFile, '.php');
        $module = null;
        if (!is_array($this->config->getModules())):
            // Init Module
            require_once $moduleFile;
            $module = new $className();
            $module->name = $moduleName;
            $module->methods = get_class_methods($module);
        elseif (in_array($moduleName, $this->config->getModules())):
            // Init Module
            require_once $moduleFile;
            $module = new $className();
            $module->name = $moduleName;
            $module->methods = get_class_methods($module);
        endif;

        return $module;
    }
}
