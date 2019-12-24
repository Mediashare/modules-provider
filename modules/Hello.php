<?php
namespace Mediashare\Modules;

class Hello
{
    public $prefix;
    public function run() {
        $this->echo();
        return $this;
    }
    public function echo(?string $message = null) {
        if (empty($message)):
            $message = "Not message recorded :( \n";
        endif;
        $message = $this->prefix . $message;
        echo $message;
        return $message;
    }
}
