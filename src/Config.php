<?php
namespace Mediashare\ModulesProvider;

/**
 * Config
 * @param string $modulesDir Modules path.
 * @param string $namespace Modules namespace used for instancied class.
 * @param string $verbose Event output.
 */
class Config {
    public $modulesDir;
    public $namespace;
    public $verbose = false;

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

    public function getVerbose(): ?bool
    {
        return $this->verbose;
    }

    public function setVerbose(bool $verbose): self
    {
        $this->verbose = $verbose;
        return $this;
    }
}
