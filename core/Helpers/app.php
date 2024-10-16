<?php

use App\App;

if (!function_exists('app')) {
    function app($abstract = null)
    {
        $container = App::getContainer();
        if (is_null($abstract)) {
            return $container;
        }
        return $container->make($abstract);
    }
}
