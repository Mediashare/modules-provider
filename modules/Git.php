<?php
namespace Mediashare\Modules;

class Git
{
    public $message = "CodeReview";
    private $output = [];
    public function run() {
        $this->add();
        $this->commit();
        $this->push();
        return $this;
    }
    public function shell(string $command) {
        $this->output[$command] = \shell_exec($command);
        return $this;
    }
    public function add() {
        $this->shell('git add .');
        return $this;
    }
    public function commit(?string $message = null) {
        if (!$message):
            $message = $this->message;
        endif;
        $this->shell('git commit -a -m "'.$message.'"');
        return $this;
    }
    public function push() {
        $this->shell('git push');
        return $this;
    }
}
