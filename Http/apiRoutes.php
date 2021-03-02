<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' => 'comments/v1'], function (Router $router) {
    $router->group(['prefix' => '/comments'], function (Router $router) {
        //Route create
        $router->post('/', [
            'as' => 'api.comments.comment.create',
            'uses' => 'CommentApiController@create',
            //'middleware' => 'auth-can:comments.comments.create'
        ]);
        //Route index
        $router->get('/', [
            'as' => 'api.comments.comment.index',
            'uses' => 'CommentApiController@index',
            //'middleware' => 'auth-can:comments.comments.index'
        ]);

        //Route show
        $router->get('/{criteria}', [
            'as' => 'api.comments.comment.show',
            'uses' => 'CommentApiController@show',
            'middleware' => 'auth-can:comments.comments.show'
        ]);

        //Route update
        $router->put('/{criteria}', [
            'as' => 'api.comments.comment.update',
            'uses' => 'CommentApiController@update',
          'middleware' => 'auth-can:comments.comments.edit'
        ]);

        //Route delete
        $router->delete('/{criteria}', [
            'as' => 'api.comments.comment.delete',
            'uses' => 'CommentApiController@delete',
            'middleware' => 'auth-can:comments.comments.destroy'
        ]);
    });
});
