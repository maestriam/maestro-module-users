<?php

use Illuminate\Support\Facades\Route;
use Maestro\Users\Views\Pages\UserView;
use Maestro\Users\Views\Pages\UserIndex;
use Maestro\Users\Views\Pages\UserForm;
use Maestro\Users\Views\Pages\UserHome;
use Maestro\Users\Views\Pages\UserLoginForm;

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
Route::get('/logout', 'UserController@logout')->name('maestro.users.logout');
