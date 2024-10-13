<?php

namespace Core\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Style\SymfonyStyle;
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
        $io = new SymfonyStyle($input, $output);
        // Obtener todas las rutas registradas
        $routes = Route::getRoutes();
        $formattedRoutes = [];

        // Formatear las rutas en una matriz apropiada para la tabla
        foreach ($routes as $method => $routeArray) {
            foreach ($routeArray as $uri => [$controller, $action]) {
                $formattedRoutes[] = [$method, $uri, $controller, $action];
            }
        }
        // Crear y mostrar la tabla
        $table = new Table($output);
        $table
            ->setHeaders(['Method', 'URI', 'Controller', 'Action'])
            ->setRows($formattedRoutes);

        $io->title('Listado de rutas');
        $table->render();

        return Command::SUCCESS;
//        // Encabezado de la tabla
//        $output->writeln("Method |      URI      | Name | Action");
//        $output->writeln(str_repeat('-', 60));
//
//        foreach ($routes as $key => $route) {
//            foreach ($route as $uri => $controller)
//            {
//
//                [$class, $method] = $controller;
//                $methodHtml = $key;
//                $uriConsole = $uri;
//                $name = $class;
//                $action = $method;
//
//                $output->writeln("{$methodHtml}    | {$uriConsole}           | {$name} | {$action}");
//            }
//        }
//
//        return Command::SUCCESS;
    }
}
