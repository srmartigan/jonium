<?php



namespace Core\Routing;

class Route
{
    static array $routes = [];
    /**
     * URI defined in the format  `"/route/{param}"`.
     *
     *  @var string
     */
    protected string $uri;

    protected string $regex;
    protected array $action;

    protected array $parameters;

    public function __construct($uri, $action){
        $this->uri = $uri;
        $this->action = $action;
        $this->regex = preg_replace('/\{(.*?)\}/', '(?P<$1>[^/]+)', $uri);
        preg_match_all('/\{(.*?)\}/', $uri, $parameters);
        $this->parameters = $parameters[1];
        static::$routes[] = $this;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function action(): array
    {
        return $this->action;
    }
    public static function get($uri, $action)
    {
        new static($uri, $action);
    }

    public static function getRoutes(): array
    {
        static::loadRoutes();
        return static::$routes;
    }

    public static function loadRoutes()
    {
        require_once ROOT_PATH . '\Routes\web.php';
    }
}
