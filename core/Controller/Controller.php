<?php

namespace Core\Controller;

use App\App;


class Controller
{
    protected $app;


    public function __construct()
    {
        $this->app = new App();

    }

    protected function View(string $view, array $data = []): void
    {
        $this->app->render($view, $data);
    }

}
