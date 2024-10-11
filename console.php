<?php

require 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Core\Command\RouteListCommand;

$application = new Application();

// Registrar el comando
$application->add(new RouteListCommand());

$application->run();
