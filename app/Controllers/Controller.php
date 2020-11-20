<?php

namespace App\Controllers;

use Noodlehaus\Config;
use Jenssegers\Blade\Blade;

class Controller
{
    public function config()
    {
        return Config::load(__DIR__ . "/../../config/app.php");
    }

    public function view($path, $args = [])
    {
        $blade = new Blade(__DIR__ . "/../../resources/views", __DIR__ . "/../../storage/views");
        echo $blade->render($path, $args);
    }

    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return $this->{$key}();
        }
    }
}
