<?php

namespace App;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Jenssegers\Blade\Blade;
use Spatie\Ignition\Ignition;

class App
{
    protected $config;
    protected $blade;

    public function __construct($config)
    {
        $this->config = $config;
        require_once ROOT_PATH . '/core/helpers.php';

        // Inicializa el contenedor de Laravel
        $container = new Container();

        // Registrar dependencias en el contenedor
        $container->singleton('files', function () {
            return new Filesystem();
        });

        $container->singleton('events', function ($container) {
            return new Dispatcher($container);
        });

        // Define las rutas a las vistas y la caché de Blade
        $views = ROOT_PATH . '/resources/views';
        $cache = ROOT_PATH . '/storage/cache';

        // Inicializa Blade
        $this->blade = new Blade($views, $cache, $container);

        // Configurar Ignition
        if ($config['env'] !== 'production') {
            Ignition::make()
                ->register();
            //Configurar ruta de la aplicación
            Ignition::make()
                ->applicationPath(ROOT_PATH)
                ->register();

        }

    }

    public function init($server)
    {
        $requestUri = trim($server['REQUEST_URI'], '/');
        $requestMethod = $server['REQUEST_METHOD'];

        $routes = require_once ROOT_PATH . '/routes/web.php';

        $found = false;

        foreach ($routes as $route => $action) {
            $routePattern = preg_replace('#\{([a-zA-Z0-9_]+)\?\}#', '([a-zA-Z0-9_]+)?', $route);
            $routePattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([a-zA-Z0-9_]+)', $routePattern);
            $routePattern = '#^' . $routePattern . '$#';

            if (preg_match($routePattern, $requestUri, $matches)) {
                array_shift($matches);

                [$controller, $method] = $action;

                $controllerInstance = new $controller($this);
                if (method_exists($controllerInstance, $method)) {
                    call_user_func_array([$controllerInstance, $method], $matches);
                } else {
                    echo "Método no encontrado.";
                }

                $found = true;
                break;
            }
        }

        if (!$found) {
            header("HTTP/1.0 404 Not Found");
            echo "404 - Página no encontrada.";
        }
    }

    public function render($view, $data = [])
    {
        echo $this->blade->render($view, $data);
    }
}
