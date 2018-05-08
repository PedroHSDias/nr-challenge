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

Route::get('/',['as'=>'home','uses'=>'CrawlerController@index']);
Route::get('pullcnpq',['as'=>'pullcnpq','uses'=>'CrawlerController@pullcnpq']);
Route::get('download/{id}',['as'=>'download','uses'=>'CrawlerController@download']);