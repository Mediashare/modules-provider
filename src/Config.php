<?php
namespace Mediashare\ModulesProvider;

/**
 * Config
 */
class Config {
    public $modulesDir;
    public $namespace;

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
            $this->namespace = "Mediashare\\ModulesProvider\\Modules\\";
        endif;
        return rtrim(rtrim($this->namespace,'\\'), "\\").'\\';
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;
        return $this;
    }
}
