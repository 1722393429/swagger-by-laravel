<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$router->get('post/lists', 'PostController@lists');
$router->group(['prefix' => 'post', 'middleware' => 'auth:api'], function ($router) {
    $router->post('store', 'PostController@store');
    $router->put('update/{post_id}', 'PostController@update');
    $router->delete('destroy/{post_id}', 'PostController@destroy');
});