<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Item;

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

Route::get('items/{id}', function (Request $request, $id) {
    $items = Item::idsSearch()
        ->values([(string)$id])
        ->postFilter('term', ['gallery' => config('app.gallery')])
        ->execute();

    if (!$items->total()) {
        abort(404);
    }

    return response()->json($items->matches()->first());
});

Route::get('items', function (Request $request) {
    $sort = (array)$request->get('sort');
    $perPage = (int)$request->get('size', 1);
    $set = (string)$request->get('set');
    $category = (string)$request->get('category');
    $order = (array)$request->get('order');

    if (!$set && !$category) {
        abort(404);
    }

    $builder = Item::boolSearch()
        ->filter('term', ['gallery' => config('app.gallery')]);

    if ($set) {
        $builder->filter('term', ['additionals.set.keyword' => $set]);
    }

    if ($category) {
        $builder->filter('term', ['additionals.category.keyword' => $category]);
    }

    $range = [];
    if (isset($order['lt'])) {
        $range['lt'] = (int)$order['lt'];
    }
    if (isset($order['gt'])) {
        $range['gt'] = (int)$order['gt'];
    }
    if ($range) {
        $builder->filter('range', ['additionals.order' => $range]);
    }

    if (!$sort) {
        $sort['additionals.order'] = 'asc';
    }
    $sortFields = ['additionals.order'];
    $directions = ['asc', 'desc'];
    foreach ($sort as $field => $direction) {
        if (in_array($field, $sortFields) &&
            in_array($direction, $directions)) {
            $builder->sort($field, $direction);
        }
    }

    $items = $builder->paginate($perPage);

    return response()->json($items);
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
