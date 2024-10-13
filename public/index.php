<?php

use App\App;


ini_set('display_errors', 1);
error_reporting(E_ALL);


// Define el path absoluto a la carpeta del proyecto
define('ROOT_PATH', realpath(dirname(__DIR__)));

// Autocarga de clases de tu aplicación
require_once ROOT_PATH . '/vendor/autoload.php';

// Inicialización de la aplicación
$app = new App();

// Maneja la solicitud actual
$app->init($_SERVER);



