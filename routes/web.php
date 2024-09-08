<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');

Route::get('/categories/{category}/news',
    [CategoryController::class, 'showNews'])->name('categories.news');

Route::get('/category/{id}/news', [CategoryController::class, 'showCategoryNews'])->name('category.news');



Route::middleware(['auth'])->group(function () {

    Route::get('/category-list', [\App\Http\Controllers\CategoryController::class, 'showCategoryList'])->name('category.list');

});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::resource('categories', CategoryController::class);


Route::resource('news', NewsController::class);
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/categories/{category}/news',
    [CategoryController::class, 'showNews'])->name('categories.news');

Route::get('/category-list', [CategoryController::class, 'showCategoryList'])->name('frontend.categoryList');

Route::get('/category/{id}/news', [CategoryController::class, 'showCategoryNews'])->name('category.news');

Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');


require __DIR__.'/auth.php';

Route::get('/category-list', [CategoryController::class, 'showCategoryList'])->name('frontend.categoryList');

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::group(['middleware' => ['superAdmin']], function () {
        Route::resource('Admins', AdminController::class);
        Route::get('/admin', [AdminController::class, 'index'])->name('admins.index');
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('/admin/store', [AdminController::class, 'store'])->name('admins.store');

    });

    Route::resource('categories', CategoryController::class);


    Route::resource('news', NewsController::class);

});

