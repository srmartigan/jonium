<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller\Controller;
use Core\Http\Request;

class PostController extends Controller
{

    public function show(Request $request)
    {
       $id = $request->query('id');
       $slug = $request->query('slug') ?? null;
       $user = User::getId($id);


        $post = true;
        if ($post) {
            $this->View('post',
                [
                    'title' => 'POST',
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => $user->password,
                    'slug' => is_null($slug) ? 'jonium el mejora framework' : $slug,
                ]);
        } else {
            $this->View('errors.404');
        }
    }

    public function create()
    {
        $this->View('post.create');
    }

    public function store(){}
}
