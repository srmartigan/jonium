<?php

use App\App;

ini_set('display_errors', 1);
error_reporting(E_ALL);


// Define el path absoluto a la carpeta del proyecto
define('ROOT_PATH', realpath(dirname(__DIR__)));

// Autocarga de clases de tu aplicación
require_once ROOT_PATH . '/vendor/autoload.php';

// Carga del archivo de configuración
$config = require_once ROOT_PATH . '/config/config.php';

// Inicialización de la aplicación
$app = new App($config);

// Maneja la solicitud actual
$app->init($_SERVER);



