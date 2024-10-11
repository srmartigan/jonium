<?php
return [
    ''                  => ['App\Controllers\HomeController', 'index'],
    'about'             => ['App\Controllers\HomeController', 'about'],
    'contact'           => ['App\Controllers\HomeController', 'contact'],
    'post/{id}'         => ['App\Controllers\PostController', 'show'], // Ruta con parámetro {id}
    'post/{id}/{slug?}' => ['App\Controllers\PostController', 'show'], // Ruta con parámetro {id} y {slug} opcional
];
