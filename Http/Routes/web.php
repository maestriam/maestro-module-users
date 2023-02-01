<?php

use Illuminate\Support\Facades\Route;
use Maestro\Users\Views\Components\UserView;
use Maestro\Users\Views\Pages\UserIndex;
use Maestro\Users\Views\Pages\UserEdition;

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

Route::prefix('users')->group(function () {
    Route::get('/', UserIndex::class)->name('maestro.users.index');
    Route::get('/create', UserEdition::class)->name('maestro.users.create');
    Route::get('/{id}/edit', UserEdition::class)->name('maestro.users.edit');
    Route::get('/{id}/view', UserView::class)->name('maestro.users.view');
});

