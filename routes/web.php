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
    Route::get('/dashboard',[
        'uses'=>'App\Http\Controllers\ZaloController@dashboard'
    ]);
    Route::get('/friend-list', [
        'as'=>'friend-list',
        'uses'=>'App\Http\Controllers\ZaloController@friendList'
    ]);
    Route::get('/invite-list/{keyword}', [
    'uses'=>'App\Http\Controllers\ZaloController@inviteSearch'
    ]);
    Route::get('/friend-list/{keyword}', [
        'uses'=>'App\Http\Controllers\ZaloController@friendSearch'
    ]);
    Route::get('/profile', [
        'as'=>'profile',
        'uses'=>'App\Http\Controllers\ZaloController@profile'
    ]);
    Route::get('/invite-list', [
        'as'=>'invite-list',
        'uses'=>'App\Http\Controllers\ZaloController@inviteList'
    ]);
Route::get('/invite-list/{keyword}', [
    'uses'=>'App\Http\Controllers\ZaloController@inviteSearch'
]);
    Route::get('/send-message/{id}', [
        'as'=>'send-message',
        'uses'=>'App\Http\Controllers\ZaloController@sendMessage'
    ]);
    Route::post('/send-message/{sendIds}', [
        'as'=>'send',
        'uses'=>'App\Http\Controllers\ZaloController@send'
    ]);
Route::post('/send-preview', [
    'uses'=>'App\Http\Controllers\ZaloController@sendPreview'
]);
    Route::get('/send-invite/{id}', [
        'as'=>'send-invite',
        'uses'=>'App\Http\Controllers\ZaloController@sendInvite'
    ]);
    Route::post('/send-invite/{sendIds}', [
        'as'=>'invite',
        'uses'=>'App\Http\Controllers\ZaloController@invite'
    ]);
Route::post('/invite-preview', [
    'uses'=>'App\Http\Controllers\ZaloController@invitePreview'
]);
    Route::get('/post-status', [
        'as'=>'make-status',
        'uses'=>'App\Http\Controllers\ZaloController@makeStatus'
    ]);
    Route::post('/post-status', [
        'as'=>'post-status',
        'uses'=>'App\Http\Controllers\ZaloController@postStatus'
    ]);
Route::post('/status-preview', [
    'uses'=>'App\Http\Controllers\ZaloController@statusPreview'
]);
Route::post('/status-preview', [
    'uses'=>'App\Http\Controllers\ZaloController@statusPreview'
]);
Route::post('/extract-process', [
    'uses'=>'App\Http\Controllers\ZaloController@extractProcess'
]);
Route::post('/preview-url', [
    'uses'=>'App\Http\Controllers\ZaloController@previewUrl'
]);
Route::get('/refresh-token',[
    'as'=>'refresh-token',
    'uses'=>'App\Http\Controllers\ZaloController@refreshToken'
]);
Route::prefix('oa')->group(function () {
    Route::get('/',[
        'as'=>'oa-token',
        'uses'=>'App\Http\Controllers\OAController@getToken'
    ]);
    Route::get('/dashboard',[
        'uses'=>'App\Http\Controllers\OAController@dashboard'
    ]);
    Route::get('/list',[
        'as'=>'oa-list',
               'uses'=>'App\Http\Controllers\OAController@oaList',
    ]);
});



Route::prefix('test')->group(function () {
    Route::get('/', [
        'as'=>'test',
        'uses'=>'App\Http\Controllers\TestController@login'
    ]);
    Route::get('/dashboard', [
        'as'=>'test.dashboard',
        'uses'=>'App\Http\Controllers\TestController@dashboard'
    ]);
    Route::get('/friend-list', [
        'as'=>'test-friend-list',
        'uses'=>'App\Http\Controllers\TestController@friendList'
    ]);
    Route::get('/friend-list/{keyword}', [
        'uses'=>'App\Http\Controllers\TestController@friendSearch'
    ]);
    Route::get('/profile', [
        'as'=>'test-profile',
        'uses'=>'App\Http\Controllers\TestController@profile'
    ]);
    Route::get('/invite-list', [
        'as'=>'test-invite-list',
        'uses'=>'App\Http\Controllers\TestController@inviteList'
    ]);
    Route::get('/invite-list/{keyword}', [
        'uses'=>'App\Http\Controllers\TestController@inviteSearch'
    ]);
    Route::get('/send-message/{id}', [
        'as'=>'test-send-message',
        'uses'=>'App\Http\Controllers\TestController@sendMessage'
    ]);
//    Route::post('/send-message', [
//        'as'=>'test-send-messages',
//        'uses'=>'App\Http\Controllers\TestController@sendMessages'
//    ]);

    Route::post('/send-message/{sendIds}', [
        'as'=>'test-send',
        'uses'=>'App\Http\Controllers\TestController@send'
    ]);
    Route::post('/send-preview', [
        'uses'=>'App\Http\Controllers\TestController@sendPreview'
    ]);
    Route::post('/status-preview', [
        'uses'=>'App\Http\Controllers\TestController@statusPreview'
    ]);
    Route::post('/invite-preview', [
        'uses'=>'App\Http\Controllers\TestController@invitePreview'
    ]);
    Route::get('/send-invite/{id}', [
        'as'=>'test-send-invite',
        'uses'=>'App\Http\Controllers\TestController@sendInvite'
    ]);
    Route::post('/send-invite/{sendIds}', [
        'as'=>'test-invite',
        'uses'=>'App\Http\Controllers\TestController@invite'
    ]);
    Route::get('/post-status', [
        'as'=>'test-make-status',
        'uses'=>'App\Http\Controllers\TestController@makeStatus'
    ]);
    Route::post('/post-status', [
        'as'=>'test-post-status',
        'uses'=>'App\Http\Controllers\TestController@postStatus'
    ]);
    Route::get('/preview-url', [
        'as'=>'test-preview-url',
        'uses'=>'App\Http\Controllers\TestController@urlPreview'
    ]);
    Route::post('/preview-url', [
        'as'=>'test-url-preview',
        'uses'=>'App\Http\Controllers\TestController@previewUrl'
    ]);
    Route::get('/utc-time', [
        'uses'=>'App\Http\Controllers\TestController@utcTime'
    ]);
});

//Route::get('/add/{id}', [
//    'as'=>'social.add',
//    'uses'=>'App\Http\Controllers\ZaloController@add'
//]);
////Route::post('/send-message}', [
////    'as'=>'social.sendmessage',
////    'uses'=>'App\Http\Controllers\ZaloController@sendmessage'
////]);
//Route::get('/dashboard', [
//    'as'=>'dashboard',
//    'uses'=>'App\Http\Controllers\ZaloController@dashboard'
//]);
//route::get('/dashboard/oa',[
//    'uses'=>'App\Http\Controllers\OAController@dashboard'
//]);
//
//Route::get('/oa/user', [
//    'as'=>'oa.user',
//    'uses'=>'App\Http\Controllers\OAController@login'
//]);
//
//
//Route::get('/test', [
//    'as'=>'test',
//    'uses'=>'App\Http\Controllers\ZaloController@test'
//]);
