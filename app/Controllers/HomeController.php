<?php

namespace App\Controllers;

class HomeController
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
    public function index()
    {
        echo'Bienvenido a Jonium ';
    }

    public function about()
    {
        nhjkh
        echo 'Pagina de Información sobre Jonium';
    }

    public function contact()
    {
        echo 'Pagina de Contacto';
    }

}
