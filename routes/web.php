<?php

use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\TestController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/{slug}', [FrontPageController::class, 'index']);
Route::get('/', [FrontPageController::class, 'index']);
Route::get('/index', [FrontPageController::class, 'index']);
Route::get('/about', [FrontPageController::class, 'about']);
Route::get('/contact', [FrontPageController::class, 'contact']);

Route::get('/category/{slug}', [CategoryPostController::class, 'index']);
Route::get('/post/{slug}', [CategoryPostController::class, 'show'])->name('post.show');




Route::get('/record', function () {
    return view('record-file');
});
Route::post('/record', [TestController::class, 'store'])->name('test.store');

Route::get('/test', function () {
    return Post::popularPosts();

});
