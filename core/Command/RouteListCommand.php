<?php

namespace Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Core\Routing\Route;

class RouteListCommand extends Command
{
    // Nombre del comando
    protected static $defaultName = 'route:list';

    protected function configure()
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription('Lista todas las rutas registradas con sus controladores')
            ->setHelp('Este comando te permite ver todas las rutas de la aplicación junto con sus controladores...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Obtener todas las rutas registradas
        $routes = Route::getRoutes();

        // Encabezado de la tabla
        $output->writeln("Method | URI | Name | Action");
        $output->writeln(str_repeat('-', 60));

        foreach ($routes as $route) {

            [$controller, $show] = $route->action();
            $method = 'GET'; //TODO: hay que añadir a las rutas el metodo y que salga en la consola.
            $uri = $route->uri();
            $name = $controller;
            $action = $show;

            $output->writeln("{$method} | {$uri} | {$name} | {$action}");
        }

        return Command::SUCCESS;
    }
}
