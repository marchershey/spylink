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

/*
 *
 * INDEX
 *
 */

Route::get('/', function () {return redirect('/index');});
Route::get('/index', function () {return view('pages.index.index');});
Route::get('/~{lid}+', 'SpyLinkController@index_view_link');
Route::get('/~{lid}', 'SpyLinkController@redirect');

// --------------------------------------------------------------------------

/*
 *
 * RESOURCES
 *
 */

Route::post('/index/create/spylink', 'SpyLinkController@store'); // Create SpyLink Form
