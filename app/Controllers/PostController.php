<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller\Controller;
use Core\Http\Request;

class PostController extends Controller
{
    protected User $user;

    public function show(Request $request)
    {
        $id = $request->query('id') ?? null;
        $slug = $request->query('slug') ?? null;


        if (!is_null($id))
        {
            /** @var User $user */
            $user = User::find($id);
//            $userAll = User::all();
//            $userWithPassword = User::whereLike('email','%@admin3.com');
//            $userWhere = User::where('password', '123456');
//            dd($userWhere);
        }

        $post = true;
        if ($post) {
            $this->View('post',
                [
                    'title' => 'POST',
                    'id' => $user->id ?? null,
                    'name' => $user->name ?? 'nombre por defecto',
                    'email' => $user->email ?? null,
                    'password' => $user->password ?? null,
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
