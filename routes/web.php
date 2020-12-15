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

Route::get('', function () {
    $articles = \App\Models\Article::orderBy('lft')->get();
    return view('homepage', compact('articles'));
})->name('homepage');

Route::get('{article:slug}', function (\App\Models\Article $article) {
    return view('article', compact('article'));
})->name('article');

Route::get('detail/{item:id}', function (\App\Models\Item $item) {
    return view('detail', compact('item'));
})->name('detail');

Route::get('zoom/{item:id}', function (\App\Models\Item $item) {
    return view('zoom', compact('item'));
})->name('zoom');
