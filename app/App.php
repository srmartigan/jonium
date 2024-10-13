<?php

namespace App;

use Core\Exceptions\RouterException;
use Core\Routing\Route;
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
        //Cargar Rutas del fichero routes/web.php
        Route::loadRoutes();

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

    /**
     * @throws RouterException
     */
    public function init($server)
    {
        $requestUri    = trim($server['REQUEST_URI'], '/');
        $requestMethod = $server['REQUEST_METHOD'];

        Route::GetRouteInfo($requestUri, $requestMethod);




    }

    public function render($view, $data = [])
    {
        echo $this->blade->render($view, $data);
    }


}
