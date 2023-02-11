<?php

use Illuminate\Support\Facades\Route;
use Maestro\Users\Views\Pages\UserView;
use Maestro\Users\Views\Pages\UserIndex;
use Maestro\Users\Views\Pages\UserForm;
use Maestro\Users\Views\Pages\UserHome;
use Maestro\Users\Views\Pages\UserLoginForm;


/*
|--------------------------------------------------------------------------
| Live Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes that used for Livewire view.  These
| routes are loaded by the RouteServiceProvider. 
| Now create something great!
*/


Route::get('/home', UserHome::class)->name('maestro.admin.home');
Route::get('/login', UserLoginForm::class)->name('maestro.users.login');

Route::prefix('users')->group(function () {
    Route::get('/', UserIndex::class)->name('maestro.users.index');
    Route::get('/create', UserForm::class)->name('maestro.users.create');
    Route::get('/{id}/edit', UserForm::class)->name('maestro.users.edit');
    Route::get('/{id}/view', UserView::class)->name('maestro.users.view');
});