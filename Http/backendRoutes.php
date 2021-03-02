<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/comments'], function (Router $router) {
    $router->bind('comment', function ($id) {
        return app('Modules\Comments\Repositories\CommentRepository')->find($id);
    });
    $router->get('comments', [
        'as' => 'admin.comments.comment.index',
        'uses' => 'CommentController@index',
        'middleware' => 'can:comments.comments.index'
    ]);
    $router->get('comments/create', [
        'as' => 'admin.comments.comment.create',
        'uses' => 'CommentController@create',
        'middleware' => 'can:comments.comments.create'
    ]);
    $router->post('comments', [
        'as' => 'admin.comments.comment.store',
        'uses' => 'CommentController@store',
        'middleware' => 'can:comments.comments.create'
    ]);
    $router->get('comments/{comment}/edit', [
        'as' => 'admin.comments.comment.edit',
        'uses' => 'CommentController@edit',
        'middleware' => 'can:comments.comments.edit'
    ]);
    $router->put('comments/{comment}', [
        'as' => 'admin.comments.comment.update',
        'uses' => 'CommentController@update',
        'middleware' => 'can:comments.comments.edit'
    ]);
    $router->delete('comments/{comment}', [
        'as' => 'admin.comments.comment.destroy',
        'uses' => 'CommentController@destroy',
        'middleware' => 'can:comments.comments.destroy'
    ]);
// append

});
