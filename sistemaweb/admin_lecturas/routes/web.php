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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
	//Roles
	Route::post('roles/store', 'RoleController@store')->name('roles.store')
		->middleware('permission:roles.create');

	Route::get('roles', 'RoleController@index')->name('roles.index')
		->middleware('permission:roles.index');

	Route::get('roles/create', 'RoleController@create')->name('roles.create')
		->middleware('permission:roles.create');

	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
		->middleware('permission:roles.edit');

	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
		->middleware('permission:roles.show');

	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
		->middleware('permission:roles.destroy');

	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
		->middleware('permission:roles.edit');
	//Users
	Route::get('users', 'UserController@index')->name('users.index')
		->middleware('permission:users.index');

	Route::put('users/{user}', 'UserController@update')->name('users.update')
		->middleware('permission:users.edit');

	Route::get('users/{user}', 'UserController@show')->name('users.show')
		->middleware('permission:users.show');

	Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
		->middleware('permission:users.destroy');

	Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
		->middleware('permission:users.edit');
		//Personas
	Route::post('personas/store', 'PersonaController@store')->name('personas.store')
		->middleware('permission:personas.create');

	Route::get('personas', 'PersonaController@index')->name('personas.index')
		->middleware('permission:personas.index');

	Route::get('personas/create', 'PersonaController@create')->name('personas.create')
		->middleware('permission:personas.create');

	Route::put('personas/{persona}', 'PersonaController@update')->name('personas.update')
		->middleware('permission:personas.edit');

	Route::get('personas/{persona}', 'PersonaController@show')->name('personas.show')
		->middleware('permission:personas.show');

	Route::delete('personas/{persona}', 'PersonaController@destroy')->name('personas.destroy')
		->middleware('permission:personas.destroy');

	Route::get('personas/{persona}/edit', 'PersonaController@edit')->name('personas.edit')
		->middleware('permission:personas.edit');

	Route::get('descargar-personas', 'PersonaController@pdf')->name('personas.pdf');
		//Medidores
	Route::post('medidores/store', 'MedidorController@store')->name('medidores.store')
		->middleware('permission:medidores.create');

	Route::get('medidores', 'MedidorController@index')->name('medidores.index')
		->middleware('permission:medidores.index');

	Route::get('medidores/create', 'MedidorController@create')->name('medidores.create')
		->middleware('permission:medidores.create');

	Route::put('medidores/{medidor}', 'MedidorController@update')->name('medidores.update')
		->middleware('permission:medidores.edit');

	Route::get('medidores/{medidor}', 'MedidorController@show')->name('medidores.show')
		->middleware('permission:medidores.show');

	Route::delete('medidores/{medidor}', 'MedidorController@destroy')->name('medidores.destroy')
		->middleware('permission:medidores.destroy');

	Route::get('medidores/{medidor}/edit', 'MedidorController@edit')->name('medidores.edit')
		->middleware('permission:medidores.edit');
	//Lecturas
	
Route::put('lecturas/store', 'LecturaController@update')->name('lecturas.update')
		->middleware('permission:lecturas.edit');

	Route::get('lecturas', 'LecturaController@index')->name('lecturas.index')
		->middleware('permission:lecturas.index');

	Route::get('lecturas/create', 'LecturaController@create')->name('lecturas.create')
		->middleware('permission:lecturas.create');

	Route::put('lecturas/{lectura}', 'LecturaController@update')->name('lecturas.update')
		->middleware('permission:lecturas.edit');

	Route::get('lecturas/{lectura}', 'LecturaController@show')->name('lecturas.show')
		->middleware('permission:lecturas.show');

	Route::delete('lecturas/{lectura}', 'LecturaController@destroy')->name('lecturas.destroy')
		->middleware('permission:lecturas.destroy');

	Route::get('lecturas/{lectura}/edit', 'LecturaController@edit')->name('lecturas.edit')
		->middleware('permission:lecturas.edit');

	Route::get('descargar-lecturas', 'LecturaController@pdf')->name('lecturas.pdf');
//////
});