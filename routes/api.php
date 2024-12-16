<?php

use App\Http\Controllers\Api\HomePageController;
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

Route::get('get-posts-index', [HomePageController::class, 'getPostForIndex'])->name('get-posts-index-api');
Route::get('get-posts-ebook', [\App\Http\Controllers\Api\EbookController::class, 'getPost'])->name('get-posts-ebook-api');
Route::get('ranking', [HomePageController::class, 'getRanking'])->name('ranking-api');
//Route::get('ranking/{serverId}', [HomePageController::class, 'ranking'])->name('ranking-api');

