<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {

    Route::get('signin', [
        'as' => 'auth.signin',
        'uses' => 'AuthController@signin'
    ]);

    Route::get('github', [
        'as' => 'auth.github.oauth',
        'uses' => 'AuthController@githubRedirect'
    ]);

    Route::get('github/callback', [
        'as' => 'auth.github.callback',
        'uses' => 'AuthController@githubCallback'
    ]);

    Route::get('signout', [
        'as' => 'auth.signout',
        'uses' => 'AuthController@signout'
    ]);

});

Route::resource('account/user', 'UserController');

Route::get('account/user/{user}/icon', [
    'as' => 'user.icon',
    'uses' => 'UserController@icon'
]);

Route::resource('account/permission', 'Auth\PermissionController', [
    'only' => ['index', 'store', 'destroy', 'show']
]);

Route::resource('issue', 'IssueController', [
    'only' => ['index', 'create', 'store', 'show']
]);

Route::get('issue/{issue}/comment', [
    'as' => 'issue.comment.list',
    'uses' => 'IssueController@listComment'
]);

Route::post('issue/{issue}/comment', [
    'as' => 'issue.comment.post',
    'uses' => 'IssueController@comment'
]);

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@home'
]);

Route::get('hit', [
    'as' => 'hit',
    'uses' => 'HomeController@hit'
]);

Route::get('hit/reset', [
    'as' => 'hit.reset',
    'uses' => 'HomeController@reset'
]);

Route::get('{view}', [
    'as' => 'view',
    'uses' => 'HomeController@playView'
])->where('view', '.+');
