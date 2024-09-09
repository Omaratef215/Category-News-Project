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

Route::get('/temp_categories/{category}/temp_news',
    [CategoryController::class, 'showNews'])->name('temp_categories.temp_news');

Route::get('/category/{id}/temp_news', [CategoryController::class, 'showCategoryNews'])->name('category.temp_news');



Route::middleware(['auth'])->group(function () {

    Route::get('/category-list', [\App\Http\Controllers\CategoryController::class, 'showCategoryList'])->name('category.list');

});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::resource('temp_categories', CategoryController::class);


Route::resource('temp_news', NewsController::class);
Route::get('/temp_news/{id}', [NewsController::class, 'show'])->name('temp_news.show');
Route::get('/temp_categories/{category}/temp_news',
    [CategoryController::class, 'showNews'])->name('temp_categories.temp_news');

Route::get('/category-list', [CategoryController::class, 'showCategoryList'])->name('temp_frontend.categoryList');

Route::get('/category/{id}/temp_news', [CategoryController::class, 'showCategoryNews'])->name('category.temp_news');

Route::get('/temp_news/{id}', [NewsController::class, 'show'])->name('temp_news.show');


require __DIR__.'/auth.php';

Route::get('/category-list', [CategoryController::class, 'showCategoryList'])->name('temp_frontend.categoryList');

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::group(['middleware' => ['superAdmin']], function () {
        Route::resource('temp_admins', AdminController::class);
        Route::get('/admin', [AdminController::class, 'index'])->name('temp_admins.index');
        Route::get('/admin/create', [AdminController::class, 'create'])->name('temp_admins.create');
        Route::post('/admin/store', [AdminController::class, 'store'])->name('temp_admins.store');

    });

    Route::resource('temp_categories', CategoryController::class);


    Route::resource('temp_news', NewsController::class);

});

