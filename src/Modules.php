<?php
namespace Mediashare\ModulesProvider;

use Exception;
use League\CLImate\CLImate;
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
        $this->modules = $this->autoload();
    }

    /**
     * Get all modules from modules directory. These modules are init in an array.
     *
     * @return array|null $modules
     */
    public function autoload(): ?array {
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
        // Init Module
        require_once $moduleFile;
        $module = new $className();
        $module->name = $moduleName;
        $module->methods = get_class_methods($module);

        return $module;
    }

    /**
     * Get specific module & init this.
     *
     * @param string $query
     * @return object $module
     */
    public function get(string $query): object {
        foreach ($this->modules as $module):
            if ($query == $module->name):
                return $module;
            endif;
        endforeach;
        throw new Exception("Module [".$className."] not found in [".$this->config->getModulesDir().$className.".php] with namespace [".\rtrim($this->config->getNamespace(), "\\")."]", 1);
    }

    public function getModules(): ?array {
        return $this->modules;
    }
}
