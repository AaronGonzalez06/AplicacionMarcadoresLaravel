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

/*use App\User;
use App\Categoria;
use App\Url;*/

Route::get('/', function () {
    /*$users = User::all();
    foreach($users as $user){
        echo $user->name . "<br/>";
        foreach($user->categorias as $categoria){
            echo $categoria->name . " y cantidad de urls ".count($categoria->urls) . "<br/>";
        }
        echo "<hr/>";
    }
    die();*/
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/configuracion', 'UserController@configuracion')->name('configuracion');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::post('/user/update/password', 'UserController@updatePassword')->name('user.update.password');
Route::get('/categoria', 'CategoriaController@categoriaAdd')->name('categoria.add');
Route::post('/categoria/add', 'CategoriaController@newCategoria')->name('categoria.add.new');
Route::get('/categoria/marcadores/{id}', 'CategoriaController@categoriaMarcadores')->name('categoria.marcadores');
Route::get('/marcadores/delete/{id}', 'MarcadorController@delete')->name('marcador.delete');
Route::get('/marcador/add', 'MarcadorController@marcadorAdd')->name('marcador.add');
Route::post('/marcador/add/new', 'MarcadorController@newMarcador')->name('marcador.add.new');
Route::get('/categorias/delete/{id}', 'CategoriaController@delete')->name('categoria.delete');
Route::get('/marcador/editar/{id}', 'MarcadorController@EditarMarcador')->name('marcador.editar');
Route::post('/marcador/update', 'MarcadorController@update')->name('marcador.update');
Route::get('/marcador/ultimosMarcadores', 'MarcadorController@ultimosMarcadores')->name('marcador.listado');
Route::get('/marcador/buscar/{titulo?}', 'MarcadorController@buscadorMarcadores')->name('marcador.buscar');
Route::get('/marcador/fav/{id}', 'MarcadorController@addFav');
Route::get('/marcador/fav/delete/{id}', 'MarcadorController@deleteFav');
Route::get('/marcador/guardado', 'MarcadorController@guardado')->name('marcador.guardado');
