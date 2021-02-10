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

    $menu = $articles->mapWithKeys(function (\App\Models\Article $article) {
        return [$article->slug => $article->title];
    });

    if (isset($menu['barokni-a-klasicistni-kresba-z-ceskych-zemi'])) {
        $menu['barokni-a-klasicistni-kresba-z-ceskych-zemi'] = "Barokní a klasicistní kresba\nz českých zemí";
    }

    if (isset($menu['graficky-kabinet-evropska-grafika-a-kresba-15-18-stoleti'])) {
        $menu['graficky-kabinet-evropska-grafika-a-kresba-15-18-stoleti'] = "Grafický kabinet\nEvropská grafika\na kresba 15.–18. století";
    }

    return view('homepage', compact('articles', 'menu'));
})->name('homepage');

Route::get('katalog', function () {
    return view('catalog');
})->name('catalog');

Route::get('{article:slug}', function (\App\Models\Article $article) {
    $template = $article->slug === 'o-vystave' ? 'about' : 'article';
    return view($template, compact('article'));
})->name('article');

Route::get('detail/{item:id}', function (\App\Models\Item $item) {
    return view('detail', compact('item'));
})->name('detail');

Route::get('zoom/{item:id}', function (\App\Models\Item $item) {
    return view('zoom', compact('item'));
})->name('zoom');

