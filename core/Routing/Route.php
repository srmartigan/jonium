<?php



namespace Core\Routing;
use Core\Exceptions\RouterException;
use Core\Http\Request;
use Illuminate\Contracts\Container\BindingResolutionException;

enum HttpMethod: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
    case PATCH = 'PATCH';
}

class Route
{
    static array $url = [];

    static array $routes = [];
    protected string $uri;
    protected string $regex;
    protected array $action;
    protected array $parameters;

    public function __construct($uri, $action){
        $this->uri = $uri;
        $this->action = $action;
        $this->regex = preg_replace('/\{(.*?)}/', '(?P<$1>[^/]+)', $uri);
        preg_match_all('/\{(.*?)}/', $uri, $parameters);
        $this->parameters = $parameters[1];
        static::$routes[] = $this;
    }

    public static function loadRoutes(): void
    {
        require_once ROOT_PATH . '/routes/web.php';
    }

    /**
     * @throws RouterException
     */
    private static function route(string $methodHtml, string $uri, $controller):void
    {
        $methodHtml = strtoupper($methodHtml);

        if($methodHtml !=  HttpMethod::FROM($methodHtml)->value){
            throw new RouterException("El methodHtml especificado no es valido");
        }
        [$class, $method] = $controller;
        if (!class_exists($class)) {
            throw new RouterException(" El controlador $class no existe");
        }
        if (!method_exists($class, $method)) {
            throw new RouterException("El metodo: $method del controlador $class no exite");
        }

        if (isset(self::$url[$methodHtml][$uri])) {
            throw new RouterException("La ruta $uri ya existe");
        }

        self::$url[$methodHtml][$uri] = [$class, $method];
    }

    /**
     * Obtiene información de la ruta basada en la URI y el método de solicitud proporcionados.
     *
     * @param string $requestUri La URI de la solicitud a coincidir con las rutas registradas.
     * @param mixed $requestMethod El método de solicitud (GET, POST, etc.) a coincidir con las rutas registradas.
     * @return void
     * @throws RouterException Si el método del controlador en la ruta coincidente no se encuentra.
     */
    public static function GetRouteInfo(string $requestUri, mixed $requestMethod)
    {

        $found = false;

        foreach (self::$url[$requestMethod] as  $uri => $controller) {

            $routePattern = preg_replace('#\{([a-zA-Z0-9_]+)\?}#', '([a-zA-Z0-9_]+)?', $uri);
            $routePattern = preg_replace('#\{([a-zA-Z0-9_]+)}#', '([a-zA-Z0-9_]+)', $routePattern);
            $routePattern = self::cambiarPrimeraBarra($routePattern);
            $routePattern = '#^' .$routePattern . '$#';

            if (preg_match($routePattern, $requestUri, $matches)) {
                array_shift($matches);

                [$class, $method] = $controller;

                preg_match_all('/\{(.*?)}/', $uri, $parameters);

                $parameters = str_replace('?','',$parameters[1]);

                /*
               $parameters: Contiene los nombres de los parámetros definidos en la ruta, almacenados en un array.
               $matches: Contiene los valores de los parámetros coincidentes obtenidos de la URI actual.
               $newParameters: Array que se crea para asociar cada nombre de parámetro con su valor correspondiente,
                               combinando los arrays $parameters y $matches. */
                $newParameters = [];
                for($i = 0; $i < count($parameters); $i++){
                    $newParameters[$parameters[$i]] = $matches[$i];
                }

                $request = app()->make(Request::class,$newParameters);

                // Resolver el controlador utilizando el container

                $ctrl = app()->make($class);
                $ctrl->$method($request);


                $found = true;
                break;
            }
        }

        if (!$found) {
            header("HTTP/1.0 404 Not Found");
            echo "404 - Página no encontrada.";
        }
    }

    /**
     * @throws RouterException
     */
    public static function getRoutes(): array
    {
        try {
            if (empty(self::$url)) {
                self::loadRoutes();
            }
        }catch (\Throwable $th){
            throw new RouterException("No se pudo cargar las rutas");
        }

        return self::$url;
    }

    /**
     * @throws RouterException
     */
    public static function get($uri, $controller)
    {
       self::route(HttpMethod::GET->value, $uri, $controller);
    }

    /**
     * @throws RouterException
     */
    public static function post($uri, $controller): void
    {
        self::route(HttpMethod::POST->value, $uri, $controller);
    }

    private static function cambiarPrimeraBarra($cadena) {
        if (substr($cadena, 0, 1) === '/') {
            return substr($cadena, 1);
        }
        return $cadena;
    }
}
