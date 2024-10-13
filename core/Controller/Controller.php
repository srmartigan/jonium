<?php

namespace Core\Controller;

use App\App;

class Controller
{
    protected $app;

    public function __construct()
    {
        $config = require ROOT_PATH . '/config/config.php';
        $this->app = new App($config);
    }

    protected function View(string $view, array $data = []): void
    {
        $this->app->render($view, $data);
    }

}
