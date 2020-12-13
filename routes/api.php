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
        ->values([$id])
        ->postFilter('term', ['gallery' => config('app.gallery')])
        ->execute();

    if (!$items->total()) {
        abort(404);
    }

    return response()->json($items->matches()->first());
});

Route::get('items', function (Request $request) {
    $sort = $request->get('sort', 'additionals.order');
    $perPage = $request->get('size', 1);
    $category = $request->get('category');

    if (!$category) {
        abort(404);
    }

    $builder = Item::boolSearch()
        ->filter('term', ['gallery' => config('app.gallery')])
        ->filter('term', ['additionals.category.keyword' => $category]);

    if ($sort !== null) {
        $builder->sort($sort);
    }

    $items = $builder->paginate($perPage);

    return response()->json($items);
});
