<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\InvokeController;
use App\Http\Controllers\ProductController;

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


Route::resource('/products',ProductController::class]);

Route::get('/', function () {
    Log::channel('custom')->info('this is a custom message');
    Log::channel('daily')->info('this is a custom message for 14 days');
    Log::channel('emergency')->info('this is a emergency message');
    return view('welcome');
});


//whereNumber
//whereIn
route::get('/test/{item?}',
    [App\Http\Controllers\TestController::class, 'test'])
    ->whereAlphaNumeric('item');

route::get('pattern/{id}', function($id) {
    echo $id;
})->where('id', '[0-9]+');

route::get('/test2', function(Request $request) {
  echo $request->boolean('id');
});


Route::get('/segments/{department}/{id}', function(Request $request){

    echo "<pre>";
    print_r($request->segments());
});


Route::get('/segment/{department}/{id}', function(Request $request){

    echo "<pre>";
    echo $request->segment(1) . '<br>';
    echo $request->segment(2) . '<br>';
    echo $request->segment(3);
});

Route::match(['get', 'post'], '/any', function (Request $request) {

    if($request->isMethod('get')) {
        echo 'get method';
    }else {
        echo 'post';
    }

});

Route::any('/any2', function (Request $request) {

    if($request->isMethod('get')) {
        echo 'get method 2';
    }else {
        echo 'post 2';
    }

});

Route::redirect('/here', '/there');
Route::redirect('/here2', '/there',301);
Route::permanentRedirect('/here3', '/there');


Route::get('/user/{department}/{id?}', function ( $department, $id) {
    echo $id . ' ' . $department;
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

Route::get('/search/{search}', function ($search) {
    echo $search;
})->where('search', '.*');


Route::get('provider/{id}', function ($id) {
    echo $id;
});

//php artisan cmd : php artisan make  controller:InvokeController --invokable
Route::get('invoke', InvokeController::class);




