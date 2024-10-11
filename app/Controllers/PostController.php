<?php

namespace App\Controllers;


use App\App;
use App\Models\User;

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
       $user = User::getId($id);

        $post = true;
        if ($post) {
            $this->app->render('home',
                [
                    'title' => 'Hola mundo jonium',
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => $user->password,
                    'slug' => 'hola-mundo-jonium',
                ]);
        } else {
            $this->app->render('errors.404');
        }
    }

    public function create()
    {
        $this->app->render('post.create');
    }
}
