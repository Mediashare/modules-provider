<?php
namespace Mediashare\Modules;

class Hello2
{
    public $suffix;
    public function echo(?string $message) {
        if (empty($message)):
            $message = "Not message recorded :(";
        endif;
        $message = $message . $this->suffix;
        echo $message;
        return $message;
    }
}
