<?php
//return [
//    ''                  => ['App\Controllers\HomeController', 'index'],
//    'about'             => ['App\Controllers\HomeController', 'about'],
//    'contact'           => ['App\Controllers\HomeController', 'contact'],
//    'post/{id}'         => ['App\Controllers\PostController', 'show'], // Ruta con parámetro {id}
//    'post/{id}/{slug?}' => ['App\Controllers\PostController', 'show'], // Ruta con parámetro {id} y {slug} opcional
//];

use App\Controllers\PostController;
use App\Controllers\HomeController;
use Core\Routing\Route;


Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'home']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/post/{id}', [PostController::class, 'show']); //Ruta con un parámetro {id}
Route::get('/post/{id}/{slug?}', [PostController::class, 'show']); //Ruta con dos parámetros {id} y {slug} este opcional
