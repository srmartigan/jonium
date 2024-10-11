<?php

namespace App\Controllers;


use App\App;

class PostController
{
    protected $app;

    public function __construct()
    {
        $config = require ROOT_PATH . '/config/config.php';
        $this->app = new App($config);
    }

    public function show($id)
    {
        $post = true;
        if ($post) {
            return $this->app->render('home',
                [
                    'title' => 'Hola mundo jonium',
                    'id' => $id,
                    'slug' => 'hola-mundo-jonium',
                ]);
        } else {
            return $this->app->render('errors.404');
        }
    }

    public function create()
    {
        return $this->app->render('post.create');
    }
}
