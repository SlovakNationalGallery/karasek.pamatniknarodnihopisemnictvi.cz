<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('articles', function (Request $request) {
    $set = (string)$request->get('set');
    $perPage = (int)$request->get('size', 1);

    $where = compact([
        'set',
    ]);
    $articles = \App\Models\Article::where($where)
        ->paginate($perPage);

    return response()->json($articles);
});

Route::get('collections', function (Request $request) {
    $category = (string)$request->get('category');
    $perPage = (int)$request->get('size', 1);

    $where = compact([
        'category',
    ]);
    $collections = \App\Models\Collection::with('article')
        ->where($where)
        ->paginate($perPage);

    return response()->json($collections);
});
