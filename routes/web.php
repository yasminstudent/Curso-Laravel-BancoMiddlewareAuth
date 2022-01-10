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

Route::get('/', function () {
    return view('welcome');
});

//Usando query builder
Route::prefix('/tarefas')->group(function (){
    Route::get('/', 'TarefasController@index')->name('tarefas.list');

    Route::get('add', 'TarefasController@create')->name('tarefas.add'); //Tela de adição
    Route::post('add', 'TarefasController@store'); //Ação de adição

    Route::get('edit/{id}', 'TarefasController@edit')->name('tarefas.edit'); //Tela de edição
    Route::post('edit/{id}', 'TarefasController@update'); //Ação de ediçãi

    Route::get('delete/{id}', 'TarefasController@destroy')->name('tarefas.del'); //Ação de deletar

    Route::get('marcar/{id}', 'TarefasController@done')->name('tarefas.done'); //Ação de marcar como resolvido ou mão
});

//Usando ORM
Route::prefix('/orm/tarefas')->group(function (){
    Route::get('/', 'TarefasORMController@index')->name('tarefas.list');

    Route::get('add', 'TarefasORMController@create')->name('tarefas.add'); //Tela de adição
    Route::post('add', 'TarefasORMController@store'); //Ação de adição

    Route::get('edit/{id}', 'TarefasORMController@edit')->name('tarefas.edit'); //Tela de edição
    Route::post('edit/{id}', 'TarefasORMController@update'); //Ação de ediçãi

    Route::get('delete/{id}', 'TarefasORMController@destroy')->name('tarefas.del'); //Ação de deletar

    Route::get('marcar/{id}', 'TarefasORMController@done')->name('tarefas.done'); //Ação de marcar como resolvido ou mão
});

//Usando controller pré montada
Route::resource('todo', 'TodoController');
/*
    Esse comando cria as seguintes rotas:
    Método -    Rota            -    Nome da Rota    -    Método Acionado    -    Funcionalidade
    GET    -    /todo           -    todo.index      -    index              -    Lista os items
    GET    -    /todo/{id}      -    todo.show       -    show               -    Exibe item específico
    GET    -    /todo/create    -    todo.create     -    create             -    Form p/ criar item
    GET    -    /todo/{id}/edit -    todo.edit       -    edit               -    Form p/ editar item
    POST   -    /todo           -    todo.store      -    store              -    Ação de criar item
    PUT    -    /todo/{id}      -    todo.update     -    update             -    Ação de editar item
    DELETE -    /todo/{id}      -    todo.destroy    -    destroy            -    Ação de excluir item
*/

//Route::get('/login', function (){ echo "Página de Login"; })->name('login');
Route::view('/rota_com_middleware', 'welcome')->middleware('auth');
/*
    Comandos usados p/ acionar o login do Laravel (tem na documentação):
        composer require laravel/ui:^2.4
        php artisan ui vue --auth

    p/ criar projeto já com o login incluso:
        laravel new blog --auth

    p/ o bootstrap pegar:
        composer require laravel/ui
        php artisan ui bootstrap
        php artisan ui bootstrap --auth
        npm install
        npm run dev
*/
Auth::routes();
Route::post('/login', 'Auth\LoginController@authenticate');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
