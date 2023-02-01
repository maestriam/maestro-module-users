<?php

use Illuminate\Support\Facades\Route;
use Maestro\Users\Views\Pages\UserView;
use Maestro\Users\Views\Pages\UserIndex;
use Maestro\Users\Views\Pages\UserForm;

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


Route::get('/home', 'AdminController@home')->name('maestro.admin.home');
Route::get('/login', 'AdminController@login')->name('maestro.admin.login');
Route::get('/logout', 'AdminController@logout')->name('maestro.admin.logout');


Route::prefix('users')->group(function () {
    Route::get('/', UserIndex::class)->name('maestro.users.index');
    Route::get('/create', UserForm::class)->name('maestro.users.create');
    Route::get('/{id}/edit', UserForm::class)->name('maestro.users.edit');
    Route::get('/{id}/view', UserView::class)->name('maestro.users.view');
});

