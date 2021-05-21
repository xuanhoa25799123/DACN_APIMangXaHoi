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

    Route::get('/dashboard', [
        'uses' => 'App\Http\Controllers\ZaloController@dashboard'
    ]);
    Route::get('/friend-list', [
        'as' => 'friend-list',
        'uses' => 'App\Http\Controllers\ZaloController@friendList'
    ]);
    Route::get('/invite-list/{keyword}', [
        'uses' => 'App\Http\Controllers\ZaloController@inviteSearch'
    ]);
    Route::get('/friend-list/{keyword}', [
        'uses' => 'App\Http\Controllers\ZaloController@friendSearch'
    ]);
    Route::get('/profile', [
        'as' => 'profile',
        'uses' => 'App\Http\Controllers\ZaloController@profile'
    ]);
    Route::get('/invite-list', [
        'as' => 'invite-list',
        'uses' => 'App\Http\Controllers\ZaloController@inviteList'
    ]);
    Route::get('/invite-list/{keyword}', [
        'uses' => 'App\Http\Controllers\ZaloController@inviteSearch'
    ]);
    Route::get('/send-message/{id}', [
        'as' => 'send-message',
        'uses' => 'App\Http\Controllers\ZaloController@sendMessage'
    ]);
    Route::post('/send-message/{sendIds}', [
        'as' => 'send',
        'uses' => 'App\Http\Controllers\ZaloController@send'
    ]);
    Route::post('/send-preview', [
        'uses' => 'App\Http\Controllers\ZaloController@sendPreview'
    ]);
    Route::get('/send-invite/{id}', [
        'as' => 'send-invite',
        'uses' => 'App\Http\Controllers\ZaloController@sendInvite'
    ]);
    Route::post('/send-invite/{sendIds}', [
        'as' => 'invite',
        'uses' => 'App\Http\Controllers\ZaloController@invite'
    ]);
    Route::post('/invite-preview', [
        'uses' => 'App\Http\Controllers\ZaloController@invitePreview'
    ]);
    Route::get('/post-status', [
        'as' => 'make-status',
        'uses' => 'App\Http\Controllers\ZaloController@makeStatus'
    ]);
    Route::post('/post-status', [
        'as' => 'post-status',
        'uses' => 'App\Http\Controllers\ZaloController@postStatus'
    ]);
    Route::post('/status-preview', [
        'uses' => 'App\Http\Controllers\ZaloController@statusPreview'
    ]);
    Route::post('/status-preview', [
        'uses' => 'App\Http\Controllers\ZaloController@statusPreview'
    ]);
    Route::post('/extract-process', [
        'uses' => 'App\Http\Controllers\ZaloController@extractProcess'
    ]);
    Route::post('/preview-url', [
        'uses' => 'App\Http\Controllers\ZaloController@previewUrl'
    ]);
    Route::get('/refresh-token', [
        'as' => 'refresh-token',
        'uses' => 'App\Http\Controllers\ZaloController@refreshToken'
    ]);

Route::prefix('oa')->group(function () {
    Route::get('/get-token',[
        'as'=>'oa-token',
        'uses'=>'App\Http\Controllers\OAController@getToken'
    ]);
    Route::get('/dashboard',[
        'as'=>'oa-dashboard',
        'uses'=>'App\Http\Controllers\OAController@dashboard'
    ]);
    Route::get('/',[
        'as'=>'oa-home',
        'uses'=>'App\Http\Controllers\OAController@home'
    ]);

    Route::get('/list',[
        'as'=>'oa-list',
        'uses'=>'App\Http\Controllers\OAController@followersList',
    ]);
       Route::get('/list/{keyword}', [
        'uses'=>'App\Http\Controllers\OAController@followerSearch'
    ]);
    //   Route::get('/update-user/{id}', [
    //       'as'=>'update-user'
    //     'uses'=>'App\Http\Controllers\OAController@updateUser'
    // ]);
    Route::get('/article',[
        'as'=>'oa-article',
        'uses'=>'App\Http\Controllers\OAController@articleList',
    ]);
 
     Route::get('/article/edit/{id}', [
        'uses'=>'App\Http\Controllers\OAController@editArticle'
    ]);
       Route::get('/video/edit/{id}', [
        'uses'=>'App\Http\Controllers\OAController@editVideo'
    ]);
      Route::get('/article/search/{keyword}',[
        'uses'=>'App\Http\Controllers\OAController@articleSearch',
    ]);
     Route::get('/video/search/{keyword}',[
        'uses'=>'App\Http\Controllers\OAController@videoSearch',
    ]);
     Route::post('/article/search-date',[
        'uses'=>'App\Http\Controllers\OAController@articleSearchDate',
    ]);
    Route::post('/video/search-date',[
        'uses'=>'App\Http\Controllers\OAController@videoSearchDate',
    ]);
      Route::get('/article/text-article',[
        'uses'=>'App\Http\Controllers\OAController@textArticle',
    ]);
    Route::get('/article/video-article',[
        'uses'=>'App\Http\Controllers\OAController@videoArticle',
    ]);
       Route::get('/reset-article-date',[
        'uses'=>'App\Http\Controllers\OAController@articleResetDate',
    ]);
       Route::get('/reset-video-date',[
        'uses'=>'App\Http\Controllers\OAController@videoResetDate',
    ]);
      Route::get('/delete-article/{id}',[
        'uses'=>'App\Http\Controllers\OAController@deleteArticle',
    ]);
     Route::get('/delete-video/{id}',[
        'uses'=>'App\Http\Controllers\OAController@deleteVideo',
    ]);
    Route::get('/select-article',[
        'as'=>'oa-article-select',
        'uses'=>'App\Http\Controllers\OAController@selectArticle',
    ]);
     Route::get('/video',[
        'as'=>'oa-video',
        'uses'=>'App\Http\Controllers\OAController@videoList',
    ]);
      
    Route::get('/create-text-article',[
        'as'=>'text-article',
        'uses'=>'App\Http\Controllers\OAController@createTextArticle',
    ]);
    Route::get('/create-video',[
        'uses'=>'App\Http\Controllers\OAController@createVideo',
    ]);
     Route::post('/store-video',[
         'as'=>'store-video',
        'uses'=>'App\Http\Controllers\OAController@storeVideo',
    ]);
     Route::post('/update-video/{id}',[
         'as'=>'update-video',
        'uses'=>'App\Http\Controllers\OAController@updateVideo',
    ]);
    Route::get('/create-video-article',[
        'as'=>'video-article',
        'uses'=>'App\Http\Controllers\OAController@createVideoArticle',
    ]);
    //      Route::post('/submit-video', [
    //     'uses'=>'App\Http\Controllers\TestController@videoArticle'
    // ]);
    //    Route::post('/submit-video', [
    //     'uses'=>'App\Http\Controllers\TestController@videoArticle'
    // ]);
        Route::post('/update-article',[
         'as'=>'update-article',
        'uses'=>'App\Http\Controllers\OAController@updateArticle',
    ]);
     Route::get('/create-article',[
        'uses'=>'App\Http\Controllers\OAController@createArticle',
    ]);
     Route::post('/store-article',[
         'as'=>'store-article',
        'uses'=>'App\Http\Controllers\OAController@storeArticle',
    ]);
     Route::get('/broadcast',[
         'as'=>'oa-broadcast',
        'uses'=>'App\Http\Controllers\OAController@Broadcast',
    ]);
    Route::get('/select-broadcast/{id}',[
        'uses'=>'App\Http\Controllers\OAController@selectBroadcast'
    ]);
    Route::get('/unselect-broadcast/{id}',[
        'uses'=>'App\Http\Controllers\OAController@unselectBroadcast'
    ]);
     Route::get('/broadcast/search/{keyword}',[
        'uses'=>'App\Http\Controllers\OAController@searchBroadcast',
    ]);
     Route::post('/broadcast/search-date',[
        'uses'=>'App\Http\Controllers\OAController@broadcastSearchDate',
    ]);
    
       Route::get('/reset-broadcast-date',[
        'uses'=>'App\Http\Controllers\OAController@broadcastResetDate',
    ]);
        Route::get('/view-broadcast/{id_str}',[
        'uses'=>'App\Http\Controllers\OAController@viewBroadcast',
    ]);
    Route::post('/send-broadcast',[
        'as'=>'oa-send-broadcast',
        'uses'=>'App\Http\Controllers\OAController@sendBroadcast',
    ]);
});



Route::prefix('test')->group(function () {
    Route::get('/', [
        'as'=>'test',
        'uses'=>'App\Http\Controllers\TestController@login'
    ]);
      Route::get('/create-video-article', [
        'as'=>'test-article',
        'uses'=>'App\Http\Controllers\TestController@videoArticle'
    ]);
     Route::get('/create-article', [
        'uses'=>'App\Http\Controllers\TestController@createArticle'
    ]);
    Route::post('/create-video', [
        'as'=>'test-create-video',
        'uses'=>'App\Http\Controllers\TestController@createVideo'
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
    Route::get('/article',[
        'as'=>'test-article',
        'uses'=>'App\Http\Controllers\TestController@articleList',
    ]);
    Route::get('/test-date',[
        'uses'=>'App\Http\Controllers\TestController@testDate',
    ]);
       Route::get('/edit-article',[
        'uses'=>'App\Http\Controllers\TestController@editArticle',
    ]);
    //  Route::get('/edit-video',[
    //     'uses'=>'App\Http\Controllers\TestController@editVideo',
    // ]);
     Route::post('/update-article',[
         'as'=>'test-update-article',
        'uses'=>'App\Http\Controllers\TestController@updateArticle',
    ]);
     Route::get('/search-broadcast',[
        'uses'=>'App\Http\Controllers\TestController@searchBroadcast',
    ]);
     Route::post('/search-broadcast-2',[
           'as'=>'test-search-broadcast',
        'uses'=>'App\Http\Controllers\TestController@searchBroadcast2',
    ]);
     Route::get('/broadcast',[
        'uses'=>'App\Http\Controllers\TestController@Broadcast',
    ]);
    Route::get('/view-broadcast/{id_str}',[
        'uses'=>'App\Http\Controllers\TestController@viewBroadcast',
    ]);
    Route::post('/send-broadcast',[
        'as'=>'test-send-broadcast',
        'uses'=>'App\Http\Controllers\TestController@sendBroadcast',
    ]);
      Route::get('/broadcast/reset-date',[
        'uses'=>'App\Http\Controllers\TestController@resetDate',
    ]);
      Route::get('/paginate',[
        'uses'=>'App\Http\Controllers\TestController@paginate',
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
