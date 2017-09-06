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

use Illuminate\Support\Facades\Route;

Route::get( '/', ['uses' => 'ArticlesController@index', 'as' => 'home'] );

//API's
Route::group( ['prefix' => 'api'], function ()
{
    Route::get( 'articles', ['uses' => 'ArticlesApiController@articles', 'as' => 'articles.list.api'] );

    Route::get( 'search/{data}', ['uses' => 'SearchController@ajaxSearch', 'as' => 'search.ajax.api'] );

    //Snippets Api
    Route::resource( 'snippets', 'SnippetController' );

    Route::get( '/comment/{id}/edit', ['uses' => 'CommentsController@show', 'as' => 'getcomment.ajax.api'] );

    Route::post( '/comment/like', ['uses' => 'CommentsController@like', 'as' => 'likecomment.ajax.api'] );

    Route::post('/comment/post', ['uses' => 'CommentsController@storeAjax', 'as' => 'storecomment.ajax.api']);

    Route::post('/login', ['uses' => 'AuthAjaxController@login', 'as' => 'login.ajax.api']);

} );

Route::group( ['prefix' => 'social'], function ()
{

    Route::get( '/login/{provider}', ['uses' => 'SocialLoginController@login', 'as' => 'social.login'] );
} );


Route::get( 'auth/logout', ['uses' => 'Auth\AuthController@getLogout', 'as' => 'user.logout'] );

Route::get( 'auth/login', ['uses' => 'Auth\AuthController@getLogin', 'as' => 'user.login'] );

Route::get( '/articles', ['uses' => 'ArticlesController@index', 'as' => 'articles.list'] );

Route::get( 'articles/{slug}', ['uses' => 'ArticlesController@show', 'as' => 'articles.single'] );

Route::get( '/categories', ['uses' => 'CategoriesController@index', 'as' => 'categories.list'] );

Route::get( '/categories/{name}', ['uses' => 'CategoriesController@show', 'as' => 'categories.single'] );

//Route::get('admin', ['uses' => 'AdminController@index', 'as' => 'admin.home']);


Route::group( ['middleware' => 'auth'], function ()
{
    Route::get( 'user/{id}', ['uses' => 'UsersController@show', 'as' => 'user.single'] );
} );


Route::get( 'forum/thread/{category}/{id}', ['uses' => 'ThreadsController@show', 'as' => 'threads.single.show'] );
Route::get( 'forum', ['uses' => 'ThreadsController@index', 'as' => 'threads.list'] );
Route::get( 'forum/{slug}', ['uses' => 'ThreadsController@showByCategory', 'as' => 'threads.list.single'] );
Route::get( 'forum/thread/create', ['uses' => 'ThreadsController@create', 'as' => 'threads.new.create'] );
Route::post( 'forum/thread/create', ['uses' => 'ThreadsController@store', 'as' => 'threads.new.store'] );

Route::post( 'forum/thread/comment/create', ['uses' => 'CommentsController@store', 'as' => 'comments.new.store'] );
Route::post( 'forum/thread/comment/update', ['uses' => 'CommentsController@update', 'as' => 'comment.update'] );


Route::get( 'portfolio', ['uses' => 'PagesController@getPortfolio', 'as' => 'portfolio'] );

Route::group( ['prefix' => 'admin', 'middleware' => 'auth.admin'], function ()
{


    Route::get( '/', ['uses' => 'UsersController@adminHome', 'as' => 'admin.home'] );
    Route::get( 'sitemap', ['uses' => 'SitemapController@generate_xml', 'as' => 'admin.sitemap.generate'] );

    Route::get( 'posts/create', ['uses' => 'PostsController@create', 'as' => 'admin.posts.create'] );
    Route::get( 'posts', ['uses' => 'PostsController@index', 'as' => 'admin.posts.list'] );
    Route::post( 'posts/create', ['uses' => 'PostsController@store', 'as' => 'admin.posts.store'] );
    Route::get( 'posts/{slug}/edit', ['uses' => 'PostsController@edit', 'as' => 'admin.posts.edit'] );
    Route::put( 'posts/{slug}/update', ['uses' => 'PostsController@update', 'as' => 'admin.posts.update'] );
    Route::post( 'posts/publish', ['uses' => 'PostsController@publish', 'as' => 'admin.posts.publish'] );
    Route::post( 'posts/unpublish', ['uses' => 'PostsController@unpublish', 'as' => 'admin.posts.unpublish'] );
    Route::delete( 'posts/{slug}', ['uses' => 'PostsController@destroy', 'as' => 'admin.posts.delete'] );


    Route::get( 'categories', ['uses' => 'CategoriesController@adminIndex', 'as' => 'admin.categories.list'] );
    Route::get( 'categories/create', ['uses' => 'CategoriesController@create', 'as' => 'admin.categories.create'] );
    Route::post( 'categories/create', ['uses' => 'CategoriesController@store', 'as' => 'admin.categories.store'] );
    Route::get( 'categories/{slug}/edit', ['uses' => 'CategoriesController@edit', 'as' => 'admin.categories.edit'] );
    Route::put( 'categories/{slug}/update', ['uses' => 'CategoriesController@update', 'as' => 'admin.categories.update'] );

    Route::get( 'tags', ['uses' => 'TagsController@adminIndex', 'as' => 'admin.tags.list'] );
    Route::get( 'tags/create', ['uses' => 'TagsController@create', 'as' => 'admin.tags.create'] );
    Route::post( 'tags/create', ['uses' => 'TagsController@store', 'as' => 'admin.tags.store'] );
    Route::get( 'tags/{slug}/edit', ['uses' => 'TagsController@edit', 'as' => 'admin.tags.edit'] );
    Route::put( 'tags/{slug}/update', ['uses' => 'TagsController@update', 'as' => 'admin.tags.update'] );


    Route::get( 'media', ['uses' => 'MediaController@index', 'as' => 'admin.media.list'] );
    Route::get( 'media/create', ['uses' => 'MediaController@create', 'as' => 'admin.media.create'] );
    Route::post( 'media/create', ['uses' => 'MediaController@store', 'as' => 'admin.media.store'] );
    Route::put( 'media/edit', ['uses' => 'MediaController@update', 'as' => 'admin.media.update'] );


    Route::get( 'user', ['uses' => 'UsersController@index', 'as' => 'admin.user.list'] );
    Route::get( 'user/create', ['uses' => 'UsersController@create', 'as' => 'admin.user.create'] );
    Route::post( 'user/create', ['uses' => 'UsersController@store', 'as' => 'admin.user.store'] );
    Route::get( 'user/{id}/edit', ['uses' => 'UsersController@edit', 'as' => 'admin.user.edit'] );
    Route::put( 'user/{id}/edit', ['uses' => 'UsersController@update', 'as' => 'admin.user.update'] );
    Route::delete( 'user/{id}', ['uses' => 'UsersController@destroy', 'as' => 'admin.user.delete'] );

    Route::get('/thread/generate', ['uses' => 'ThreadsController@generateArticlesThread', 'as' => 'admin.articles.thread.generate']);
    Route::get( 'thread/categories', ['uses' => 'ThreadCategoriesController@index', 'as' => 'admin.threads.category.list'] );
    Route::get( 'thread/categories/create', ['uses' => 'ThreadCategoriesController@create', 'as' => 'admin.threads.category.create'] );
    Route::post( 'thread/categories/create', ['uses' => 'ThreadCategoriesController@store', 'as' => 'admin.threads.category.store'] );
    Route::get( 'thread/categories/{slug}/edit', ['uses' => 'ThreadCategoriesController@edit', 'as' => 'admin.threads.category.edit'] );
    Route::put( 'thread/categories/{slug}/update', ['uses' => 'ThreadCategoriesController@update', 'as' => 'admin.threads.category.update'] );
    Route::delete( 'thread/categories/{slug}', ['uses' => 'ThreadCategoriesController@destroy', 'as' => 'admin.threads.category.delete'] );

    Route::get('threads', ['uses' => 'ThreadsController@index', 'as' => 'admin.threads.list']);
    Route::get('threads/{id}/edit', ['uses' => 'ThreadsController@edit', 'as' => 'admin.threads.edit']);
    Route::put('threads/{id}/edit', ['uses' => 'ThreadsController@update', 'as' => 'admin.threads.update']);
    Route::delete('threads/{id}', ['uses' => 'ThreadsController@destroy', 'as' => 'admin.threads.delete']);


    Route::get('books', ['uses' => 'BooksController@index', 'as' => 'admin.books.list']);
    Route::get('books/upload', ['uses' => 'BooksController@create', 'as' => 'admin.books.create']);
    Route::post('books/upload', ['uses' => 'BooksController@store', 'as' => 'admin.books.store']);
    Route::get('books/{id}/download', ['uses' => 'BooksController@download', 'as' => 'admin.books.download']);

    Route::get('books/{id}/edit', ['uses' => 'BooksController@edit', 'as' => 'admin.books.edit']);
    Route::put('books/{id}/edit', ['uses' => 'BooksController@update', 'as' => 'admin.books.update']);

    Route::delete('books/{id}', ['uses' => 'BooksController@destroy', 'as' => 'admin.books.delete']);


} );

Route::get('/about', ['uses' => 'PagesController@about', 'as' => 'about']);
Route::get('/contact', ['uses' => 'PagesController@contact', 'as' => 'contact']);
Route::post('/contact', ['uses' => 'PagesController@contactPost', 'as' => 'contact.post']);
Route::get('/privacy', ['uses' => 'PagesController@privacy', 'as' => 'privacy']);

Route::post('/subscribe', ['uses' => 'Auth\AuthController@subscribe', 'as' => 'user.subscribe']);

Route::controllers( [
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
] );
