<?php

use App\App;

if (!function_exists('config')) {
    function config($abstract = null)
    {
        $config = require ('../../config/config.php');
        dd($config);
        if (is_null($abstract)) {
            return $config;
        }
        return $config->make($abstract);
    }
}
