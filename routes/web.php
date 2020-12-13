<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function () {
    return view('about');
});

Route::get('detail/{id}', function ($id) {
    return view('detail', compact('id'));
});

Route::get('article/{article:slug}', function (\App\Models\Article $article) {
    if ($article->parent) {
        abort(404);
    }

    return view('article', compact('article'));
})->name('article');
