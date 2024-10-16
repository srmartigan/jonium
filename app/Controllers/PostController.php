<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller\Controller;
use Core\Http\Request;
use Core\orm\DB;

class PostController extends Controller
{

    public function show(Request $request)
    {
        $db = DB::getDB();
        $sql = "SELECT * FROM users";
        $result = $db->query($sql);
        $user = $result->fetch();


       $id = $user['id'] ?? null;
       $slug = $user['email'] ?? null;



        $post = true;
        if ($post) {
            $this->View('post',
                [
                    'title' => 'POST',
                    'id' => $user['id'] ?? null,
                    'name' => 'name',
                    'email' => $user['email'] ?? null,
                    'password' => $user['password'] ?? null,
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
