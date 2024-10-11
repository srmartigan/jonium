<?php

namespace App\Models;



use Core\orm\ORM;

class User extends ORM
{
    public $id;
    public $name;
    public $email;
    public $password;

    private function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public static function getId($id = null) : User|null
    {
        if (is_null($id)) { return null; }

        $data = self::find($id);
        return new self($data);
    }

}
