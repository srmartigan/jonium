<?php

namespace Core\orm;

abstract class ORM
{
    protected string $createdAt;
    protected string $updatedAt;
    protected string $deletedAt;

    static function find($id)
    {
        //obtener la clase padre
        $class = get_called_class();
        $table = self::getTable($class);

        // Aqui introduciremos la logica de buscar en la base de datos mientras retornamos datos fakes
        $model = DB::runQuery("SELECT * FROM $table WHERE id = $id");

        $model = $model->fetch();
        if ($model === false) { return null;}

        $instanceClass = new $class($model);
        $instanceClass->createdAt = $model['created_at'];

        return $instanceClass ?: null;
    }

    static function all()
    {
        //Obtener clase padre y el nombre de la tabla
        $class = get_called_class();
        $table = self::getTable($class);

        //Realizamos la query e instanciamos los modelos
        $model = DB::runQuery('SELECT * FROM '.$table);
        $model = $model->fetchAll();
        $instances = [];
        foreach ($model as $item) {
            $instanceClass = new $class($item);
            $instanceClass->createdAt = $item['created_at'];
            $instances[] = $instanceClass;
        }
        return $instances;
    }
    static function pluralize(string $word): string {
        // Lista de reglas simples para la pluralización
        $pluralRules = [
            '/(quiz)$/i'               => "$1zes",
            '/^(ox)$/i'                => "$1en",
            '/([m|l])ouse$/i'          => "$1ice",
            '/(matr|vert|ind)ix|ex$/i' => "$1ices",
            '/(x|ch|ss|sh)$/i'         => "$1es",
            '/([^aeiouy]|qu)y$/i'      => "$1ies",
            '/(hive)$/i'               => "$1s",
            '/(?:([^f])fe|([lr])f)$/i' => "$1$2ves",
            '/(shea|lea|loa|thie)f$/i' => "$1ves",
            '/sis$/i'                  => "ses",
            '/([ti])um$/i'             => "$1a",
            '/(tomat|potat|ech|her|vet)o$/i' => "$1oes",
            '/(bu)s$/i'                => "$1ses",
            '/(alias)$/i'              => "$1es",
            '/(octop)us$/i'            => "$1i",
            '/(ax|test)is$/i'          => "$1es",
            '/(us)$/i'                 => "$1es",
            '/s$/i'                    => "s",
            '/$/'                      => "s"
        ];

        foreach ($pluralRules as $rule => $replacement) {
            if (preg_match($rule, $word, $matches)) {
                return preg_replace($rule, $replacement, $word);
            }
        }

        return $word;
    }

    /**
     * @param string $class
     * @return string
     */
    public static function getTable(string $class): string
    {
        $table = basename(str_replace('\\', '/', $class));
        $table = static::pluralize($table);
        return $table;
    }

    public static function where($column, $value)
    {
        $class = get_called_class();
        $table = self::getTable($class);

        $query = DB::runQuery("SELECT * FROM $table WHERE $column = $value");
        $model = $query->fetchAll();
        $instances = [];
        foreach ($model as $item) {
            $instanceClass = new $class($item);
            $instanceClass->createdAt = $item['created_at'];
            $instances[] = $instanceClass;
        }
        return $instances;
    }

    public static function whereLike($column, $value)
    {
        $class = get_called_class();
        $table = self::getTable($class);

        $query = DB::runQuery("SELECT * FROM $table WHERE $column LIKE '%$value%'");
        $model = $query->fetchAll();
        $instances = [];
        foreach ($model as $item){
            $instanceClass = new $class($item);
            $instanceClass->createdAt = $item['created_at'];
            $instances[] = $instanceClass;
        }
        return $instances;
    }

    public static function first()
    {

    }
}
