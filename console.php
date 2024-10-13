<?php

require 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Core\Command\RouteListCommand;

// Define el path absoluto a la carpeta del proyecto
define('ROOT_PATH', realpath(dirname(__FILE__)));

$application = new Application();

// Registrar el comando
$application->add(new RouteListCommand());

$application->run();
