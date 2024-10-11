<?php

namespace Core\orm;

abstract class ORM
{
    static function find($id)
    {
        // Aqui introduciremos la logica de buscar en la base de datos mientras retornamos datos fakes

        return self::dateFakes($id);
    }

    private static function dateFakes($id)
    {
        return [
            'id' => $id,
            'name' => 'Persona Prueba',
            'email' => 'emailPrueba@email',
            'password' => '12345678',
            'created_at' => '2020-01-01 00:00:00',
            'updated_at' => '2020-01-01 00:00:00'
        ];
    }
}
