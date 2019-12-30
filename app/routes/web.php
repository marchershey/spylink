<?php

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

Auth::routes();

/* ----------------------------- INDEX -------------------------------- */

// Index Views
Route::get('/', function () {return redirect('/index');});
Route::get('/index', function () {return view('pages.index.index');});

// Links
Route::get('/~{lid}+', 'LinkController@index');
Route::get('/~{lid}', 'LinkController@redirect');

/* --------------------------- RESOURCES ------------------------------ */

/*
 * Spylink Store
 * Location: /index
 */
Route::post('/link/create', 'LinkController@store');
