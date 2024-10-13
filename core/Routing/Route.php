<?php



namespace Core\Routing;
use Core\Exceptions\RouterException;

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

                $controllerInstance = new $class() ;
                if (method_exists($controllerInstance, $method)) {
                    call_user_func_array([$controllerInstance, $method], $matches);
                } else {
                    throw new RouterException('Metodo no encontrado');
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

    public static function getRoutes(): array
    {
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
