<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () use ($router) {
    return $router->app->version();
});
//Registro
$router->post('/auth/register','AuthController@register');
//Login --> crea el token
$router->post('/auth/login','AuthController@postLogin');
//Rutas con token
$router->group(['middleware'=>'auth:api'],function($router){
    //Grupo usuarios + editors + admin
    $router->group(['middleware'=>'role:user'],function($router){
        //Usuarios
        $router->get('user/{id}', 'UsersController@get');
        //Peliculas
        $router->get('films', 'FilmsController@all');
        $router->get('films/{id}', 'FilmsController@get');
        //Listas
        $router->get('list/user/{id}', 'UsersFilmsController@getUser');
        $router->get('list/my/{id}', 'UsersFilmsController@getStat');
        $router->post('list', 'UsersFilmsController@addStat');
    });
    //Grupo editores + admin
    $router->group(['middleware'=>'role:editor'],function($router){
        //Peliculas
        $router->post('films', 'FilmsController@add');
        $router->put('films/{id}', 'FilmsController@put');
    });
    //Grupo administradores
    $router->group(['middleware'=>'role:admin'],function($router){
        $router->get('user', 'UsersController@all');
        $router->put('user/{id}', 'UsersController@put');
        //Listas
        $router->get('list', 'UsersFilmsController@all');
        $router->get('list/film/{id}', 'UsersFilmsController@getFilm');
        
    });
    
});
//$router->delete('films/{id}', 'FilmsController@remove');
//$router->delete('user/{id}', 'UsersController@remove');