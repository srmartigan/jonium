<?php

/**
 * Muestra el contenido de la variable de forma legible.
 *
 * @param  mixed  $var
 * @return void
 */
//function dump($var)
//{
//    echo "<pre>";
//    echo json_encode($var, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
//    echo "</pre>";
//}

/**
 * Dump the given variables and stop the script.
 *
 * @param  mixed  ...$args
 * @return void
 */
//function dd(...$args)
//{
//    foreach ($args as $x) {
//        dump($x);
//    }
//
//    die(1);
//}

function response($data, $status = 200)
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
}
