<?php

namespace App;

use Core\Controller\Controller;
use Core\Exceptions\RouterException;
use Core\Http\Request;
use Core\Routing\Route;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\CircularDependencyException;
use Jenssegers\Blade\Blade;
use Spatie\Ignition\Ignition;

class App
{
    protected static $container;
    protected $config = [];
    protected $blade;


    /**
     * @throws CircularDependencyException
     * @throws BindingResolutionException
     */
    public function __construct()
    {

        // Incluye el archivo de configuración
        $configPath = ROOT_PATH . '\config\config.php';
        $this->config = require $configPath;


        // Inicializa el contenedor de Laravel
        if (!self::$container) {
            self::$container = new Container;
        }
        self::$container->instance('app', $this);
        self::$container->singleton(Request::class, function ($container, $params){

            return new Request($params);
        });


        //Cargar Rutas del fichero routes/web.php
        Route::loadRoutes();

        // Define las rutas a las vistas y la caché de Blade
        $views = ROOT_PATH . '/resources/views';
        $cache = ROOT_PATH . '/storage/cache';

        // Inicializa Blade
        $this->blade = new Blade($views, $cache, self::getContainer());

        // Configurar Ignition

        if ( $this->config["env"] != 'production') {
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

    public static function getContainer(): Container
    {
        return self::$container;
    }


}
