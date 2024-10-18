<?php

require 'vendor/autoload.php';

use Core\orm\DB;
use Symfony\Component\Console\Application;
use Core\Command\RouteListCommand;
use Core\Command\MigrateCommand;

// Define el path absoluto a la carpeta del proyecto
define('ROOT_PATH', realpath(dirname(__FILE__)));
$config = require 'config/config.php';
//Iniciar Base de Datos
DB::InitDatabase($config);

$application = new Application();

// Registrar el comando
$application->add(new RouteListCommand());
$application->add(new MigrateCommand());

$application->run();
