<?php
namespace Mediashare\ModulesProvider;

/**
 * Config
 * @param string $modulesDir Modules path.
 * @param string $namespace Modules namespace used for instancied class.
 */
class Config {
    public $modulesDir;
    public $namespace;
    public $modules = null; // If null then enable all modules from $modulesDir

    public function getModulesDir(): ?string
    {
        if (!$this->modulesDir):
            $this->modulesDir = __DIR__."/modules/";
        endif;
        return $this->modulesDir;
    }

    public function setModulesDir(string $modulesDir): self
    {
        $this->modulesDir = $modulesDir;
        return $this;
    }

    public function getNamespace(): ?string
    {
        if (!$this->namespace):
            $this->namespace = "Mediashare\\Modules\\";
        endif;
        return rtrim(rtrim($this->namespace,'\\'), "\\").'\\';
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function getModules(): ?array
    {
        return $this->modules;
    }

    public function setModules(array $modules): self
    {
        $this->modules = $modules;
        return $this;
    }

    public function addModule(string $module): self
    {
        $this->modules[] = $module;
        return $this;
    }

    public function removeModule(string $module): self
    {
        foreach ($this->getModules() as $index => $object) {
            if ($module == $object):
                unset($this->modules[$index]);
            endif;
        }
        return $this;
    }
}
