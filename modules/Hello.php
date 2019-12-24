<?php
namespace Mediashare\Modules;

class Hello
{
    public $prefix;
    public $message = "Not message recorded :( \n";
    public function run() {
        $this->echo();
        return $this;
    }
    public function echo(?string $message = null) {
        if (!empty($message)):
            $this->message = $message;
        endif;
        $message = $this->prefix . $this->message;
        echo $message;
        return $message;
    }
    public function setMessage(?string $message): self {
        $this->message = $message;
        return $this;
    }
}
