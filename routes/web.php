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

Route::get('/', [
    'uses'=>'App\Http\Controllers\ZaloController@login',
]);
Route::get('/login', [
    'as'=>'login',
    'uses'=>'App\Http\Controllers\ZaloController@login'
]);

Route::prefix('dashboard')->group(function () {
    Route::get('/friend-list', [
        'as'=>'friend-list',
        'uses'=>'App\Http\Controllers\ZaloController@friendList'
    ]);
    Route::get('/friend-list/{keyword}', [
        'uses'=>'App\Http\Controllers\ZaloController@search'
    ]);
    Route::get('/profile', [
        'as'=>'profile',
        'uses'=>'App\Http\Controllers\ZaloController@profile'
    ]);
    Route::get('/invite-list', [
        'as'=>'invite-list',
        'uses'=>'App\Http\Controllers\ZaloController@inviteList'
    ]);
});

Route::get('/add/{id}', [
    'as'=>'social.add',
    'uses'=>'App\Http\Controllers\ZaloController@add'
]);
Route::post('/send-message}', [
    'as'=>'social.sendmessage',
    'uses'=>'App\Http\Controllers\ZaloController@sendmessage'
]);
Route::get('/dashboard', [
    'as'=>'dashboard',
    'uses'=>'App\Http\Controllers\ZaloController@dashboard'
]);
route::get('/dashboard/oa',[
    'uses'=>'App\Http\Controllers\OAController@dashboard'
]);

Route::get('/oa/user', [
    'as'=>'oa.user',
    'uses'=>'App\Http\Controllers\OAController@login'
]);


Route::get('/test', [
    'as'=>'test',
    'uses'=>'App\Http\Controllers\ZaloController@test'
]);
