<?php
namespace Mediashare\Modules;

class Helloqsd
{
    public $prefix;
    public function echo(?string $message) {
        if (empty($message)):
            $message = "Not message recorded :(";
        endif;
        $message = $this->prefix . $message;
        echo $message;
        return $message;
    }
}
