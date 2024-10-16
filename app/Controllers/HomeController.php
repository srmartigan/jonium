<?php

namespace App\Controllers;

use Core\Controller\Controller;

class HomeController extends Controller
{

    public function index()
    {
        echo'Bienvenido a Jonium ';
    }

    public function home()
    {
        $this->View('home', ['title' => 'Home ']);
    }
    public function about()
    {
        echo 'Pagina de Información sobre Jonium';
    }

    public function contact()
    {
        echo 'Pagina de Contacto';
    }

}
