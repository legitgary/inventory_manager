<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('welcome');
    // return Illuminate\Mail\Markdown::parse(file_get_contents(base_path() . '/README.md'));
    return Illuminate\Support\Str::markdown(file_get_contents(base_path() . '/README.md'));

});

Route::get('/users', function () {
    return view('users', ['users' => App\Models\User::all()]);
});
