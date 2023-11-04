<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/register', [LandingController::class, 'formRegister'])->name('form_register');
Route::post('/send-register', [AuthController::class, 'register'])->name('send_register');
Route::get('/login', [LandingController::class, 'formLogin'])->name('login');
Route::post('/send-login', [AuthController::class, 'login'])->name('send_login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::group(['middleware' => 'auth', 'prefix' => 'article'], function () {
    Route::get('/', [ArticleController::class, 'index'])->name('article');
    Route::get('/create', [ArticleController::class, 'formArticle'])->name('form_article');
    Route::post('/create-article', [ArticleController::class, 'createArticle'])->name('create_article');
    Route::put('/update/{article}', [ArticleController::class, 'updateArticle'])->name('update_article');
    Route::post('/delete/{article}', [ArticleController::class, 'deleteArticle'])->name('delete_article');
    Route::get('/detail/{article}', [ArticleController::class, 'seeArticle'])->name('see_article');
    Route::post('/like/{article}', [ArticleController::class, 'likeArticle'])->name('like_article');
    Route::get('/edit/{article}', [ArticleController::class, 'editArticle'])->name('edit_article');
    Route::get('/{article}', [ArticleController::class, 'detail'])->name('detail_article');
    Route::post('/comment/{article}', [ArticleController::class, 'sendComment'])->name('comment_article');
    Route::post('/{article}/like/{comment}', [ArticleController::class, 'likeComment'])->name('like_comment');
});
