<?php
namespace Mediashare\Modules;

class Hello
{
    public $prefix;
    public $message = "Not message recorded :( \n";
    public function run() {
        dump("Helloqsdkqmsldk");
        $this->echo();
        return $this;
    }
    public function echo(?string $message = null) {
        if (!empty($message)):
            $this->message = $message;
        endif;
        $message = $this->prefix . $message;
        echo $message;
        return $message;
    }
}
